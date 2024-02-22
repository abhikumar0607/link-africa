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
                      <h3 class="card-title">Edit Landlord Approval Record</h3>
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
                    <form action="{{ route('admin.planning.landlord.approval.update',$record[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_master_file_records" class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif
                  
                      <div class="card-body no-scroll-need">
                        <div class="row border-box" style="margin-top:10px;">
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project Status: </label>
                                <input type="text" class="form-control block-field" name="project_status" id="project_status" value="{{ $record[0]['site_master_record']['project_status'] }}">
                            </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                <label>Date New:</label>
                                <input type="text" class="form-control block-field" name="" id="" value="{{ Carbon\Carbon::parse($record[0]['site_master_record']['date_new'])->format('m/d/Y'); }}"> 
                            </div>
                          </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" class="form-control" name="circuit_id" id="circuit_id" value="{{ $record[0]['site_master_record']['circuit_id'] }}">
                                <input type="hidden" class="form-control" name="service_id" id="service_id" value="{{ $record[0]['site_master_record']['service_id'] }}">
                               
                            </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                <label>Date Po Order Rx:</label>
                                <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                  @if($record[0]['datenew'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_po_order_rx" id="date_po_order_rx" data-target="#custom_date_picker4" value="{{ Carbon\Carbon::parse($record[0]['datenew'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="date_po_order_rx" id="date_po_order_rx" data-target="#custom_date_picker4" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>            
                           <div class="col-2">
                            <div class="form-group">
                                <label>Client Ring:</label>
                                <input type="text" name="client_ring" value="{{ $record[0]['site_master_record']['client_ring'] }}" id="client_ring" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                <input type="text" name="metro_area" value="{{ $record[0]['site_master_record']['metro_area'] }}" id="metro_area" class="form-control block-field">
                            </div>
                          </div>
                          
                          <div class="col-2">
                <div class="form-group">
                    <label>PLANNING STATUS:</label>
                    <input type="text" class="form-control block-field" name="planning_status" id="planning_status" value="{{ $record[0]['planning_status'] }}"> 
                </div>
              </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Service Type:</label>
                                <input type="text" name="service_type" value="{{ $record[0]['site_master_record']['service_type'] }}" id="service_type" class="form-control block-field">
                             </div>
                          </div>
                                                                         
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" name="project_id" value="{{ $record[0]['site_master_record']['project_id'] }}" id="project_id" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Order Ref No:</label>
                                <input type="text" name="order_ref_number" value="{{ $record[0]['site_master_record']['order_ref_number'] }}" id="order_ref_number" class="form-control block-field">
                            </div>
                          </div>
                           <div class="col-2">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['site_master_record']['client_name'] }}" id="client_name" class="form-control block-field">
                            </div>
                          </div>    
                                               
                          <div class="col-2">
                            <div class="form-group">
                                <label>Province:</label>
                                <input type="text" name="province" value="{{ $record[0]['site_master_record']['province'] }}" id="province" class="form-control block-field">
                            </div>
                          </div>
                       
                          <div class="col-2">
                            <div class="form-group">
                                <label>BUILD STATUS:</label>
                                <input type="text" name="province" value="{{ $record[0]['site_master_record']['province'] }}" id="province" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project Type:</label>
                                <input type="text" name="type" value="{{ $record[0]['site_master_record']['type'] }}" id="type" class="form-control block-field">
                            </div>
                          </div>
                          </div>
                          <div class="row" style="margin-bottom:10px;">                          
                          <div class="col-6">
                            <div class="form-group">
                                <label>LandLord Approval Status:</label>
                                <select class="form-control" name="landlord_approval_status" id="landlord_approval_status">
                                  <option value="" selected="">Please Select</option>
                                  @if($record[0]['landlord_record'])
                                   @foreach($all_landlord_status as $landlord_status)
                                    <option value="{{ $landlord_status->landlord_status }}"<?php if($record[0]['landlord_record']['landlord_approval_status'] == $landlord_status->landlord_status){ echo "selected";}?>>{{ $landlord_status->landlord_status }}</option>
                                   @endforeach
                                  @else
                                   @foreach($all_landlord_status as $landlord_status)
                                    <option value="{{ $landlord_status->landlord_status }}">{{ $landlord_status->landlord_status }}</option>
                                    @endforeach
                                   @endif
                                </select>
                            </div>
                          </div> 
                          <div class="col-6">
                            <div class="form-group">
                                <label>LINK DEPENDENCY:</label>
                                <input type="text" name="link_dependency" value="{{ $record[0]['link_dependency'] }}" id="link_dependency" class="form-control block-field">
                            </div>
                          </div> 
                          </div>
                          <div class="row secound-Qw border-box" style="padding:15px;">
                           <div class="col-md-4 inner-peth border-box">                           
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site A:</label>
                                <input type="text" name="site_a" value="{{ $record[0]['site_master_record']['site_a'] }}" id="site_a" class="form-control block-field">
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

                          <!--<div class="col-3">
                        <div class="form-group">
                          <label>Site A LLA Submitted:</label>
                            <div class="input-group date" id="custom_date_picker1" data-target-input="nearest">
                               @if($record[0]['permission_record']['site_a_lla_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['permission_record']['site_a_lla_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_lla_submitted" id="site_a_lla_submitted" data-target="#custom_date_picker1">
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
                            <label>Site A LLA Estimated:</label>
                            <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                            <input type="text" value="{{ Carbon\Carbon::parse($site_a_lla_estimated)->format('m/d/Y') }}" class="form-control  block-field" name="site_a_lla_estimated" id="site_a_lla_estimated">
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>Site A LLA Received:</label>
                            <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                            @if($record[0]['permission_record']['site_a_lla_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['permission_record']['site_a_lla_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_lla_received" id="site_a_lla_received" data-target="#custom_date_picker3">
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
                                <label>OVERDUE A:</label>
                                <input type="text" name="overdue_a" value="{{ $overdue_date }}" id="overdue_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>LLA DUR SITEA:</label>
                                <input type="text" name="lla_dur_sitea" value="{{ $lla_duration_date }}" id="lla_dur_sitea" class="form-control block-field">
                            </div>
                          </div>-->
                          <div class="col-3">
                            <div class="form-group">
                                <label>CONTACT NAME - SITE A:</label>
                                <input type="text" name="contact_name_site_a" value="{{ $record[0]['site_master_record']['contact_name_site_a'] }}" id="contact_name_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PHYISCAL ADDRESS - SITE A:</label>
                                <input type="text" name="phyical_address_site_a" value="{{ $record[0]['site_master_record']['physical_address_site_a'] }}" id="phyical_address_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WORK NUMBER - SITE A:</label>
                                <input type="text" name="work_number_site_a" value="{{ $record[0]['site_master_record']['work_number_site_a'] }}" id="work_number_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>MOBILE NUMBER- SITE A:</label>
                                <input type="text" name="mobile_number_site_a" value="{{ $record[0]['site_master_record']['mobile_number_site_a'] }}" id="mobile_number_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>EMAIL ADDRESS - SITE A</label>:</label>
                                <input type="text" name="email_address_site_a" value="{{ $record[0]['site_master_record']['email_address_site_a'] }}" id="email_address_site_a" class="form-control block-field">
                            </div>
                          </div>
                         
                          </div>
                          <div class="col-md-4 inner-peth">                         
                          <div class="col-3">
                              <div class="form-group">
                                <label>Date Received From Site B:</label>
                                <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="landlord_date_received_from" id="landlord_date_received_from" data-target="#custom_date_picker5" value="{{ $record[0]['landlord_record']['landlord_date_received_from'] }}">
                                  
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="landlord_date_received_from" id="landlord_date_received_from" data-target="#custom_date_picker5" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label>Date Submit for landlord Site B:</label>
                                <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_submit_for_landlord" id="date_submit_for_landlord" data-target="#custom_date_picker6" value="{{ $record[0]['landlord_record']['date_submit_for_landlord'] }}">
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="date_submit_for_landlord" id="date_submit_for_landlord" data-target="#custom_date_picker6" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label>Date Landlord Approval Site B:</label>
                                <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_landlord_approval" id="date_landlord_approval" data-target="#custom_date_picker7" value="{{ $record[0]['landlord_record']['date_landlord_approval'] }}">
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="date_landlord_approval" id="date_landlord_approval" data-target="#custom_date_picker7" value="">
                                @endif
                                   
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label>Date On-Hold Site B:</label>
                                <div class="input-group date" id="custom_date_picker8" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="landlord_date_on_hold" id="landlord_date_on_hold" data-target="#custom_date_picker8" value="{{ $record[0]['landlord_record']['landlord_date_on_hold'] }}">
                                  
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="landlord_date_on_hold" id="landlord_date_on_hold" data-target="#custom_date_picker8" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker8" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>    
                            
                            <div class="col-3">
                              <div class="form-group">
                                <label>Date Received From Site A:</label>
                                <div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="landlord_date_received_from_site_a" id="landlord_date_received_from_site_a" data-target="#custom_date_picker9" value="{{ $record[0]['landlord_record']['landlord_date_received_from_site_a'] }}">
                                  
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="landlord_date_received_from_site_a" id="landlord_date_received_from_site_a" data-target="#custom_date_picker9" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>

                            <div class="col-3">
                              <div class="form-group">
                                <label>Date Submit for landlord Site A:</label>
                                <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_submit_for_landlord_site_a" id="date_submit_for_landlord_site_a" data-target="#custom_date_picker10" value="{{ $record[0]['landlord_record']['date_submit_for_landlord_site_a'] }}">
                                  
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="date_submit_for_landlord_site_a" id="date_submit_for_landlord_site_a" data-target="#custom_date_picker10" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>

                            <div class="col-3">
                              <div class="form-group">
                                <label>Date Landlord Approval Site A:</label>
                                <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_landlord_approval_site_a" id="date_landlord_approval_site_a" data-target="#custom_date_picker11" value="{{ $record[0]['landlord_record']['date_landlord_approval_site_a'] }}">
                                  
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="date_landlord_approval_site_a" id="date_landlord_approval_site_a" data-target="#custom_date_picker11" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>

                            <div class="col-3">
                              <div class="form-group">
                                <label>Date On-Hold Site A:</label>
                                <div class="input-group date" id="custom_date_picker12" data-target-input="nearest">
                                @if($record[0]['landlord_record'])
                                    <input type="text" class="form-control datetimepicker-input" name="landlord_date_on_hold_site_a" id="landlord_date_on_hold_site_a" data-target="#custom_date_picker12" value="{{ $record[0]['landlord_record']['landlord_date_on_hold_site_a'] }}">
                                  
                                    @else
                                <input type="text" class="form-control datetimepicker-input" name="landlord_date_on_hold_site_a" id="landlord_date_on_hold_site_a" data-target="#custom_date_picker12" value="">
                                @endif
                                   
                                    <div class="input-group-append" data-target="#custom_date_picker12" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                </div>
								              </div>
								            </div>
                          </div>
                          
                          <div class="col-md-4 inner-peth border-box">                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B:</label>
                                <input type="text" name="site_b" value="{{ $record[0]['site_master_record']['site_b'] }}" id="site_b" class="form-control block-field         ">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                            <label>SITE B Status:</label>
                            <select class="form-control" name="site_b_status" id="site_b_status">                           
                                <option value="">please Select</option>
                                @foreach($all_site_status as $site_status)
                                 <option value="{{ $site_status->site_status }}" <?php if($record[0]['site_b_status'] == $site_status->site_status) { echo "selected"; } ?>>{{ $site_status->site_status }}</option>
                                @endforeach
                             </select>                                     
                            </div>
                          </div>

                          <!--<div class="col-3">
                          <div class="form-group">
                            <label>SITE B LLA SUBMITTED:</label>
                            <div class="input-group date" id="custom_date_picker21" data-target-input="nearest">
                              @if($record[0]['permission_record']['site_b_lla_submitted'])
                                <input type="text" class="form-control datetimepicker-input" name="site_b_lla_submitted" id="site_b_lla_submitted" data-target="#custom_date_picker21" value="{{ Carbon\Carbon::parse($record[0]['permission_record']['site_b_lla_submitted'])->format('m/d/Y') }}">
                                @else
                                <input type="text" class="form-control datetimepicker-input" name="site_b_lla_submitted" id="site_b_lla_submitted" data-target="#custom_date_picker21" value="">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker21" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>SITE B LLA ESTIMATED:</label>
                                <input type="text" name="site_b_lla_estimated" value="{{ $site_b_lla_estimated }}" id="site_b_lla_estimated" class="form-control block-field">
                            </div>
                          </div>
                        <div class="col-3">
                              <div class="form-group">
                                <label>SITE B LLA RECEIVED:</label>
                                <div class="input-group date" id="custom_date_picker22" data-target-input="nearest">
                                  @if($record[0]['permission_record']['site_b_lla_received'])
                                    <input type="text" class="form-control datetimepicker-input" name="site_b_lla_received" id="site_b_lla_received" data-target="#custom_date_picker22" value="{{ Carbon\Carbon::parse($record[0]['permission_record']['site_b_lla_received'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="site_b_lla_received" id="site_b_lla_received" data-target="#custom_date_picker22" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker22" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                </div>
                              </div>
                        </div> 
                          <div class="col-3">
                            <div class="form-group">
                                <label>OVERDUE B:</label>
                                <input type="text" name="overdue_b" value="{{$overdue_dateB}}" id="overdue_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>LLA DUR SITEB:</label>
                                <input type="text" name="overdue_b" value="{{ $llb_duration_date }}" id="overdue_b" class="form-control block-field">
                            </div>
                          </div>-->
                          <div class="col-3">
                            <div class="form-group">
                                <label>CONTACT NAME - Site B:</label>
                                <input type="text" name="contact_name_site_b" value="{{ $record[0]['site_master_record']['contact_name_site_b'] }}" id="contact_name_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site B:</label>
                                <input type="text" name="physical_address_site_b" value="{{ $record[0]['site_master_record']['physical_address_site_b'] }}" id="physical_address_site_b" class="form-control block-field">
                            </div>
                          </div>
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site B:</label>
                                <input type="text" name="work_number_site_b" value="{{ $record[0]['site_master_record']['work_number_site_b'] }}" id="work_number_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site B:</label>
                                <input type="text" name="mobile_number_site_b" value="{{ $record[0]['site_master_record']['mobile_number_site_b'] }}" id="mobile_number_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site B:</label>
                                <input type="email" name="email_address_site_b" value="{{ $record[0]['site_master_record']['email_address_site_b'] }}" id="email_address_site_b" class="form-control block-field">
                            </div>
                          </div>
                         
                          
                          </div>
                          <div class="row">
                            <div class="col-12">
                            <label for="w3review">Comment:</label>
                            <textarea id="w3review1" name="Comment"  cols="120" style="width:100%">{{ $record[0]['comment'] }}</textarea>
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