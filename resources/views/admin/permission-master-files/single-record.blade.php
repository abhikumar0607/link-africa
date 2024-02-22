@extends('admin.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="col-sm-12"> <!--content-wrapper-->
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        @include('admin.permission-master-files.permission-header')
        </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content --> 
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Edit Planning</h3></br>
                @if (Session::has('success'))
                  <p class="success">{{ Session::get('success') }}</p>
                @endif
                @if (Session::has('unsuccess'))
                  <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                @endif
              </div>
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                @if(in_array('all', $edit_access['edit_access_type']) OR in_array('permission', $edit_access['edit_access_type']))
                    <form action="{{ route('admin.permission.update-record', $record[0]['id']) }}" method="POST" enctype="multipart/form-data" id="update_permission_master_file_record"> 
                    {{ csrf_field() }} 
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
              
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3">
                          <div class="form-group">
                            <label>Service ID:</label>
                            <input type="text" class="form-control" name="service_id" value="{{ $record[0]['service_id'] }}" id="service_id">
                            @if ($errors->has('service_id'))
                                <span class="help-block">
                                  <p>{{ $errors->first('service_id') }}</p>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label>Date New:</label>
                            <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                @if($record[0]['datenew'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['datenew'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="datenew" id="datenew" data-target="#custom_date_picker">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="datenew" id="datenew" data-target="#custom_date_picker">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>permissions_status: {{ $record[0]['permissions_status'] }}</label>
                            <select class="form-control" name="permissions_status" id="permissions_status">
                                <option value="">Select Project Status</option>
                                <option value="L) Cancelled">L) Cancelled</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label>site_a_lla_submitted:</label>
                            <div class="input-group date" id="custom_date_picker1" data-target-input="nearest">
                                @if($record[0]['site_a_lla_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_lla_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_lla_submitted" id="site_a_lla_submitted" data-target="#custom_date_picker1">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="site_a_lla_submitted" id="site_a_lla_submitted" data-target="#custom_date_picker1">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                          <div class="form-group">
                            <label>site_a_lla_estimated:</label>
                            <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                                @if($record[0]['site_a_lla_estimated'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_lla_estimated'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_lla_estimated" id="site_a_lla_estimated" data-target="#custom_date_picker2">
                                @else
                                   <input type="text" value="" class="form-control datetimepicker-input" name="site_a_lla_estimated" id="site_a_lla_estimated" data-target="#custom_date_picker2">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>site_a_lla_received:</label>
                            <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                                @if($record[0]['site_a_lla_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_lla_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_lla_received" id="site_a_lla_received" data-target="#custom_date_picker3">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="site_a_lla_received" id="site_a_lla_received" data-target="#custom_date_picker3">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>site_b_lla_submitted:</label>
                            <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                @if($record[0]['site_b_lla_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_lla_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="site_b_lla_submitted" id="site_b_lla_submitted" data-target="#cuom_date_picker4">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="site_b_lla_submitted" id="site_b_lla_submitted" data-target="#custom_date_picker4">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>site_b_lla_estimated:</label>
                            <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                @if($record[0]['site_b_lla_estimated'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_lla_estimated'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="site_b_lla_estimated" id="site_b_lla_estimated" data-target="#cuom_date_picker5">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="site_b_lla_estimated" id="site_b_lla_estimated" data-target="#custom_date_picker5">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>site_b_lla_received:</label>
                            <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                @if($record[0]['site_b_lla_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_lla_received'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="site_b_lla_received" id="site_b_lla_received" data-target="#cuom_date_picker6">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="site_b_lla_received" id="site_b_lla_received" data-target="#custom_date_picker6">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>wayleaves_submitted:</label>
                            <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                @if($record[0]['wayleaves_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wayleaves_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="wayleaves_submitted" id="wayleaves_submitted" data-target="#cuom_date_picker7">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="wayleaves_submitted" id="wayleaves_submitted" data-target="#custom_date_picker7">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>wayleaves_estimated:</label>
                            <div class="input-group date" id="custom_date_picker8" data-target-input="nearest">
                                @if($record[0]['wayleaves_estimated'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wayleaves_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="wayleaves_estimated" id="wayleaves_estimated" data-target="#cuom_date_picker8">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="wayleaves_estimated" id="wayleaves_estimated" data-target="#custom_date_picker8">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker8" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>wayleaves_received:</label>
                            <div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                                @if($record[0]['wayleaves_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wayleaves_received'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="wayleaves_received" id="wayleaves_received" data-target="#cuom_date_picker9">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="wayleaves_received" id="wayleaves_received" data-target="#custom_date_picker9">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>wayleaves_status:</label>
                            <select class="form-control" name="wayleaves_status" id="wayleaves_status">
                                <option value="">Select wayleaves_status</option>
                                <option value="Complete">Complete</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>resource:</label>
                            <input type="text" name="resource" value="{{ $record[0]['resource'] }}" id="resource" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>wl_planned_submitted_date:</label>
                            <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                @if($record[0]['wl_planned_submitted_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wl_planned_submitted_date'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="wl_planned_submitted_date" id="wl_planned_submitted_date" data-target="#cuom_date_picker10">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="wl_planned_submitted_date" id="wl_planned_submitted_date" data-target="#custom_date_picker10">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>province:</label>
                            <input type="text" name="province" value="{{ $record[0]['province'] }}" id="province" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>osp_status_permissions:</label>
                            <input type="text" name="osp_status_permissions" value="{{ $record[0]['osp_status_permissions'] }}" id="osp_status_permissions" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>isp_a_b_status:</label>
                            <input type="text" name="isp_a_b_status" value="{{ $record[0]['isp_a_b_status'] }}" id="isp_a_b_status" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>existing_wl_ref_no:</label>
                            <input type="text" name="existing_wl_ref_no" value="{{ $record[0]['existing_wl_ref_no'] }}" id="existing_wl_ref_no" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>exepected_wl_received_date:</label>
                            <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                @if($record[0]['exepected_wl_received_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['exepected_wl_received_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="exepected_wl_received_date" id="exepected_wl_received_date" data-target="#custom_date_picker11">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="exepected_wl_received_date" id="exepected_wl_received_date" data-target="#custom_date_picker11">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>total_number_of_responses_oustanding:</label>
                            <input type="text" name="total_number_of_responses_oustanding" value="{{ $record[0]['total_number_of_responses_oustanding'] }}" id="total_number_of_responses_oustanding" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>final_wl_submission_date:</label>
                            <div class="input-group date" id="custom_date_picker12" data-target-input="nearest">
                                @if($record[0]['final_wl_submission_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['final_wl_submission_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="final_wl_submission_date" id="final_wl_submission_date" data-target="#custom_date_picker12">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="final_wl_submission_date" id="final_wl_submission_date" data-target="#custom_date_picker12">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker12" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>wl_expiry_date:</label>
                            <div class="input-group date" id="custom_date_picker13" data-target-input="nearest">
                                @if($record[0]['wl_expiry_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wl_expiry_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="wl_expiry_date" id="wl_expiry_date" data-target="#custom_date_picker13">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="wl_expiry_date" id="wl_expiry_date" data-target="#custom_date_picker13">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker13" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>wl_osp_status:</label>
                            <input type="text" name="wl_osp_status" value="{{ $record[0]['wl_osp_status'] }}" id="wl_osp_status" class="form-control">
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>stormwater_rou_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker14" data-target-input="nearest">
                                @if($record[0]['stormwater_rou_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['stormwater_rou_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="stormwater_rou_date_submitted" id="stormwater_rou_date_submitted" data-target="#custom_date_picker14">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="stormwater_rou_date_submitted" id="stormwater_rou_date_submitted" data-target="#custom_date_picker14">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker14" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>stormwater_rou_date_received:</label>
                            <div class="input-group date" id="custom_date_picker15" data-target-input="nearest">
                                @if($record[0]['stormwater_rou_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['stormwater_rou_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="stormwater_rou_date_received" id="stormwater_rou_date_received" data-target="#custom_date_picker15">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="stormwater_rou_date_received" id="stormwater_rou_date_received" data-target="#custom_date_picker15">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker15" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>stormwater_rou_lead_time:</label>
                            <input type="text" name="stormwater_rou_lead_time" value="{{ $record[0]['stormwater_rou_lead_time'] }}" id="stormwater_rou_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>sewer_rou_date_received:</label>
                            <div class="input-group date" id="custom_date_picker16" data-target-input="nearest">
                                @if($record[0]['sewer_rou_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sewer_rou_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sewer_rou_date_received" id="sewer_rou_date_received" data-target="#custom_date_picker16">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sewer_rou_date_received" id="sewer_rou_date_received" data-target="#custom_date_picker16">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker16" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>sewer_rou_lead_time:</label>
                            <input type="text" name="sewer_rou_lead_time" value="{{ $record[0]['sewer_rou_lead_time'] }}" id="sewer_rou_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>telkom_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker18" data-target-input="nearest">
                                @if($record[0]['telkom_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['telkom_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="telkom_date_submitted" id="telkom_date_submitted" data-target="#custom_date_picker18">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="telkom_date_submitted" id="telkom_date_submitted" data-target="#custom_date_picker18">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker18" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>telkom_date_received:</label>
                            <div class="input-group date" id="custom_date_picker19" data-target-input="nearest">
                                @if($record[0]['telkom_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['telkom_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="telkom_date_received" id="telkom_date_received" data-target="#custom_date_picker19">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="telkom_date_received" id="telkom_date_received" data-target="#custom_date_picker19">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker19" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>telkom_lead_time:</label>
                            <input type="text" name="telkom_lead_time" value="{{ $record[0]['telkom_lead_time'] }}" id="telkom_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>sasol_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker21" data-target-input="nearest">
                                @if($record[0]['sasol_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sasol_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sasol_date_submitted" id="sasol_date_submitted" data-target="#custom_date_picker21">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sasol_date_submitted" id="sasol_date_submitted" data-target="#custom_date_picker21">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker21" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>sasol_date_received:</label>
                            <div class="input-group date" id="custom_date_picker22" data-target-input="nearest">
                                @if($record[0]['sasol_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sasol_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sasol_date_received" id="sasol_date_received" data-target="#custom_date_picker22">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sasol_date_received" id="sasol_date_received" data-target="#custom_date_picker22">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker22" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>sasol_lead_time:</label>
                            <input type="text" name="sasol_lead_time" value="{{ $record[0]['sasol_lead_time'] }}" id="sasol_lead_time" class="form-control">
                        </div>
                      </div>
                         <div class="col-3">
                        <div class="form-group">
                            <label>transnet_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker24" data-target-input="nearest">
                                @if($record[0]['transnet_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['transnet_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="transnet_date_submitted" id="transnet_date_submitted" data-target="#custom_date_picker24">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="transnet_date_submitted" id="transnet_date_submitted" data-target="#custom_date_picker24">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker24" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>transnet_date_received:</label>
                            <div class="input-group date" id="custom_date_picker25" data-target-input="nearest">
                                @if($record[0]['transnet_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['transnet_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="transnet_date_received" id="transnet_date_received" data-target="#custom_date_picker25">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="transnet_date_received" id="transnet_date_received" data-target="#custom_date_picker25">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker25" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>transnet_lead_time:</label>
                            <input type="text" name="transnet_lead_time" value="{{ $record[0]['transnet_lead_time'] }}" id="transnet_lead_time" class="form-control">
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>neotel_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker27" data-target-input="nearest">
                                @if($record[0]['neotel_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['neotel_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="neotel_date_submitted" id="neotel_date_submitted" data-target="#custom_date_picker27">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="neotel_date_submitted" id="neotel_date_submitted" data-target="#custom_date_picker27">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker27" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>neotel_date_received:</label>
                            <div class="input-group date" id="custom_date_picker28" data-target-input="nearest">
                                @if($record[0]['neotel_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['neotel_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="neotel_date_received" id="neotel_date_received" data-target="#custom_date_picker28">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="neotel_date_received" id="neotel_date_received" data-target="#custom_date_picker28">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker28" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>neotel_lead_time:</label>
                            <input type="text" name="neotel_lead_time" value="{{ $record[0]['neotel_lead_time'] }}" id="transnet_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>dfa_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker30" data-target-input="nearest">
                                @if($record[0]['dfa_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['dfa_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="dfa_date_submitted" id="dfa_date_submitted" data-target="#custom_date_picker30">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="dfa_date_submitted" id="dfa_date_submitted" data-target="#custom_date_picker30">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker30" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>dfa_date_received:</label>
                            <div class="input-group date" id="custom_date_picker31" data-target-input="nearest">
                                @if($record[0]['dfa_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['dfa_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="dfa_date_received" id="dfa_date_received" data-target="#custom_date_picker31">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="dfa_date_received" id="dfa_date_received" data-target="#custom_date_picker31">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker31" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>dfa_lead_time:</label>
                            <input type="text" name="dfa_lead_time" value="{{ $record[0]['dfa_lead_time'] }}" id="dfa_lead_time" class="form-control">
                        </div>
                      </div>
                     <div class="col-3">
                      <div class="form-group">
                            <label>mtn_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker33" data-target-input="nearest">
                                @if($record[0]['mtn_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['mtn_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="mtn_date_submitted" id="mtn_date_submitted" data-target="#custom_date_picker33">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="mtn_date_submitted" id="mtn_date_submitted" data-target="#custom_date_picker33">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker33" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>mtn_date_received:</label>
                            <div class="input-group date" id="custom_date_picker34" data-target-input="nearest">
                                @if($record[0]['mtn_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['mtn_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="mtn_date_received" id="mtn_date_received" data-target="#custom_date_picker34">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="mtn_date_received" id="mtn_date_received" data-target="#custom_date_picker34">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker34" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>mtn_lead_time:</label>
                            <input type="text" name="mtn_lead_time" value="{{ $record[0]['mtn_lead_time'] }}" id="mtn_lead_time" class="form-control">
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>sanral_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker36" data-target-input="nearest">
                                @if($record[0]['sanral_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sanral_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sanral_date_submitted" id="sanral_date_submitted" data-target="#custom_date_picker36">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sanral_date_submitted" id="sanral_date_submitted" data-target="#custom_date_picker36">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker36" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>sanral_date_received:</label>
                            <div class="input-group date" id="custom_date_picker37" data-target-input="nearest">
                                @if($record[0]['sanral_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sanral_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sanral_date_received" id="sanral_date_received" data-target="#custom_date_picker37">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sanral_date_received" id="sanral_date_received" data-target="#custom_date_picker37">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker37" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>sanral_lead_time:</label>
                            <input type="text" name="sanral_lead_time" value="{{ $record[0]['sanral_lead_time'] }}" id="sanral_lead_time" class="form-control">
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>dept_of_transport_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker39" data-target-input="nearest">
                                @if($record[0]['dept_of_transport_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['dept_of_transport_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="dept_of_transport_date_submitted" id="dept_of_transport_date_submitted" data-target="#custom_date_picker39">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="dept_of_transport_date_submitted" id="dept_of_transport_date_submitted" data-target="#custom_date_picker39">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker39" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>dept_of_transport_date_received:</label>
                            <div class="input-group date" id="custom_date_picker40" data-target-input="nearest">
                                @if($record[0]['dept_of_transport_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['dept_of_transport_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="dept_of_transport_date_received" id="dept_of_transport_date_received" data-target="#custom_date_picker40">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="dept_of_transport_date_received" id="dept_of_transport_date_received" data-target="#custom_date_picker40">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker40" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                         <div class="col-3">
                        <div class="form-group">
                            <label>dept_of_transport_lead_time:</label>
                            <input type="text" name="dept_of_transport_lead_time" value="{{ $record[0]['dept_of_transport_lead_time'] }}" id="dept_of_transport_lead_time" class="form-control">
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>water_sanitation_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker42" data-target-input="nearest">
                                @if($record[0]['water_sanitation_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['water_sanitation_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="water_sanitation_date_submitted" id="water_sanitation_date_submitted" data-target="#custom_date_picker42">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="water_sanitation_date_submitted" id="water_sanitation_date_submitted" data-target="#custom_date_picker42">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker42" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>water_sanitation_date_received:</label>
                            <div class="input-group date" id="custom_date_picker43" data-target-input="nearest">
                                @if($record[0]['water_sanitation_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['water_sanitation_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="water_sanitation_date_received" id="water_sanitation_date_received" data-target="#custom_date_picker43">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="water_sanitation_date_received" id="water_sanitation_date_received" data-target="#custom_date_picker43">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker43" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>water_sanitation_lead_time:</label>
                            <input type="text" name="water_sanitation_lead_time" value="{{ $record[0]['water_sanitation_lead_time'] }}" id="water_sanitation_lead_time" class="form-control">
                        </div>
                      </div>
                     
                       <div class="col-3">
                      <div class="form-group">
                            <label>ethekwini_transport_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker45" data-target-input="nearest">
                                @if($record[0]['ethekwini_transport_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['ethekwini_transport_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="ethekwini_transport_date_submitted" id="ethekwini_transport_date_submitted" data-target="#custom_date_picker45">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="ethekwini_transport_date_submitted" id="ethekwini_transport_date_submitted" data-target="#custom_date_picker45">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker45" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                      <div class="form-group">
                            <label>ethekwini_transport_date_received:</label>
                            <div class="input-group date" id="custom_date_picker46" data-target-input="nearest">
                                @if($record[0]['ethekwini_transport_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['ethekwini_transport_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="ethekwini_transport_date_received" id="ethekwini_transport_date_received" data-target="#custom_date_picker46">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="ethekwini_transport_date_received" id="ethekwini_transport_date_received" data-target="#custom_date_picker45">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker46" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                  
                      <div class="col-3">
                        <div class="form-group">
                            <label>ethekwini_transport_lead_time:</label>
                            <input type="text" name="ethekwini_transport_lead_time" value="{{ $record[0]['ethekwini_transport_lead_time'] }}" id="ethekwini_transport_lead_time" class="form-control">
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>roads_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker47" data-target-input="nearest">
                                @if($record[0]['roads_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['roads_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="roads_date_submitted" id="roads_date_submitted" data-target="#custom_date_picker47">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="roads_date_submitted" id="roads_date_submitted" data-target="#custom_date_picker47">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker47" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>roads_date_received:</label>
                            <div class="input-group date" id="custom_date_picker48" data-target-input="nearest">
                                @if($record[0]['roads_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['roads_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="roads_date_received" id="roads_date_received" data-target="#custom_date_picker48">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="roads_date_received" id="roads_date_received" data-target="#custom_date_picker48">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker48" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>roads_lead_time:</label>
                            <input type="text" name="roads_lead_time" value="{{ $record[0]['roads_lead_time'] }}" id="roads_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>electricity_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker49" data-target-input="nearest">
                                @if($record[0]['electricity_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['electricity_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="electricity_date_submitted" id="electricity_date_submitted" data-target="#custom_date_picker49">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="electricity_date_submitted" id="electricity_date_submitted" data-target="#custom_date_picker49">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker49" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>electricity_date_received:</label>
                            <div class="input-group date" id="custom_date_picker50" data-target-input="nearest">
                                @if($record[0]['electricity_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['electricity_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="electricity_date_received" id="electricity_date_received" data-target="#custom_date_picker50">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="electricity_date_received" id="electricity_date_received" data-target="#custom_date_picker50">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker50" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>electricity_lead_time:</label>
                            <input type="text" name="electricity_lead_time" value="{{ $record[0]['electricity_lead_time'] }}" id="electricity_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>coastal_stormwater_catchment_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker51" data-target-input="nearest">
                                @if($record[0]['coastal_stormwater_catchment_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['coastal_stormwater_catchment_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_submitted" id="coastal_stormwater_catchment_date_submitted" data-target="#custom_date_picker51">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_submitted" id="coastal_stormwater_catchment_date_submitted" data-target="#custom_date_picker51">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker51" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>coastal_stormwater_catchment_date_received:</label>
                            <div class="input-group date" id="custom_date_picker52" data-target-input="nearest">
                                @if($record[0]['coastal_stormwater_catchment_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['coastal_stormwater_catchment_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_received" id="coastal_stormwater_catchment_date_received" data-target="#custom_date_picker52">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_received" id="coastal_stormwater_catchment_date_received" data-target="#custom_date_picker52">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker52" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>coastal_stormwater_catchment_lead_time:</label>
                            <input type="text" name="coastal_stormwater_catchment_lead_time" value="{{ $record[0]['coastal_stormwater_catchment_lead_time'] }}" id="coastal_stormwater_catchment_lead_time" class="form-control">
                        </div>
                      </div>
                     <div class="col-3">
                      <div class="form-group">
                            <label>development_planning_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker53" data-target-input="nearest">
                                @if($record[0]['development_planning_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['development_planning_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="development_planning_date_submitted" id="development_planning_date_submitted" data-target="#custom_date_picker53">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="development_planning_date_submitted" id="development_planning_date_submitted" data-target="#custom_date_picker53">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker53" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>development_planning_date_received:</label>
                            <div class="input-group date" id="custom_date_picker54" data-target-input="nearest">
                                @if($record[0]['development_planning_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['development_planning_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="development_planning_date_received" id="development_planning_date_received" data-target="#custom_date_picker54">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="development_planning_date_received" id="development_planning_date_received" data-target="#custom_date_picker54">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker54" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>development_planning_lead_time:</label>
                            <input type="text" name="development_planning_lead_time" value="{{ $record[0]['development_planning_lead_time'] }}" id="development_planning_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>Sch Date:</label>
                            <div class="input-group date" id="custom_date_picker55" data-target-input="nearest">
                                @if($record[0]['traffic_signals_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['traffic_signals_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="traffic_signals_date_submitted" id="traffic_signals_date_submitted" data-target="#custom_date_picker55">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="traffic_signals_date_submitted" id="traffic_signals_date_submitted" data-target="#custom_date_picker55">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker55" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="col-3">
                        <div class="form-group">
                            <label>traffic_signals_date_received:</label>
                            <div class="input-group date" id="custom_date_picker56" data-target-input="nearest">
                                @if($record[0]['traffic_signals_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['traffic_signals_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="traffic_signals_date_received" id="traffic_signals_date_received" data-target="#custom_date_picker56">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="traffic_signals_date_received" id="traffic_signals_date_received" data-target="#custom_date_picker56">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker56" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>traffic_signals_lead_time:</label>
                            <input type="text" name="traffic_signals_lead_time" value="{{ $record[0]['traffic_signals_lead_time'] }}" id="traffic_signals_lead_time" class="form-control">
                        </div>
                      </div>
                         <div class="col-3">
                        <div class="form-group">
                            <label>enviromental_management_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker57" data-target-input="nearest">
                                @if($record[0]['enviromental_management_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['enviromental_management_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="enviromental_management_date_submitted" id="enviromental_management_date_submitted" data-target="#custom_date_picker57">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="enviromental_management_date_submitted" id="enviromental_management_date_submitted" data-target="#custom_date_picker57">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker57" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>enviromental_management_date_received:</label>
                            <div class="input-group date" id="custom_date_picker58" data-target-input="nearest">
                                @if($record[0]['enviromental_management_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['enviromental_management_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="enviromental_management_date_received" id="enviromental_management_date_received" data-target="#custom_date_picker58">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="enviromental_management_date_received" id="enviromental_management_date_received" data-target="#custom_date_picker58">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker58" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>enviromental_management_lead_time:</label>
                            <input type="text" name="enviromental_management_lead_time" value="{{ $record[0]['enviromental_management_lead_time'] }}" id="enviromental_management_lead_time" class="form-control">
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>transportation_planning_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker59" data-target-input="nearest">
                                @if($record[0]['transportation_planning_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['transportation_planning_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="transportation_planning_date_submitted" id="transportation_planning_date_submitted" data-target="#custom_date_picker59">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="transportation_planning_date_submitted" id="transportation_planning_date_submitted" data-target="#custom_date_picker59">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker59" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>transportation_planning_date_received:</label>
                            <div class="input-group date" id="custom_date_picker60" data-target-input="nearest">
                                @if($record[0]['transportation_planning_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['transportation_planning_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="transportation_planning_date_received" id="transportation_planning_date_received" data-target="#custom_date_picker60">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="transportation_planning_date_received" id="transportation_planning_date_received" data-target="#custom_date_picker60">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker60" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>transportation_planning_lead_time:</label>
                            <input type="text" name="transportation_planning_lead_time" value="{{ $record[0]['transportation_planning_lead_time'] }}" id="transportation_planning_lead_time" class="form-control">
                        </div>
                      </div>
                          <div class="col-3">
                        <div class="form-group">
                            <label>technical_services_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker61" data-target-input="nearest">
                                @if($record[0]['technical_services_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['technical_services_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="technical_services_date_submitted" id="technical_services_date_submitted" data-target="#custom_date_picker61">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="technical_services_date_submitted" id="technical_services_date_submitted" data-target="#custom_date_picker61">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker61" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                        <div class="form-group">
                            <label>technical_services_date_received:</label>
                            <div class="input-group date" id="custom_date_picker62" data-target-input="nearest">
                                @if($record[0]['technical_services_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['technical_services_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="technical_services_date_received" id="technical_services_date_received" data-target="#custom_date_picker62">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="technical_services_date_received" id="technical_services_date_received" data-target="#custom_date_picker62">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker62" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>technical_services_lead_time:</label>
                            <input type="text" name="technical_services_lead_time" value="{{ $record[0]['technical_services_lead_time'] }}" id="technical_services_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>sembcorp_siza_water_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker63" data-target-input="nearest">
                                @if($record[0]['sembcorp_siza_water_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sembcorp_siza_water_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_submitted" id="sembcorp_siza_water_date_submitted" data-target="#custom_date_picker63">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_submitted" id="sembcorp_siza_water_date_submitted" data-target="#custom_date_picker63">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker63" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>sembcorp_siza_water_date_received:</label>
                            <div class="input-group date" id="custom_date_picker64" data-target-input="nearest">
                                @if($record[0]['sembcorp_siza_water_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['sembcorp_siza_water_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_received" id="sembcorp_siza_water_date_received" data-target="#custom_date_picker64">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_received" id="sembcorp_siza_water_date_received" data-target="#custom_date_picker64">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker64" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>sembcorp_siza_water_lead_time:</label>
                            <input type="text" name="sembcorp_siza_water_lead_time" value="{{ $record[0]['sembcorp_siza_water_lead_time'] }}" id="sembcorp_siza_water_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>legal_services_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker65" data-target-input="nearest">
                                @if($record[0]['legal_services_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['legal_services_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="legal_services_date_submitted" id="legal_services_date_submitted" data-target="#custom_date_picker65">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="legal_services_date_submitted" id="legal_services_date_submitted" data-target="#custom_date_picker65">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker65" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>legal_services_date_received:</label>
                            <div class="input-group date" id="custom_date_picker66" data-target-input="nearest">
                                @if($record[0]['legal_services_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['legal_services_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="legal_services_date_received" id="legal_services_date_received" data-target="#custom_date_picker66">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="legal_services_date_received" id="legal_services_date_received" data-target="#custom_date_picker66">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker66" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>legal_services_lead_time:</label>
                            <input type="text" name="legal_services_lead_time" value="{{ $record[0]['legal_services_lead_time'] }}" id="legal_services_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                            <label>eskom_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker67" data-target-input="nearest">
                                @if($record[0]['eskom_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['eskom_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="eskom_date_submitted" id="eskom_date_submitted" data-target="#custom_date_picker67">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="eskom_date_submitted" id="eskom_date_submitted" data-target="#custom_date_picker67">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker67" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>eskom_date_received:</label>
                            <div class="input-group date" id="custom_date_picker68" data-target-input="nearest">
                                @if($record[0]['eskom_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['eskom_date_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="eskom_date_received" id="eskom_date_received" data-target="#custom_date_picker68">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="eskom_date_received" id="eskom_date_received" data-target="#custom_date_picker68">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker68" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>eskom_lead_time:</label>
                            <input type="text" name="eskom_lead_time" value="{{ $record[0]['eskom_lead_time'] }}" id="eskom_lead_time" class="form-control">
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>parks_date_submitted:</label>
                            <div class="input-group date" id="custom_date_picker69" data-target-input="nearest">
                                @if($record[0]['parks_date_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['parks_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="parks_date_submitted" id="parks_date_submitted" data-target="#custom_date_picker69">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="parks_date_submitted" id="parks_date_submitted" data-target="#custom_date_picker69">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker69" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>parks_date_received:</label>
                            <div class="input-group date" id="custom_date_picker70" data-target-input="nearest">
                                @if($record[0]['parks_date_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['parks_date_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="parks_date_received" id="parks_date_received" data-target="#custom_date_picker70">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="parks_date_received" id="parks_date_received" data-target="#custom_date_picker70">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker70" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>parks_lead_time:</label>
                            <input type="text" name="parks_lead_time" value="{{ $record[0]['parks_lead_time'] }}" id="parks_lead_time" class="form-control">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>site_owner:</label>
                            <input type="text" name="site_owner" value="{{ $record[0]['site_owner'] }}" id="site_owner" class="form-control">
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>external_la_wl_num:</label>
                            <input type="text" name="external_la_wl_num" value="{{ $record[0]['external_la_wl_num'] }}" id="external_la_wl_num" class="form-control">
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>permissions_comments:</label>
                            <input type="text" name="permissions_comments" value="{{ $record[0]['permissions_comments'] }}" id="permissions_comments" class="form-control">
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>mat:</label>
                            <input type="text" name="mat" value="{{ $record[0]['mat'] }}" id="mat" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                  @if(in_array('all', $edit_access['edit_access_type']) OR in_array('permission', $edit_access['edit_access_type']))
                        <button type="submit" class="btn btn-primary">Update</button>
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