<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;

$adminurl = config('app.admin_path');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('cache-clear', function () {
    Artisan::call("cache:clear");
    Artisan::call("view:clear");
    Artisan::call("route:clear");
    Artisan::call('optimize:clear');
    echo "Compiled views cleared!<br>Application cache cleared!<br>Route cache cleared!<br>Configuration cache cleared!<br>Caches cleared successfully!";
});

Auth::routes();

//Frontend
Route::get('/', 'HomeController@home')->name('home_page');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully.');
    return redirect('/');
});

// Route::get('/admin', function(){    
//     return redirect('/admin/dashboard');
// });

//==== admin route==//
Route::group(['prefix' => $adminurl, 'namespace' => '\App\Http\Controllers\Admin'], function () {
    Route::post('unlock-screen', ['uses' => 'AdminController@postUnlockScreen', 'as' => 'postUnlockScreen']);
    Route::get('lock-screen', ['uses' => 'AdminController@getLockscreen', 'as' => 'getLockScreen']);
    Route::post('forgot', ['uses' => 'AdminController@postForgot', 'as' => 'postForgot']);
    Route::get('forgot', ['uses' => 'AdminController@getForgot', 'as' => 'getForgot']);
    Route::post('register', ['uses' => 'AdminController@postRegister', 'as' => 'postRegister']);
    Route::get('register', ['uses' => 'AdminController@getRegister', 'as' => 'getRegister']);
    Route::get('logout', ['uses' => 'AdminController@getLogout', 'as' => 'getLogout']);
    Route::post('login', ['uses' => 'AdminController@postLogin', 'as' => 'postLogin']);
    Route::get('login', ['uses' => 'AdminController@getLogin', 'as' => 'getLogin']);
});

//Route::get('/', 'HomeController@index')->name('home');
Route::group(['prefix' => $adminurl, 'middleware' => ['admin.auth'], 'namespace' => '\App\Http\Controllers\Admin'], function () {
    Route::get('/', ['uses' => 'AdminController@getIndex', 'as' => 'getIndex']);
    Route::get('/dashboard', ['uses' => 'AdminController@getIndex', 'as' => 'getAdminDashboard']);
    Route::get('/dashboard', ['uses' => 'AdminController@getIndex', 'as' => 'getAdminProfile']);


    //Menu Management
    Route::get('menu-management', ['uses' => 'MenusController@getIndex', 'as' => 'getMenus']);
    Route::post('menu-management/add-save-menu', ['uses' => 'MenusController@postAddSave', 'as' => 'postAddMenu']);
    Route::get('menu-management/edit/{id}', ['uses' => 'MenusController@editMenu', 'as' => 'getEditMenu']);
    Route::get('menu-management/delete/{id}', ['uses' => 'MenusController@deleteMenu', 'as' => 'deleteMenu']);
    Route::post('menu-management/edit-save-menu/{id}', ['uses' => 'MenusController@postUpdateSave', 'as' => 'postUpdateMenu']);

    //Privileges
    Route::get('privileges', ['uses' => 'MenusController@getPrivilege', 'as' => 'getPrivilege']);
    Route::get('privileges/add', ['uses' => 'MenusController@getAddPrivilege', 'as' => 'getAddPrivilege']);
    Route::post('privileges/add-save-privilege', ['uses' => 'MenusController@postAddPrivilege', 'as' => 'postAddPrivilege']);
    Route::get('privileges/edit/{id}', ['uses' => 'MenusController@getEditPrivilege', 'as' => 'getEditPrivilege']);
    Route::get('privileges/delete/{id}', ['uses' => 'MenusController@getDeletePrivilege', 'as' => 'getDeletePrivilege']);
    Route::post('privileges/edit-save-privilege/{id}', ['uses' => 'MenusController@postUpdatePrivilege', 'as' => 'postUpdatePrivilege']);

    //Admin Users
    Route::get('admin-users', ['uses' => 'AdminUsersController@getIndex', 'as' => 'getAdminUsers']);
    Route::get('admin-users/add', ['uses' => 'AdminUsersController@getAdd', 'as' => 'getAddAdminUser']);
    Route::post('admin-users/add-save', ['uses' => 'AdminUsersController@postAddSave', 'as' => 'postAddSaveAdminUser']);
    Route::get('admin-users/edit/{id}', ['uses' => 'AdminUsersController@getEdit', 'as' => 'getEditAdminUser']);
    Route::post('admin-users/update-save/{id}', ['uses' => 'AdminUsersController@postUpdateSave', 'as' => 'postUpdateSaveAdminUser']);
    Route::get('admin-users/delete/{id}', ['uses' => 'AdminUsersController@getDelete', 'as' => 'getDeleteAdminUser']);

    //CMS Management
    Route::get('manage-cms', ['uses' => 'ManageCMSController@getIndex', 'as' => 'getManageCMS']);
    Route::get('manage-cms/add', ['uses' => 'ManageCMSController@getAdd', 'as' => 'getAddCms']);
    Route::post('manage-cms/add-save-cms', ['uses' => 'ManageCMSController@postAddSave', 'as' => 'postAddCms']);
    Route::get('manage-cms/detail/{id}', ['uses' => 'ManageCMSController@getDetail', 'as' => 'getDetailCms']);
    Route::get('manage-cms/edit/{id}', ['uses' => 'ManageCMSController@getEdit', 'as' => 'getEditCms']);
    Route::post('manage-cms/edit-save-cms/{id}', ['uses' => 'ManageCMSController@postUpdateSave', 'as' => 'postUpdateCms']);
    Route::get('manage-cms/delete/{id}', ['uses' => 'ManageCMSController@getDelete', 'as' => 'deleteCms']);
    Route::post('manage-cms/action-selected', ['uses' => 'ManageCMSController@postActionSelected', 'as' => 'actionSelectedCms']);


    // State
    Route::get('states', ['uses' => 'ManageState@getIndex', 'as' => 'getState']);
    Route::get('states/add', ['uses' => 'ManageState@addManage', 'as' => 'getAddManageState']);
    Route::post('states', ['uses' => 'ManageState@postAddSave', 'as' => 'postAddState']);
    Route::get('states/edit/{id}', ['uses' => 'ManageState@getEdit', 'as' => 'getEditState']);
    Route::post('edit-save-states/{id}', ['uses' => 'ManageState@postUpdateSave', 'as' => 'postUpdateState']);
    Route::get('states/detail/{id}', ['uses' => 'ManageState@getDetail', 'as' => 'getDetailManageState']);
    Route::get('states/delete/{id}', ['uses' => 'ManageState@deleteManageState', 'as' => 'deleteManageState']);
    Route::post('states/action-selected', ['uses' => 'ManageState@postActionSelected', 'as' => 'actionSelectedManageState']);


    //City 

    Route::get('cities', ['uses' => 'ManageCity@getIndex', 'as' => 'getCity']);
    Route::get('cities/add', ['uses' => 'ManageCity@addManage', 'as' => 'getAddManageCity']);
    Route::post('cities', ['uses' => 'ManageCity@postAddSave', 'as' => 'postAddCity']);
    Route::get('cities/edit/{id}', ['uses' => 'ManageCity@getEdit', 'as' => 'getEditCity']);
    Route::post('edit-save-cities/{id}', ['uses' => 'ManageCity@postUpdateSave', 'as' => 'postUpdateCity']);
    Route::get('cities/detail/{id}', ['uses' => 'ManageCity@getDetail', 'as' => 'getDetailManageState']);
    Route::get('cities/delete/{id}', ['uses' => 'ManageCity@deleteManageManageCity', 'as' => 'deleteManageManageCity']);
    Route::post('cities/action-selected', ['uses' => 'ManageCity@postActionSelected', 'as' => 'actionSelectedManageManageCity']);

    //Settings
    Route::get('general-settings', ['uses' => 'SettingsController@getGeneralSettings', 'as' => 'getGeneralSettings']);
    Route::post('general-settings/save-general-settings', ['uses' => 'SettingsController@postSaveGeneralSettings', 'as' => 'postSaveGeneralSettings']);

    //Download & Delete File
    Route::get('download-file', 'AdminController@download_file');
    Route::get('delete-image', 'AdminController@delete_file');

    //admin profile
    Route::get('profile', ['uses' => 'ProfileController@getProfileData', 'as' => 'getProfileData']);
    Route::post('save-profile', ['uses' => 'ProfileController@postSaveProfile', 'as' => 'postSaveProfile']);

    //Manage Email templates
    Route::get('email-templates', ['uses' => 'ManageEmailTemplates@getIndex', 'as' => 'getIndexEmailTemplate']);
    Route::get('email-templates/add', ['uses' => 'ManageEmailTemplates@getAdd', 'as' => 'addEmailTemplate']);
    Route::post('add-save-email-templates', ['uses' => 'ManageEmailTemplates@postAddSave', 'as' => 'postAddEmailTemplate']);
    Route::get('email-templates/detail/{id}', ['uses' => 'ManageEmailTemplates@getDetail', 'as' => 'getDetailEmailTemplate']);
    Route::get('email-templates/edit/{id}', ['uses' => 'ManageEmailTemplates@getEdit', 'as' => 'getEditEmailTemplate']);
    Route::post('edit-save-email-templates/{id}', ['uses' => 'ManageEmailTemplates@postUpdateSave', 'as' => 'postUpdateEmailTemplate']);
    Route::get('email-templates/delete/{id}', ['uses' => 'ManageEmailTemplates@deleteDuration', 'as' => 'deleteManageEmailTemplate']);
    Route::post('email-templates/action-selected', ['uses' => 'ManageEmailTemplates@postActionSelected', 'as' => 'actionSelectedManageEmailTemplate']);
    Route::get('email-templates/action-selected', ['uses' => 'ManageEmailTemplates@postActionSelected', 'as' => 'actionSelectedManageEmailTemplate']);

    // Manage User
    Route::get('/users',  [UserController::class, 'index'] )->name('users.index');
    Route::get('/users/create',  [UserController::class, 'index'] )->name('users.create');
    Route::post('/users',  [UserController::class, 'store'] )->name('users.store');
    Route::get('/users/{user}',  [UserController::class, 'show'] )->name('users.show');
    Route::get('/users/{user}/edit',  [UserController::class, 'edit'] )->name('users.edit');
    Route::put('/users/{user}',  [UserController::class, 'update'] )->name('users.update');
    Route::delete('/users/{user}',  [UserController::class, 'destroy'] )->name('users.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
