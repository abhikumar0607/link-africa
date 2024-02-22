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
                      <h3 class="card-title">LA POP</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']) OR in_array('planning', $edit_access['edit_access_type']))
                    <form action="{{ route('admin.submit.la.pop.record') }}" method="POST" enctype="multipart/form-data" id="submit_lead_sale_form_file_record" class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif
                  
                      <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                          <div class="col-4">
                            <div class="form-group">
                                <label>POP ID:</label>
                                <input type="text" name="pop_id" value="" id="pop_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                          <div class="col-4">
                          </div>
                          </div>
                          <div class="row thrd-Qw">
                          <div class="col-4">
                            <div class="form-group">
                                <label>Area:</label>
                                <select class="form-control" name="area" id="area">
                                <option value="testing">testing</option>
                                <option value="testing">testing</option>
                                 </select>
                            </div>
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>ISP PLAN DATE:</label>
                                <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="isp_plan_date" id="isp_plan_date " data-target="#custom_date_picker5" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4"></div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>Area Name:</label>
                                <input type="text" name="area_name" value="" id="area_name" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                <label>sumission to Permission:</label>
                                <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="sumission_permission" id="sumission_permission " data-target="#custom_date_picker6" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4"></div>
                          
                          <div class="col-4">
                            <div class="form-group">
                                <label>POP TYPE:</label>
                                <input type="text" name="pop_type" value="" id="pop_type" class="form-control">
                            </div>
                          </div>
                           <div class="col-4">
                              <div class="form-group">
                                <label>Date Approved From permission:</label>
                                <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="date_approved_from_permission" id="date_approved_from_permission" data-target="#custom_date_picker7" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4"></div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>POP NAME:</label>
                                <input type="text" name="pop_name" value="" id="pop_name" class="form-control">
                            </div>
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>BOQ RELEASE DATE:</label>
                                <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="boq_release_date" id="boq_release_date" data-target="#custom_date_picker2" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>POP ADDRESS:</label>
                                <input type="text" name="pop_address" value="" id="pop_address" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>COMMENTS:</label>
                                <input type="text" name="comments" value="" id="comments" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>LAT:</label>
                                <input type="text" name="lat" value="" id="lat" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>POP STATUS:</label>
                                <input type="text" name="pop_status" value="" id="pop_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>LONG:</label>
                                <input type="text" name="long" value="" id="long" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>LAND LORD NAME:</label>
                                <input type="text" name="land_lord_name" value="" id="land_lord_name" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>PLANNING PROGRESS STATUS:</label>
                                <input type="text" name="planning_progress_status" value="" id="planning_progress_status" class="form-control">
                            </div>
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>LAND LORD CONTACT:</label>
                                <input type="text" name="land_lord_contact" value="" id="land_lord_contact" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>ISP/CAPACITY PLANNER:</label>
                                <input type="text" name="isp_capacity_planner" value="" id="isp_capacity_planner" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                          <div class="col-4">
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>SURVEY DATE:</label>
                                <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="survey_date" id="survey_date" data-target="#custom_date_picker3" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('planning', $edit_access['edit_access_type']))
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