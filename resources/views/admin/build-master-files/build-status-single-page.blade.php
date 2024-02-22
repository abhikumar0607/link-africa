@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.build-master-files.build-header')
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
                      <h3 class="card-title">Edit Build Status</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @if(count($record) >= 1)
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']) OR in_array('build', $edit_access['edit_access_type']))
                    <form action="{{ route('admin.build.build.status.update',$record[0]['circuit_id'])}}" method="POST" enctype="multipart/form-data" id="add_site_survey_file_record" class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif
                      <div class="card-body no-scroll-need">
                        <div class="row border-box" style="margin-top:10px; margin-bottom:10px;">
                        <div class="col-4 listing-design-link">
                            <div class="form-group">
                              <h2 style="font-size:18px;font-weight:700;">Uploaded Files:</h2>
                              @if(count($record[0]['attachment_record']) > 0) 
                                @foreach($record[0]['attachment_record'] as $attachment)
                                @if($attachment['page_type'] == 'build')
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
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#build_modal">
                           Upload Attachment
                          </button>
                            </div>

                            </div>
                            </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Project Status:</label>      
                                <input type="text" class="form-control block-field" name="project_status" id="project_status" value="{{ $record[0]['site_master_record']['project_status'] }}">  
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
                                <input type="text" class="form-control block-field" name="circuit_id" id="circuit_id" value="{{ $record[0]['site_master_record']['circuit_id'] }}"> 
                            </div>
                          </div>        
                          <div class="col-3">
                              <div class="form-group">
                                <label>ORDER REF NO:</label>
                                <input type="text" class="form-control block-field" name="order_ref_number" id="order_ref_number" value="{{ ($record[0]['site_master_record']['order_ref_number']) }}"> 
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
                                <label>CLIENT RING:</label>
                                <input type="text" name="client_ring" value="{{ $record[0]['site_master_record']['client_ring'] }}" id="client_ring" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO MRC:</label>
                                <input type="text" name="po_mrc" value="{{ $record[0]['site_master_record']['po_mrc'] }}" id="po_mrc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PLANNING STATUS:</label>
                                <input type="text" name="planning_status" value="{{ $record[0]['planning_record']['planning_status'] }}" id="planning_status" class="form-control block-field">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>DATE PO ORDER RX:</label>
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_master_record']['date_po_order_rx'])->format('m/d/Y') }}" class="form-control datetimepicker-input block-field" name="date_po_order_rx" id="date_po_order_rx">
                                </div>
                            </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>METRO AREA:</label>
                                <input type="text" name="metro_area" value="{{ $record[0]['site_master_record']['metro_area'] }}" id="metro_area" class="form-control block-field">       
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>CLIENT NAME:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['site_master_record']['client_name'] }}" id="client_name" class="form-control block-field"> 
                                </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PO NRC:</label>
                                <input type="text" name="po_nrc" value="{{ $record[0]['site_master_record']['po_nrc'] }}" id="po_nrc" class="form-control">
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
                                <label>PROJECT ID:</label>
                                <input type="text" name="project_id" value="{{ $record[0]['site_master_record']['project_id'] }}" id="project_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                               <label>SERVICE TYPE:</label>                         
                                <input type="text" name="service_type" value="{{ $record[0]['site_master_record']['service_type'] }}" id="service_type" class="form-control block-field">
                             </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                             <label>Project Type:</label>
                                <input type="text" name="type" value="{{ $record[0]['site_master_record']['type'] }}" id="type" class="form-control block-field">
                             </div>
                          </div> 
                         
                         <div class="col-3">
                         </div>
                         </div>  
                         <div class="row">                    
                         <div class="col-3">
                            <div class="form-group">
                                <label>BUILD STATUS:</label>
                                <select class="form-control" name="build_status" id="build_status">
                                @foreach($all_build_status as $build_status)
                                   <option value="{{ $build_status->build_status }}" <?php if($record[0]['build_status'] == $build_status->build_status){ echo 'selected'; } ?>>{{ $build_status->build_status }}</option>
                                @endforeach   
                                  </select>
                            </div>
                          </div> 
                          <div class="col-3">
                           <div class="form-group">
                            <label>BUILD OSP STATUS:</label>
                            <select class="form-control" name="build_osp_status" id="build_osp_status">
                                <option value="" selected="">Please Select</option>
                                @foreach($all_build_osp_status as $build_osp_status)
                                 <option value="{{ $build_osp_status->build_osp_status }}" <?php if($record[0]['build_osp_status'] == $build_osp_status->build_osp_status){ echo 'selected'; } ?>>{{ $build_osp_status->build_osp_status }}</option>
                                @endforeach  
						               </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                            <label>PLANNED WP2 RELEASED DATE:</label>
                                <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planning_record']['planned_wp2_released_date'])->format('m/d/Y') }}" class="form-control block-field" name="planned_wp2_released_date" id="planned_wp2_released_date">
                            </div>
                            </div>
                        <div class="col-3">
                            <div class="form-group">
                            <label>REVISED PLANNED WP2 DATE:</label>
                                <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planning_record']['revised_planned_wp2_date'])->format('m/d/Y') }}" class="form-control block-field" name="revised_planned_wp2_date" id="revised_planned_wp2_date">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                            </div>
                        </div>   
                        <div class="col-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-3">
                         <div class="form-group">
                                <label>Lease term in Months:</label>
                                <input type="text" name="lease_term_in_months" value="{{ $record[0]['site_master_record']['lease_term_in_months'] }}" id="lease_term_in_months" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                            </div>
                        </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Date New:</label>
                                <input type="text" class="form-control block-field" name="" id="" value="{{ Carbon\Carbon::parse($record[0]['site_master_record']['date_new'])->format('m/d/Y'); }}"> 
                            </div>
                          </div>
                    </div>
                          <div class="row border-box">
                           <div class="col-md-6 inner-peth"> 
                           <div class="table-box" style="margin-top:10px;margin-right:10px;">
                          <?php
                           //Cal OSP DISTANCE
                           $osp_distance_trench = $record[0]['planning_record']['osp_distance_trench'] ?? 0;
                           $osp_distance_3rd_party_ducts = $record[0]['planning_record']['osp_distance_3rd_party_ducts'] ?? 0;
                           $osp_la_existing_duct = $record[0]['planning_record']['osp_la_existing_duct'] ?? 0;
                           $osp_la_existing_network = $record[0]['planning_record']['osp_la_existing_network'] ?? 0;
                           $osp_distance_focus = $record[0]['planning_record']['osp_distance_focus'] ?? 0;
                           $osp_in_buildin_conduits = $record[0]['planning_record']['osp_in_buildin_conduits'] ?? 0;

                           $ops_total_distance_total = (int)$osp_distance_trench+(int)$osp_distance_3rd_party_ducts+(int)$osp_la_existing_duct+(int)$osp_la_existing_network+(int)$osp_distance_focus+(int)$osp_in_buildin_conduits;
                           $ops_total_distance = $ops_total_distance_total.' M';

                           //Cal OSP AS BUILD DISTANCE
                            $actual_osp_build_distance_trench = $record[0]['actual_osp_build_distance_trench'] ?? 0;
                            $actual_osp_build_distance_3rd_party_ducts = $record[0]['actual_osp_build_distance_3rd_party_ducts'] ?? 0;
                            $actual_osp_build_la_existing_duct = $record[0]['actual_osp_build_la_existing_duct'] ?? 0;
                            $actual_osp_build_la_existing_network = $record[0]['actual_osp_build_la_existing_network'] ?? 0;
                            $actual_osp_build_distance_focus = $record[0]['actual_osp_build_distance_focus'] ?? 0;
                            $actual_osp_build_in_building_conduits = $record[0]['actual_osp_build_in_building_conduits'] ?? 0;

                            $actual_ops_build_total_distance_total = (int)$actual_osp_build_distance_trench+(int)$actual_osp_build_distance_3rd_party_ducts+(int)$actual_osp_build_la_existing_duct+(int)$actual_osp_build_la_existing_network+(int)$actual_osp_build_distance_focus+(int)$actual_osp_build_in_building_conduits;
                            $actual_ops_build_total_distance = $actual_ops_build_total_distance_total.' M';

                            //Cal ISP A AS BUILD DISTANCE
                            $isp_a_asb_trench = $record[0]['isp_a_asb_trench'] ?? 0;
                            $isp_a_asb_3rd_party_ducts = $record[0]['isp_a_asb_3rd_party_ducts'] ?? 0;
                            $isp_a_asb_la_existing_duct = $record[0]['isp_a_asb_la_existing_duct'] ?? 0;
                            $isp_a_asb_existing_network = $record[0]['isp_a_asb_existing_network'] ?? 0;
                            $isp_a_asb_distance_focus = $record[0]['isp_a_asb_distance_focus'] ?? 0;
                            $isp_a_asb_in_building_conduits = $record[0]['isp_a_asb_in_building_conduits'] ?? 0;

                            $isp_a_total_distance_two_total = (int)$isp_a_asb_trench+(int)$isp_a_asb_3rd_party_ducts+(int)$isp_a_asb_la_existing_duct+(int)$isp_a_asb_existing_network+(int)$isp_a_asb_distance_focus+(int)$isp_a_asb_in_building_conduits;
                            $isp_a_total_distance_two = $isp_a_total_distance_two_total.' M';

                            //Cal ISP B AS BUILD DISTANCE
                            $isp_b_asb_trench = $record[0]['isp_b_asb_trench'] ?? 0;
                            $isp_b_asb_3rd_party_ducts = $record[0]['isp_b_asb_3rd_party_ducts'] ?? 0;
                            $isp_b_asb_la_existing_duct = $record[0]['isp_b_asb_la_existing_duct'] ?? 0;
                            $isp_b_asb_existing_network = $record[0]['isp_b_asb_existing_network'] ?? 0;
                            $isp_b_asb_distance_focus = $record[0]['isp_b_asb_distance_focus'] ?? 0;
                            $isp_b_asb_in_building_conduits = $record[0]['isp_b_asb_in_building_conduits'] ?? 0;

                            $isp_b_total_distance_total = (int)$isp_b_asb_trench+(int)$isp_b_asb_3rd_party_ducts+(int)$isp_b_asb_la_existing_duct+(int)$isp_b_asb_existing_network+(int)$isp_b_asb_distance_focus+(int)$isp_b_asb_in_building_conduits;
                            $isp_b_total_distance = $isp_b_total_distance_total.' M';

                            //Cal Per Build_completion
                            $build_completion = 0;
                            if($record[0]['build_percantage'] == 0){
                            $build_completion_per = 0;
                            } else {
                              $build_completion_per = $record[0]['build_percantage'];
                            }     
                            if($record[0]['build_completion'] >= 1){
                              $build_completion = (int)$record[0]['build_completion'];

                              $new_ops_total_distance = $ops_total_distance;
                              $build_isp_a_total_distance = $record[0]['planning_record']['isp_a_total_distance'] ?? 0;
                              $new_build_isp_a_total_distance = str_replace('M', '', $build_isp_a_total_distance);
                              $build_isp_b_total_distance = $record[0]['planning_record']['isp_b_total_distance'] ?? 0;
                              $new_build_isp_b_total_distance = str_replace('M', '', $build_isp_b_total_distance);
                              

                              $sum_build_completion_per = (int)$new_ops_total_distance+(int)$new_build_isp_a_total_distance+(int)$new_build_isp_b_total_distance;
                              $cal_build_completion_per = $build_completion/$sum_build_completion_per;
                              $is_build_completion_per = round($cal_build_completion_per, 2);
                              if($build_completion_per == "NaN"){
                                $build_completion_per = round($cal_build_completion_per, 2);
                              }
                            }
                            
                        ?>
                      <table>
                        <tbody>
                        <tr>
                          <th></th>
                          <th>OSP DISTANCE</th>
                          <th>OSP AS BUILD DISTANCE</th>
                          <th>ISP A DISTANCE</th>
                          <th>ISP A AS BUILD DISTANCE</th>
                          <th>ISP B DISTANCE</th>
                          <th>ISP B AS BUILD DISTANCE</th>
                        </tr>
                        <tr>
                          <td>DISTANCE TRENCH</td>
                          <td><input type="text" name="osp_distance_trench" value="{{ $record[0]['planning_record']['osp_distance_trench'] }}" id="osp_distance_trench" class="form-control block-field"></td>
                          <td><input type="text" name="actual_osp_build_distance_trench" value="{{ $record[0]['actual_osp_build_distance_trench'] }}" id="actual_osp_build_distance_trench" class="form-control  qty3"></td>
                          <td><input type="text" name="isp_a_distance_trench" value="{{ $record[0]['planning_record']['isp_a_distance_trench'] }}" id="isp_a_distance_trench" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_asb_trench" value="{{ $record[0]['isp_a_asb_trench'] }}" id="isp_a_asb_trench" class="form-control qty1"></td>
                          <td><input type="text" name="isp_b_distance_trench" value="{{ $record[0]['planning_record']['isp_b_distance_trench'] }}" id="isp_b_distance_trench" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_asb_trench" value="{{ $record[0]['isp_b_asb_trench'] }}" id="isp_b_asb_trench" class="form-control qty2"></td>
                        </tr>
                        <tr>
                          <td>DISTANCE-3RD PARTY DUCTS</td>
                          <td><input type="text" name="osp_distance_3rd_party_ducts" value="{{ $record[0]['planning_record']['osp_distance_3rd_party_ducts'] }}" id="osp_distance_3rd_party_ducts" class="form-control block-field"></td>
                          <td><input type="text" name="actual_osp_build_distance_3rd_party_ducts" value="{{ $record[0]['actual_osp_build_distance_3rd_party_ducts'] }}" id="actual_osp_build_distance_3rd_party_ducts" class="form-control qty3"></td>
                          <td><input type="text" name="isp_a_distance_3rd_party_ducts" value="{{ $record[0]['planning_record']['isp_a_distance_3rd_party_ducts'] }}" id="isp_a_distance_3rd_party_ducts" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_asb_3rd_party_ducts" value="{{ $record[0]['isp_a_asb_3rd_party_ducts'] }}" id="isp_a_asb_3rd_party_ducts" class="form-control qty1"></td>
                          <td><input type="text" name="isp_b_distance_3rd_party_ducts" value="{{ $record[0]['planning_record']['isp_b_distance_3rd_party_ducts'] }}" id="isp_b_distance_3rd_party_ducts" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_asb_3rd_party_ducts" value="{{ $record[0]['isp_b_asb_3rd_party_ducts'] }}" id="isp_b_asb_3rd_party_ducts" class="form-control qty2"></td>
                        </tr>
                        <tr>
                          <td>LA EXISTNG DUCT</td>
                          <td><input type="text" name="osp_la_existing_duct" value="{{ $record[0]['planning_record']['osp_la_existing_duct'] }}" id="osp_la_existing_duct" class="form-control block-field"></td>
                          <td><input type="text" name="actual_osp_build_la_existing_duct" value="{{ $record[0]['actual_osp_build_la_existing_duct'] }}" id="actual_osp_build_la_existing_duct" class="form-control qty3"></td>
                          <td><input type="text" name="isp_a_la_existing_duct" value="{{ $record[0]['planning_record']['isp_a_la_existing_duct'] }}" id="isp_a_la_existing_duct" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_asb_la_existing_duct" value="{{ $record[0]['isp_a_asb_la_existing_duct'] }}" id="isp_a_asb_la_existing_duct" class="form-control qty1"></td>
                          <td><input type="text" name="isp_b_la_existing_duct" value="{{ $record[0]['planning_record']['isp_b_la_existing_duct'] }}" id="isp_b_la_existing_duct" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_asb_la_existing_duct" value="{{ $record[0]['isp_b_asb_la_existing_duct'] }}" id="isp_b_asb_la_existing_duct" class="form-control qty2"></td>
                        </tr> 
                        <tr>
                          <td>LA EXISTING NETWORK</td>
                          <td><input type="text" name="osp_la_existing_network" value="{{ $record[0]['planning_record']['osp_la_existing_network'] }}" id="osp_la_existing_network" class="form-control block-field"></td>
                          <td><input type="text" name="actual_osp_build_la_existing_network" value="{{ $record[0]['actual_osp_build_la_existing_network'] }}" id="actual_osp_build_la_existing_network" class="form-control qty3"></td>
                          <td><input type="text" name="isp_a_la_existing_network" value="{{ $record[0]['planning_record']['isp_a_la_existing_network'] }}" id="isp_a_la_existing_network" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_asb_existing_network" value="{{ $record[0]['isp_a_asb_existing_network'] }}" id="isp_a_asb_existing_network" class="form-control qty1"></td>
                          <td><input type="text" name="isp_b_la_existing_network" value="{{ $record[0]['planning_record']['isp_b_la_existing_network'] }}" id="isp_b_la_existing_network" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_asb_existing_network" value="{{ $record[0]['isp_b_asb_existing_network'] }}" id="isp_b_asb_existing_network" class="form-control qty2"></td>
                        </tr>
                        <tr>
                          <td>DISTANCE FOCUS</td>
                          <td><input type="text" name="osp_distance_focus" value="{{ $record[0]['planning_record']['osp_distance_focus'] }}" id="osp_distance_focus" class="form-control  block-field"></td>
                          <td><input type="text" name="actual_osp_build_distance_focus" value="{{ $record[0]['actual_osp_build_distance_focus'] }}" id="actual_osp_build_distance_focus" class="form-control qty3"></td>
                          <td><input type="text" name="isp_a_distance_focus" value="{{ $record[0]['planning_record']['isp_a_distance_focus'] }}" id="isp_a_distance_focus" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_asb_distance_focus" value="{{ $record[0]['isp_a_asb_distance_focus'] }}" id="isp_a_asb_distance_focus" class="form-control qty1"></td>
                          <td><input type="text" name="isp_b_distance_focus" value="{{ $record[0]['planning_record']['isp_b_distance_focus'] }}" id="isp_b_distance_focus" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_asb_distance_focus" value="{{ $record[0]['isp_b_asb_distance_focus'] }}" id="isp_b_asb_distance_focus" class="form-control qty2"></td>
                        </tr>
                        <tr>
                          <td>IN-BUILDIN CONDUITS</td>
                          <td><input type="text" name="osp_in_buildin_conduits" value="{{ $record[0]['planning_record']['osp_in_buildin_conduits'] }}" id="osp_in_buildin_conduits" class="form-control block-field"></td>
                          <td><input type="text" name="actual_osp_build_in_building_conduits" value="{{ $record[0]['actual_osp_build_in_building_conduits'] }}" id="actual_osp_build_in_building_conduits" class="form-control qty3"></td>
                          <td><input type="text" name="isp_a_in_buildin_conduits" value="{{ $record[0]['planning_record']['isp_a_in_buildin_conduits'] }}" id="isp_a_in_buildin_conduits" class="form-control block-field"></td>
                          <td><input type="text" name="isp_a_asb_in_building_conduits" value="{{ $record[0]['isp_a_asb_in_building_conduits'] }}" id="isp_a_asb_in_building_conduits" class="form-control qty1"></td>
                          <td><input type="text" name="isp_b_in_buildin_conduits" value="{{ $record[0]['planning_record']['isp_b_in_buildin_conduits'] }}" id="isp_b_in_buildin_conduits" class="form-control block-field"></td>
                          <td><input type="text" name="isp_b_asb_in_building_conduits" value="{{ $record[0]['isp_b_asb_in_building_conduits'] }}" id="isp_b_asb_in_building_conduits" class="form-control qty2"></td>
                        </tr>  
                       
                        </tbody><tfoot>
                          <tr>
                          <td>Total</td>
                          <td><input type="text" name="ops_total_distance" value="{{ $ops_total_distance; }}" id="ops_total_distance" class="form-control block-field  block-field"></td>
                          <td><input type="text" name="actual_ops_build_total_distance" value="{{ $actual_ops_build_total_distance; }}" id="actual_ops_build_total_distance" class="form-control block-field total3"></td>
                          <td><input type="text" name="isp_a_total_distance" value="{{ $record[0]['planning_record']['isp_a_total_distance'] }}" id="isp_a_total_distance" class="form-control block-field block-field"></td>
                          <td><input type="text" name="isp_a_total_distance_two" value="{{ $isp_a_total_distance_two; }}" id="isp_a_total_distance_two" class="form-control block-field total"></td>
                          <td><input type="text" name="isp_b_total_distance" value="{{ $record[0]['planning_record']['isp_b_total_distance'] }}" id="isp_b_total_distance" class="form-control block-field block-field"></td>
                          <td><input type="text" name="isp_b_total_distance2" value="{{ $isp_b_total_distance; }}" id="isp_b_total_distance2" class="form-control block-field total2"></td>
                          </tr>
                      </tfoot>
                      </table>
                      </div>
           
                          </div>
                          <div class="col-md-3 inner-peth">  
                            <div class="border-box" style="margin-top:10px;">                       
                          <div class="col-3">
                            <div class="form-group">
                                <label>PLANNING OSP STATUS:</label>                                
                                <input type="text" name="osp_status_panning" value="{{ $record[0]['planning_record']['osp_status_panning'] }}" id="osp_status_panning" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PLANNING WP2 WL SUBMISSION:</label>                                
                                <input type="text" name="planning_wp2_wl_submission" value="{{ $record[0]['planning_record']['planning_wp2_wl_submission'] }}" id="planning_wp2_wl_submission" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WAYLEAVES STATUS:</label>
                                <input type="text" name="wayleaves_status" value="{{ $record[0]['permission_record']['wayleaves_status'] }}" id="wayleaves_status" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>WAYLEAVES RECEIVED:</label>
                                <input type="text" name="wayleaves_received" value="{{ $record[0]['permission_record']['wayleaves_received'] }}" id="wayleaves_received" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A:</label>
                                <input type="text" name="site_a" value="{{ $record[0]['site_master_record']['site_a'] }}" id="site_a" class="form-control block-field">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>SITE A STATUS:</label>                              
                                <select class="form-control" name="site_a_status" id="site_a_status">
                                <option value="">please Select</option>
                                @foreach($all_site_status as $site_status)
                                 <option value="{{ $site_status->site_status }}" <?php if($record[0]['planning_record']['site_a_status'] == $site_status->site_status) { echo "selected"; } ?>>{{ $site_status->site_status }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A ID:</label>
                                <input type="text" name="site_a_id" value="{{ $record[0]['planning_record']['site_a_id'] }}" id="site_a_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>SITE B:</label>                                
                                <input type="text" name="site_b" value="{{ $record[0]['site_master_record']['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B STATUS:</label>                               
                                <select class="form-control" name="site_b_status" id="site_b_status">                                  
                                <option value="">please Select</option>
                                @foreach($all_site_status as $site_status)
                                 <option value="{{ $site_status->site_status }}" <?php if($record[0]['planning_record']['site_b_status'] == $site_status->site_status) { echo "selected"; } ?>>{{ $site_status->site_status }}</option>
                                @endforeach
                             </select>                                     
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE B ID:</label>
                                <input type="text" name="site_b_id" value="{{ $record[0]['planning_record']['site_b_id'] }}" id="site_b_id" class="form-control">
                            </div>
                        </div> 
                        
                        <div class="col-3">
                            <div class="form-group">
                                <label>PLANNED BUILD COMPLETION DATE:</label>
                                <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                @if($record[0]['planned_build_completion_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planned_build_completion_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planned_build_completion_date" id="planned_build_completion_date" data-target="#custom_date_picker7">
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
                     </div>

                          <div class="col-md-3 inner-peth">                         
                       <div class="border-box" style="margin-top:10px;">
                           <div class="col-3">
                            <div class="form-group">
                                <label>Bandwidth</label>
                                <input type="text" name="" value="{{ $record[0]['site_master_record']['rate_mbit_s'] }}" id="" class="form-control">
                            </div>
                          </div>
                            <!--<div class="col-3">
                            <div class="form-group">
                                <label>BUILD COMPLETION:</label>
                                <input type="text" name="build_completion" value="{{ $build_completion; }}" id="build_completion" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>BUILD % COMPLETED:</label>
                                <input type="text" name="build_completion_per" value="{{ $build_completion_per; }}" id="build_completion_per" class="form-control block-field">
                            </div> 
                           </div> -->   
                          </div>
                          <div class="border-box">
                          <div class="col-3">
                        <div class="form-group">
                            <label>PO REQUESTED:</label>
                            <div class="input-group date" id="custom_date_picker51" data-target-input="nearest">
                                @if($record[0]['po_requested'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['po_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="po_requested" id="po_requested" data-target="#custom_date_picker51">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="po_requested" id="po_requested" data-target="#custom_date_picker51">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker51" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>PO RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker8" data-target-input="nearest">
                                @if($record[0]['po_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['po_received'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="po_received" id="po_received" data-target="#cuom_date_picker8">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="po_received" id="po_received" data-target="#custom_date_picker8">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker8" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                            <div class="form-group">
                                <label>STANDARD BUILD DURATION:</label>
                                <input type="text" name="" value="{{ $standard_build_duration }}" id="" class="form-control block-field">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>BUILD DURATION:</label>
                                <input type="text" name="build_duration" value="{{ $record[0]['build_duration'] }}" id="build_duration" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                              <div class="form-group">
                                <label>PLANNED START DATE:</label>
                                
                                <input type="text" value="{{ $planned_start_date }}" class="form-control block-field" name="planned_start_date" id="planned_start_date">
                                    
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>EST.COMPLETION DATE:</label>
                                <input type="text" name="" value="{{ $est_complition_date }}" id="" class="form-control block-field">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>REVISED START DATE:</label>
                                <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                                    @if($record[0]['revised_build_start_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_build_start_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="revised_build_start_date" id="revised_build_start_date" data-target="#custom_date_picker3">
                                    @else
                                         <input type="text" value="" class="form-control datetimepicker-input" name="revised_build_start_date" id="revised_build_start_date" data-target="#custom_date_picker3">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-3">
                        <div class="form-group">
                            <label>REVISED BUILD COMPLETION DATE:</label>
                                    <input type="text" value="{{ $revised_build_completion_date }}" class="form-control block-field" name="revised_build_co_date" id="revised_build_co_date">
                        </div>
                      </div>
                      <div class="col-3">
                            <div class="form-group">
                                <label>COMPLETION DATE:</label>
                                <div class="input-group date" id="custom_date_picker65" data-target-input="nearest">
                                    @if($record[0]['actual_build_completion_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['actual_build_completion_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="actual_build_completion_date" id="actual_build_completion_date" data-target="#custom_date_picker65">
                                    @else
                                         <input type="text" value="" class="form-control datetimepicker-input" name="actual_build_completion_date" id="actual_build_completion_date" data-target="#custom_date_picker65">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker65" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                               
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin:0px">
                      <div class="col-md-6 inner-peth">    
                        <div class="table-box-two">
                      <table>
                        <tbody>
                        <tr>
                          <th></th>
                          <th>OSP</th>
                          <th>ISP A</th>
                          <th>ISP B</th>   
                        </tr>
                        <tr>
                          <td>PROJECT LEADER</td>
                          <td><input type="text" name="osp_project_leader" value="{{ $record[0]['osp_project_leader'] }}" id="osp_project_leader" class="form-control"></td>
                          <td><input type="text" name="isp_a_project_leader" value="{{ $record[0]['isp_a_project_leader'] }}" id="isp_a_project_leader" class="form-control"></td>
                          <td><input type="text" name="isp_b_project_leader" value="{{ $record[0]['isp_b_project_leader'] }}" id="isp_b_project_leader" class="form-control"></td> 
                        </tr>
                        <tr>
                          <td>CIVIL CONTRACTOR</td>
                          <td><input type="text" name="osp_civil_contractor" value="{{ $record[0]['osp_civil_contractor'] }}" id="osp_civil_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_a_civil_contractor" value="{{ $record[0]['isp_a_civil_contractor'] }}" id="isp_a_civil_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_b_civil_contractor" value="{{ $record[0]['isp_b_civil_contractor'] }}" id="isp_b_civil_contractor" class="form-control"></td>
                        </tr>
                        <!-- <tr>
                          <td>JETTING CONTRACTOR</td>
                          <td><input type="text" name="osp_jetting_contractor" value="{{ $record[0]['osp_jetting_contractor'] }}" id="osp_jetting_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_a_jetting_contractor" value="{{ $record[0]['isp_a_jetting_contractor'] }}" id="isp_a_jetting_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_b_jetting_contractor" value="{{ $record[0]['isp_b_jetting_contractor'] }}" id="isp_b_jetting_contractor" class="form-control"></td>
                        </tr>  -->
                        <tr>
                          <td>RE INSTATEMENT CONTRACTOR</td>
                          <td><input type="text" name="osp_re_instatement_contractor" value="{{ $record[0]['osp_re_instatement_contractor'] }}" id="osp_re_instatement_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_a_re_instatement_contractor" value="{{ $record[0]['isp_a_re_instatement_contractor'] }}" id="isp_a_re_instatement_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_b_re_instatement_contractor" value="{{ $record[0]['isp_b_re_instatement_contractor'] }}" id="isp_b_re_instatement_contractor" class="form-control"></td>
                        </tr>
                        <tr>
                          <td>DRILLING CONTRACTOR</td>
                          <td><input type="text" name="osp_drilling_contractor" value="{{ $record[0]['osp_drilling_contractor'] }}" id="osp_drilling_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_a_drilling_contractor" value="{{ $record[0]['isp_a_drilling_contractor'] }}" id="isp_a_drilling_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_b_drilling_contractor" value="{{ $record[0]['isp_b_drilling_contractor'] }}" id="isp_b_drilling_contractor" class="form-control"></td>
                        </tr>
                        <tr>
                          <td>FLOATING CONTRACTOR</td>
                          <td><input type="text" name="osp_floating_contractor" value="{{ $record[0]['osp_floating_contractor'] }}" id="osp_floating_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_a_floating_contractor" value="{{ $record[0]['isp_a_floating_contractor'] }}" id="isp_a_floating_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_b_floating_contractor" value="{{ $record[0]['isp_b_floating_contractor'] }}" id="isp_b_floating_contractor" class="form-control"></td>
                        </tr>  
                       
                        <!-- <tr>
                          <td>FOCUS CONTRACTOR</td>
                          <td><input type="text" name="osp_focus_contractor" value="{{ $record[0]['osp_focus_contractor'] }}" id="osp_focus_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_a_focus_contractor" value="{{ $record[0]['isp_a_focus_contractor'] }}" id="isp_a_focus_contractor" class="form-control"></td>
                          <td><input type="text" name="isp_b_focus_contractor" value="{{ $record[0]['isp_b_focus_contractor'] }}" id="isp_b_focus_contractor" class="form-control"></td>
                        </tr>  -->
                      </tbody>
                      </table>
                      </div>
                   
                    </div>
                    <div class="col-md-3 inner-peth">
                    <div class="col-3">
                            <div class="form-group">
                                <label>FEASIBILITY REF Nr:</label>
                                <input type="text" name="feasibility_ref_nr" value="{{ $record[0]['site_master_record']['feasibility_ref_nr'] }}" id="feasibility_ref_nr" class="form-control block-field">
                            </div>
                    </div>
                    <div class="col-3">
                            <div class="form-group">
                                <label>NETWORK TYPE:</label>
                              <input type="text" name="network_type" value="{{ $record[0]['site_master_record']['network_types'] }}" id="network_type" class="form-control block-field">
                            </div>
                    </div>
                    <div class="border-box">
                        <h2>SPLICING</h2>
                        <div class="col-3">
                            <div class="form-group">
                                <label>SPLICING TEAM:</label>
                              <select class="form-control" name="splicing_team" id="splicing_team">
                                <option value="">Please Select</option>
                                <option value="INTERNAL" <?php if($record[0]['splicing_team'] == 'INTERNAL'){ echo 'Selected';}?>>INTERNAL</option>
                                <option value="EXTERNAL"<?php if($record[0]['splicing_team'] == 'EXTERNAL'){ echo 'Selected';}?>>EXTERNAL</option>
                                
                                </select>
                            </div>
                    </div> 
                    <div class="col-3">
                              <div class="form-group">
                                <label>NAME:</label>
                                <input type="text" name="name" value="{{ $record[0]['name'] }}" id="name" class="form-control">
                            </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>TOC SUBMITTED:</label>
                            <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                @if($record[0]['toc_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['toc_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="toc_submitted" id="toc_submitted" data-target="#cuom_date_picker5">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="toc_submitted" id="toc_submitted" data-target="#custom_date_picker5">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>TOC RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                @if($record[0]['toc_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['toc_received'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="toc_received" id="toc_received" data-target="#cuom_date_picker6">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="toc_received" id="toc_received" data-target="#custom_date_picker6">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div> 
                    </div>
                    </div>
                    <div class="col-md-3 inner-peth">
                        <div class="border-box">
                        <div class="col-3">
                        <div class="form-group">
                            <label>OSP ASBUILD SUBMISSION:</label>
                            <div class="input-group date" id="custom_date_picker50" data-target-input="nearest">
                                @if($record[0]['osp_asbuild_submission'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['osp_asbuild_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="osp_asbuild_submission" id="osp_asbuild_submission" data-target="#cuom_date_picker50">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="osp_asbuild_submission" id="osp_asbuild_submission" data-target="#custom_date_picker50">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker50" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>ISP ASBUILD SUBMISSION:</label>
                            <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                @if($record[0]['isp_asbuild_submission'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_asbuild_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_asbuild_submission" id="isp_asbuild_submission" data-target="#custom_date_picker11">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_asbuild_submission" id="isp_asbuild_submission" data-target="#custom_date_picker11">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>OSP ASBUILD SUBMISSION:</label>
                            <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                @if($record[0]['osp_asbuild_submission'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['osp_asbuild_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="osp_asbuild_submission" id="osp_asbuild_submission" data-target="#cuom_date_picker10">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="osp_asbuild_submission" id="osp_asbuild_submission" data-target="#custom_date_picker10">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        </div>
                        <div class="col-3">
                              <div class="form-group">
                                <label>OTDR DISTANCE:</label>
                                <input type="text" name="otdr_distance" value="{{ $record[0]['otdr_distance'] }}" id="otdr_distance" class="form-control">
                            </div>
                    </div>
                    <div class="border-box">
                    <div class="col-3">
                              <div class="form-group">
                                <label>QA REQUESTED:</label>
                                <div class="input-group date" id="custom_date_picker64" data-target-input="nearest">
                                    @if($record[0]['qa_requested'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['qa_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="qa_requested" id="qa_requested" data-target="#custom_date_picker64">
                                    @else
                                         <input type="text" value="" class="form-control datetimepicker-input" name="qa_requested" id="qa_requested" data-target="#custom_date_picker64">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker64" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                    <div class="col-3">
                                <div class="form-group">
                                <label>FINAL SECTIONAL:</label>
                                <div class="input-group date" id="custom_date_picker66" data-target-input="nearest">
                                    @if($record[0]['final_sectional_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['final_sectional_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="final_sectional_date" id="final_sectional_date" data-target="#custom_date_picker66">
                                    @else
                                         <input type="text" value="" class="form-control datetimepicker-input" name="final_sectional_date" id="final_sectional_date" data-target="#custom_date_picker66">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker66" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
  
                            </div>
                   </div>
                    <div class="col-3">
                              <div class="form-group">
                                <label>OTOC RECEIVED:</label>
                                <div class="input-group date" id="custom_date_picker67" data-target-input="nearest">
                                    @if($record[0]['otoc'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['otoc'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="otoc" id="otoc" data-target="#custom_date_picker67">
                                    @else
                                         <input type="text" value="" class="form-control datetimepicker-input" name="otoc" id="otoc" data-target="#custom_date_picker67">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker67" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                              </div>
                    </div> 
                    </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"> 
                        <div class="form-group">                      
                            <label for="w3review">Comment:</label>
                     <textarea id="w3review1" name="comments" cols="120" style="width:100%; height:300px;">{{ $record[0]['comments'] }}</textarea>
                           </div>
                          </div>
                       <div class="col-md-6">
                       <div class="form-group">
                                <label>LINK DEPENDENCY:</label>                              
                                <input type="text" name="link_dependency" value="{{ $record[0]['planning_record']['link_dependency'] }}" id="link_dependency" class="form-control">                        
                            </div>
                       </div>
                    </div>
                    <!---new fields-->
                    <div class="row secound-Qw" style="margin-top:10px;">
                           <div class="col-md-4 inner-peth peth-terd">
                           <!-- <div class="col-3">
                            <div class="form-group">
                                <label>Qty:</label>
                                <input type="text" name="qty" value="{{ $record[0]['site_master_record']['qty'] }}" id="estimated_enterprise_usage" class="form-control">
                            </div>
                           </div> -->

                           <div class="col-3">
                            <div class="form-group">
                                <label>Year:</label>
                                <select class="form-control" name="year" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     @foreach($year as $status)
                                      <option value="{{ $status->name }}" <?php if($record[0]['site_master_record']['year'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
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
                                   <option value="{{ $status->name }}" <?php if($record[0]['site_master_record']['sd_status'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
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
                                      <option value="{{ $status->name }}" <?php if($record[0]['site_master_record']['week'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
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
                                      <option value="{{ $status->name }}" <?php if($record[0]['site_master_record']['resources'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach
                                </select>     
                            </div>
                           </div>
                           <div class="col-3">
                            <div class="form-group">
                                <label>Comments:</label>
                                <select class="form-control" name="build_comments" id="service_delivery_status">
                                     <option value="" selected>Please Select</option>
                                     @foreach($add_comment as $status)
                                      <option value="{{ $status->name }}" <?php if($record[0]['site_master_record']['comments'] == $status->name){ echo 'selected'; } ?>>{{ $status->name }}</option>
                                     @endforeach
                                </select>     
                            </div>
                           </div>
                           </div>
                          </div>
                    </div>
                   
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('build', $edit_access['edit_access_type']))
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
   <div class="modal fade" id="build_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog sale-attachment">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Build Attachment</h5>
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
                                  <input type="hidden" id="page_type" name="sales" value ="build">
                                  </div>
                                  <div id="selectedFiles"></div>
                                  <label>Select Type</label><br>
                                  <select class="form-control" id="form_type" name="form_type">
                                    <option value ="">Please Select</option>
                                    <option value ="Final BOQ's">Final BOQ's</option>
                                    <option value ="TOC">TOC</option>
                                    <option value ="As Build">As Build</option>
                                    <option value ="VO's QC Tick sheets">VO's QC Tick sheets</option>
                                    <option value ="Final Sectionals">Final Sectionals</option>
                                    <option value ="OTOC">OTOC</option>
                                    <option value ="AS BUilt Map ISP Site">AS BUilt Map ISP Site</option>
                                    <option value ="Instructions">Instructions</option>
                                    <option value ="As Built Map ISP Site">As Built Map ISP Site</option>
                                    <option value ="Instructions">VO's QC Tick sheets</option>
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