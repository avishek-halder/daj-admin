<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage User';
        $data['limit'] = $limit = (!empty($request->get('limit')) ? $request->get('limit') : 20);
        $q = $request->get('q');
        $data["rows"] = User::when($q,function($query) use ($q)
        {
            $query->where("users.fname","like","%".$q."%");
            $query->orWhere("users.lname","like","%".$q."%");
            $query->orWhere("users.phone_number","like","%".$q."%");

        })->paginate($data["limit"]);
        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        return view('admin.users.index', $data);
    }
}
