@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.financial.financial-header')
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
                      <h3 class="card-title">Project Approval Management</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                    @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                        <form action="{{ route('update.financial.detail',$record[0]['circuit_id'])}}" method="POST" enctype="multipart/form-data" id="add_site_master_file_record"> 
                        {{ csrf_field() }} 
                    @else
                      <form method="POST" action="#" enctype="multipart/form-data">
                    @endif
                    <div class="card-body no-scroll-need">
                        <div class="row free-Qwe peth-terd">
                       
                        <!-- Modal -->
                        <div class="col-3">
                            <div class="form-group">
                                <label>Project Status:</label>
                                <input type="text" name="project_status" value="{{ $record[0]['project_status'] }}" id="project_status" class="form-control block-field">
                                <input type="hidden" name="is_regional_manager_email" value="{{ $record[0]['build_record']['is_regional_manager_email'] }}" id="build_status">
                                <input type="hidden" name="is_coo_email" value="{{ $record[0]['build_record']['is_coo_email'] }}" id="build_status">
                                <input type="hidden" name="is_cfo_email" value="{{ $record[0]['build_record']['is_cfo_email'] }}" id="build_status">
                                <input type="hidden" name="region" value="{{ $record[0]['region'] }}" id="region">
                              </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" name="circuit_id" value="{{ $record[0]['circuit_id'] }}" id="circuit_id" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Date Po Order Rx:</label>
                                <input type="text" class="form-control block-field" name="date_po_order_rx"  value="{{ $record[0]['date_po_order_rx'] }}"> 
                               
                            </div>
                          </div>  
                          <div class="col-3">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                <input type="text" class="form-control block-field" name="metro_area"  value="{{ $record[0]['metro_area'] }}">        
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Planning Status:</label>
                                <input type="text" class="form-control block-field" name=""  value="{{ $record[0]['planning_record']['planning_status'] }}">        
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Date New:</label>
                                <input type="text" class="form-control block-field" name=""  value="{{ $record[0]['date_new'] }}">        
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Service Type:</label>
                                <input type="text" name="" value="{{ $record[0]['service_type'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          

                          <div class="col-3">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" name="project_id" value="" id="project_id" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Order Ref No:</label>
                                <input type="text" name="" value="{{ $record[0]['order_ref_number'] }}" id="order_ref_number" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Permission Status:</label>
                                <input type="text" name="" value="{{ $record[0]['permission_record']['permissions_status'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['client_name'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Client Ring:</label>
                                <input type="text" name="" value="{{ $record[0]['client_ring'] }}" id="client_ring" class="form-control block-field">   
           
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Build Status</label>
                                <input type="text" name="" value="{{ $record[0]['build_record']['build_status'] }}" id="build_status" class="form-control block-field">   
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Province:</label>
                                <input type="text" class="form-control block-field" name="" id="province" value="{{ $record[0]['province'] }}">   
            
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Service Manager:</label>
                                <input type="text" name="" value="" id="" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Project Type:</label>
                                <input type="text" name="" value="{{ $record[0]['type'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Service Delivery Status:</label>
                                <input type="text" name="" value="{{ $record[0]['service_delivery_status'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Lease Term:</label>
                                <input type="text" name="" value="{{ $record[0]['lease_term_in_months'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO MRC:</label>
                                <input type="text" name="" value="{{ $record[0]['po_mrc'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO NRC:</label>
                                <input type="text" name="" value="{{ $record[0]['po_nrc'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Financial Status:</label>
                                <input type="text" name="" value="{{ $record[0]['build_record']['financial_status'] }}" id="" class="form-control block-field">
                                <!-- <select name ="financial_status" class="form-control">
                                    <option value="">Please Select</option>
                                    <option value = "A) New Sales" <?php if($record[0]['build_record']['financial_status'] == 'A) New Sales') echo ' selected="selected"'; ?>>A) New Sales</option>
                                    <option value = "B) Submitted for Financial Approval" <?php if($record[0]['build_record']['financial_status'] == 'B) Submitted for Financial Approval') echo ' selected="selected"'; ?>>B) Submitted for Financial Approval</option>
                                    <option value = "C) Project Approved" <?php if($record[0]['build_record']['financial_status'] == 'C) Project Approved') echo ' selected="selected"'; ?>>C) Project Approved</option>
                                    <option value = "D) PO/Picking Slip Request Received from Build" <?php if($record[0]['build_record']['financial_status'] == 'D) PO/Picking Slip Request Received from Build') echo ' selected="selected"'; ?>>D) PO/Picking Slip Request Received from Build</option>
                                    <option value = "E) PO/Picking Slip Released to Build" <?php if($record[0]['build_record']['financial_status'] == 'E) PO/Picking Slip Released to Build') echo ' selected="selected"'; ?>>E) PO/Picking Slip Released to Build</option>
                                    <option value = "F) TOC P2 Recevied" <?php if($record[0]['build_record']['financial_status'] == 'F) TOC P2 Recevied') echo ' selected="selected"'; ?>>F) TOC P2 Recevied</option>
                                    <option value = "G) Billing Commenced" <?php if($record[0]['build_record']['financial_status'] == 'G) Billing Commenced') echo ' selected="selected"'; ?>>G) Billing Commenced</option>
                                    <option value = "H) On Hold" <?php if($record[0]['build_record']['financial_status'] == 'H) On Hold') echo ' selected="selected"'; ?>>H) On Hold</option>
                                    <option value = "I) Return To Sales" <?php if($record[0]['build_record']['financial_status'] == 'I) Return To Sales') echo ' selected="selected"'; ?>>I) Return To Sales</option>
                                    <option value = "J) Cancelled" <?php if($record[0]['build_record']['financial_status'] == 'J) Cancelled') echo ' selected="selected"'; ?>>J) Cancelled</option>
                                    <option value = "K) Terminated" <?php if($record[0]['build_record']['financial_status'] == 'K) Terminated') echo ' selected="selected"'; ?>>K) Terminated</option>
                                    <option value = "L) Sale Data Fix" <?php if($record[0]['build_record']['financial_status'] == 'L) Sale Data Fix') echo ' selected="selected"'; ?>>L) Sale Data Fix</option>
                               </select> -->
                            </div>
                          </div>
                          <div class="col-3">
                          </div>
                          <div class="col-3">
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Special Build NRC:</label>
                                <input type="text" name="" value="{{ $record[0]['special_build_nrc'] }}" id="" class="form-control block-field">
                            </div>
                          </div>
                          </div>
                        <div class="row free-Qwe peth-terd">
                           <div class="col-md-4 inner-peth">
                           </div> 
                           <div class="col-md-4 inner-peth">
                            <a href="{{ url('admin/financial-attachment',$record[0]['circuit_id']) }}"><h2 class="view-doc-fina">View Project Document</a></h2>
                           </div>
                           <div class="col-md-4 inner-peth">
                           </div>
                        </div> 
                        <div class="row free-Qwe">
                           <div class="col-md-4 inner-peth"> 
                           @php
                              //remove R
                              $total_boq_value_isp_a = substr($record[0]['planning_record']['total_boq_value_isp_a'], 2);
                              $total_boq_value_isp_b = substr($record[0]['planning_record']['total_boq_value_isp_b'], 2);
                              $total_boq_value_osp = substr($record[0]['planning_record']['total_boq_value_osp'], 2);

                              $boq_service_cost = $record[0]['planning_record']['labour_cost_isp_a'] + $record[0]['planning_record']['labour_cost_isp_b'] + $record[0]['planning_record']['material_cost_osp'];
                              $boq_material_cost = $record[0]['planning_record']['material_cost_isp_a'] + $record[0]['planning_record']['material_cost_isp_b'] + $record[0]['planning_record']['material_cost_osp'];
                              $boq_total_cost = floatval($total_boq_value_isp_a) + floatval($total_boq_value_isp_b)
                              + floatval($total_boq_value_osp);
                            @endphp  
                    <div class="col-3">
                        <div class="form-group">
                            <label>BOQ Service Cost (R):</label>
                            <input type="text" name="" value="{{ number_format($boq_service_cost, 2) }}" id="" class="form-control block-field">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>BOQ  Materail Cost (R):</label>
                            <input type="text" name="" value="{{ number_format($boq_material_cost, 2) }}" id="" class="form-control block-field">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>BOQ Total Cost (R):</label>
                            <input type="text" name="" value="{{  number_format($boq_total_cost, 2) }}" id="" class="form-control block-field ">
                        </div>
                    </div>
                   
                       
                    </div> 
                      <?php
                      //remove M
                      $isp_a_toatal_distance = str_replace("M", "", $record[0]['planning_record']['isp_a_total_distance']);
                      $isp_b_total_distance = str_replace("M", "", $record[0]['planning_record']['isp_b_total_distance']);
                      $osp_distance_focus = str_replace("M", "", $record[0]['planning_record']['ops_total_distance']);


                        $physical_built_distance = $record[0]['planning_record']['isp_a_distance_trench'] + $record[0]['planning_record']['isp_a_distance_3rd_party_ducts'] + $record[0]['planning_record']['isp_a_la_existing_duct'] +
                        $record[0]['planning_record']['isp_a_distance_focus'] + $record[0]['planning_record']['isp_a_in_buildin_conduits'] + $record[0]['planning_record']['isp_b_distance_trench'] + $record[0]['planning_record']['isp_b_distance_3rd_party_ducts']
                        +  $record[0]['planning_record']['isp_b_la_existing_duct'] + $record[0]['planning_record']['isp_b_distance_focus'] + $record[0]['planning_record']['isp_b_in_buildin_conduits'] + $record[0]['planning_record']['osp_distance_trench'] + 
                        $record[0]['planning_record']['osp_distance_3rd_party_ducts'] + $record[0]['planning_record']['osp_la_existing_duct'] + $record[0]['planning_record']['osp_distance_focus'] + $record[0]['planning_record']['osp_in_buildin_conduits'];
                        
                        //orange field
                        $orange_field = $record[0]['planning_record']['osp_la_existing_network'] + $record[0]['planning_record']['isp_b_la_existing_network']
                                        + $record[0]['planning_record']['isp_a_la_existing_network'];
                        $total_route_distance = ((floatval($isp_a_toatal_distance) + floatval($isp_b_total_distance) +  floatval($osp_distance_focus)) - $orange_field);
                        //echo $osp_distance_focus;exit;
                        $cost_m_service_only = '0';
                        if(!empty($physical_built_distance)  && is_numeric($physical_built_distance)){
                          $cost_m_service_only = $boq_service_cost / $physical_built_distance;
                        }
                        
                        $cost_m_total_project = '0';
                        if(!empty($total_route_distance) && is_numeric($total_route_distance)){
                          $cost_m_total_project = $boq_total_cost /  $total_route_distance;
                        }

                        $new_po_mrc = '0';
                        if(isset($record[0]['po_mrc'])){
                            $po_mrc = $record[0]['po_mrc'];
                            $r_po_mrc = str_replace("R","",$po_mrc);
                            $new_po_mrc = str_replace(",","",$r_po_mrc);          
                        }
                       $year_mrc =  $new_po_mrc  * 12;
//echo $year_mrc;exit;
                       //check year_mrc is not 0
                       $payback_peroid_year = 0;
                       if($year_mrc > 0){
                        $payback_peroid_year = ($boq_total_cost - $record[0]['special_build_nrc']) / $year_mrc;
                       }
                       

                        $payback_period_in_month =  round(($payback_peroid_year * 12),2);

                     ?>
                      
                           <div class="col-md-4 inner-peth">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Physical Built Distance (M):</label>
                                    <input type="text" name="" value="{{ number_format($physical_built_distance, 2) }}" id="" class="form-control block-field">
                                </div>
                                </div>
                                <div class="col-3">
                                <div class="form-group">
                                    <label>Cost/M Service Only (R):</label>
                                    <input type="text" name="" value="{{ number_format($cost_m_service_only, 2) }}" id="" class="form-control block-field">
                                </div>
                                </div>
                                <div class="col-3">
                                <div class="form-group">
                                    <label>Total Route Distance (M):</label>
                                    <input type="text" name="" value="{{  number_format($total_route_distance, 2) }}" id="" class="form-control block-field">
                                </div>
                                </div>
                                <div class="col-3">
                                <div class="form-group">
                                    <label>Cost/M Total Project (R):</label>
                                    <input type="text" name="" value="{{ number_format($cost_m_total_project, 2) }}" id="" class="form-control block-field">
                                </div>
                                </div>
                           </div> 
                           
                           <div class="col-md-4 inner-peth">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Yearly MRC:</label>
                                    <input type="text" name="" value="{{ number_format($year_mrc, 2) }}" id="" class="form-control block-field">
                                </div>
                                </div>
                                <div class="col-3">
                                <div class="form-group">
                                    <label>Payback Period in Years:</label>
                                    <input type="text" name="" value="{{ number_format($payback_peroid_year, 1) }}" id="" class="form-control block-field">
                                </div>
                                </div>
                                <div class="col-3">
                                <div class="form-group">
                                    <label>Payback Period in Month:</label>
                                    <input type="text" name="" value="{{ $payback_period_in_month }}" id="" class="form-control block-field">
                                </div>
                                </div>
                           </div>
                        </div>

                        <div class="row free-Qwe peth-terd">
                           <div class="col-2">
                                <div class="form-group">
                                    <label>Regional Manager Approval:</label>
                                    @php $approve = 'A) Approved'; @endphp
                                    @if($record[0]['build_record']['regional_manager_approval'] == $approve)
                                      <input type="text" class="form-control  block-field" value="{{ $record[0]['build_record']['regional_manager_approval'] }}" name="regional_manager_approval" id="">
                                    @else
                                      <select name ="regional_manager_approval" class="form-control">
                                          <option value="">Please Select</option>
                                          <option value = "A) Approved" <?php if($record[0]['build_record']['regional_manager_approval'] == 'A) Approved') echo ' selected="selected"'; ?>>A) Approved</option>
                                          <option value = "B) Rejected" <?php if($record[0]['build_record']['regional_manager_approval'] == 'B) Rejected') echo ' selected="selected"'; ?>>B) Rejected</option>
                                          <option value = "C) Request Changes" <?php if($record[0]['build_record']['regional_manager_approval'] == 'C) Request Changes') echo ' selected="selected"'; ?>>C) Request Changes</option>
                                      </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Regional Manager Approval Date:</label>
                                    @if($record[0]['build_record']['regional_mang_appr_date'])
                                      <input type="text" class="form-control datetimepicker-input block-field" value="{{ Carbon\Carbon::parse($record[0]['build_record']['regional_mang_appr_date'])->format('m/d/Y'); }}" name="regional_mang_appr_date" id="date_po_order_rx">
                                    @else
                                      <input type="text" class="form-control datetimepicker-input block-field" value="" name="regional_mang_appr_date" id="date_po_order_rx">
                                    @endif                               
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>COO Approval:</label>
                                    @php $approve = 'A) Approved'; @endphp
                                    @if($record[0]['build_record']['coo_approval'] == $approve)
                                    <input type="text" class="form-control  block-field" value="{{ $record[0]['build_record']['coo_approval'] }}" name="coo_approval" id="">
                                    @else
                                    <select name ="coo_approval" class="form-control">
                                        <option value="">Please Select</option>
                                        <option value = "A) Approved" <?php if($record[0]['build_record']['coo_approval'] == 'A) Approved') echo ' selected="selected"'; ?>>A) Approved</option>
                                        <option value = "B) Rejected" <?php if($record[0]['build_record']['coo_approval'] == 'B) Rejected') echo ' selected="selected"'; ?>>B) Rejected</option>
                                        <option value = "C) Request Changes" <?php if($record[0]['build_record']['coo_approval'] == 'C) Request Changes') echo ' selected="selected"'; ?>>C) Request Changes</option>
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>COO Approval Date:</label>
                                    @if($record[0]['build_record']['coo_appr_date'])
                                     <input type="text" class="form-control datetimepicker-input block-field" value="{{ Carbon\Carbon::parse($record[0]['build_record']['coo_appr_date'])->format('m/d/Y'); }}" name="coo_appr_date" id="coo_appr_date">
                                    @else
                                     <input type="text" class="form-control datetimepicker-input block-field" name="coo_appr_date" id="coo_appr_date">
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>CFO Approval:</label>
                                    @php $approve = 'A) Approved'; @endphp
                                    @if($record[0]['build_record']['cfo_approval'] == $approve)
                                      <input type="text" class="form-control  block-field" value="{{ $record[0]['build_record']['cfo_approval'] }}" name="coo_approval" id="">
                                    @else
                                    <select name ="cfo_approval" class="form-control">
                                    <option value="">Please Select</option>
                                        <option value = "A) Approved" <?php if($record[0]['build_record']['cfo_approval'] == 'A) Approved') echo ' selected="selected"'; ?>>A) Approved</option>
                                        <option value = "B) Rejected" <?php if($record[0]['build_record']['cfo_approval'] == 'B) Rejected') echo ' selected="selected"'; ?>>B) Rejected</option>
                                        <option value = "C) Request Changes" <?php if($record[0]['build_record']['cfo_approval'] == 'C) Request Changes') echo ' selected="selected"'; ?>>C) Request Changes</option>
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>CFO Approval Date:</label>
                                  @if($record[0]['build_record']['cfo_appr_date'])   
                                    <input type="text" class="form-control datetimepicker-input block-field" value="{{ Carbon\Carbon::parse($record[0]['build_record']['cfo_appr_date'])->format('m/d/Y'); }}" name="cfo_appr_date" id="cfo_appr_date">
                                  @else
                                  <input type="text" class="form-control datetimepicker-input block-field" name="cfo_appr_date" id="cfo_appr_date">
                                  @endif                                
                                </div>
                            </div>
                         <div class="col-md-4 inner-peth">
                         <div class="col-12">
                            <div class="form-group">
                                <label>Regional Manager Comments:</label>
                                <textarea class="form-control" name="regional_manager_comment" cols="50">{{ $record[0]['build_record']['regional_manager_comment'] }}</textarea>
                            </div>
                         </div>
                         </div>
                         <div class="col-md-4 inner-peth">
                         <div class="col-12">
                            <div class="form-group">
                                <label>COO Comments:</label>
                                <textarea class="form-control" name="coo_manager_comment" cols="50">{{ $record[0]['build_record']['coo_manager_comment'] }}</textarea>
                            </div>
                            </div>
                         </div>
                         <div class="col-md-4 inner-peth">
                         <div class="col-12">
                            <div class="form-group">
                                <label>CFO Comments:</label>
                                <textarea class="form-control" name="cfo_manager_comment" cols="50">{{ $record[0]['build_record']['cfo_manager_comment'] }}</textarea>
                            </div>
                            </div>  
                         </div>
                        </div>    
                          <div class="row free-Qwe" style="width:100%";>
                          <div class="col-md-4 inner-peth">
                          <h2 class="finanicial-heading">PO & Picking Slip / Billing Hand Over</h2>
                         </div>
                         <div class="col-md-5 inner-peth">
                          <div class="col-3">
                         
                          </div>  
                         </div>
                         <div class="col-md-3 inner-peth">
                          <div class="form-group">
                            <div class="upload-icon">
                            <i class="fas fa-upload"></i>
                              <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Upload Attachment
                          </button>
                            </div>
                          </div>  
                         </div>
                          </div>
                          
                      <div class="row" style="margin-bottom:20px;padding: 10px;">
                      <div class="col-md-12 inner-peth">    
                        <div class="table-box-two">
                      <table style="width:100%">
                        <tbody>
                        <tr>
                          <th></th>
                          <th>OSP</th>
                          <th>ISP A</th>
                          <th>ISP B</th>   
                        </tr>
                        <tr>
                          <td>PROJECT LEADER</td>
                          <td><input type="text" name="osp_project_leader" value="{{ $record[0]['build_record']['osp_project_leader'] }}" id="osp_project_leader" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_project_leader" value="{{ $record[0]['build_record']['isp_a_project_leader'] }}" id="isp_a_project_leader" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_project_leader" value="{{ $record[0]['build_record']['isp_b_project_leader'] }}" id="isp_b_project_leader" class="form-control block-field"></td> 
                        </tr>
                        <tr>
                          <td>CIVIL CONTRACTOR</td>
                          <td><input type="text" name="osp_civil_contractor" value="{{ $record[0]['build_record']['osp_civil_contractor'] }}" id="osp_civil_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_civil_contractor" value="{{ $record[0]['build_record']['isp_a_civil_contractor'] }}" id="isp_a_civil_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_civil_contractor" value="{{ $record[0]['build_record']['isp_b_civil_contractor'] }}" id="isp_b_civil_contractor" class="form-control block-field"></td>
                        </tr>
                        <!-- <tr>
                          <td>JETTING CONTRACTOR</td>
                          <td><input type="text" name="osp_jetting_contractor" value="{{ $record[0]['build_record']['osp_jetting_contractor'] }}" id="osp_jetting_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_jetting_contractor" value="{{ $record[0]['build_record']['isp_a_jetting_contractor'] }}" id="isp_a_jetting_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_jetting_contractor" value="{{ $record[0]['build_record']['isp_b_jetting_contractor'] }}" id="isp_b_jetting_contractor" class="form-control block-field"></td>
                        </tr>  -->
                        <tr>
                          <td>RE INSTATEMENT CONTRACTOR</td>
                          <td><input type="text" name="osp_re_instatement_contractor" value="{{ $record[0]['build_record']['osp_re_instatement_contractor'] }}" id="osp_re_instatement_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_re_instatement_contractor" value="{{ $record[0]['build_record']['isp_a_re_instatement_contractor'] }}" id="isp_a_re_instatement_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_re_instatement_contractor" value="{{ $record[0]['build_record']['isp_b_re_instatement_contractor'] }}" id="isp_b_re_instatement_contractor" class="form-control block-field"></td>
                        </tr>
                        <tr>
                          <td>DRILLING CONTRACTOR</td>
                          <td><input type="text" name="osp_drilling_contractor" value="{{ $record[0]['build_record']['osp_drilling_contractor'] }}" id="osp_drilling_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_drilling_contractor" value="{{ $record[0]['build_record']['isp_a_drilling_contractor'] }}" id="isp_a_drilling_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_drilling_contractor" value="{{ $record[0]['build_record']['isp_b_drilling_contractor'] }}" id="isp_b_drilling_contractor" class="form-control block-field"></td>
                        </tr>
                        <tr>
                          <td>FLOATING CONTRACTOR</td>
                          <td><input type="text" name="osp_floating_contractor" value="{{ $record[0]['build_record']['osp_floating_contractor'] }}" id="osp_floating_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_floating_contractor" value="{{ $record[0]['build_record']['isp_a_floating_contractor'] }}" id="isp_a_floating_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_floating_contractor" value="{{ $record[0]['build_record']['isp_b_floating_contractor'] }}" id="isp_b_floating_contractor" class="form-control block-field"></td>
                        </tr>  
<!--                        
                        <tr>
                          <td>FOCUS CONTRACTOR</td>
                          <td><input type="text" name="osp_focus_contractor" value="{{ $record[0]['build_record']['osp_focus_contractor'] }}" id="osp_focus_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_focus_contractor" value="{{ $record[0]['build_record']['isp_a_focus_contractor'] }}" id="isp_a_focus_contractor" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_focus_contractor" value="{{ $record[0]['build_record']['isp_b_focus_contractor'] }}" id="isp_b_focus_contractor" class="form-control block-field"></td>
                        </tr>  -->
                      </tbody>
                      </table>
                      </div>
                      </div>
                      </div>
                          <div class="row secound-Qw">
                           <div class="col-md-4 inner-peth peth-terd">
                           <div class="col-3">
                            <div class="form-group">
                                <label>Site A:</label>
                                <input type="text" name="site_a" value="{{ $record[0]['site_a'] }}" id="site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site A Status:</label>
                                <select class="form-control" name="site_a" id="site_a">
                                    <option value="">Please Select</option>
                                    
                                    @foreach($all_site_a_lists as $site_a)
                                     <option value="{{ $site_a['site_name'] }}" {{ ( $site_a['site_name'] == $record[0]['site_a']) ? 'selected' : '' }}> {{ $site_a['site_name'] }} </option>
                                    @endforeach
                                  
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name - Site A:</label>
                                <input type="text" name="contact_name_site_a" value="{{ $record[0]['contact_name_site_a'] }}" id="contact_name_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site A:</label>
                                <input type="text" name="physical_address_site_a" value="{{ $record[0]['physical_address_site_a'] }}" id="physical_address_site_a" class="form-control block-field">
                            </div>
                          </div>
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site A:</label>
                                <input type="text" name="work_number_site_a" value="{{ $record[0]['work_number_site_a'] }}" id="work_number_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site A:</label>
                                <input type="text" name="mobile_number_site_a" value="{{ $record[0]['mobile_number_site_a'] }}" id="mobile_number_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site A:</label>
                                <input type="text" name="email_address_site_a" value="{{ $record[0]['email_address_site_a'] }}" id="email_address_site_a" class="form-control block-field">
                            </div>
                          </div>
                    
                          </div>
                          
                          
                          <div class="col-md-4 inner-peth peth-terd">  
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO Request Received:</label>
                                @if($record[0]['build_record']['po_requested'])
                                      <input type="text" class="form-control block-field" value="{{ Carbon\Carbon::parse($record[0]['build_record']['po_requested'])->format('m/d/Y'); }}">
                                    @else
                                      <input type="text" class="form-control block-field" value="" name="" id="date_po_order_rx">
                                @endif              
                          </div>
                      </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO Released:</label>
                                <div class="input-group date" id="custom_date_picker22" data-target-input="nearest">
                                @if($record[0]['build_record']['po_released'])
                                      <input type="text" class="form-control datetimepicker-input" value="{{ Carbon\Carbon::parse($record[0]['build_record']['po_released'])->format('m/d/Y'); }}" name="po_released" id="date_po_order_rx" data-target="#custom_date_picker22" data-date-end-date="0d">
                                    @else
                                      <input type="text" class="form-control datetimepicker-input" value="" name="po_released" id="date_po_order_rx" data-target="#custom_date_picker22" data-date-end-date="0d">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker22" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                            </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Picking Slip Request Received:</label>
                                @if($record[0]['build_record']['po_requested'])
                                      <input type="text" class="form-control block-field" value="{{ Carbon\Carbon::parse($record[0]['build_record']['po_requested'])->format('m/d/Y'); }}">
                                    @else
                                      <input type="text" class="form-control block-field" value="" name="" id="date_po_order_rx">
                                @endif       
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Picking Slip Released:</label>
                                 <div class="input-group date" id="custom_date_picker24" data-target-input="nearest">
                                @if($record[0]['build_record']['pick_slip_release'])
                                      <input type="text" class="form-control datetimepicker-input" value="{{ Carbon\Carbon::parse($record[0]['build_record']['pick_slip_release'])->format('m/d/Y'); }}" name="pick_slip_release" id="date_po_order_rx" data-target="#custom_date_picker24" data-date-end-date="0d">
                                    @else
                                      <input type="text" class="form-control datetimepicker-input" value="" name="pick_slip_release" id="date_po_order_rx" data-target="#custom_date_picker24" data-date-end-date="0d">
                                @endif 
                                <div class="input-group-append" data-target="#custom_date_picker24" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                            </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>TOC P2 Received:</label>
                                @if($record[0]['build_record']['toc_received_date_recieved'])
                                      <input type="text" class="form-control block-field" value="{{ Carbon\Carbon::parse($record[0]['build_record']['toc_received_date_recieved'])->format('m/d/Y'); }}">
                                    @else
                                      <input type="text" class="form-control block-field" value="" name="" id="date_po_order_rx">
                                @endif  
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Billing Commenced:</label>
                                <div class="input-group date" id="custom_date_picker26" data-target-input="nearest">
                                @if($record[0]['build_record']['billing_commenced'])
                                      <input type="text" class="form-control datetimepicker-input" value="{{ Carbon\Carbon::parse($record[0]['build_record']['billing_commenced'])->format('m/d/Y'); }}" name="billing_commenced" id="date_po_order_rx" data-target="#custom_date_picker26" data-date-end-date="0d">
                                    @else
                                      <input type="text" class="form-control datetimepicker-input" value="" name="billing_commenced" id="date_po_order_rx" data-target="#custom_date_picker26" data-date-end-date="0d">
                                @endif 
                                <div class="input-group-append" data-target="#custom_date_picker26" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                            </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Billing Stopped:</label>
                                <div class="input-group date" id="custom_date_picker27" data-target-input="nearest">
                                @if($record[0]['build_record']['billing_stopped'])
                                      <input type="text" class="form-control datetimepicker-input" value="{{ Carbon\Carbon::parse($record[0]['build_record']['billing_stopped'])->format('m/d/Y'); }}" name="billing_stopped" id="date_po_order_rx" data-target="#custom_date_picker27" data-date-end-date="0d">
                                    @else
                                      <input type="text" class="form-control datetimepicker-input" value="" name="billing_stopped" id="date_po_order_rx" data-target="#custom_date_picker27" data-date-end-date="0d">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker27" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                            </div> 
                            </div>
                          </div>
                          
                           </div>

                           <div class="col-md-4 inner-peth peth-terd">  
                           <div class="col-3">
                            <div class="form-group">
                                <label>Site B:</label>
                                <input type="text" name="site_b" value="{{ $record[0]['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                          </div>    
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site B Status:</label>
                                <select class="form-control" name="site_b" id="site_b">
                                    <option value="">Please Select</option>
                                  
                                    @foreach($all_site_b_lists as $site_b)
                                    <option value="{{ $site_b['site_name'] }}" {{ ( $site_b['site_name'] == $record[0]['site_b']) ? 'selected' : '' }}> {{ $site_b['site_name'] }} </option>
                                    @endforeach
                             
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name  - Site B:</label>
                                <input type="text" name="contact_name_site_b" value="{{ $record[0]['contact_name_site_b'] }}" id="contact_name_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site B:</label>
                                <input type="text" name="physical_address_site_b" value="{{ $record[0]['physical_address_site_b'] }}" id="physical_address_site_b" class="form-control block-field">
                            </div>
                          </div>
                          
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site B:</label>
                                <input type="text" name="work_number_site_b" value="{{ $record[0]['work_number_site_b'] }}" id="work_number_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site B:</label>
                                <input type="text" name="mobile_number_site_b" value="{{ $record[0]['mobile_number_site_b'] }}" id="mobile_number_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site B:</label>
                                <input type="email" name="email_address_site_b" value="{{ $record[0]['email_address_site_b'] }}" id="email_address_site_b" class="form-control block-field">
                            </div>
                          </div>     
                          </div>
                          </div>
                          <div class="row peth-terd">
                           <div class="col-md-12">
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
                                    <option  value="{{ $network_type->network_type }}" <?php if($record[0]['network_types'] == $network_type->network_type) { echo "selected"; } ?>>{{ $network_type->network_type }}</option> 
                                    @endforeach
                                </select>
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
                                <label>Finance Comments:</label>
                                <textarea id="finance_comment" name="finance_comment" rows="4" cols="50" class="form-control">{{ $record[0]['build_record']['finance_comment'] }}</textarea>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog sale-attachment">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Financial Attachment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form id="upload_attachment_new" action="#" enctype="multipart/form-data">
                                <div class="upload-icon">
                                  <i class="fas fa-upload"></i>
                                  <span>Upload Document</span>
                                  <input type="file" id="filenames" name="filenames[]" multiple>
                                  <input type="hidden" id="service_id" name="service_id" value ="">
                                  <input type="hidden" id="circuit_id" name="circuit_id" value = "">
                                  <input type="hidden" id="page_type" name="sales" value ="financial">
                                  </div>
                                  <div id="selectedFiles"></div>
                                  <label>Select Type</label><br>
                                  <select id="form_type" name="form_type">
                                    <option value ="financial">financial</option>
                                  </select>
                                  <inpput type="text" value="" name="testingggggg" id="testingggggg">
                                  <button type="submit" class="btn btn-primary att-dis">Submit</button>
                                  <div class="success_msg"></div>
                                </form>
                            </div>
                    </div>
            </div>
      </div>

 @endsection
         