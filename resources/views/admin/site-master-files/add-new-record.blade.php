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
                      <h3 class="card-title">Add New Sale</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                    @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                        <form action="{{ route('admin.sale.submit-record') }}" method="POST" enctype="multipart/form-data" id="add_site_master_file_record"> 
                        {{ csrf_field() }} 
                    @else
                      <form method="POST" action="#" enctype="multipart/form-data">
                    @endif
                    <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                        
                                <div class="col-2">
                            <div class="form-group">
                              <label>Date New:</label>
                                <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control" name="date_new" id="date_new" value="{{ Carbon\Carbon::now()->format('m/d/Y'); }}" >
                                </div>
                            </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" name="circuit_id" value="" id="circuit_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Date Po Order Rx:</label>
                                <div class="input-group date" id="custom_date_picker100" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="date_po_order_rx" id="date_po_order_rx" data-target="#custom_date_picker100" data-date-end-date="0d">
                                    <div class="input-group-append" data-target="#custom_date_picker100" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>  
                          <div class="col-2">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                <select class="form-control" name="metro_area" id="metro_area">        
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Service Type:</label>
                                <select class="form-control" name="service_type" id="service_type">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_service_types as $service_type)
                                        <option value="{{ $service_type->service_name }}">{{ $service_type->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>PO MRC:</label>
                                <input type="text" name="po_mrc" value="" id="po_mrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project Status:</label>
                                <select class="form-control" name="project_status" id="project_status">  
                                    <option data-id="{{ Carbon\Carbon::now()->format('m/d/Y'); }}" value="A) New Sales">A) New Sales</option>
									                  <option data-id="{{ Carbon\Carbon::now()->format('m/d/Y'); }}" value="V) Pending CTS">V) Pending CTS</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-2">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" name="project_id" value="" id="project_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Order Ref No:</label>
                                <input type="text" name="order_ref_number" value="" id="order_ref_number" class="form-control">
                            </div>
                          </div>
                           <div class="col-2">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <select class="form-control" name="client_name" id="client_name">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_customers as $customer)
                                        <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Client Ring:</label>
                                <input type="text" name="client_ring" value="" id="client_ring" class="form-control">   
                                <div id="client_ring_res" class="client-ring-list"></div> 
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>PO NRC:</label>
                                <input type="text" name="po_nrc" value="" id="po_nrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                <label>Service ID:</label>
                                <input type="text" class="form-control" name="service_id" value="" id="service_id">
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
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Region:</label>
                                <select class="form-control" name="region" id="region">
                                    <option value="" selected>Please Select</option>
                                    <option value="Eastern Region">Eastern Region</option>
                                    <option value="Northern Region">Northern Region</option>
                                    <option value="Western Region">Western Region</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>LA Invoice:</label>
                                <input type="text" name="la_invoice" value="" id="la_invoice" class="form-control">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project Type:</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_project_type as $project_type)
                                    <option value="{{ $project_type->project_type }}">{{ $project_type->project_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>VODACOM VCW:</label>
                                <input type="text" name="vodacom_vcw" value="" id="vodacom_vcw" class="form-control">
                            </div>
                          </div> 
                          <div class="col-2">
                          </div>
                          </div>
                          <div class="row secound-Qw">
                           <div class="col-md-4 inner-peth">
                               <h2 class="cont-Qwe">SITE A</h2>
                          <div class="col-3">
                            <div class="form-group sed-Qw">
                                <label>Site A:</label>
                                <select class="form-control" name="site_a" id="site_a">
                                    <option value="">Please Select</option>
                                     @foreach($all_site_a_lists as $site_a)
                                        <option value="{{ $site_a->site_name }}">{{ $site_a->site_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name - Site A:</label>
                                <input type="text" name="contact_name_site_a" value="" id="contact_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site A:</label>
                                <input type="text" name="physical_address_site_a" value="" id="physical_address_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co - ordinates - Site A-X:</label>
                                <input type="text" name="gps_co_ordinates_site_a_x" value="" id="gps_co_ordinates_site_a_x" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co - ordinates - Site A-Y:</label>
                                <input type="text" name="gps_co_ordinates_site_a_y" value="" id="gps_co_ordinates_site_a_y" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site A:</label>
                                <input type="text" name="work_number_site_a" value="" id="work_number_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site A:</label>
                                <input type="text" name="mobile_number_site_a" value="" id="mobile_number_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site A:</label>
                                <input type="text" name="email_address_site_a" value="" id="email_address_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Name - Site A:</label>
                                <input type="text" name="landlord_name_site_a" value="" id="landlord_name_site_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Contact Number A:</label>
                                <input type="text" name="landlord_contact_number_a" value="" id="landlord_contact_number_a" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Managing Agent - Site A:</label>
                                <input type="text" name="managing_agent_site_a" value="" id="managing_agent_site_a" class="form-control">
                            </div>
                          </div>
                          </div>
                          <div class="col-md-4 inner-peth">
                              <h2 class="cont-Qwe">SITE B</h2>
                              
                          <div class="col-3">
                            <div class="form-group sed-Qw">
                                <label>Site B:</label>
                                <select class="form-control" name="site_b" id="site_b">
                                    <option value="">Please Select</option>
                                    @foreach($all_site_b_lists as $site_b)
                                        <option value="{{ $site_b->site_name }}">{{ $site_b->site_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name  - Site B:</label>
                                <input type="text" name="contact_name_site_b" value="" id="contact_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site B:</label>
                                <input type="text" name="physical_address_site_b" value="" id="physical_address_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co- ordinates - Site B-X:</label>
                                <input type="text" name="gps_co_ordinates_site_b_x" value="" id="gps_co_ordinates_site_b_x" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>GPS Co- ordinates - Site B-Y:</label>
                                <input type="text" name="gps_co_ordinates_site_b_y" value="" id="gps_co_ordinates_site_b_y" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site B:</label>
                                <input type="text" name="work_number_site_b" value="" id="work_number_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site B:</label>
                                <input type="text" name="mobile_number_site_b" value="" id="mobile_number_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site B:</label>
                                <input type="email" name="email_address_site_b" value="" id="email_address_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Name - Site B:</label>
                                <input type="text" name="landlord_name_site_b" value="" id="landlord_name_site_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>landlord Contact Number B:</label>
                                <input type="text" name="landlord_contact_number_b" value="" id="landlord_contact_number_b" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Managing Agent - Site B:</label>
                                <input type="text" name="managing_agent_site_b" value="" id="managing_agent_site_b" class="form-control">
                            </div>
                          </div>
                          
                          </div>
                          
                          <div class="col-md-4 inner-peth">
                              <h2 class="cont-Qwe">Service Description</h2>
                          
                          <!-- <div class="col-3">
                            <div class="form-group sed-Qwr">
                                <label>Description:</label>
                                <select class="form-control" name="description" id="description">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_descriptions as $description)
                                        <option value="{{ $description->description }}">{{ $description->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div> -->
                          <div class="col-3">
                            <div class="form-group">
                                <label>Core Network colocation facilitie:</label>
                                <input type="text" name="core_network_colocation_facilities" value="" id="core_network_colocation_facilities" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 18U:</label>
                                <input type="text" name="rack_space_18u" value="" id="rack_space_18u" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 9U Core Access Active:</label>
                                <input type="text" name="rack_space_9u_core_access_active" value="" id="rack_space_9u_core_access_active" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack space 9U Core Access Passive:</label>
                                <input type="text" name="rack_space_9u_core_access_passive" value="" id="rack_space_9u_core_access_passive" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rack Space 1U -Passive:</label>
                                <input type="text" name="rack_space_1u_passive" value="" id="rack_space_1u_passive" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Crossconnect:</label>
                                <input type="text" name="crossconnect" value="" id="crossconnect" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Technical hands:</label>
                                <input type="text" name="technical_hands" value="" id="technical_hands" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SLA:</label>
                                <input type="text" name="sla" value="" id="sla" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SLA Premium:</label>
                                <input type="text" name="sla_premium" value="" id="sla_premium" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Rate Mbit-S:</label>
                                <select class="form-control" name="rate_mbit_s" id="rate_mbit_s">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_rate_mbit_s as $rate_mbit_s)
                                    <option value="{{ $rate_mbit_s->rate_mbit_s }}">{{ $rate_mbit_s->rate_mbit_s }}</option> 
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
                                     <option value="{{ $strands->strands }}">{{ $strands->strands }}</option>
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
                                <input type="radio" id="llc_received" name="llc_received" value="1" class="form-control">
                                <label for="css">Yes</label><br>
                                </div>
                                <div class="radio-btn">
                                 <input type="radio" id="llc_received" name="llc_received" value="0" class="form-control">
                                 <label for="javascript">No</label>
                                 </div>
                            </div>
                          </div>
                            <div class="col-3">
                            <div class="form-group">
                                <label>Lease term in Months:</label> 
                                <select class="form-control" name="lease_term_in_months" id="lease_term_in_months">
                                     <option value="" selected>Please Select</option>
                                     @foreach($all_lease_term_in_month as $lease_term_in_month)
                                     <option value="{{ $lease_term_in_month->lease_term_in_month }}">{{ $lease_term_in_month->lease_term_in_month }}</option>
                                     @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>KAM Name:</label>
                                <select class="form-control" name="kam_name" id="kam_name">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_kam_name as $kam_name)
                                    <option  value="{{ $kam_name->kam_name }}">{{ $kam_name->kam_name }}</option> 
                                    @endforeach
                                  </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Order Type:</label>
                                <select class="form-control" name="order_type" id="order_type">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_order_name as $order_name)
                                    <option  value="{{ $order_name->order_name }}">{{ $order_name->order_name }}</option> 
                                    @endforeach
                                </select>
                            </div>
                          </div>
                         
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>Feasibility Ref Nr:</label>
                                <input type="text" name="feasibility_ref_nr" value="" id="feasibility_ref_nr" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Penalty Charges:</label>
                                <input type="text" name="penalty_charges" value="" id="penalty_charges" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Cancellation date:</label>
                                <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="cancellation_date" id="cancellation_date" data-target="#custom_date_picker7">
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
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_network_type as $network_type)
                                    <option  value="{{ $network_type->network_type }}">{{ $network_type->network_type }}</option> 
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Special Build NRC:</label>
                                <input type="text" name="special_build_nrc" value="" id="special_build_nrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Return to Sales:</label>
                                <select class="form-control" name="return_to_sales" id="return_to_sales">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_return_to_sale as $return_to_sale)
                                    <option value="{{ $return_to_sale->return_to_sale }}">{{ $return_to_sale->return_to_sale }}</option>                                  
                                    @endforeach
                                </select>
                            </div>
                          </div>                       
                          <div class="col-3">
                            <div class="form-group">
                                <label>Termination Date:</label>
                                <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="termination_date" id="termination_date" data-target="#custom_date_picker6">
                                    <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>3rd Party NRC:</label>
                                <input type="text" name="thrd_party_nrc" value="" id="thrd_party_nrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>3rd Party MRC:</label>
                                <input type="text" name="thrd_party_mrc" value="" id="thrd_party_mrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>3rd Party Provider:</label>
                                <select class="form-control" name="thrd_party_provider" id="thrd_party_provider">
                                    <option value="" selected>Please Select</option>
                                    @foreach($all_thrd_party_provider as $thrd_party_provider)
                                    <option value="{{ $thrd_party_provider->thrd_party_provider }}">{{ $thrd_party_provider->thrd_party_provider }}</option> 
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Sales Comments:</label>
                                <textarea id="sales_comments" name="sales_comments" rows="4" cols="50" class="form-control"></textarea>
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