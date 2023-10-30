@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ AdminHelper::adminpath() }}/states"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage States</a></p>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div>

            <div class="card-body">                
                    <div class="row g-3">
                        <div class="table-responsive">
                            <table id="table-detail" class="table table-striped">
                                <tbody>

                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $country->name }}</td>
                                    </tr>



                                    <tr>
                                        <td> State Name</td>
                                        <td>{{ $row->name }}</td>
                                    </tr>


                                   

                                    
                                    <tr>
                                        <td>Date</td>
                                        <td>{{date('m-d-Y h:i A', strtotime($row->created_at))}}</td>
                                    </tr>
                                    
                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->                  

                </form>

            </div>
        </div>
    </div>
    <!--END AUTO MARGIN-->

</div>
@endsection