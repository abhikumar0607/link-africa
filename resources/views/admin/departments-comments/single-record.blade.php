@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.site-master-files.sale-header')
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
                      <h3 class="card-title">Comment Form</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                    @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                    @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
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
                                <input type="text" name="project_status" value="{{ $record[0]['project_status'] }}" id="project_status" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Build Status: </label>
                                <input type="text" name="build_status" value="@if($record[0]['build_record']) {{ $record[0]['build_record']['build_status'] }}@endif" id="build_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" name="circuit_id" value="{{ $record[0]['circuit_id'] }}" id="circuit_id" class="form-control">
                                 <input type="hidden" name="service_id" value="{{ $record[0]['service_id'] }}" id="service_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Client:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['client_name'] }}" id="client_name" class="form-control">
                            </div>
                          </div>
                            <div class="col-3">
                            <div class="form-group">
                                <label>Planning Status:</label>
                                <input type="text" name="planning_status" value="@if($record[0]['planning_record']) {{ $record[0]['planning_record']['planning_status'] }}@endif" id="planning_status" class="form-control">
                            </div>
                          </div>
                             <div class="col-3">
                            <div class="form-group">
                                <label>SD Status:</label>
                                <input type="text" name="sd_status" value="{{ $record[0]['service_delivery_status'] }}" id="sd_status" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                 <input type="text" name="metro_area" value="{{ $record[0]['metro_area'] }}" id="metro_area" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Type:</label>
                                <input type="text" name="type" value="{{ $record[0]['type'] }}" id="type" class="form-control">
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
                                 <input type="text" name="service_type" value="{{ $record[0]['service_type'] }}" id="service_type" class="form-control">
                            </div>
                          </div>
                          
                          <div class="col-2">
                          </div>
                          </div>
                          <div class="row thrd-Qw">
                           <div class="col-md-3">
                               <h2>Planning Comments</h2>
                             <textarea id="w3review" name="planning_comment">@if($record[0]['department_comment']){{$record[0]['department_comment']['planning_comment']}}@endif</textarea>  
                          </div>
                          <div class="col-md-3">
                               <h2>Permission Comments</h2>
                               <textarea id="w3review" name="permission_comment">@if($record[0]['department_comment']){{$record[0]['department_comment']['permission_comment']}}@endif</textarea> 
                          </div>
                          <div class="col-md-3">
                              <h2>Build Comments</h2>
                               <textarea id="w3review" name="build_comment">@if($record[0]['department_comment']){{$record[0]['department_comment']['build_comment']}}@endif</textarea> 
                          </div>
                           <div class="col-md-3">
                               <h2>Service Delivery Comments</h2>
                               <textarea id="w3review" name="service_delivery_comment">@if($record[0]['department_comment']){{$record[0]['department_comment']['service_delivery_comment']}}@endif</textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                          <button type="submit" class="btn btn-primary">Submit</button>
                        @endif
                          
                    </div>
                </form> 
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