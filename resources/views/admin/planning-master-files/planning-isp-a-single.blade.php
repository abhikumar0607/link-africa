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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card La-add-scroll">
                  <div class="card-header">
                      <h3 class="card-title">Edit Planning Isp A</h3>
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
                    <form action="{{ route('admin.planning.planning.status.update',$record[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_survey_file_record"  class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif

                  
                      <div class="card-body no-scroll-need">
                        <div class="row border-box" style="margin-top:10px; margin-bottom:10px;">
                          <div class="col-3">
                            <div class="form-group">
                                <label>Project Status:</label>
                                <input type="text" class="form-control block-field" name="project_status" id="project_status" value="{{ $record[0]['site_master_record']['project_status'] }}"> 
                                @if($record[0]['landlord_record'])
                                <input type="hidden" class="form-control block-field" name="landlord_approval_status" id="landlord_approval_status" value="{{ $record[0]['landlord_record']['landlord_approval_status'] }}">
                                @else
                                <input type="hidden" class="form-control block-field" name="landlord_approval_status" id="landlord_approval_status" value="">
                                @endif

                                @if($record[0]['site_survey_record'])
                                <input type="hidden" class="form-control block-field" name="site_survey_status" id="site_survey_status" value="{{ $record[0]['site_survey_record']['site_survey_status'] }}"> 
                                @else
                                <input type="hidden" class="form-control block-field" name="site_survey_status" id="site_survey_status" value=""> 
                                @endif
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
                                <label>Circuit ID:</label>
                                <input type="text" class="form-control" name="circuit_id" id="circuit_id" value="{{ $record[0]['site_master_record']['circuit_id'] }}"> 
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Service ID:</label>
                                <input type="text" class="form-control block-field" name="service_id" id="service_id" value="{{ $record[0]['site_master_record']['service_id'] }}"> 
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Date Po Order Rx:</label>
                                <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                  @if($record[0]['datenew'])
                                    <input type="text" class="form-control datetimepicker-input block-field" name="date_po_order_rx" id="date_po_order_rx" data-target="#custom_date_picker4" value="{{ Carbon\Carbon::parse($record[0]['datenew'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input block-field" name="date_po_order_rx" id="date_po_order_rx" data-target="#custom_date_picker4" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>            
                           <div class="col-3">
                            <div class="form-group">
                                <label>Client Ring:</label>
                                <input type="text" name="client_ring" value="{{ $record[0]['site_master_record']['client_ring'] }}" id="client_ring" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                <input type="text" name="metro_area" value="{{ $record[0]['site_master_record']['metro_area'] }}" id="metro_area" class="form-control block-field">
                            </div>
                          </div>
                          
                          <div class="col-3">
                        <div class="form-group">
                            <label>PERMISSION STATUS:</label>
                            <input type="text" name="permissions_status" value="{{ $record[0]['permission_record']['permissions_status'] }}" id="permissions_status" class="form-control block-field">
                        </div>
                      </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <label>Service Type:</label>
                                <input type="text" name="service_type" value="{{ $record[0]['site_master_record']['service_type'] }}" id="service_type" class="form-control block-field">
                            </div>
                          </div>
                                                                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" name="project_id" value="{{ $record[0]['site_master_record']['project_id'] }}" id="project_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Order Ref No:</label>
                                <input type="text" name="order_ref_number" value="{{ $record[0]['site_master_record']['order_ref_number'] }}" id="order_ref_number" class="form-control block-field">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['site_master_record']['client_name'] }}" id="client_name" class="form-control block-field">
                            </div>
                          </div>    
                                               
                          <div class="col-3">
                            <div class="form-group">
                                <label>Province:</label>
                                <input type="text" name="province" value="{{ $record[0]['site_master_record']['province'] }}" id="province" class="form-control block-field">
                            </div>
                          </div>
                       
                          <div class="col-3">
                            <div class="form-group">
                                <label>BUILD STATUS:</label>
                                <input type="text" name="build_status" value="{{ $record[0]['build_record']['build_status'] }}" id="build_status" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Project Type:</label>
                                <select class="form-control" name="type" id="type">
                                <option value="" selected="">Please Select</option>
                                @foreach($all_project_type as $project_type)
                                <option value="{{ $project_type->project_type }}"<?php if ($record[0]['site_master_record']['type'] == $project_type->project_type) echo ' selected="selected"'; ?>>{{ $project_type->project_type }}</option>
                                 @endforeach 
                                </select>
                            </div>
                          </div> 
                          <div class="col-2">
                           <div class="form-group">
                                <label>PO MRC:</label>
                                <input type="text" name="po_mrc" value="{{ $record[0]['site_master_record']['po_mrc'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                         </div> 
                         <div class="col-2">
                           <div class="form-group">
                                <label>PO NRC:</label>
                                <input type="text" name="po_nrc" value="{{ $record[0]['site_master_record']['po_nrc'] }}" id="po_nrc" class="form-control block-field">
                            </div>
                         </div> 
                         <div class="col-2">
                         <div class="form-group">
                                <label>Special Build NRC:</label>
                                <input type="text" name="special_build_nrc" value="{{ $record[0]['site_master_record']['special_build_nrc'] }}" id="special_build_nrc" class="form-control block-field">
                            </div>
                         </div>
                         </div>  
                         <div class="row">                    
                          <div class="col-4">
                <div class="form-group">
                    <label>PLANNING STATUS:</label>
                    <select class="form-control" name="planning_status" id="planning_status">
                        <option value="">Select planning Status</option>
                        @foreach($all_planning_status as $planning_status)
                        <option value="{{ $planning_status->planning_status }}" <?php if($record[0]['planning_status'] == $planning_status->planning_status) { echo "selected"; } ?>>{{ $planning_status->planning_status }}</option>
                        @endforeach
                      </select>
                </div>
              </div> 
                          <div class="col-4">
                            <div class="form-group">
                                <label>FEASIBILITY REF Nr:</label>
                                <input type="text" name="feasibility_ref_nr" value="{{ $record[0]['site_master_record']['feasibility_ref_nr'] }}" id="feasibility_ref_nr" class="form-control">
                            </div>
                          </div> 
                          <div class="col-4">
                            <div class="form-group">
                                <label>NETWORK TYPE:</label>

                                <select class="form-control" name="network_types" id="network_types">
                                  @foreach($all_network_type as $network_type)
                                    <option value="{{ $network_type->network_type }}" <?php if($record[0]['site_master_record']['network_types'] == $network_type->network_type) { echo "selected"; } ?>>{{ $network_type->network_type }}</option>
                                 @endforeach
                                </select>
                            </div>
                          </div> 
                          <div class="col-4">
                            <div class="form-group">
                                <label>OSP STATUS PLANNING:</label>
                                <select class="form-control" name="osp_status_panning" id="osp_status_panning">
                                <option value="">Please Select</option>
                                @foreach($all_osp_planning_status as $osp_planning_status)
                                  <option value="{{ $osp_planning_status->osp_status_planning }}" <?php if($record[0]['osp_status_panning'] == $osp_planning_status->osp_status_planning) { echo "selected"; } ?>>{{ $osp_planning_status->osp_status_planning }}</option>
                                @endforeach  
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>LINK DEPENDENCY:</label>                              
                                <input type="text" name="link_dependency" value="{{ $record[0]['link_dependency'] }}" id="link_dependency" class="form-control">                        
                            </div>
                          </div>
                          </div>
                          <div class="row secound-Qw">
                           <div class="col-md-4 inner-peth"> 
                            <div class="border-box" style="margin-top:10px;">
                            <div class="row">                         
                          <div class="col-6">
                            <div class="form-group">
                                <label>Pop List:</label>
                                <select class="form-control" name="pop_list" id="pop_list">
                                  @foreach($la_records as $la_record)
                                  <option value="{{ $la_record['pop_name'] }}">{{ $la_record['pop_name'] }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                                <label>Site A:</label>
                                <select class="form-control" name="site_a" id="site_a">
                                <option value="">Please Select</option>
                                @foreach($site_a_records as $site_a_record)
                                  <option value="{{ $site_a_record['site_name'] }}" <?php if($record[0]['site_master_record']['site_a'] == $site_a_record['site_name']) { echo "selected"; } ?>>{{ $site_a_record['site_name'] }}</option>
                                @endforeach
                                </select>
                            </div>
                          </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A STATUS:</label>                              
                                <select class="form-control" name="site_a_status" id="site_a_status">
                                <option value="">please Select</option>
                                @foreach($all_site_status as $site_status)
                                <option value="{{ $site_status->site_status }}" <?php if($record[0]['site_a_status'] == $site_status->site_status) { echo "selected"; } ?>>{{ $site_status->site_status }}</option>
                               @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A:</label>
                                <input type="text" name="view_name_site_a" value="{{ $record[0]['site_master_record']['site_a'] }}" id="view_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>CONTACT NAME - SITE A:</label>
                                <input type="text" name="contact_name_site_a" value="{{ $record[0]['site_master_record']['contact_name_site_a'] }}" id="contact_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PHYISCAL ADDRESS - SITE A:</label>
                                <input type="text" name="physical_address_site_a" value="{{ $record[0]['site_master_record']['physical_address_site_a'] }}" id="physical_address_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co - ordinates - Site A-X:</label>
                                <input type="text" name="gps_co_ordinates_site_a_x" value="{{ $record[0]['site_master_record']['gps_co_ordinates_site_a_x'] }}" id="gps_co_ordinates_site_a_x" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co - ordinates - Site A-Y:</label>
                                <input type="text" name="gps_co_ordinates_site_a_y" value="{{ $record[0]['site_master_record']['gps_co_ordinates_site_a_y'] }}" id="gps_co_ordinates_site_a_y" class="form-control valid" aria-invalid="false">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WORK NUMBER - SITE A:</label>
                                <input type="text" name="work_number_site_a" value="{{ $record[0]['site_master_record']['work_number_site_a'] }}" id="work_number_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>MOBILE NUMBER- SITE A:</label>
                                <input type="text" name="mobile_number_site_a" value="{{ $record[0]['site_master_record']['mobile_number_site_a'] }}" id="mobile_number_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>EMAIL ADDRESS - SITE A</label>:</label>
                                <input type="text" name="email_address_site_a" value="{{ $record[0]['site_master_record']['email_address_site_a'] }}" id="email_address_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                <div class="form-group">
                <label>SITE A SURVEY DATE:</label>
                 <div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                   @if($record[0]['site_a_survey_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_survey_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_survey_date" id="site_a_survey_date" data-target="#custom_date_picker9">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_a_survey_date" id="site_a_survey_date" data-target="#custom_date_picker9">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>SITE A ISP SUBMISSION:</label>
                 <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                   @if($record[0]['site_a_survey_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_isp_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_isp_submission" id="site_a_isp_submission" data-target="#custom_date_picker10">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_a_isp_submission" id="site_a_isp_submission" data-target="#custom_date_picker10">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>ISP A WP2 APPROVAL RECEIVED:</label>
                 <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                   @if($record[0]['isp_a_wp2_approval_received'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_a_wp2_approval_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_a_wp2_approval_received" id="isp_a_wp2_approval_received" data-target="#custom_date_picker5">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_a_wp2_approval_received" id="isp_a_wp2_approval_received" data-target="#custom_date_picker5">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>ISP A WP2 APPROVAL REQUESTED:</label>
                 <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                   @if($record[0]['isp_a_wp2_approval_requested'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_a_wp2_approval_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_a_wp2_approval_requested" id="isp_a_wp2_approval_requested" data-target="#custom_date_picker6">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_a_wp2_approval_requested" id="isp_a_wp2_approval_requested" data-target="#custom_date_picker6">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                </div> 
                <div class="border-box">
                <div class="col-3">
                <div class="form-group">
                <label>Rx IN PLANNING:</label>
                   @if($record[0]['datenew'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['datenew'])->format('m/d/Y') }}" class="form-control  block-field" name="rx_in_planning" id="rx_in_planning">
                    @else
                    <input type="text" value="" class="form-control  block-field" name="rx_in_planning" id="rx_in_planning">
                  @endif  
                    </div>
                  </div>
                 
              
                <div class="col-3">
                <div class="form-group">
                <label>PLANNED WP2 RELEASED DATE:</label>
                   @if($newe_rx_planning_date)
                      <input type="text" value="{{ $newe_rx_planning_date }}" class="form-control block-field" name="planned_wp2_released_date" id="planned_wp2_released_date" data-target="#custom_date_picker">
                    @else
                      <input type="text" value="" class="form-control  block-field" name="planned_wp2_released_date" id="planned_wp2_released_date">
                  @endif
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>PLANNING WP2 WL SUBMISSION::</label>
                 <div class="input-group date" id="custom_date_picker14" data-target-input="nearest">
                   @if($record[0]['planning_wp2_wl_submission'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planning_wp2_wl_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planning_wp2_wl_submission" id="planning_wp2_wl_submission" data-target="#custom_date_picker14">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="planning_wp2_wl_submission" id="planning_wp2_wl_submission" data-target="#custom_date_picker14">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker14" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>REVISED PLANNED WP2 DATE:</label>
                 <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                   @if($record[0]['revised_planned_wp2_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_planned_wp2_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>OSP WP2 APPROVAL REQUESTED:</label>
                 <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                   @if($record[0]['wp2_approval_requested'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wp2_approval_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="wp2_approval_requested" id="wp2_approval_requested" data-target="#custom_date_picker3">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="wp2_approval_requested" id="wp2_approval_requested" data-target="#custom_date_picker3">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>OSP WP2 APPROVAL RECEIVED:</label>
                 <div class="input-group date" id="custom_date_picker15" data-target-input="nearest">
                   @if($record[0]['wp2_approval_received'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wp2_approval_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="wp2_approval_received" id="wp2_approval_requested" data-target="#custom_date_picker15">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="wp2_approval_received" id="wp2_approval_received" data-target="#custom_date_picker15">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker15" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>OSP ASBUILD RECEIVED DATE:</label>
                  <div class="input-group date" id="custom_date_picker50" data-target-input="nearest">
                   @if($record[0]['build_record'])
                    <input type="text" value="{{ $record[0]['build_record']['osp_asbuild_received'] }}" class="form-control datetimepicker-input" name="osp_asbuild_received" id="osp_asbuild_received" data-target="#custom_date_picker50">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="osp_asbuild_received" id="osp_asbuild_received" data-target="#custom_date_picker50">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker50" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                   
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>ISP ASBuild RECEIVED DATE:</label>
                <div class="input-group date" id="custom_date_picker52" data-target-input="nearest">
                   @if($record[0]['build_record'])
                    <input type="text" value="{{ $record[0]['build_record']['isp_asbuild_received'] }}" class="form-control datetimepicker-input" name="isp_asbuild_received" id="isp_asbuild_received" data-target="#custom_date_picker52">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_asbuild_received" id="isp_asbuild_received" data-target="#custom_date_picker52">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker52" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  
                 </div>
                </div>
                </div>
                          </div>
                          <div class="col-md-4 inner-peth">  
                            <div class="border-box" style="margin-top:10px;">   
                            <div class="row">                         
                          <div class="col-6">
                            <div class="form-group">
                                <label>Pop List:</label>
                                <select class="form-control" name="pop_list" id="pop_list">
                                  @foreach($la_records as $la_record)
                                  <option value="{{ $la_record['pop_name'] }}">{{ $la_record['pop_name'] }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>                    
                          <div class="col-6">
                            <div class="form-group">
                                <label>SITE B:</label>                                
                                <select class="form-control" name="site_b" id="site_b">
                                <option value="">Please Select</option>
                                @foreach($site_b_records as $site_b_record)
                                  <option value="{{ $site_b_record['site_name'] }}" <?php if($record[0]['site_master_record']['site_b'] == $site_b_record['site_name']) { echo "selected"; } ?>>{{ $site_b_record['site_name'] }}</option>
                                @endforeach
                                 </select>
                            </div>
                          </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B STATUS:</label>                               
                                <select class="form-control" name="site_b_status" id="site_b_status">                                  
                                <option value="">please Select</option>
                                @foreach($all_site_status as $site_status)
                                <option value="{{ $site_status->site_status }}" <?php if($record[0]['site_b_status'] == $site_status->site_status) { echo "selected"; } ?>>{{ $site_status->site_status }}</option>
                               @endforeach
                             </select>                                    
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site B:</label>
                                <input type="text" name="view_name_site_b" value="{{ $record[0]['site_master_record']['site_b'] }}" id="view_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>CONTACT NAME - Site B:</label>
                                <input type="text" name="contact_name_site_b" value="{{ $record[0]['site_master_record']['contact_name_site_b'] }}" id="contact_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site B:</label>
                                <input type="text" name="physical_address_site_b" value="{{ $record[0]['site_master_record']['physical_address_site_b'] }}" id="physical_address_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co- ordinates - Site B-X:</label>
                                <input type="text" name="gps_co_ordinates_site_b_x" value="{{ $record[0]['site_master_record']['gps_co_ordinates_site_b_x'] }}" id="gps_co_ordinates_site_b_x" class="form-control valid" aria-invalid="false">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co- ordinates - Site B-Y:</label>
                                <input type="text" name="gps_co_ordinates_site_b_y" value="{{ $record[0]['site_master_record']['gps_co_ordinates_site_b_y'] }}" id="gps_co_ordinates_site_b_y" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site B:</label>
                                <input type="text" name="work_number_site_b" value="{{ $record[0]['site_master_record']['work_number_site_b'] }}" id="work_number_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site B:</label>
                                <input type="text" name="mobile_number_site_b" value="{{ $record[0]['site_master_record']['mobile_number_site_b'] }}" id="mobile_number_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site B:</label>
                                <input type="email" name="email_address_site_b" value="{{ $record[0]['site_master_record']['email_address_site_b'] }}" id="email_address_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                <div class="form-group">
                <label>SITE B SURVEY DATE:</label>
                 <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                   @if($record[0]['site_b_survey_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_survey_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_b_survey_date" id="site_b_survey_date" data-target="#custom_date_picker11">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_b_survey_date" id="site_b_survey_date" data-target="#custom_date_picker11">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>SITE B ISP SUBMISSION:</label>
                 <div class="input-group date" id="custom_date_picker12" data-target-input="nearest">
                   @if($record[0]['site_b_isp_submission'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_isp_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_b_isp_submission" id="site_b_isp_submission" data-target="#custom_date_picker12">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_b_isp_submission" id="site_b_isp_submission" data-target="#custom_date_picker12">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker12" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>  
                <div class="col-3">
                <div class="form-group">
                <label>ISP B WP2 APPROVAL RECEIVED:</label>
                 <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                   @if($record[0]['isp_b_wp2_approval_received'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_b_wp2_approval_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_b_wp2_approval_received" id="isp_b_wp2_approval_received" data-target="#custom_date_picker7">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_b_wp2_approval_received" id="isp_b_wp2_approval_received" data-target="#custom_date_picker7">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                <label>ISP B WP2 APPROVAL REQUESTED:</label>
                 <div class="input-group date" id="custom_date_picker8" data-target-input="nearest">
                   @if($record[0]['isp_b_wp2_approval_requested'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_b_wp2_approval_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_b_wp2_approval_requested" id="isp_b_wp2_approval_requested" data-target="#custom_date_picker8">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_b_wp2_approval_requested" id="isp_b_wp2_approval_requested" data-target="#custom_date_picker8">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker8" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div> 
                </div>
                <div class="border-box">
                <div class="col-3">
                <div class="form-group">
                    <label>OSP PLANNERS:</label>
                    <select class="form-control" name="osp_planners" id="osp_planners">                                  
                      <option value="">Please Select</option>
                      @foreach($all_osp_planners as $osp_planners)
                      <option value="{{ $osp_planners->osp_planners }}"  <?php if($record[0]['osp_planners'] == $osp_planners->osp_planners) { echo "selected"; } ?>>{{ $osp_planners->osp_planners }}</option>
                      @endforeach
                    </select>  
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP PLANNERS:</label>
                    <select class="form-control" name="isp_planners" id="isp_planners">                                  
                      <option value="">Please Select</option>
                      @foreach($all_isp_planners as $isp_planners)
                      <option value="{{ $isp_planners->isp_planners }}" <?php if($record[0]['isp_planners'] == $isp_planners->isp_planners) { echo "selected"; } ?>>{{ $isp_planners->isp_planners }}</option>
                      @endforeach
                    </select>  
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SURVEYORS:</label>
                    <select class="form-control" name="surveyors" id="surveyors">                                  
                      <option value="">Please Select</option>
                      @foreach($all_surveyors as $surveyors)
                      <option value="{{ $surveyors->surveyors }}" <?php if($record[0]['surveyors'] == $surveyors->surveyors) { echo "selected"; } ?>>{{ $surveyors->surveyors }}</option>
                      @endforeach
                    </select>   
                </div>
              </div> 
              <div class="col-3">
                <div class="form-group">
                  <label>WAYLEAVES SUBMITTED:</label>
                  <div class="input-group date" id="custom_date_picker19" data-target-input="nearest">
                    @if( $record[0]['permission_record']['wayleaves_submitted'])
                      <input type="text" class="form-control datetimepicker-input" name="wayleaves_submitted" id="wayleaves_submitted" data-target="#custom_date_picker19" value="{{ Carbon\Carbon::parse($record[0]['permission_record']['wayleaves_submitted'])->format('m/d/Y') }}">
                      @else
                      <input type="text" class="form-control datetimepicker-input" name="wayleaves_submitted" id="wayleaves_submitted" data-target="#custom_date_picker19" value="">
                      @endif
                      <div class="input-group-append" data-target="#custom_date_picker19" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                  </div>
                </div>
              </div>  
              <div class="col-3">
                <div class="form-group">
                  <label>WAYLEAVES ESTIMATED:</label>
                      <input type="text" class="form-control" name="wayleaves_estimated" id="wayleaves_estimated" data-target="#custom_date_picker21" value="{{ $record[0]['permission_record']['wayleaves_estimated'] }}">  
                </div>
              </div>   
              <div class="col-3">
                <div class="form-group">
                  <label>WAYLEAVES RECEIVED:</label>
                  <div class="input-group date" id="custom_date_picker22" data-target-input="nearest">
                    @if($record[0]['permission_record']['wayleaves_received'])
                      <input type="text" class="form-control datetimepicker-input" name="wayleaves_received" id="wayleaves_received" data-target="#custom_date_picker22" value="{{ Carbon\Carbon::parse($record[0]['permission_record']['wayleaves_received'])->format('m/d/Y') }}">
                      @else
                      <input type="text" class="form-control datetimepicker-input" name="wayleaves_received" id="wayleaves_received" data-target="#custom_date_picker22" value="">
                      @endif
                      <div class="input-group-append" data-target="#custom_date_picker22" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                  </div>
                </div>
              </div>  
              <div class="col-3">
                <div class="form-group">
                    <label>WAYLEAVES STATUS:</label>
                    <input type="text" class="form-control block-field" name="wayleaves_status" id="wayleaves_status"  value="{{ $record[0]['permission_record']['wayleaves_status'] }}">        
                </div>
              </div>
             </div>                                     
                          </div>
                          
                          <div class="col-md-4 inner-peth">                         
                        <div class="border-box" style="margin-top:10px;">
                          <div class="col-3">
                            <div class="form-group">
                                <label>Description:</label>
                              <select class="form-control valid" name="description" id="description" aria-invalid="false">
                              @foreach($all_descriptions as $description)
                                <option value="{{ $description->description }}"  <?php if($record[0]['site_master_record']['description'] ==  $description->description ) { echo "selected"; } ?>>{{ $description->description }}</option>
                              @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Core Network colocation facilitie:</label>
                                <input type="text" name="core_network_colocation_facilities" value="{{ $record[0]['site_master_record']['core_network_colocation_facilities']}}" id="core_network_colocation_facilities" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 18U:</label>
                                <input type="text" name="rack_space_18u" value="{{ $record[0]['site_master_record']['rack_space_18u'] }}" id="rack_space_18u" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 9U Core Access Active:</label>
                                <input type="text" name="rack_space_9u_core_access_active" value="{{ $record[0]['site_master_record']['rack_space_9u_core_access_active'] }}" id="rack_space_9u_core_access_active" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 9U Core Access Passive:</label>
                                <input type="text" name="rack_space_9u_core_access_passive" value="{{ $record[0]['site_master_record']['rack_space_9u_core_access_passive'] }}" id="rack_space_9u_core_access_passive" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack Space 1U -Passive:</label>
                                <input type="text" name="rack_space_1u_passive" value="{{ $record[0]['site_master_record']['rack_space_1u_passive'] }}" id="rack_space_1u_passive" class="form-control">
                            </div>
                          </div>
  
                          <div class="col-3">
                            <div class="form-group">
                                <label>Crossconnect:</label>
                                <input type="text" name="crossconnect" value="{{ $record[0]['site_master_record']['crossconnect'] }}" id="crossconnect" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Technical hands:</label>
                                <input type="text" name="technical_hands" value="{{ $record[0]['site_master_record']['technical_hands'] }}" id="technical_hands" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SLA:</label>
                                <input type="text" name="sla" value="{{ $record[0]['site_master_record']['sla'] }}" id="sla" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SLA Premium:</label>
                                <input type="text" name="sla_premium" value="{{ $record[0]['site_master_record']['sla_premium'] }}" id="sla_premium" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rate Mbit-S:</label>
                                <select class="form-control" name="rate_mbit_s" id="rate_mbit_s">
                                  @foreach($all_rate_mbit_s as $rate_mbit_s)
                                    <option value="{{ $rate_mbit_s->rate_mbit_s }}" <?php if($record[0]['site_master_record']['rate_mbit_s'] == $rate_mbit_s->rate_mbit_s) { echo "selected"; } ?>>{{ $rate_mbit_s->rate_mbit_s }}</option>
                                   @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Strands:</label>
                                <input type="text" name="strands" value="{{ $record[0]['site_master_record']['strands'] }}" id="strands" class="form-control">
                            </div>
                          </div>
                          </div>
                          <div class="border-box">
                          <div class="col-3">
                            <label for="w3review">Comment:</label>
                     <textarea id="w3review1" name="Comment"  cols="120" style="width:100%; height:300px;">{{ $record[0]['comment'] }}</textarea>
                         
                          
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