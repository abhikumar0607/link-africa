@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
 <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.permission-master-files.permission-header')
              
        </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
          <div class="card La-add-scroll">
              <div class="card-header">
                  <h3 class="card-title">Edit Wayleaves Status</h3>
                @if (Session::has('success'))
                  <p class="success">{{ Session::get('success') }}</p>
                @endif
                @if (Session::has('unsuccess'))
                  <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                @endif
              </div>
              @if(count($record) >= 1)
              @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
              @if(in_array('all', $edit_access['edit_access_type']) OR in_array('permission', $edit_access['edit_access_type']))
                  <form action="{{ route('permission.wayleaves.status.update',$record[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_master_file_records" class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
              
                <div class="card-body no-scroll-need">
                  <div class="one-box-row border-box">
                    <div class="one-box-inner">
                      <div class="fild-row"><label>PROJECT STATUS</label><input type="text" class="form-control block-field" name="project_status" id="project_status" value="{{ $record[0]['site_master_record']['project_status'] }}"></div>
                      <div class="fild-row"><label>DATE NEW</label><input type="text" class="form-control block-field" name="" id="project_status" value="{{ Carbon\Carbon::parse($record[0]['site_master_record']['date_new'])->format('m/d/Y'); }}"></div>
                      <div class="fild-row"><label>PLANNING STATUS</label><input type="text" name="planning_status" value="{{ $record[0]['planning_record']['planning_status'] }}" id="planning_status" class="form-control block-field"></div>
                      <div class="fild-row"><label>Service delivery status</label><input type="text" value="{{ $record[0]['site_master_record']['service_delivery_status'] }}" class="form-control block-field"></div>
                      <div class="fild-row"><label>PERMISSIONS STATUS</label><input type="text" name="permissions_status" value="{{ $record[0]['permissions_status'] }}" id="permissions_status" class="form-control block-field"></div>
                      </div>
                      <div class="one-box-inner">
                      <div class="fild-row"><label>PROVINCE</label><input type="text" name="province" value="{{ $record[0]['site_master_record']['province'] }}" id="province" class="form-control block-field"></div>
                      <div class="fild-row"><label>METRO/AREA</label> <input type="text" name="metro_area" value="{{ $record[0]['site_master_record']['metro_area'] }}" id="metro_area" class="form-control block-field"></div>
                      <div class="fild-row"><label>OSP PLANNERS</label><input type="text" name="osp_planners" value="{{ $record[0]['planning_record']['osp_planners'] }}" id="osp_planners" class="form-control block-field"></div>
                      <div class="fild-row"><label>WAYLEAVE OSP STATUS</label><input type="text" name="wl_osp_status" value="{{ $record[0]['wl_osp_status'] }}" id="wl_osp_status" class="form-control block-field"></div>
                      </div>
                      <div class="one-box-inner">
                      <div class="fild-row"><label>SERVICE ID</label><input type="text" name="service_id" value="{{ $record[0]['service_id'] }}" id="service_id" class="form-control block-field"></div>
                      <div class="fild-row"><label>SITE A</label><input type="text" name="site_a" value="{{ $record[0]['site_master_record']['site_a'] }}" id="site_a" class="form-control block-field"></div>
                      <div class="fild-row"><label>SITE B</label><input type="text" name="site_a" value="{{ $record[0]['site_master_record']['site_b'] }}" id="site_b" class="form-control block-field"></div>
                      </div>
                      </div>

                      <div class="one-box-row two-box-row border-box">
                      <div class="one-box-inner">
                      <div class="fild-row"><label>RESOURCE</label>
                      <select class="form-control" name="resource" id="resource">                                  
                                  <option value="">please Select</option>
                                  @foreach($all_resources as $resources)
                                   <option value="{{ $resources->resources }}" <?php if($record[0]['resource'] == $resources->resources){ echo "selected";}?>>{{ $resources->resources }}</option>
                                  @endforeach
                               </select>  
                    </div>
                      <div class="fild-row"><label>WAYLEAVES SUBMITTED</label>
                      <div class="input-group date" id="custom_date_picker19" data-target-input="nearest">
                        @if($record[0]['wayleaves_submitted'])
                                          <input type="text" class="form-control datetimepicker-input" name="wayleaves_submitted" id="wayleaves_submitted" data-target="#custom_date_picker19" value="{{ Carbon\Carbon::parse($record[0]['wayleaves_submitted'])->format('m/d/Y') }}">
                                            @else
                                            <input type="text" class="form-control datetimepicker-input" name="wayleaves_submitted" id="wayleaves_submitted" data-target="#custom_date_picker19" value="">
                                          @endif
                                            <div class="input-group-append" data-target="#custom_date_picker19" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                  </div>
                    </div>
                      <div class="fild-row"><label>EXEPECTED WAYLEAVES RECEIVED DATE</label>
                      @if($wayleaves_recived_date)
                      <input type="text" value="{{ $wayleaves_recived_date }}" name="exepected_wl_received_date" id="exepected_wl_received_date" class="block-field"/>
                      @else
                      <input type="text" name="exepected_wl_received_date" value="" id="exepected_wl_received_date" class="form-control block-field">
                      @endif
                    </div>
                      </div>
                      <div class="one-box-inner">
                      <div class="fild-row"><label>WAYLEAVES RECEIVED</label>
                      <div class="input-group date" id="custom_date_picker22" data-target-input="nearest">
                      @if($record[0]['wayleaves_received'])
                          <input type="text" class="form-control datetimepicker-input" name="wayleaves_received" id="wayleaves_received" data-target="#custom_date_picker22" value="{{ Carbon\Carbon::parse($record[0]['wayleaves_received'])->format('m/d/Y') }}">
                          @else
                          <input type="text" class="form-control datetimepicker-input" name="wayleaves_received" id="wayleaves_received" data-target="#custom_date_picker22" value="">
                          @endif
                          <div class="input-group-append" data-target="#custom_date_picker22" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                  </div>
                    </div>
                      <div class="fild-row"><label>WAYLEAVES EXPIRY DATE</label>
                      <div class="input-group date" id="custom_date_picker23" data-target-input="nearest">
                      @if($record[0]['wl_expiry_date'])
                          <input type="text" class="form-control datetimepicker-input" name="wl_expiry_date" id="wl_expiry_date" data-target="#custom_date_picker23" value="{{ Carbon\Carbon::parse($record[0]['wl_expiry_date'])->format('m/d/Y') }}">
                          @else
                          <input type="text" class="form-control datetimepicker-input" name="wl_expiry_date" id="wl_expiry_date" data-target="#custom_date_picker23" value="">
                          @endif
                          <div class="input-group-append" data-target="#custom_date_picker23" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                  </div>
                      </div>
                      <div class="fild-row"><label>TOTAL NUMBER OF Responese Oustanding</label>
                      <input type="text" name="total_number_of_responses_oustanding" value="{{ $total_number_of_responses_oustanding }}" id="total_number_of_responses_oustanding" class="form-control block-field">
                    </div>
                      </div>
                      <div class="one-box-inner">
                      <div class="fild-row"><label>Rx IN PLANING</label>
                      <input type="text" name="rx_in_planning" value="{{ Carbon\Carbon::parse($record[0]['planning_record']['rx_in_planning'])->format('m/d/Y') }}" id="rx_in_planning" class="form-control block-field">
                    </div>
                      <div class="fild-row"><label>PLANNED WP2 RELEASED DATE</label>
                      <input type="text" name="planning_wp2_wl_submission" value="{{ Carbon\Carbon::parse($record[0]['planning_record']['planned_wp2_released_date'])->format('m/d/Y') }}" id="planning_wp2_wl_submission" class="form-control block-field">
                    </div>
                      <div class="fild-row"><label>PLANNING WP2 WL SUBMISSION</label>
                      <div class="input-group date" id="custom_date_picker1" data-target-input="nearest">
                               @if($record[0]['planning_record'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planning_record']['planning_wp2_wl_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planning_wp2_wl_submission" id="planning_wp2_wl_submission" data-target="#custom_date_picker1">
                              @else    
                              <input type="text" value="" class="form-control datetimepicker-input" name="planning_wp2_wl_submission" id="planning_wp2_wl_submission" data-target="#custom_date_picker1">
                                @endif
                              <div class="input-group-append" data-target="#custom_date_picker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                    </div>
                      <div class="fild-row"><label>EXISTING WAYLEAVES REF NO</label>
                      <input type="text" name="existing_wl_ref_no" value="{{ $record[0]['existing_wl_ref_no'] }}" id="existing_wl_ref_no" class="form-control">
                    </div>
                      <div class="fild-row"><label>External LA WL NUM</label>
                      <input type="text" name="external_la_wl_num" value="{{ $record[0]['external_la_wl_num'] }}" id="external_la_wl_num" class="form-control">
                    </div>
                      </div>
                      </div>


                      <div class="one-box-row three-box-row">
                      <div class="one-box-inner" style="padding:0;">
                      <div class="box-table-left">
                      <table>
                        <tr>
                          <th></th>
                          <th>Submitted</th>
                          <th>Lead Times</th>
                          <th>EST. Date</th>
                          <th>Recieved</th>
                        </tr>
                        <tr>
                          <td>stormwater Rou Dept.</td>                        
                          <td>
                            <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                  @if($record[0]['stormwater_rou_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="stormwater_rou_date_submitted" id="stormwater_rou_date_submitted" data-target="#custom_date_picker4" value="{{ Carbon\Carbon::parse($record[0]['stormwater_rou_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="stormwater_rou_date_submitted" id="stormwater_rou_date_submitted" data-target="#custom_date_picker4" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
                              </td>
                          <td> <input type="text" name="stormwater_rou_lead_time" value="{{ $record[0]['stormwater_rou_lead_time'] }}" id="stormwater_rou_lead_time" class="form-control"></td>
                          <td>{{ $stormwater_rou_date_estimated }}</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker16" data-target-input="nearest">
                                  @if($record[0]['stormwater_rou_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="stormwater_rou_date_received" id="stormwater_rou_date_received" data-target="#custom_date_picker16" value="{{ Carbon\Carbon::parse($record[0]['stormwater_rou_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="stormwater_rou_date_received" id="stormwater_rou_date_received" data-target="#custom_date_picker16" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker16" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                          </td>
                        </tr>           
                        <tr>
                          <td>Sewer Rou Dept.</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                  @if($record[0]['sewer_rou_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="sewer_rou_date_submitted" id="sewer_rou_date_submitted" data-target="#custom_date_picker5" value="{{ Carbon\Carbon::parse($record[0]['sewer_rou_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sewer_rou_date_submitted" id="sewer_rou_date_submitted" data-target="#custom_date_picker5" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                          </td>
                          <td><input type="text" name="sewer_rou_lead_time" value="{{ $record[0]['sewer_rou_lead_time'] }}" id="sewer_rou_lead_time" class="form-control"></td>
                          <td>{{ $sewer_rou_date_estimate }}</td>
                          <td> <div class="input-group date" id="custom_date_picker17" data-target-input="nearest">
                                  @if($record[0]['sewer_rou_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="sewer_rou_date_received" id="sewer_rou_date_received" data-target="#custom_date_picker17" value="{{ Carbon\Carbon::parse($record[0]['sewer_rou_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sewer_rou_date_received" id="sewer_rou_date_received" data-target="#custom_date_picker17" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker17" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>Telkom Dept.</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                  @if($record[0]['telkom_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="telkom_date_submitted" id="telkom_date_submitted" data-target="#custom_date_picker6" value="{{ Carbon\Carbon::parse($record[0]['telkom_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="telkom_date_submitted" id="telkom_date_submitted" data-target="#custom_date_picker6" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                          </td>
                          <td><input type="text" name="telkom_lead_time" value="{{ $record[0]['telkom_lead_time'] }}" id="telkom_lead_time" class="form-control"></td>
                          <td>{{ $telkom_date_estimate }}</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker24" data-target-input="nearest">
                                  @if($record[0]['telkom_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="telkom_date_received" id="telkom_date_received" data-target="#custom_date_picker24" value="{{ Carbon\Carbon::parse($record[0]['telkom_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="telkom_date_received" id="telkom_date_received" data-target="#custom_date_picker24" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker24" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Sasol Dept.</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                  @if($record[0]['sasol_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="sasol_date_submitted" id="sasol_date_submitted" data-target="#custom_date_picker7" value="{{ Carbon\Carbon::parse($record[0]['sasol_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sasol_date_submitted" id="sasol_date_submitted" data-target="#custom_date_picker7" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                          </td>
                          <td><input type="text" name="sasol_lead_time" value="{{ $record[0]['sasol_lead_time'] }}" id="sasol_lead_time" class="form-control"></td>
                          <td>{{ $sasol_date_estimate }}</td>
                          <td><div class="input-group date" id="custom_date_picker25" data-target-input="nearest">
                                  @if($record[0]['sasol_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="sasol_date_received" id="sasol_date_received" data-target="#custom_date_picker25" value="{{ Carbon\Carbon::parse($record[0]['sasol_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sasol_date_received" id="sasol_date_received" data-target="#custom_date_picker25" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker25" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>Transnet Dept.</td>
                          <td> <div class="input-group date" id="custom_date_picker8" data-target-input="nearest">
                                  @if($record[0]['transnet_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="transnet_date_submitted" id="transnet_date_submitted" data-target="#custom_date_picker8" value="{{ Carbon\Carbon::parse($record[0]['transnet_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="transnet_date_submitted" id="transnet_date_submitted" data-target="#custom_date_picker8" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker8" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="transnet_lead_time" value="{{ $record[0]['transnet_lead_time'] }}" id="transnet_lead_time" class="form-control"></td>
                          <td>{{ $transnet_date_estimate }}</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker26" data-target-input="nearest">
                                  @if($record[0]['transnet_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="transnet_date_received" id="transnet_date_received" data-target="#custom_date_picker26" value="{{ Carbon\Carbon::parse($record[0]['transnet_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="transnet_date_received" id="transnet_date_received" data-target="#custom_date_picker26" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker26" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Neotel Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                                  @if($record[0]['neotel_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="neotel_date_submitted" id="neotel_date_submitted" data-target="#custom_date_picker9" value="{{ Carbon\Carbon::parse($record[0]['neotel_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="neotel_date_submitted" id="neotel_date_submitted" data-target="#custom_date_picker9" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="neotel_lead_time" value="{{ $record[0]['neotel_lead_time'] }}" id="neotel_lead_time" class="form-control"></td>
                          <td>{{ $neotel_date_estimate }}</td>
                          <td> <div class="input-group date" id="custom_date_picker27" data-target-input="nearest">
                                  @if($record[0]['neotel_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="neotel_date_received" id="neotel_date_received" data-target="#custom_date_picker27" value="{{ Carbon\Carbon::parse($record[0]['neotel_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="neotel_date_received" id="neotel_date_received" data-target="#custom_date_picker27" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker27" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>Roads Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                  @if($record[0]['roads_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="roads_date_submitted" id="roads_date_submitted" data-target="#custom_date_picker10" value="{{ Carbon\Carbon::parse($record[0]['roads_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="roads_date_submitted" id="roads_date_submitted" data-target="#custom_date_picker10" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="roads_lead_time" value="{{ $record[0]['roads_lead_time'] }}" id="roads_lead_time" class="form-control"></td>
                          <td>{{ $roads_date_estimate }}</td>
                          <td> <div class="input-group date" id="custom_date_picker28" data-target-input="nearest">
                                  @if($record[0]['roads_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="roads_date_received" id="roads_date_received" data-target="#custom_date_picker28" value="{{ Carbon\Carbon::parse($record[0]['roads_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="roads_date_received" id="roads_date_received" data-target="#custom_date_picker28" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker28" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>DFA Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                  @if($record[0]['dfa_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="dfa_date_submitted" id="dfa_date_submitted" data-target="#custom_date_picker10" value="{{ Carbon\Carbon::parse($record[0]['dfa_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="dfa_date_submitted" id="dfa_date_submitted" data-target="#custom_date_picker10" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="dfa_lead_time" value="{{ $record[0]['dfa_lead_time'] }}" id="dfa_lead_time" class="form-control"></td>
                          <td>{{ $dfa_date_estimate }}</td>
                          <td><div class="input-group date" id="custom_date_picker29" data-target-input="nearest">
                                  @if($record[0]['dfa_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="dfa_date_received" id="dfa_date_received" data-target="#custom_date_picker29" value="{{ Carbon\Carbon::parse($record[0]['dfa_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="dfa_date_received" id="dfa_date_received" data-target="#custom_date_picker29" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker29" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>MTN Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker12" data-target-input="nearest">
                                  @if($record[0]['mtn_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="mtn_date_submitted" id="mtn_date_submitted" data-target="#custom_date_picker12" value="{{ Carbon\Carbon::parse($record[0]['mtn_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="mtn_date_submitted" id="mtn_date_submitted" data-target="#custom_date_picker12" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker12" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="mtn_lead_time" value="{{ $record[0]['mtn_lead_time'] }}" id="mtn_lead_time" class="form-control"></td>
                          <td>{{ $mtn_date_estimate }}</td>
                          <td><div class="input-group date" id="custom_date_picker30" data-target-input="nearest">
                                  @if($record[0]['mtn_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="mtn_date_received" id="mtn_date_received" data-target="#custom_date_picker30" value="{{ Carbon\Carbon::parse($record[0]['mtn_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="mtn_date_received" id="mtn_date_received" data-target="#custom_date_picker30" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker30" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>Sanral Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker13" data-target-input="nearest">
                                  @if($record[0]['sanral_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="sanral_date_submitted" id="sanral_date_submitted" data-target="#custom_date_picker13" value="{{ Carbon\Carbon::parse($record[0]['sanral_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sanral_date_submitted" id="sanral_date_submitted" data-target="#custom_date_picker13" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker13" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="sanral_lead_time" value="{{ $record[0]['sanral_lead_time'] }}" id="sanral_lead_time" class="form-control"></td>
                          <td>{{ $sanral_date_estimate }}</td>
                          <td><div class="input-group date" id="custom_date_picker31" data-target-input="nearest">
                                  @if($record[0]['sanral_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="sanral_date_received" id="sanral_date_received" data-target="#custom_date_picker31" value="{{ Carbon\Carbon::parse($record[0]['sanral_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sanral_date_received" id="sanral_date_received" data-target="#custom_date_picker31" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker31" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>Dept of Transport Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker14" data-target-input="nearest">
                                  @if($record[0]['dept_of_transport_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="dept_of_transport_date_submitted" id="dept_of_transport_date_submitted" data-target="#custom_date_picker14" value="{{ Carbon\Carbon::parse($record[0]['dept_of_transport_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="dept_of_transport_date_submitted" id="dept_of_transport_date_submitted" data-target="#custom_date_picker14" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker14" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="dept_of_transport_lead_time" value="{{ $record[0]['dept_of_transport_lead_time'] }}" id="dept_of_transport_lead_time" class="form-control"></td>
                          <td>{{ $dept_of_transport_estimate }}</td>
                          <td><div class="input-group date" id="custom_date_picker32" data-target-input="nearest">
                                  @if($record[0]['dept_of_transport_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="dept_of_transport_date_received" id="dept_of_transport_date_received" data-target="#custom_date_picker32" value="{{ Carbon\Carbon::parse($record[0]['dept_of_transport_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="dept_of_transport_date_received" id="dept_of_transport_date_received" data-target="#custom_date_picker32" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker32" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                        <tr>
                          <td>Water Sanitization Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker15" data-target-input="nearest">
                                  @if($record[0]['water_sanitation_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="water_sanitation_date_submitted" id="water_sanitation_date_submitted" data-target="#custom_date_picker15" value="{{ Carbon\Carbon::parse($record[0]['water_sanitation_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="water_sanitation_date_submitted" id="water_sanitation_date_submitted" data-target="#custom_date_picker15" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker15" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                          <td><input type="text" name="water_sanitation_lead_time" value="{{ $record[0]['water_sanitation_lead_time'] }}" id="water_sanitation_lead_time" class="form-control"></td>
                          <td>{{ $water_sanitation_date_estimate }}</td>
                          <td><div class="input-group date" id="custom_date_picker33" data-target-input="nearest">
                                  @if($record[0]['water_sanitation_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="water_sanitation_date_received" id="water_sanitation_date_received" data-target="#custom_date_picker33" value="{{ Carbon\Carbon::parse($record[0]['water_sanitation_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="water_sanitation_date_received" id="water_sanitation_date_received" data-target="#custom_date_picker33" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker33" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div></td>
                        </tr>
                      </table>
                      </div>
                      <div class="box-table-right">
                      <table>
                        <tr>
                          <td>Ethekwin Transport Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker50" data-target-input="nearest">
                                  @if($record[0]['ethekwini_transport_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="ethekwini_transport_date_submitted" id="ethekwini_transport_date_submitted" data-target="#custom_date_picker50" value="{{ Carbon\Carbon::parse($record[0]['ethekwini_transport_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="ethekwini_transport_date_submitted" id="ethekwini_transport_date_submitted" data-target="#custom_date_picker50" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker50" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                          <td><input type="text" name="ethekwini_transport_lead_time" value="{{ $record[0]['ethekwini_transport_lead_time'] }}" id="ethekwini_transport_lead_time" class="form-control"></td>
                          <td>{{ $ethekwini_transport_date_submitted }}</td>
                          <td><div class="input-group date" id="custom_date_picker51" data-target-input="nearest">
                                  @if($record[0]['ethekwini_transport_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="ethekwini_transport_date_received" id="ethekwini_transport_date_received" data-target="#custom_date_picker51" value="{{ Carbon\Carbon::parse($record[0]['ethekwini_transport_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="ethekwini_transport_date_received" id="ethekwini_transport_date_received" data-target="#custom_date_picker51" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker51" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                            </td>
                        </tr>
                        <tr>
                          <td>Electricity Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker52" data-target-input="nearest">
                                  @if($record[0]['electricity_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="electricity_date_submitted" id="electricity_date_submitted" data-target="#custom_date_picker52" value="{{ Carbon\Carbon::parse($record[0]['electricity_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="electricity_date_submitted" id="electricity_date_submitted" data-target="#custom_date_picker52" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker52" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div></td>
                          <td><input type="text" name="electricity_lead_time" value="{{ $record[0]['electricity_lead_time'] }}" id="electricity_lead_time" class="form-control"></td>
                          <td>{{$electricity_date_submitted}}</td>
                          <td><div class="input-group date" id="custom_date_picker53" data-target-input="nearest">
                                  @if($record[0]['electricity_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="electricity_date_received" id="electricity_date_received" data-target="#custom_date_picker53" value="{{ Carbon\Carbon::parse($record[0]['electricity_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="electricity_date_received" id="electricity_date_received" data-target="#custom_date_picker53" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker53" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                            </td>
                        </tr>
                        <tr>
                          <td>Parks Dept.</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker70" data-target-input="nearest">
                                  @if($record[0]['parks_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="parks_date_submitted" id="parks_date_submitted" data-target="#custom_date_picker70" value="{{ Carbon\Carbon::parse($record[0]['parks_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="parks_date_submitted" id="parks_date_submitted" data-target="#custom_date_picker70" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker70" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                            </div>
                          </td>
                          <td><input type="text" name="parks_lead_time" value="{{ $record[0]['parks_lead_time'] }}" id="parks_lead_time" class="form-control"></td>
                          <td>{{ $parks_date_submitted }}</td>
                          <td><div class="input-group date" id="custom_date_picker98" data-target-input="nearest">
                                  @if($record[0]['parks_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="parks_date_received" id="parks_date_received" data-target="#custom_date_picker98" value="{{ Carbon\Carbon::parse($record[0]['parks_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="parks_date_received" id="parks_date_received" data-target="#custom_date_picker98" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker98" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                            </td>
                        </tr> 
                        <tr>
                          <td>Coastal Stormwater Catchment.</td>
                          <td>
                          <div class="input-group date" id="custom_date_picker71" data-target-input="nearest">
                                  @if($record[0]['coastal_stormwater_catchment_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_submitted" id="coastal_stormwater_catchment_date_submitted" data-target="#custom_date_picker71" value="{{ Carbon\Carbon::parse($record[0]['coastal_stormwater_catchment_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_submitted" id="coastal_stormwater_catchment_date_submitted" data-target="#custom_date_picker71" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker71" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          
                            </td>
                          <td><input type="text" name="coastal_stormwater_catchment_lead_time" value="{{ $record[0]['coastal_stormwater_catchment_lead_time'] }}" id="coastal_stormwater_catchment_lead_time" class="form-control"></td>
                          <td>{{$coastal_stormwater_catchment_date_submitted}}</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker72" data-target-input="nearest">
                                  @if($record[0]['coastal_stormwater_catchment_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_received" id="coastal_stormwater_catchment_date_received" data-target="#custom_date_picker72" value="{{ Carbon\Carbon::parse($record[0]['coastal_stormwater_catchment_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="coastal_stormwater_catchment_date_received" id="coastal_stormwater_catchment_date_received" data-target="#custom_date_picker72" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker72" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                            </td>
                        </tr>
                        <tr>
                          <td>Development Planning Dept.</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker54" data-target-input="nearest">
                                  @if($record[0]['development_planning_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="development_planning_date_submitted" id="development_planning_date_submitted" data-target="#custom_date_picker54" value="{{ Carbon\Carbon::parse($record[0]['development_planning_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="development_planning_date_submitted" id="development_planning_date_submitted" data-target="#custom_date_picker54" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker54" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                          <td><input type="text" name="development_planning_lead_time" value="{{ $record[0]['development_planning_lead_time'] }}" id="development_planning_lead_time" class="form-control"></td>
                          <td>{{$development_planning_date_submitted}}</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker55" data-target-input="nearest">
                                  @if($record[0]['development_planning_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="development_planning_date_received" id="development_planning_date_received" data-target="#custom_date_picker55" value="{{ Carbon\Carbon::parse($record[0]['development_planning_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="development_planning_date_received" id="development_planning_date_received" data-target="#custom_date_picker55" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker55" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Traffic Signals Dept.</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker56" data-target-input="nearest">
                                  @if($record[0]['traffic_signals_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="traffic_signals_date_submitted" id="traffic_signals_date_submitted" data-target="#custom_date_picker56" value="{{ Carbon\Carbon::parse($record[0]['traffic_signals_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="traffic_signals_date_submitted" id="traffic_signals_date_submitted" data-target="#custom_date_picker56" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker56" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                              </div>
                          </td>
                          <td><input type="text" name="traffic_signals_lead_time" value="{{ $record[0]['traffic_signals_lead_time'] }}" id="traffic_signals_lead_time" class="form-control"></td>
                          <td>{{$traffic_signals_date_submitted}}</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker57" data-target-input="nearest">
                                  @if($record[0]['traffic_signals_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="traffic_signals_date_received" id="traffic_signals_date_received" data-target="#custom_date_picker57" value="{{ Carbon\Carbon::parse($record[0]['traffic_signals_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="traffic_signals_date_received" id="traffic_signals_date_received" data-target="#custom_date_picker57" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker57" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                              </div>
                          </td>
                        </tr>  
                        <tr>
                          <td>Environmental Management Dept.</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker58" data-target-input="nearest">
                                  @if($record[0]['enviromental_management_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="enviromental_management_date_submitted" id="enviromental_management_date_submitted" data-target="#custom_date_picker58" value="{{ Carbon\Carbon::parse($record[0]['enviromental_management_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="enviromental_management_date_submitted" id="enviromental_management_date_submitted" data-target="#custom_date_picker58" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker58" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                              </div>
                          </td>
                          <td><input type="text" name="enviromental_management_lead_time" value="{{ $record[0]['enviromental_management_lead_time'] }}" id="enviromental_management_lead_time" class="form-control"></td>
                          <td>{{$enviromental_management_date_submitted}}</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker59" data-target-input="nearest">
                                  @if($record[0]['enviromental_management_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="enviromental_management_date_received" id="enviromental_management_date_received" data-target="#custom_date_picker59" value="{{ Carbon\Carbon::parse($record[0]['enviromental_management_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="enviromental_management_date_received" id="enviromental_management_date_received" data-target="#custom_date_picker59" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker59" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                            </div>
                          </td>
                        </tr>  
                        <tr>
                          <td>Transporation Planning Dept.</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker60" data-target-input="nearest">
                                  @if($record[0]['transportation_planning_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="transportation_planning_date_submitted" id="transportation_planning_date_submitted" data-target="#custom_date_picker60" value="{{ Carbon\Carbon::parse($record[0]['transportation_planning_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="transportation_planning_date_submitted" id="transportation_planning_date_submitted" data-target="#custom_date_picker60" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker60" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                            </div>
                          </td>
                          <td><input type="text" name="transportation_planning_lead_time" value="{{ $record[0]['transportation_planning_lead_time'] }}" id="transportation_planning_lead_time" class="form-control"></td>
                          <td>{{$transportation_planning_date_submitted}}</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker61" data-target-input="nearest">
                                  @if($record[0]['transportation_planning_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="transportation_planning_date_received" id="transportation_planning_date_received" data-target="#custom_date_picker61" value="{{ Carbon\Carbon::parse($record[0]['transportation_planning_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="transportation_planning_date_received" id="transportation_planning_date_received" data-target="#custom_date_picker61" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker61" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                            </div>
                          </td>
                        </tr> 
                        <tr>
                          <td>Technical Services Dept.</td>
                          <td>
                            <div class="input-group date" id="custom_date_picker62" data-target-input="nearest">
                                  @if($record[0]['technical_services_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="technical_services_date_submitted" id="technical_services_date_submitted" data-target="#custom_date_picker62" value="{{ Carbon\Carbon::parse($record[0]['technical_services_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="technical_services_date_submitted" id="technical_services_date_submitted" data-target="#custom_date_picker62" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker62" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                              </div>
                          </td>
                          <td><input type="text" name="technical_services_lead_time" value="{{ $record[0]['technical_services_lead_time'] }}" id="technical_services_lead_time" class="form-control"></td>
                          <td>{{$technical_services_date_submitted}}</td>
                          <td><div class="input-group date" id="custom_date_picker63" data-target-input="nearest">
                                  @if($record[0]['technical_services_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="technical_services_date_received" id="technical_services_date_received" data-target="#custom_date_picker63" value="{{ Carbon\Carbon::parse($record[0]['technical_services_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="technical_services_date_received" id="technical_services_date_received" data-target="#custom_date_picker63" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker63" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                        </tr> 
                        <tr>  
                          <td>Sembcorp Siza Water Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker64" data-target-input="nearest">
                                  @if($record[0]['sembcorp_siza_water_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_submitted" id="sembcorp_siza_water_date_submitted" data-target="#custom_date_picker64" value="{{ Carbon\Carbon::parse($record[0]['sembcorp_siza_water_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_submitted" id="sembcorp_siza_water_date_submitted" data-target="#custom_date_picker64" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker64" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                          <td><input type="text" name="sembcorp_siza_water_lead_time" value="{{ $record[0]['sembcorp_siza_water_lead_time'] }}" id="sembcorp_siza_water_lead_time" class="form-control"></td>
                          <td>{{$sembcorp_siza_water_date_submitted}}</td>
                          <td><div class="input-group date" id="custom_date_picker65" data-target-input="nearest">
                                  @if($record[0]['sembcorp_siza_water_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_received" id="sembcorp_siza_water_date_received" data-target="#custom_date_picker65" value="{{ Carbon\Carbon::parse($record[0]['sembcorp_siza_water_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="sembcorp_siza_water_date_received" id="sembcorp_siza_water_date_received" data-target="#custom_date_picker65" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker65" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                        </tr>  
                        <tr>
                          <td>Legal Services Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker66" data-target-input="nearest">
                                  @if($record[0]['legal_services_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="legal_services_date_submitted" id="legal_services_date_submitted" data-target="#custom_date_picker66" value="{{ Carbon\Carbon::parse($record[0]['legal_services_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="legal_services_date_submitted" id="legal_services_date_submitted" data-target="#custom_date_picker66" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker66" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                          <td><input type="text" name="legal_services_lead_time" value="{{ $record[0]['legal_services_lead_time'] }}" id="legal_services_lead_time" class="form-control"></td>
                          <td>{{$legal_services_date_submitted}}</td>
                          <td><div class="input-group date" id="custom_date_picker67" data-target-input="nearest">
                                  @if($record[0]['legal_services_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="legal_services_date_received" id="legal_services_date_received" data-target="#custom_date_picker67" value="{{ Carbon\Carbon::parse($record[0]['legal_services_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="legal_services_date_received" id="legal_services_date_received" data-target="#custom_date_picker67" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker67" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                        </tr> 
                        <tr>
                          <td>Eskom Dept.</td>
                          <td><div class="input-group date" id="custom_date_picker68" data-target-input="nearest">
                                  @if($record[0]['eskom_date_submitted'])
                                    <input type="text" class="form-control datetimepicker-input" name="eskom_date_submitted" id="eskom_date_submitted" data-target="#custom_date_picker68" value="{{ Carbon\Carbon::parse($record[0]['eskom_date_submitted'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="eskom_date_submitted" id="eskom_date_submitted" data-target="#custom_date_picker68" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker68" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div>
                          </td>
                          <td><input type="text" name="eskom_lead_time" value="{{ $record[0]['eskom_lead_time'] }}" id="eskom_lead_time" class="form-control"></td>
                          <td>{{$eskom_date_submitted}}</td>
                          <td><div class="input-group date" id="custom_date_picker69" data-target-input="nearest">
                                  @if($record[0]['eskom_date_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="eskom_date_received" id="eskom_date_received" data-target="#custom_date_picker69" value="{{ Carbon\Carbon::parse($record[0]['eskom_date_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="eskom_date_received" id="eskom_date_received" data-target="#custom_date_picker69" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker69" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>             
                                 </div></td>
                        </tr>
                      </table>
                      </div>
                      </div>
                      </div>

                      </div>
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('permission', $edit_access['edit_access_type']))
                          <button type="submit" class="btn btn-primary">Submit</button>
                        @endif
                    </div>
                      </form>
                      @else
                        <h2>No Result Found</h2>
                        @endif
                      </div>


                                    
                            </div>
                            </div>
                              </div>
                          </section>
</div>
     <!-- Main content -->
 @endsection