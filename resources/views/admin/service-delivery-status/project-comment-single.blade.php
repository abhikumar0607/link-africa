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
                          <div class="col-3">
                            <div class="form-group">
                                <label>PROJECT STATUS:</label>
                                 <input type="text" name="project_status" value="{{ $all_records[0]['project_status'] }}" id="project_status" class="form-control">
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
                                <label>TYPE:</label>
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
                                    <option value="A) New Sales" <?php if($all_records[0]['service_delivery_status'] == 'A) New Sales'){echo "selected";}?>>A) New Sales</option>
                                    <option value="B) Work In Progress"  <?php if($all_records[0]['service_delivery_status'] == 'B) Work In Progress'){echo "selected";}?>>B) Work In Progress</option>
                                    <option value="C) Client Escalation" <?php if($all_records[0]['service_delivery_status'] == 'C) Client Escalation'){echo "selected";}?>>C) Client Escalation</option>
                                    <option value="K) OTOC'd" <?php if($all_records[0]['service_delivery_status'] == "K) OTOC'd"){echo "selected";}?>>K) OTOC'd</option>
                                    <option value="J) Cancelled" <?php if($all_records[0]['service_delivery_status'] == "J) Cancelled"){echo "selected";}?>>J) Cancelled</option>
                                    <option value="S) Terminated" <?php if($all_records[0]['service_delivery_status'] == "S) Terminated"){echo "selected";}?>>S) Terminated</option>
                                    <option value="D) TOC P2 Received-Build" <?php if($all_records[0]['service_delivery_status'] == "D) TOC P2 Received-Build"){echo "selected";}?>>D) TOC P2 Received-Build</option>
                                    <option value="E) TOC P2 Submitted-Client" <?php if($all_records[0]['service_delivery_status'] == "E) TOC P2 Submitted-Client"){echo "selected";}?>>E) TOC P2 Submitted-Client</option>
                                    <option value="E) TOC P2 Received-Client" <?php if($all_records[0]['service_delivery_status'] == "E) TOC P2 Received-Client"){echo "selected";}?>>E) TOC P2 Received-Client</option>
                                    <option value="I) On-Hold" <?php if($all_records[0]['service_delivery_status'] == "I) On-Hold"){echo "selected";}?>>I) On-Hold</option>
                                    <option value="L) Back to Planning" <?php if($all_records[0]['service_delivery_status'] == "L) Back to Planning"){echo "selected";}?>>L) Back to Planning</option>
                                    <option value="Q) Deemed Toc Received" <?php if($all_records[0]['service_delivery_status'] == "Q) Deemed Toc Received"){echo "selected";}?>>Q) Deemed Toc Received</option>
                                    <option value="R) Return to Sales" <?php if($all_records[0]['service_delivery_status'] == "R) Return to Sales"){echo "selected";}?>>R) Return to Sales</option>
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
                                <select class="form-control" name="network_types" id="network_types">
                                    <option value="NET1" selected>Please Select</option>
                                    <option value="NET1" <?php if($all_records[0]['network_types'] == "NET1"){ echo "selected"; } ?>>NET1</option>
                                    <option value="NET2.1" <?php if($all_records[0]['network_types'] == "NET2.1"){ echo "selected"; } ?>>NET2.1</option>
                                    <option value="NET2.2" <?php if($all_records[0]['network_types'] == "NET2.2"){ echo "selected"; } ?>>NET2.2</option>
                                    <option value="NET3.1" <?php if($all_records[0]['network_types'] == "NET3.1"){ echo "selected"; } ?>>NET3.1</option>
                                    <option value="NET3.2" <?php if($all_records[0]['network_types'] == "NET3.2"){ echo "selected"; } ?>>NET3.2</option> 
                                    <option value="NET4" <?php if($all_records[0]['network_types'] == "NET4"){ echo "selected"; } ?>>NET4</option>
                                    <option value="NET5" <?php if($all_records[0]['network_types'] == "NET5"){ echo "selected"; } ?>>NET5</option>
                                    <option value="NET6.1" <?php if($all_records[0]['network_types'] == "NET6.1"){ echo "selected"; } ?>>NET6.1</option>
                                    <option value="NET6.2.0" <?php if($all_records[0]['network_types'] == "NET6.2.0"){ echo "selected"; } ?>>NET6.2.0</option>
                                    <option value="NET6.2.1" <?php if($all_records[0]['network_types'] == "NET6.2.1"){ echo "selected"; } ?>>NET6.2.1</option>
                                    <option value="NET6.3" <?php if($all_records[0]['network_types'] == "NET6.3"){ echo "selected"; } ?>>NET6.3</option>
                                    <option value="NET6.4" <?php if($all_records[0]['network_types'] == "NET6.4"){ echo "selected"; } ?>>NET6.4</option>
                                    <option value="NET6.5" <?php if($all_records[0]['network_types'] == "NET6.5"){ echo "selected"; } ?>>NET6.5</option>
                                    <option value="NET6.6" <?php if($all_records[0]['network_types'] == "NET6.6"){ echo "selected"; } ?>>NET6.6</option>
                                    <option value="NET7" <?php if($all_records[0]['network_types'] == "NET7"){ echo "selected"; } ?>>NET7</option>
                                    <option value="NET8" <?php if($all_records[0]['network_types'] == "NET8"){ echo "selected"; } ?>>NET8</option>
                                    <option value="NET9" <?php if($all_records[0]['network_types'] == "NET9"){ echo "selected"; } ?>>NET9</option>
                                </select>
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
                                        <input type="text" value="" class="form-control datetimepicker-input" name="shc_date" id="shc_date" data-target="#custom_date_picker9">
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
                                <textarea name="comments" id="comments" rows="3" cols="38" class="form-control">{{ $all_records[0]['build_record']['comments'] }}</textarea>
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
                                <label>TOC SUBMITTED:</label>
                                <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                        <input type="text" value="" class="form-control datetimepicker-input" name="toc_submitted" id="toc_submitted" data-target="#custom_date_picker10">
                                    <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>TOC RECEIVED:</label>
                                <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                        <input type="text" value="" class="form-control datetimepicker-input" name="toc_received" id="toc_received" data-target="#custom_date_picker11">
                                    <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>RETURN TO SALE:</label>
                                <select class="form-control" name="return_to_sale" id="return_to_sale">
                                     <option value="" selected>Please Select</option>
                                    <option value="Landlord Approval outstanding from Customer">Landlord Approval outstanding from Customer</option>
                                    <option value="Still Waiting on Customer for Site Survey">Still Waiting on Customer for Site Survey</option>
                                    <option value="Incorrect Customer Contact Details">Incorrect Customer Contact Details</option>
                                    <option value="Incorrect Physical Address">Incorrect Physical Address</option>
                                    <option value="Not Commercially Feasible">Not Commercially Feasible</option>
                                    <option value="Customer Has Requested Cancellation">Customer Has Requested Cancellation</option>
                                    <option value="Incorrect Feasibility Result">Incorrect Feasibility Result</option>
                                    <option value="Incomplete Order">Incomplete Order</option>
                                    <option value="Pending Customer H&S Approval">Pending Customer H&S Approval</option>
                                    <option value="Customer Site Not Ready">Customer Site Not Ready</option>
                                    <option value="Awaiting Consent to Survey Form">Awaiting Consent to Survey Form</option>
                                    <option value="Pending COVID Letter">Pending COVID Letter</option>
                                    <option value="Insufficient Capacity/Backhaul">Insufficient Capacity/Backhaul</option>
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