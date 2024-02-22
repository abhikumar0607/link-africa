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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card La-add-scroll">
                  <div class="card-header">
                      <h3 class="card-title">Edit Sale</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                   @if(count($record) >= 1)
                   @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                    @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                    <form action="{{ route('admin.sale.update-record', $record[0]['id'])}}" method="POST" enctype="multipart/form-data" id="" class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data" class="edit_site_master_file_record">
                  @endif
                      <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                        <div class="col-4 listing-design-link">
                            <div class="form-group">
                              <h2 style="font-size:18px;font-weight:700;">Uploaded Files:</h2>
                              @if(count($record[0]['attachment_record']) > 0) 
                                @foreach($record[0]['attachment_record'] as $attachment)
                                @if($attachment['page_type'] == 'sales')
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
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Upload Attachment
                          </button>
                            </div>

                            </div>
                            </div>
                                <div class="col-2">
                            <div class="form-group">
                              <label>Date New:</label>
                                <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control" name="date_new" id="date_new" value="{{ Carbon\Carbon::parse($record[0]['date_new'])->format('m/d/Y'); }}" >
                                </div>
                            </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" name="circuit_id" value="{{ $record[0]['circuit_id'] }}" id="circuit_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Date Po Order Rx:</label>
                                <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                @if($record[0]['date_po_order_rx'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_po_order_rx" id="date_po_order_rx" data-target="#custom_date_picker4" value="{{ Carbon\Carbon::parse($record[0]['date_po_order_rx'])->format('m/d/Y'); }}">
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
                                <label>Metro Area:</label>
                                <select class="form-control" name="metro_area" id="metro_area">
                                <option value="{{ $record[0]['metro_area'] }}">{{ $record[0]['metro_area'] }}</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Service Type:</label>
                                <select class="form-control" name="service_type" id="service_type">
                                  @foreach($all_service_types as $service_type)
                                        <option value="{{ $service_type['service_name'] }}" 
                                                {{ (strtolower(str_replace(' ', '', $service_type['service_name'])) === strtolower(str_replace(' ', '', $record[0]['service_type']))) ? 'selected' : '' }}>
                                            {{ $service_type['service_name'] }}
                                        </option>
                                   @endforeach

                                    <option value="Link Connect BB">Link Connect BB</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>PO MRC:</label>
                                <input type="text" name="po_mrc" value="{{ $record[0]['po_mrc'] }}" id="po_mrc" class="form-control">
                            </div>
                          </div>
                                

                          <div class="col-2">
                            <div class="form-group">
                                <label>Select Project Status:</label>
                                <select class="form-control" name="project_status" id="project_status"> 
                                   <option value="" disabled>Please select</option>
                                    <option  data-id="@if($record[0]['date_new']){{ Carbon\Carbon::parse($record[0]['date_new'])->format('m/d/Y'); }}
                                    @else
                                    {{ Carbon\Carbon::now()->format('m/d/Y'); }} 
                                    @endif" value="A) New Sales"<?php if ($record[0]['project_status'] == 'A) New Sales') echo ' selected="selected"'; ?>>A) New Sales</option> 
                                    
                                    <option  value="B) New In-Planning"<?php if ($record[0]['project_status'] == 'B) New In-Planning') echo ' selected="selected"'; ?>>B) New In-Planning</option> 
                                    <option  value="C) In-Survey"<?php if ($record[0]['project_status'] == 'C) In-Survey') echo ' selected="selected"'; ?>>C) In-Survey</option> 
                                    <option  value="D) In-Planning"<?php if ($record[0]['project_status'] == 'D) In-Planning') echo ' selected="selected"'; ?>>D) In-Planning</option> 
                                    <option  value="E) Landlord-Approval"<?php if ($record[0]['project_status'] == 'E) Landlord-Approval') echo ' selected="selected"'; ?>>E) Landlord-Approval</option> 
                                    <option  value="F) Permissions"<?php if ($record[0]['project_status'] == 'F) Permissions') echo ' selected="selected"'; ?>>F) Permissions</option> 
                                    <option  value="G) VO Process"<?php if ($record[0]['project_status'] == 'G) VO Process') echo ' selected="selected"'; ?>>G) VO Process</option> 
                                    <option  value="G1) Planning Review"<?php if ($record[0]['project_status'] == 'G1) Planning Review') echo ' selected="selected"'; ?>>G1) Planning Review</option> 
                                    <option  value="H) Financial Approval"<?php if ($record[0]['project_status'] == 'H) Financial Approval') echo ' selected="selected"'; ?>>H) Financial Approval</option> 
                                    <option  value="I) New In-Build"<?php if ($record[0]['project_status'] == 'I) New In-Build') echo ' selected="selected"'; ?>>I) New In-Build</option> 
                                    <option  value="J) In-Build"<?php if ($record[0]['project_status'] == 'J) In-Build') echo ' selected="selected"'; ?>>J) In-Build</option> 
                                    <option  value="K) TOC P1 Submitted-L2"<?php if ($record[0]['project_status'] == 'K) TOC P1 Submitted-L2') echo ' selected="selected"'; ?>>K) TOC P1 Submitted-L2</option>
                                    <option  value="L) TOC P2 Received-L2"<?php if ($record[0]['project_status'] == 'L) TOC P2 Received-L2') echo ' selected="selected"'; ?>>L) TOC P2 Received-L2</option> 
                                    <option  value="M) Service Delivery"<?php if ($record[0]['project_status'] == 'M) Service Delivery') echo ' selected="selected"'; ?>>M) Service Delivery</option> 
                                    <option  value="N) TOC P2 Submitted"<?php if ($record[0]['project_status'] == 'N) TOC P2 Submitted') echo ' selected="selected"'; ?>>N) TOC P2 Submitted</option> 
                                    <option  value="O) TOC P2 Received"<?php if ($record[0]['project_status'] == 'O) TOC P2 Received') echo ' selected="selected"'; ?>>O) TOC P2 Received</option> 
                                    <option  value="P) VNO Provisioning"<?php if ($record[0]['project_status'] == 'P) VNO Provisioning') echo ' selected="selected"'; ?>>P) VNO Provisioning</option>
                                    <option  value="Q) Cancelled"<?php if ($record[0]['project_status'] == 'Q) Cancelled') echo ' selected="selected"'; ?>>Q) Cancelled</option>
                                    <option  value="R) On-Hold"<?php if ($record[0]['project_status'] == 'R) On-Hold') echo ' selected="selected"'; ?>>R) On-Hold</option>
                                    <option  value="S) Return to Sales"<?php if ($record[0]['project_status'] == 'S) Return to Sales') echo ' selected="selected"'; ?>>S) Return to Sales</option> 
                                    <option  value="T) Complete"<?php if ($record[0]['project_status'] == 'T) Complete') echo ' selected="selected"'; ?>>T) Complete</option> 
                                    <option  value="U) Terminated"<?php if ($record[0]['project_status'] == 'U) Terminated') echo ' selected="selected"'; ?>>U) Terminated</option> 
                                    <option data-id="{{ Carbon\Carbon::now()->format('m/d/Y'); }}" value="V) Pending CTS"<?php if ($record[0]['project_status'] == 'V) Pending CTS') echo ' selected="selected"'; ?>>V) Pending CTS</option>
                                   
                                  </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                              <label>Project Status:</label>
                              <input type="text" name="" value="{{ $record[0]['project_status'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Sales Status:</label>
                                <select class="form-control" name="sales_status" id="sales_status">  
                                    <option  value="A)New Sales"<?php if ($record[0]['sales_status'] == 'A) New Sales') echo ' selected="selected"'; ?>>A) New Sales</option> 
                                    <option  value="C) On-Hold"<?php if ($record[0]['sales_status'] == 'C) On-Hold') echo ' selected="selected"'; ?>>C) On-Hold</option>
                                    <option  value="D) Cancelled"<?php if ($record[0]['sales_status'] == 'D) Cancelled') echo ' selected="selected"'; ?>>D) Cancelled</option>
                                    <option  value="E) Terminated"<?php if ($record[0]['sales_status'] == 'E) Terminated') echo ' selected="selected"'; ?>>E) Terminated</option>
                                    <option  value="F) Data Fix"<?php if ($record[0]['sales_status'] == 'F) Data Fix') echo ' selected="selected"'; ?>>F) Data Fix</option>
                                  </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" name="project_id" value="{{ $record[0]['project_id'] }}" id="project_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Order Ref No:</label>
                                <input type="text" name="order_ref_number" value="{{ $record[0]['order_ref_number'] }}" id="order_ref_number" class="form-control">
                            </div>
                          </div>
                           <div class="col-2">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <select class="form-control" name="client_name" id="client_name">
                                    @foreach($all_customers as $customer)
                                        <option value="{{ $customer['name'] }}" {{ ( $customer['name'] == $record[0]['client_name']) ? 'selected' : '' }}> {{ $customer['name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Client Ring:</label>
                                <input type="text" name="client_ring" value="{{ $record[0]['client_ring'] }}" id="client_ring" class="form-control">   
                                <div id="client_ring_res" class="client-ring-list"></div> 
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>PO NRC:</label>
                                <input type="text" name="po_nrc" value="{{ $record[0]['po_nrc'] }}" id="po_nrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
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
                          <div class="col-2">
                            <div class="form-group">
                                <label>Province:</label>
                                <select class="form-control" name="province" id="province">
                                  <option value="{{ $record[0]['province'] }}">{{ $record[0]['province'] }}</option>  
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Region:</label>
                                <select class="form-control" name="region" id="region">
                                <option value="Eastern Region"<?php if ($record[0]['region'] == 'Eastern Region') echo ' selected="selected"'; ?>>Eastern Region</option>
                                     <option value="Northern Region"<?php if ($record[0]['region'] == 'Northern Region') echo ' selected="selected"'; ?>>Northern Region</option>
                                      <option value="Western Region"<?php if ($record[0]['region'] == 'Western Region') echo ' selected="selected"'; ?>>Western Region</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>LA Invoice:</label>
                                <input type="text" name="la_invoice" value="{{ $record[0]['la_invoice'] }}" id="la_invoice" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                            <label>Project Type:</label>
                                <select class="form-control" name="type" id="type">
                                 @foreach($all_project_type as $project_type)
                                   <option value="{{ $project_type->project_type }}"<?php if ($record[0]['type'] == $project_type->project_type) echo ' selected="selected"'; ?>>{{ $project_type->project_type }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>VODACOM VCW:</label>
                                <input type="text" name="vodacom_vcw" value="{{ $record[0]['vodacom_vcw'] }}" id="vodacom_vcw" class="form-control">
                            </div>
                          </div> 
                          <div class="col-2">
                          <div class="form-group">
                                <label>Data From:</label>
                                <input type="text" name="" value="{{ $record[0]['data_from'] }}" id="vodacom_vcw" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                          <div class="form-group">
                                <label>SLA Group:</label>
                                <select class="form-control" name="sla_group" id="sla_group">
                                  <option value="{{ $record[0]['sla_group'] }}">{{ $record[0]['sla_group'] }}</option>
                                </select>  
                            </div>
                          </div>
                          <div class="col-2">
                          <div class="form-group">
                                <label>MTTR SLA:</label>
                                <select class="form-control" name="mttr_sla" id="mttr_sla">
                                <option value="{{ $record[0]['mttr_sla'] }}">{{ $record[0]['mttr_sla'] }}</option>
                                </select> 
                            </div>
                          </div>
                          </div>
                          <div class="row secound-Qw">
                           <div class="col-md-4 inner-peth">
                               <h2 class="cont-Qwe">SITE A</h2>
                          <div class="col-3">
                            <div class="form-group sed-Qw">
                                <label>Site A:</label>
                                <select class="form-control" name="site_a" id="site_a">
                                    <option value="">Please Select Site A</option>
                                     @foreach($all_site_a_lists as $site_a)
                                        <option value="{{ $site_a['site_name'] }}" {{ ( $site_a['site_name'] == $record[0]['site_a']) ? 'selected' : '' }}> {{ $site_a['site_name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site A:</label>
                                <input type="text" name="view_name_site_a" value="{{ $record[0]['site_a'] }}" id="view_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name - Site A:</label>
                                <input type="text" name="contact_name_site_a" value="{{ $record[0]['contact_name_site_a'] }}" id="contact_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site A:</label>
                                <input type="text" name="physical_address_site_a" value="{{ $record[0]['physical_address_site_a'] }}" id="physical_address_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co - ordinates - Site A-X:</label>
                                <input type="text" name="gps_co_ordinates_site_a_x" value="{{ $record[0]['gps_co_ordinates_site_a_x'] }}" id="gps_co_ordinates_site_a_x" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co - ordinates - Site A-Y:</label>
                                <input type="text" name="gps_co_ordinates_site_a_y" value="{{ $record[0]['gps_co_ordinates_site_a_y'] }}" id="gps_co_ordinates_site_a_y" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site A:</label>
                                <input type="text" name="work_number_site_a" value="{{ $record[0]['work_number_site_a'] }}" id="work_number_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site A:</label>
                                <input type="text" name="mobile_number_site_a" value="{{ $record[0]['mobile_number_site_a'] }}" id="mobile_number_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site A:</label>
                                <input type="text" name="email_address_site_a" value="{{ $record[0]['email_address_site_a'] }}" id="email_address_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Name - Site A:</label>
                                <input type="text" name="landlord_name_site_a" value="{{ $record[0]['landlord_name_site_a'] }}" id="landlord_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Contact Number A:</label>
                                <input type="text" name="landlord_contact_number_a" value="{{ $record[0]['landlord_contact_number_a'] }}" id="landlord_contact_number_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Managing Agent - Site A:</label>
                                <input type="text" name="managing_agent_site_a" value="{{ $record[0]['managing_agent_site_a'] }}" id="managing_agent_site_a" class="form-control">
                            </div>
                          </div>
                          </div>
                          <div class="col-md-4 inner-peth">
                              <h2 class="cont-Qwe">SITE B</h2>
                              
                          <div class="col-3">
                            <div class="form-group sed-Qw">
                                <label>Site B:</label>
                                <select class="form-control" name="site_b" id="site_b">
                                     <option value="">Please Select Site B</option>
                                    @foreach($all_site_b_lists as $site_b)
                                         <option value="{{ $site_b['site_name'] }}" {{ ( $site_b['site_name'] == $record[0]['site_b']) ? 'selected' : '' }}> {{ $site_b['site_name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site B:</label>
                                <input type="text" name="view_name_site_b" value="{{ $record[0]['site_b'] }}" id="view_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name  - Site B:</label>
                                <input type="text" name="contact_name_site_b" value="{{ $record[0]['contact_name_site_b'] }}" id="contact_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site B:</label>
                                <input type="text" name="physical_address_site_b" value="{{ $record[0]['physical_address_site_b'] }}" id="physical_address_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co- ordinates - Site B-X:</label>
                                <input type="text" name="gps_co_ordinates_site_b_x" value="{{ $record[0]['gps_co_ordinates_site_b_x'] }}" id="gps_co_ordinates_site_b_x" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co- ordinates - Site B-Y:</label>
                                <input type="text" name="gps_co_ordinates_site_b_y" value="{{ $record[0]['gps_co_ordinates_site_b_y'] }}" id="gps_co_ordinates_site_b_y" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site B:</label>
                                <input type="text" name="work_number_site_b" value="{{ $record[0]['work_number_site_b'] }}" id="work_number_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site B:</label>
                                <input type="text" name="mobile_number_site_b" value="{{ $record[0]['mobile_number_site_b'] }}" id="mobile_number_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site B:</label>
                                <input type="email" name="email_address_site_b" value="{{ $record[0]['email_address_site_b'] }}" id="email_address_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Name - Site B:</label>
                                <input type="text" name="landlord_name_site_b" value="{{ $record[0]['landlord_name_site_b'] }}" id="landlord_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Contact Number B:</label>
                                <input type="text" name="landlord_contact_number_b" value="{{ $record[0]['landlord_contact_number_b'] }}" id="landlord_contact_number_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Managing Agent - Site B:</label>
                                <input type="text" name="managing_agent_site_b" value="{{ $record[0]['managing_agent_site_b'] }}" id="managing_agent_site_b" class="form-control">
                            </div>
                          </div>
                          
                          </div>
                          
                          <div class="col-md-4 inner-peth">
                              <h2 class="cont-Qwe">Service Description</h2>
                          
                        <!-- <div class="col-3">
                          <div class="form-group sed-Qwr">
                              <label>Description:</label>
                              <select class="form-control" name="description" id="description">
                                <option value=""></option>
                                  @foreach($all_descriptions as $description)
                                  <option value="{{ $description['description'] }}" {{ ( $description['description'] == $record[0]['site_b']) ? 'selected' : '' }}> {{ $description['description'] }} </option>
                                  @endforeach
                              </select>
                          </div>
                        </div> -->
                          <div class="col-3">
                            <div class="form-group">
                                <label>Core Network colocation facilitie:</label>
                                <input type="text" name="core_network_colocation_facilities" value="{{ $record[0]['core_network_colocation_facilities'] }}" id="core_network_colocation_facilities" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 18U:</label>
                                <input type="text" name="rack_space_18u" value="{{ $record[0]['rack_space_18u'] }}" id="rack_space_18u" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 9U Core Access Active:</label>
                                <input type="text" name="rack_space_9u_core_access_active" value="{{ $record[0]['rack_space_9u_core_access_active'] }}" id="rack_space_9u_core_access_active" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 9U Core Access Passive:</label>
                                <input type="text" name="rack_space_9u_core_access_passive" value="{{ $record[0]['rack_space_9u_core_access_passive'] }}" id="rack_space_9u_core_access_passive" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack Space 1U -Passive:</label>
                                <input type="text" name="rack_space_1u_passive" value="{{ $record[0]['rack_space_1u_passive'] }}" id="rack_space_1u_passive" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Crossconnect:</label>
                                <input type="text" name="crossconnect" value="{{ $record[0]['crossconnect'] }}" id="crossconnect" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Technical hands:</label>
                                <input type="text" name="technical_hands" value="{{ $record[0]['technical_hands'] }}" id="technical_hands" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SLA:</label>
                                <input type="text" name="sla" value="{{ $record[0]['sla'] }}" id="sla" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SLA Premium:</label>
                                <input type="text" name="sla_premium" value="{{ $record[0]['sla_premium'] }}" id="sla_premium" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rate Mbit-S:</label>
                                <select class="form-control" name="rate_mbit_s" id="rate_mbit_s">
                                @foreach($all_rate_mbit_s as $rate_mbit_s)
                                <option value="{{ $rate_mbit_s->rate_mbit_s }}"<?php if ($record[0]['rate_mbit_s'] == $rate_mbit_s->rate_mbit_s) echo ' selected="selected"'; ?>>{{ $rate_mbit_s->rate_mbit_s }}</option> 
                                @endforeach                                 
                                </select>
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Strands:</label>
                                <select class="form-control" name="strands" id="strands">
                                <option value="" selected>Please Select</option>
                                  @foreach($all_strands as $strands)
                                  <option value="{{ $strands->strands }}" <?php if ($record[0]['strands'] == $strands->strands) echo ' selected="selected"'; ?>>{{ $strands->strands }}</option>
                                  @endforeach
                               </select>
                            </div>
                          </div>
                           </div>
                          </div>
                            <div class="row peth-terd">
                           <div class="col-md-12">
                         
                         <div class="col-3">
                            <div class="form-group">
                                <label>LLC Received:</label>
                                <div class="radio-btn">
                                <input type="radio" id="llc_received"  class="form-control" name="llc_received" value="1" <?php if ($record[0]['llc_received'] == '1') echo ' checked="checked"'; ?>>
                                <label for="css">Yes</label><br>
                                </div>
                                <div class="radio-btn">
                                 <input type="radio" id="llc_received" class="form-control" name="llc_received" value="0"  <?php if ($record[0]['llc_received'] == '0') echo ' checked="checked"';?>>
                                 <label for="css">No</label>
                                 </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Lease term in Months:</label> 
                                <select class="form-control" name="lease_term_in_months" id="lease_term_in_months">
                                @foreach($all_lease_term_in_month as $lease_term_in_month)
                                     <option value="{{ $lease_term_in_month->lease_term_in_month }}" <?php if($record[0]['lease_term_in_months'] == $lease_term_in_month->lease_term_in_month) { echo "selected"; } ?>>{{ $lease_term_in_month->lease_term_in_month }}</option>
                                @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>KAM Name:</label>
                                <select class="form-control" name="kam_name" id="kam_name">
                                  <option value="{{ $record[0]['kam_name'] }}">{{ $record[0]['kam_name'] }}</option>
                                @foreach($all_kam_name as $kam_name)
                                    <option  value="{{ $kam_name->kam_name }}" <?php if($record[0]['kam_name'] ==  $kam_name->kam_name ) { echo "selected"; } ?>>{{ $kam_name->kam_name }}</option>
                                @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Order Type:</label>
                                <select class="form-control" name="order_type" id="order_type">
                                @foreach($all_order_name as $order_name)
                                    <option value="{{ $order_name->order_name }}" <?php if($record[0]['order_type'] == $order_name->order_name) { echo "selected"; } ?>>{{ $order_name->order_name }}</option>
                                @endforeach
                                </select>
                            </div>
                          </div>
                          
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>Feasibility Ref Nr:</label>
                                <input type="text" name="feasibility_ref_nr" value="{{ $record[0]['feasibility_ref_nr'] }}" id="feasibility_ref_nr" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Penalty Charges:</label>
                                <input type="text" name="penalty_charges" value="{{ $record[0]['penalty_charges'] }}" id="penalty_charges" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Cancellation date:</label>
                                <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                @if($record[0]['cancellation_date'])
                                    <input type="text" class="form-control datetimepicker-input" name="cancellation_date" id="cancellation_date" data-target="#custom_date_picker7" value="{{ Carbon\Carbon::parse($record[0]['cancellation_date'])->format('m/d/Y'); }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="cancellation_date" id="cancellation_date" data-target="#custom_date_picker7" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Network Types:</label>
                                <select class="form-control" name="network_types" id="network_types">
                                @foreach($all_network_type as $network_type)
                                    <option value="{{ $network_type->network_type }}" 
                                            {{ strtolower($record[0]['network_types']) === strtolower($network_type->network_type) ? 'selected' : '' }}>
                                        {{ $network_type->network_type }}
                                    </option> 
                                @endforeach
                                </select>
                            </div>
                          </div>
                        
                          <div class="col-3">
                            <div class="form-group">
                                <label>Special Build NRC:</label>
                                <input type="text" name="special_build_nrc" value="{{ $record[0]['special_build_nrc'] }}" id="special_build_nrc" class="form-control">
                            </div>
                          </div>
                          
                          <div class="col-3">
                            <div class="form-group">
                                <label>Return to Sales:</label>
                                <select class="form-control" name="return_to_sales" id="return_to_sales">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_return_to_sale as $return_to_sale)
                                    <option value="{{ $return_to_sale->return_to_sale }}" <?php if($record[0]['return_to_sales'] == $return_to_sale->return_to_sale) { echo "selected"; } ?>>{{ $return_to_sale->return_to_sale }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          
                          <div class="col-3">
                            <div class="form-group">
                                <label>Termination Date:</label>
                                <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                  @if($record[0]['termination_date'])
                                    <input type="text" class="form-control datetimepicker-input" name="termination_date" id="termination_date" data-target="#custom_date_picker6" value="{{ Carbon\Carbon::parse($record[0]['termination_date'])->format('m/d/Y'); }}">
                                    @else
                                    <input type="text" class="form-control datetimepicker-input" name="termination_date" id="termination_date" data-target="#custom_date_picker6" value="">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          
                       
                          <div class="col-3">
                            <div class="form-group">
                                <label>3rd Party NRC:</label>
                                <input type="text" name="thrd_party_nrc" value="{{ $record[0]['thrd_party_nrc'] }}" id="thrd_party_nrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>3rd Party MRC:</label>
                                <input type="text" name="thrd_party_mrc" value="{{ $record[0]['thrd_party_mrc'] }}" id="thrd_party_mrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>3rd Party Provider:</label>
                                <select class="form-control" name="thrd_party_provider" id="thrd_party_provider">
                                <option value="" selected>Please Select</option>
                                  @foreach($all_thrd_party_provider as $thrd_party_provider)
                                     <option value="{{ $thrd_party_provider->thrd_party_provider }}" <?php if($record[0]['thrd_party_provider'] == $thrd_party_provider->thrd_party_provider) { echo "selected"; } ?>>{{ $thrd_party_provider->thrd_party_provider }}</option>  
                                  @endforeach
                                    </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Sales Comments:</label>
                                <textarea id="sales_comments" name="sales_comments" rows="4" cols="50" class="form-control">{{ $record[0]['sales_comments'] }}</textarea>
                            </div>
                          </div>
                       
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                        <button type="submit" class="btn btn-primary">Submit</button> 
                        @endif
                          
                    </div>
                </form> 
                @else
                <h2>Result Not found</h2>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog sale-attachment">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sales Attachment</h5>
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
                                  <input type="hidden" id="service_id" name="service_id" value ="{{ $record[0]['circuit_id'] }}">
                                  <input type="hidden" id="circuit_id" name="circuit_id" value = "{{ $record[0]['circuit_id'] }}">
                                  <input type="hidden" id="page_type" name="sales" value ="sales">
                                  </div>
                                  <div id="selectedFiles"></div>
                                  <label>Select Type</label>
                                  <select class="form-control" id="form_type" name="form_type">
                                  <option value ="">Please Select</option>
                                    <option value ="Signed Quote">Signed Quote</option>
                                    <option value ="Po from ISP">Po from ISP</option>
                                    <option value ="Consent to Survey">Consent to Survey</option>
                                    <option value ="Covid Questionnaire">Covid Questionnaire</option>
                                    <option value ="Contact Database - Including">Contact Database - Including</option>
                                    <option value ="Cm - Fm">Cm - Fm</option>
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