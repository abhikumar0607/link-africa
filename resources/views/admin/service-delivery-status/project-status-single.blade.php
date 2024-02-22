@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.service-delivery-status.service-header')
            </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card La-add-scroll service-delivery">
                  <div class="card-header">
                      <h3 class="card-title">Edit project Status</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @if(count($all_records) >= 1)
                   @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                   @if(in_array('all', $edit_access['edit_access_type']) OR in_array('service_delivery', $edit_access['edit_access_type']))
                      <form action="{{ route('service.delivery.status.update', $all_records[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_master_file_records"> 
                      {{ csrf_field() }} 
                    @else
                      <form method="POST" action="#" enctype="multipart/form-data">
                    @endif
                      <div class="card-body no-scroll-need">
                        <div class="row  border-box" style="margin-top:10px;">
                        <div class="col-4 listing-design-link">
                            <div class="form-group">
                              <h2 style="font-size:18px;font-weight:700;">Uploaded Files:</h2>
                              @if(count($all_records[0]['attachment_record']) > 0) 
                                @foreach($all_records[0]['attachment_record'] as $attachment)
                                @if($attachment['page_type'] == 'service_delivery')
                                  <li><a href="{{ url('admin/download-attachment', $attachment['id']) }}">{{ $attachment['attachment_name'] }}</a></li>
                                @endif
                                @endforeach
                                @else
                                  <p>No Document Please Upload</p>
                              @endif
                            </div>
                            </div>
                            <div class="col-2">
                            <div class="form-group">
                            </div>
                            </div>
                            <div class="col-2">
                            <div class="form-group">
                            </div>
                            </div>
                            <div class="col-2">
                            <div class="form-group">
                            </div>
                            </div>
                            <div class="col-2">
                            <div class="form-group upload-design">
                            <div class="upload-icon">
                            <i class="fas fa-upload"></i>
                              <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#service_modal">
                           Upload Attachment
                          </button>
                            </div>

                            </div>
                            </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PROJECT STATUS:</label>
                                 <input type="text" name="project_status" value="{{ $all_records[0]['project_status'] }}" id="project_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Date New:</label>
                                <input type="text" class="form-control block-field" name="" id="" value="{{ Carbon\Carbon::parse($all_records[0]['date_new'])->format('m/d/Y'); }}"> 
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SERVICE ID:</label>
                                 <input type="text" name="service_id" value="{{ $all_records[0]['service_id'] }}" id="service_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>DATE PO/ORDER RX:</label>
                               <input type="text" name="date_po_order_rx" value="{{ carbon\Carbon::parse($all_records[0]['date_po_order_rx'])->format('m/d/Y'); }}" id="date_po_order_rx" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>CLIENT NAME:</label>
                                <input type="text" name="client_name" value="{{ $all_records[0]['client_name'] }}" id="client_name" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                              <div class="form-group">
                                <label>PLANNING STATUS:</label>
                                <input type="text" name="planning_status" value="{{ $all_records[0]['planning_record']['planning_status'] }}" id="planning_status" class="form-control">
                            </div>
                          </div>
                          
                          <div class="col-3">
                            <div class="form-group">
                              <label>DATENEW:</label>
                                <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control" name="datenew" id="datenew" value="{{ carbon\Carbon::parse($all_records[0]['planning_record']['datenew'])->format('m/d/Y'); }}" >
                                </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ORDER REF NO:</label>
                                <input type="text" name="order_ref_number" value="{{ $all_records[0]['order_ref_number'] }}" id="order_ref_number" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>SERVICE TYPE:</label>
                                <input type="text" name="service_type" value="{{ $all_records[0]['service_type'] }}" id="service_type" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>PERMISSION STATUS:</label>
                                <input type="text" name="permission_status" value="{{ $all_records[0]['permission_record']['permissions_status'] }}" id="permission_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>CIRCUIT ID:</label>
                                <input type="text" name="circuit_id" value="{{ $all_records[0]['circuit_id'] }}" id="circuit_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>METRO/AREA:</label>
                                <input type="text" name="metro_area" value="{{ $all_records[0]['metro_area'] }}" id="metro_area" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>SERVICE MANAGER:</label>
                                <input type="text" name="service_manager" value="{{ $all_records[0]['service_manager'] }}" id="service_manager" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>BUILD STATUS:</label>
                                <input type="text" name="build_status" value="{{ $all_records[0]['build_record']['build_status'] }}" id="build_status" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>PROJECT ID:</label>
                                <input type="text" name="project_id" value="{{ $all_records[0]['project_id'] }}" id="project_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>PROVINCE:</label>
                                <input type="text" name="province" value="{{ $all_records[0]['province'] }}" id="province" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Project TYPE:</label>
                                <input type="text" name="type" value="{{ $all_records[0]['type'] }}" id="type" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                         <div class="form-group">
                                <label>Lease term in Months:</label>
                                <input type="text" name="lease_term_in_months" value="{{ $all_records[0]['lease_term_in_months'] }}" id="lease_term_in_months" class="form-control block-field">
                            </div>
                          </div>
                          </div>
                          <div class="row" style="margin-bottom:10px;">
                          <div class="col-3">
                            <div class="form-group">
                                <label>SERVICE DELIVERY STATUS:</label>
                                <select class="form-control" name="service_delivery_status" id="service_delivery_status">
                                    @foreach($all_service_delivery_status as $service_delivery_status) 
                                     <option value="{{ $service_delivery_status->service_delivery_status }}" <?php if($all_records[0]['service_delivery_status'] == $service_delivery_status->service_delivery_status){echo "selected";}?>>{{ $service_delivery_status->service_delivery_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>FEASIBILITY REF NO:</label>
                                <input type="text" name="feasibility_ref_no" value="{{ $all_records[0]['feasibility_ref_nr'] }}" id="feasibility_ref_no" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>NETWORK TYPES:</label>
                                <input type="text" name="network_types" value="{{ $all_records[0]['network_types'] }}" id="network_types" class="form-control">
                            </div>
                          </div>
                          </div>
                          
                          <div class="row secound-Qw">
                           <div class="col-md-4 inner-peth peth-terd">
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A:</label>
                                <input type="text" name="site_a" value="{{ $all_records[0]['site_a'] }}" id="site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A STATUS:</label>
                                <input type="text" name="site_a_status" value="{{ $all_records[0]['planning_record']['site_a_status'] }}" id="site_a_status" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A LLA SUBMITTED:</label>
                                <input type="text" name="site_a_lla_submitted" value="{{ $all_records[0]['permission_record']['site_a_lla_submitted'] }}" id="site_a_lla_submitted" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A LLA RECEIVED:</label>
                                <input type="text" name="site_a_lla_received" value="{{ $all_records[0]['permission_record']['site_a_lla_received'] }}" id="site_a_lla_received" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B:</label>
                                <input type="text" name="site_b" value="{{ $all_records[0]['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B STATUS:</label>
                                <input type="text" name="site_b_status" value="{{ $all_records[0]['planning_record']['site_b_status'] }}" id="site_b_status" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B LLA SUBMITTED:</label>
                                @if($all_records[0]['landlord_record'])
                                <input type="text" name="" value="{{ $all_records[0]['landlord_record']['date_submit_for_landlord'] }}" id="" class="form-control block-field">
                                @else
                                <input type="text" name="" value="" id="" class="form-control block-field">
                                @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B LLA RECEIVED:</label>
                                @if($all_records[0]['landlord_record'])
                                <input type="text" name="" value="{{ $all_records[0]['landlord_record']['landlord_date_received_from'] }}" id="" class="form-control block-field">
                                @else
                                <input type="text" name="" value="" id="" class="form-control block-field">
                                @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A SURVEY DATE:</label>
                                <input type="text" name="site_a_survey_date" value="{{ $all_records[0]['planning_record']['site_a_survey_date'] }}" id="site_a_survey_date" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B SURVEY DATE:</label>
                                @if($all_records[0]['site_survey_record'])
                                  <input type="text" name="site_b_survey_date" value="{{ $all_records[0]['site_survey_record']['date_site_survey'] }}" id="site_b_survey_date" class="form-control block-field">
                                @else
                                   <input type="text" name="" value="" id="" class="form-control block-field">
                                @endif
                              </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SHC STATUS:</label>
                                <input type="text" name="shc_status" value="{{ $all_records[0]['shc_status'] }}" id="shc_status" class="form-control">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>SHC DATE:</label>
                               
                                <div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                                @if($all_records[0]['sch_date'])
                                        <input type="text" value="{{ carbon\Carbon::parse($all_records[0]['sch_date'])->format('m/d/Y'); }}" class="form-control datetimepicker-input" name="shc_date" id="shc_date" data-target="#custom_date_picker9">
                                    @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="sch_date" id="sch_date" data-target="#custom_date_picker9">
                                    @endif
                                        <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>             
                                </div> 
                              </div>
                            </div>
</div>
</div>
                          <div class="col-md-4 inner-peth peth-terd">
                          <div class="col-3">
                            <div class="form-group">
                                <label>CLIENT RING:</label>
                               <input type="text" name="client_ring" value="{{ $all_records[0]['client_ring'] }}" id="client_ring" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A:</label>
                                <input type="text" name="site_a" value="{{ $all_records[0]['site_a'] }}" id="site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A COMMENTS:</label>
                                <input type="text" name="site_a_comment" value="{{ $all_records[0]['planning_record']['site_a_comment'] }}" id="site_a_comment" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B:</label>
                                <input type="text" name="site_b" value="{{ $all_records[0]['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B COMMENTS:</label>
                                <input type="text" name="site_b_comment" value="{{ $all_records[0]['planning_record']['site_b_comment'] }}" id="site_b_comment" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO MRC:</label>
                                <input type="text" name="po_mrc" value="{{ $all_records[0]['po_mrc'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO NRC:</label>
                                <input type="text" name="po_nrc" value="{{ $all_records[0]['po_nrc'] }}" id="po_nrc" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SPECIAL BUILD NRC:</label>
                                <input type="text" name="po_nrc" value="{{ $all_records[0]['special_build_nrc'] }}" id="po_nrc" class="form-control block-field">
                            </div>
                          </div>
                           <!-- <div class="col-3">
                            <div class="form-group">
                                <label>SERVICE DELIVERY COMMENTS:</label>
                                <textarea name="service_delivery_comments" id="service_delivery_comments" rows="3" cols="38" class="form-control">{{ $all_records[0]['service_delivery_comments'] }}</textarea>
                               
                            </div>
                          </div> -->
                           <div class="col-3">
                            <div class="form-group">
                                <label>COMMENTS:</label>
                                <textarea name="sales_comments" id="sales_comments" rows="3" cols="38" class="form-control">{{ $all_records[0]['sales_comments'] }}</textarea>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PLANNED BUILD COMPLETION DATE:</label>
                                <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                @if($all_records[0]['build_record']['planned_build_completion_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($all_records[0]['build_record']['planned_build_completion_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planned_build_completion_date" id="planned_build_completion_date" data-target="#custom_date_picker7">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="planned_build_completion_date" id="planned_build_completion_date" data-target="#custom_date_picker7">
                                @endif     
                                        <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          </div>
                          <div class="col-md-4 inner-peth peth-terd">
                          <div class="col-3">
                            <div class="form-group">
                                <label>WAYLEAVES SUBMITTED:</label>
                               <input type="text" name="wayleaves_submitted" value="{{ $all_records[0]['permission_record']['wayleaves_submitted'] }}" id="wayleaves_submitted" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WAYLEAVES RECEIVED:</label>
                                <input type="text" name="wayleaves_received" value="{{ $all_records[0]['permission_record']['wayleaves_received'] }}" id="wayleaves_received" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PLANNED WP2 RELEASED DATE:</label>
                                <input type="text" name="planned_wp2_released_date" value="{{ $all_records[0]['planning_record']['planned_wp2_released_date'] }}" id="planned_wp2_released_date" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>REVISED PLANNED WP2 DATE:</label>
                                <input type="text" name="revised_planned_wp2_date" value="{{ $all_records[0]['planning_record']['revised_planned_wp2_date'] }}" id="revised_planned_wp2_date" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WP2 APPROVAL REQUESTED:</label>
                                <input type="text" name="wp2_approval_requested" value="{{ $all_records[0]['planning_record']['wp2_approval_requested'] }}" id="wp2_approval_requested" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WP2 APPROVAL RECEIVED:</label>
                                <input type="text" name="wp2_approval_received" value="{{ $all_records[0]['planning_record']['wp2_approval_received'] }}" id="wp2_approval_received" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>BUILD PLANNED COMPLETION DATES:</label>
                                <input type="text" name="build_planned_completion_dates" value="{{ $all_records[0]['build_record']['build_planned_completion_dates'] }}" id="build_planned_completion_dates" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL BUILD COMPLETION DATE:</label>
                                <input type="text" name="actual_build_completion_date" value="{{ $all_records[0]['build_record']['actual_build_completion_date'] }}" id="actual_build_completion_date" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Submitted To Customer:</label>
                             
                                <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                @if($all_records[0]['build_record']['Submitted_to_customer'])
                                        <input type="text" value="{{ carbon\Carbon::parse($all_records[0]['build_record']['Submitted_to_customer'])->format('m/d/Y'); }}" class="form-control datetimepicker-input" name="Submitted_to_customer" id="Submitted_to_customer" data-target="#custom_date_picker10">
                                    @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="Submitted_to_customer" id="Submitted_to_customer" data-target="#custom_date_picker10">
                                    @endif
                                        <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Toc Recieved From Customer:</label>
                           
                                <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                @if($all_records[0]['build_record']['toc_received_date_recieved'])
                                        <input type="text" value="{{ carbon\Carbon::parse($all_records[0]['build_record']['toc_received_date_recieved'])->format('m/d/Y'); }}" class="form-control datetimepicker-input" name="toc_received_date_recieved" id="toc_received_date_recieved" data-target="#custom_date_picker11">
                                        @else
                                        <input type="text" value="" class="form-control datetimepicker-input" name="toc_received_date_recieved" id="toc_received_date_recieved" data-target="#custom_date_picker10">
                                    @endif
                                        <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>RETURN TO SALE:</label>
                                <select class="form-control" name="return_to_sales" id="return_to_sales">
                                     <option value="" selected>Please Select</option>
                                     @foreach($all_return_to_sale as $return_to_sale)
                                      <option value="{{ $return_to_sale->return_to_sale }}"<?php if($all_records[0]['return_to_sales'] == $return_to_sale->return_to_sale){echo "selected";}?>>{{ $return_to_sale->return_to_sale }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>ESTIMATED ENTERPRISE USAGE:</label>
                                <input type="text" name="estimated_enterprise_usage" value="{{ $all_records[0]['estimated_enterprise_usage'] }}" id="estimated_enterprise_usage" class="form-control">
                            </div>
                          </div>
                           </div>
                          </div>
                          <div class="row secound-Qw" style="margin-top:10px;">
                           <div class="col-md-4 inner-peth peth-terd">
                           <!-- <div class="col-3">
                            <div class="form-group">
                                <label>Qty:</label>
                                <input type="text" name="qty" value="{{ $all_records[0]['qty'] }}" id="estimated_enterprise_usage" class="form-control">
                            </div>
                           </div> -->

                           <div class="col-3">
                            <div class="form-group">
                                <label>Year:</label>
                                <select class="form-control" name="year" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     @foreach($year as $status)
                                      <option value="{{ $status->name }}" <?php if($all_records[0]['year'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach 
                                </select>     
                            </div>
                           </div>

                           </div>
                           <div class="col-md-4 inner-peth peth-terd">
                           <div class="col-3">
                            <div class="form-group">
                                <label>SD Status:</label>
                                <select class="form-control" name="sd_status" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     @foreach($sd_status as $status)
                                      <option value="{{ $status->name }}" <?php if($all_records[0]['sd_status'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach 
                                </select>     
                            </div>
                           </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Week:</label>
                                <select class="form-control" name="week" id="service_delivery_status">
                                <option value="" selected>Please Select</option>
                                    @foreach($week as $status)
                                      <option value="{{ $status->name }}" <?php if($all_records[0]['week'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach  
                                </select>     
                            </div>
                           </div>
                           </div>
                           <div class="col-md-4 inner-peth peth-terd">
                           <div class="col-3">
                            <div class="form-group">
                                <label>Resources:</label>
                                <select class="form-control" name="resources" id="service_delivery_status">
                                <option value="" selected>Please Select</option>
                                    @foreach($resource_team as $status)
                                      <option value="{{ $status->name }}" <?php if($all_records[0]['resources'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach
                                </select>     
                            </div>
                           </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Comments:</label>
                                <select class="form-control" name="comments" id="service_delivery_status">
                                <option value="" selected>Please Select</option>
                                     @foreach($add_comment as $status)
                                      <option value="{{ $status->name }}" <?php if($all_records[0]['comments'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach
                                </select>     
                            </div>
                           </div>
                           </div>
                          </div>
                      </div>
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('service_delivery', $edit_access['edit_access_type']))
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
  <!-- Modal -->
  <div class="modal fade" id="service_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog sale-attachment">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Serivce Delivery Attachment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form id="upload_attachment_new" action="#" enctype="multipart/form-data">
                                <div class="upload-icon">
                                  <i class="fas fa-upload"></i>
                                  <span>Upload Document</span>
                                  <input class="form-control" type="file" id="filenames" name="filenames[]" multiple required>
                                  <input type="hidden" id="service_id" name="service_id" value ="{{ $all_records[0]['circuit_id'] }}">
                                  <input type="hidden" id="circuit_id" name="circuit_id" value = "{{ $all_records[0]['circuit_id'] }}">
                                  <input type="hidden" id="page_type" name="sales" value ="service_delivery">
                                  </div>
                                  <div id="selectedFiles"></div>
                                  <label>Select Type</label>
                                  <select class="form-control" id="form_type" name="form_type">
                                  <option value ="">Please Select</option>
                                    <option value ="PO">PO</option>
                                    <option value ="TOC Part1">TOC Part1</option>
                                    <option value ="TOC Part2">TOC Part2</option>
                                    <option value ="Other Documents">Other Documents</option>
                                  </select>
                                  <button type="submit" class="btn btn-primary att-dis">Submit</button>
                                  <div class="success_msg"></div>
                                </form>
                            </div>
                    </div>
            </div>
      </div>
 @endsection