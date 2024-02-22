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
                      <h3 class="card-title">Edit Sd Table</h3>
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
                          </div>
                          <div class="row" style="margin-bottom:10px;">
                          <div class="col-3">
                            <div class="form-group">
                                <label>SERVICE DELIVERY STATUS:</label>
                                <select class="form-control" name="service_delivery_status" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
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
                                <input type="text" name="site_b_lla_submitted" value="{{ $all_records[0]['permission_record']['site_b_lla_submitted'] }}" id="site_b_lla_submitted" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B LLA RECEIVED:</label>
                                <input type="text" name="site_b_lla_received" value="{{ $all_records[0]['permission_record']['site_b_lla_received'] }}" id="site_b_lla_received" class="form-control block-field">
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
                                <input type="text" name="site_b_survey_date" value="{{ $all_records[0]['planning_record']['site_b_survey_date'] }}" id="site_b_survey_date" class="form-control block-field">
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
                                <label>SERVICE DELIVERY COMMENTS:</label>
                                <textarea name="service_delivery_comments" id="service_delivery_comments" rows="3" cols="38" class="form-control">{{ $all_records[0]['service_delivery_comments'] }}</textarea>
                               
                            </div>
                          </div>
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
                           <div class="col-3">
                            <div class="form-group">
                                <label>Qty:</label>
                                <input type="text" name="qty" value="{{ $all_records[0]['qty'] }}" id="estimated_enterprise_usage" class="form-control">
                            </div>
                           </div>

                           <div class="col-3">
                            <div class="form-group">
                                <label>Year:</label>
                                <select class="form-control" name="year" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     <option value="2023" <?php if($all_records[0]['year'] == '2023'){echo "selected";}?>>2023</option>
                                     <option value="2024" <?php if($all_records[0]['year'] == '2024'){echo "selected";}?>>2024</option>
                                     <option value="2025" <?php if($all_records[0]['year'] == '2025'){echo "selected";}?>>2025</option>
                                     <option value="2026" <?php if($all_records[0]['year'] == '2026'){echo "selected";}?>>2026</option>
                                     <option value="2027" <?php if($all_records[0]['year'] == '2027'){echo "selected";}?>>2027</option>
                                     <option value="2028" <?php if($all_records[0]['year'] == '2028'){echo "selected";}?>>2028</option>
                                     <option value="2029" <?php if($all_records[0]['year'] == '2029'){echo "selected";}?>>2029</option>
                                     <option value="2030" <?php if($all_records[0]['year'] == '2030'){echo "selected";}?>>2030</option>
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
                                     <option value="Jan" <?php if($all_records[0]['sd_status'] == 'Jan'){echo "selected";}?>>Jan</option>
                                     <option value="Feb" <?php if($all_records[0]['sd_status'] == 'Feb'){echo "selected";}?>>Feb</option>
                                     <option value="Mar" <?php if($all_records[0]['sd_status'] == 'Mar'){echo "selected";}?>>Mar</option>
                                     <option value="Apr" <?php if($all_records[0]['sd_status'] == 'Apr'){echo "selected";}?>>Apr</option>
                                     <option value="May" <?php if($all_records[0]['sd_status'] == 'May'){echo "selected";}?>>May</option>
                                     <option value="Jun" <?php if($all_records[0]['sd_status'] == 'Jun'){echo "selected";}?>>Jun</option>
                                     <option value="Jul" <?php if($all_records[0]['sd_status'] == 'Jul'){echo "selected";}?>>Jul</option>
                                     <option value="Aug" <?php if($all_records[0]['sd_status'] == 'Aug'){echo "selected";}?>>Aug</option>
                                     <option value="Sep" <?php if($all_records[0]['sd_status'] == 'Sep'){echo "selected";}?>>Sep</option>
                                     <option value="Oct" <?php if($all_records[0]['sd_status'] == 'Oct'){echo "selected";}?>>Oct</option>
                                     <option value="Nov" <?php if($all_records[0]['sd_status'] == 'Nov'){echo "selected";}?>>Nov</option>
                                     <option value="Dec" <?php if($all_records[0]['sd_status'] == 'Dec'){echo "selected";}?>>Dec</option>
                                     <option value="BCX Migration Project" <?php if($all_records[0]['sd_status'] == 'BCX Migration Project'){echo "selected";}?>>BCX Migration Project</option>
                                     <option value="Cancelled" <?php if($all_records[0]['sd_status'] == 'Cancelled'){echo "selected";}?>>Cancelled</option>
                                     <option value="New Orders In Planning" <?php if($all_records[0]['sd_status'] == 'New Orders In Planning'){echo "selected";}?>>New Orders In Planning</option>
                                     <option value="On-Hold(LLA)" <?php if($all_records[0]['sd_status'] == 'On-Hold(LLA)'){echo "selected";}?>>On-Hold(LLA)</option>
                                     <option value="On-Hold(Pending Cancellation)" <?php if($all_records[0]['sd_status'] == 'On-Hold(Pending Cancellation)'){echo "selected";}?>>On-Hold(Pending Cancellation)</option>
                                     <option value="Orders in DFA Precinct" <?php if($all_records[0]['sd_status'] == 'Orders in DFA Precinct'){echo "selected";}?>>Orders in DFA Precinct</option>
                                     <option value="Orders that require wayleaves & LLA" <?php if($all_records[0]['sd_status'] == 'Orders that require wayleaves & LLA'){echo "selected";}?>>Orders that require wayleaves & LLA</option>
                                     <option value="Stretch Target" <?php if($all_records[0]['sd_status'] == 'Stretch Target'){echo "selected";}?>>Stretch Target</option>
                                     <option value="Revised Target for May" <?php if($all_records[0]['sd_status'] == 'Revised Target for May'){echo "selected";}?>>Revised Target for May</option>
                                </select>     
                            </div>
                           </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Week:</label>
                                <select class="form-control" name="week" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     <option value="w1"  <?php if($all_records[0]['week'] == 'w1'){echo "selected";}?>>w1</option>
                                     <option value="w2"  <?php if($all_records[0]['week'] == 'w2'){echo "selected";}?>>w2</option>
                                     <option value="w3"  <?php if($all_records[0]['week'] == 'w3'){echo "selected";}?>>w3</option>
                                     <option value="w4"  <?php if($all_records[0]['week'] == 'w4'){echo "selected";}?>>w4</option>
                                     <option value="w5"  <?php if($all_records[0]['week'] == 'w5'){echo "selected";}?>>w5</option>
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
                                     <option value="MIT" <?php if($all_records[0]['resources'] == 'MIT'){echo "selected";}?>>MIT</option>
                                     <option value="DFA" <?php if($all_records[0]['resources'] == 'DFA'){echo "selected";}?>>DFA</option>
                                     <option value="IC" <?php if($all_records[0]['resources'] == 'IC'){echo "selected";}?>>IC</option>
                                     <option value="Internal" <?php if($all_records[0]['resources'] == 'Internal'){echo "selected";}?>>Internal</option>
                                     <option value="Planning" <?php if($all_records[0]['resources'] == 'Planning'){echo "selected";}?>>Planning</option>
                                     <option value="UIT" <?php if($all_records[0]['resources'] == 'UIT'){echo "selected";}?>>UIT</option>
                                     <option value="Seacom" <?php if($all_records[0]['resources'] == 'Seacom'){echo "selected";}?>>Seacom</option>
                                     <option value="Elite Skyline" <?php if($all_records[0]['resources'] == 'Elite Skyline'){echo "selected";}?>>Elite Skyline</option>
                                     <option value="FCC" <?php if($all_records[0]['resources'] == 'FCC'){echo "selected";}?>>FCC</option>
                                     <option value="Go Connect" <?php if($all_records[0]['resources'] == 'Go Connect'){echo "selected";}?>>Go Connect</option>
                                     <option value="INT" <?php if($all_records[0]['resources'] == 'INT'){echo "selected";}?>>INT</option>
                                     <option value="IDS" <?php if($all_records[0]['resources'] == 'IDS'){echo "selected";}?>>IDS</option>
                                     <option value="LIBBY" <?php if($all_records[0]['resources'] == 'LIBBY'){echo "selected";}?>>LIBBY</option>
                                     <option value="FIBREWAY" <?php if($all_records[0]['resources'] == 'FIBREWAY'){echo "selected";}?>>FIBREWAY</option>
                                     <option value="ITS" <?php if($all_records[0]['resources'] == 'ITS'){echo "selected";}?>>ITS</option>
                                     <option value="ELECTRICAL" <?php if($all_records[0]['resources'] == 'ELECTRICAL'){echo "selected";}?>>ELECTRICAL</option>
                                </select>     
                            </div>
                           </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Comments:</label>
                                <select class="form-control" name="comments" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     <option value="BCX Migration Project" <?php if($all_records[0]['comments'] == 'BCX Migration Project'){echo "selected";}?>>BCX Migration Project</option>
                                     <option value="BAU - LANET1 (LLA)" <?php if($all_records[0]['comments'] == 'BAU - LANET1 (LLA)'){echo "selected";}?>>BAU - LANET1 (LLA)</option>
                                     <option value="BAU - LANET1 (Survey)" <?php if($all_records[0]['comments'] == 'BAU - LANET1 (Survey)'){echo "selected";}?>>BAU - LANET1 (Survey)</option>
                                     <option value="BAU - Mall Order (LLA)" <?php if($all_records[0]['comments'] == 'BAU - Mall Order (LLA)'){echo "selected";}?>>BAU - Mall Order (LLA)</option>
                                     <option value="BAU - Mall Order (Survey)" <?php if($all_records[0]['comments'] == 'BAU - Mall Order (Survey)'){echo "selected";}?>>BAU - Mall Order (Survey)</option>
                                     <option value="BAU - Old (>30days)" <?php if($all_records[0]['comments'] == 'BAU - Old (>30days)'){echo "selected";}?>>BAU - Old (>30days)</option>
                                     <option value="BiDi Swap Out" <?php if($all_records[0]['comments'] == 'BiDi Swap Out'){echo "selected";}?>>BiDi Swap Out</option>
                                     <option value="BOQ" <?php if($all_records[0]['comments'] == 'BOQ'){echo "selected";}?>>BOQ</option>
                                     <option value="BOQ and LL Required" <?php if($all_records[0]['comments'] == 'BOQ and LL Required'){echo "selected";}?>>BOQ and LL Required</option>
                                     <option value="BOQ VO" <?php if($all_records[0]['comments'] == 'BOQ VO'){echo "selected";}?>>BOQ VO</option>
                                     <option value="Cancelled" <?php if($all_records[0]['comments'] == 'Cancelled'){echo "selected";}?>>Cancelled</option>
                                     <option value="Customer requested to put project on Hold" <?php if($all_records[0]['comments'] == 'Customer requested to put project on Hold'){echo "selected";}?>>Customer requested to put project on Hold</option>
                                     <option value="DFA - Redefine - Phase 2" <?php if($all_records[0]['comments'] == 'DFA - Redefine - Phase 2'){echo "selected";}?>>DFA - Redefine - Phase 2</option>
                                     <option value="Entry Build Required for Peregrine Order" <?php if($all_records[0]['comments'] == 'Entry Build Required for Peregrine Order'){echo "selected";}?>>Entry Build Required for Peregrine Order</option>
                                     <option value="H&S Approval outstanding" <?php if($all_records[0]['comments'] == 'H&S Approval outstanding'){echo "selected";}?>>H&S Approval outstanding</option>
                                     <option value="LA Optimization Project" <?php if($all_records[0]['comments'] == 'LA Optimization Project'){echo "selected";}?>>LA Optimization Project</option>
                                     <option value="Not Excutable_Planning - Site not built(BTS)" <?php if($all_records[0]['comments'] == 'Not Excutable_Planning - Site not built(BTS)'){echo "selected";}?>>Not Excutable_Planning - Site not built(BTS)</option>
                                     <option value="On-Hold" <?php if($all_records[0]['comments'] == 'On-Hold'){echo "selected";}?>>On-Hold</option>
                                     <option value="Pending Cancellation" <?php if($all_records[0]['comments'] == 'Pending Cancellation'){echo "selected";}?>>Pending Cancellation</option>
                                     <option value="Query Sales/Planning" <?php if($all_records[0]['comments'] == 'Query Sales/Planning'){echo "selected";}?>>Query Sales/Planning</option>
                                     <option value="RTS - Planning_LLA - Old(BTS)" <?php if($all_records[0]['comments'] == 'RTS - Planning_LLA - Old(BTS)'){echo "selected";}?>>RTS - Planning_LLA - Old(BTS)</option>
                                     <option value="SAS - Project" <?php if($all_records[0]['comments'] == 'SAS - Project'){echo "selected";}?>>SAS - Project</option>
                                     <option value="Seacom - LA tech to investigate" <?php if($all_records[0]['comments'] == 'Seacom - LA tech to investigate'){echo "selected";}?>>Seacom - LA tech to investigate</option>
                                     <option value="Soweto Forums - June - Week 4(VC)" <?php if($all_records[0]['comments'] == 'Soweto Forums - June - Week 4(VC)'){echo "selected";}?>>Soweto Forums - June - Week 4(VC)</option>
                                     <option value="Stretch Target" <?php if($all_records[0]['comments'] == 'Stretch Target'){echo "selected";}?>>Stretch Target</option>
                                     <option value="Wayleaves Required - Only" <?php if($all_records[0]['comments'] == 'Wayleaves Required - Only'){echo "selected";}?>>Wayleaves Required - Only</option>
                                     <option value="Wayleaves & BOQ Required" <?php if($all_records[0]['comments'] == 'Wayleaves & BOQ Required'){echo "selected";}?>>Wayleaves & BOQ Required</option>
                                     <option value="Bonus Orders" <?php if($all_records[0]['comments'] == 'Bonus Orders'){echo "selected";}?>>Bonus Orders</option>
                                     <option value="Jan" <?php if($all_records[0]['comments'] == 'Jan'){echo "selected";}?>>Jan</option>
                                     <option value="Feb" <?php if($all_records[0]['comments'] == 'Feb'){echo "selected";}?>>Feb</option>
                                     <option value="Mar" <?php if($all_records[0]['comments'] == 'Mar'){echo "selected";}?>>Mar</option>
                                     <option value="Apr" <?php if($all_records[0]['comments'] == 'Apr'){echo "selected";}?>>Apr</option>
                                     <option value="May" <?php if($all_records[0]['comments'] == 'May'){echo "selected";}?>>May</option>
                                     <option value="Jun" <?php if($all_records[0]['comments'] == 'Jun'){echo "selected";}?>>Jun</option>
                                     <option value="Jul" <?php if($all_records[0]['comments'] == 'Jul'){echo "selected";}?>>Jul</option>
                                     <option value="Aug" <?php if($all_records[0]['comments'] == 'Aug'){echo "selected";}?>>Aug</option>
                                     <option value="Sep" <?php if($all_records[0]['comments'] == 'Sep'){echo "selected";}?>>Sep</option>
                                     <option value="Oct" <?php if($all_records[0]['comments'] == 'Oct'){echo "selected";}?>>Oct</option>
                                     <option value="Nov" <?php if($all_records[0]['comments'] == 'Nov'){echo "selected";}?>>Nov</option>
                                     <option value="Dec" <?php if($all_records[0]['comments'] == 'Dec'){echo "selected";}?>>Dec</option>
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
 @endsection