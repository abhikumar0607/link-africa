@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.planning-master-files.planning-header')
            </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row cmmnt-frm">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card La-add-scroll">
                  <div class="card-header">
                      <h3 class="card-title">Planning Comment Form</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @if(count($record) >= 1)
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']) OR in_array('planning', $edit_access['edit_access_type']))
                    <form action="{{ route('admin.submit.department.comment') }}" method="POST" enctype="multipart/form-data" id="submit_comment_form_file_record" class="edit_site_master_file_record">
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif
                      <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                           <div class="col-3">
                            <div class="form-group">
                                <label>Project Status: </label>
                                <input type="text" name="project_status" value="@if($record[0]['site_master_record']) {{ $record[0]['site_master_record']['project_status'] }} @endif" id="project_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Date New:</label>
                                <input type="text" class="form-control block-field" name="" id="" value="{{ Carbon\Carbon::parse($record[0]['site_master_record']['date_new'])->format('m/d/Y'); }}"> 
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Build Status: </label>
                                <input type="text" name="build_status" value="@if($record[0]['build_record']) {{ $record[0]['build_record']['build_status'] }} @endif" id="build_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>SERVICE ID:</label>
                                <input type="text" name="circuit_id" value="{{ $record[0]['service_id'] }}" id="circuit_id" class="form-control">
                                 <input type="hidden" name="service_id" value="{{ $record[0]['circuit_id'] }}" id="service_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Client:</label>
                                <input type="text" name="client_name" value="@if($record[0]['site_master_record']) {{ $record[0]['site_master_record']['client_name'] }} @endif" id="client_name" class="form-control">
                            </div>
                          </div>
                            <div class="col-3">
                            <div class="form-group">
                                <label>Planning Status:</label>
                                <input type="text" name="planning_status" value="{{ $record[0]['planning_status'] }}" id="planning_status" class="form-control">
                            </div>
                          </div>
                             <div class="col-3">
                            <div class="form-group">
                                <label>SD Status:</label>
                                <input type="text" name="sd_status" value="@if($record[0]['site_master_record']) {{ $record[0]['site_master_record']['service_delivery_status'] }} @endif" id="sd_status" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                 <input type="text" name="metro_area" value="@if($record[0]['site_master_record']) {{ $record[0]['site_master_record']['metro_area'] }} @endif" id="metro_area" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Type:</label>
                                <input type="text" name="type" value="@if($record[0]['site_master_record']) {{ $record[0]['site_master_record']['type'] }} @endif" id="type" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Permission Status: </label>
                                <input type="text" name="permission_status" value="@if($record[0]['permission_record']) {{ $record[0]['permission_record']['permissions_status'] }}@endif" id="permission_status" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Service Type:</label>
                                 <input type="text" name="service_type" value="@if($record[0]['site_master_record']) {{ $record[0]['site_master_record']['service_type'] }} @endif" id="service_type" class="form-control">
                            </div>
                          </div>
                          
                          <div class="col-2">
                          </div>
                          </div>
                          <div class="row thrd-Qw">
                           <div class="col-md-3">
                               <h2>Planning Comments</h2>
                             <textarea id="w3review" name="planning_comment">@if($record[0]['department_record']) {{ $record[0]['department_record']['planning_comment'] }}@endif</textarea>  
                          </div>
                          <div class="col-md-3">
                               <h2>Permission Comments</h2>
                               <textarea id="w3review" name="permission_comment">@if($record[0]['department_record']) {{ $record[0]['department_record']['permission_comment'] }}@endif</textarea> 
                          </div>
                          <div class="col-md-3">
                              <h2>Build Comments</h2>
                               <textarea id="w3review" name="build_comment">@if($record[0]['department_record']) {{ $record[0]['department_record']['build_comment'] }}@endif</textarea> 
                          </div>
                           <div class="col-md-3">
                               <h2>Service Delivery Comments</h2>
                               <textarea id="w3review" name="service_delivery_comment">@if($record[0]['department_record']) {{ $record[0]['department_record']['service_delivery_comment'] }}@endif</textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('planning', $edit_access['edit_access_type']))
                          <button type="submit" class="btn btn-primary">Submit</button>
                        @endif
                    </div>
                </form> 
                @else
                <h2>No Result Found</h2>
                @endif
                <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection