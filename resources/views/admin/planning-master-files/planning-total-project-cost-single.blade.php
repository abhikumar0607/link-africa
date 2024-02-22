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
                      <h3 class="card-title">Edit Total Project Cost</h3>
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
                    <form action="{{ route('admin.planning.total.cost.update',$record[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_survey_file_record" class="edit_site_master_file_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif

                  
                      <div class="card-body no-scroll-need">
                        <div class="row border-box" style="margin-top:10px; margin-bottom:10px;">
                          <div class="col-4">
                            <div class="form-group">
                                <label>Project Status:</label>
                                <input type="text" class="form-control block-field" name="project_status" id="project_status" value="{{ $record[0]['site_master_record']['project_status'] }}"> 
                            </div>
                          </div> 
                          <div class="col-4">
                              <div class="form-group">
                                <label>Date New:</label>
                                <input type="text" class="form-control block-field" name="" id="" value="{{ Carbon\Carbon::parse($record[0]['site_master_record']['date_new'])->format('m/d/Y'); }}"> 
                            </div>
                          </div>                        
                          <div class="col-4">
                              <div class="form-group">
                                <label>Service ID:</label>
                                <input type="text" class="form-control" name="service_id" id="service_id" value="{{ $record[0]['site_master_record']['service_id'] }}"> 
                            </div>
                          </div>                        
                          <div class="col-4">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                <input type="text" class="form-control block-field" name="metro_area" id="metro_area" value="{{ $record[0]['site_master_record']['metro_area'] }}">    
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                            <label>PLANNED WP2 RELEASED DATE:</label>
                                <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planned_wp2_released_date'])->format('m/d/Y') }}" class="form-control block-field" name="planned_wp2_released_date" id="planned_wp2_released_date"> 
                                </div>
                                </div>                    
                            <div class="col-4">
                                <div class="form-group">
                                <label>PLANNING STATUS:</label>
                                <input type="text" class="form-control block-field" name="planning_status" id="planning_status" value="{{ $record[0]['planning_status'] }}">        
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                             <label>Site A:</label>
                                <input type="text" name="site_a" value="{{ $record[0]['site_master_record']['site_a'] }}" id="site_a" class="form-control block-field">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                             <label>Site B:</label>
                                <input type="text" name="site_b" value="{{ $record[0]['site_master_record']['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                            <label>REVISED PLANNED WP2 DATE:</label>
                            <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                            @if($record[0]['revised_planned_wp2_date'])
                                <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_planned_wp2_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input  block-field" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                                @else
                                <input type="text" value="" class="form-control datetimepicker-input  block-field" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                            @endif
                            <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            </div>
                      </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Client Name:</label>
                            <input type="text" name="client_name" value="{{ $record[0]['site_master_record']['client_name'] }}" id="client_name" class="form-control block-field">
                            </div>
                          </div>       
                          <div class="col-4">
                         <div class="form-group">
                           <label>SITE A ID:</label>
                           <input type="text" name="site_a_id" value="{{ $record[0]['site_a_id'] }}" id="site_a_id" class="form-control">
                           </div>
                       </div>
                       <div class="col-4">
                       <div class="form-group">
                            <label>SITE B ID:</label>
                            <input type="text" name="site_b_id" value="{{ $record[0]['site_b_id'] }}" id="site_b_id" class="form-control">
                         </div>
                       </div>
                       <div class="col-4">
                         <div class="form-group">
                        <label>OSP PLANNERS:</label>                   
                        <select class="form-control" name="osp_planners" id="osp_planners">
                          <option value="">please select</option>
                          @foreach($all_osp_planners as $osp_planners)
                          <option value="{{ $osp_planners->osp_planners }}" <?php if($record[0]['osp_planners'] == $osp_planners->osp_planners){ echo "selected";}?>>{{ $osp_planners->osp_planners }}</option>
                          @endforeach
                        </select>
                      </div>
                       </div>                          
                          </div>
                          <div class="row secound-Qw border-box">
                           <div class="col-md-4 inner-peth">                                
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A DISTANCE - TRENCH:</label>
                                    <input type="text" name="isp_a_distance_trench" value="{{ $record[0]['isp_a_distance_trench'] }}" id="isp_a_distance_trench" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A DISTANCE - 3RD PARTY DUCTS:</label>
                                    <input type="text" name="isp_a_distance_3rd_party_ducts" value="{{ $record[0]['isp_a_distance_3rd_party_ducts'] }}" id="isp_a_distance_3rd_party_ducts" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A LA EXISTING DUCT:</label>
                                    <input type="text" name="isp_a_la_existing_duct" value="{{ $record[0]['isp_a_la_existing_duct'] }}" id="isp_a_la_existing_duct" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A LA EXISTING NETWORK:</label>
                                    <input type="text" name="isp_a_la_existing_network" value="{{ $record[0]['isp_a_la_existing_network'] }}" id="isp_a_la_existing_network" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A DISTANCE - FOCUS:</label>
                                    <input type="text" name="isp_a_distance_focus" value="{{ $record[0]['isp_a_distance_focus'] }}" id="isp_a_distance_focus" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A in - BUILDIN CONDUITS:</label>
                                    <input type="text" name="isp_a_in_buildin_conduits" value="{{ $record[0]['isp_a_in_buildin_conduits'] }}" id="isp_a_in_buildin_conduits" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A TOTAL DISTANCE:</label>
                                    <input type="text" name="isp_a_total_distance" value="{{ $record[0]['isp_a_total_distance'] }}" id="isp_a_total_distance" class="form-control block-field total">
                                </div>
                            </div>
                          </div>
                          <div class="col-md-4 inner-peth">                                      
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP B DISTANCE - TRENCH:</label>
                                    <input type="text" name="isp_b_distance_trench" value="{{ $record[0]['isp_b_distance_trench'] }}" id="isp_b_distance_trench" class="form-control qty2">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP B DISTANCE - 3RD PARTY DUCTS:</label>
                                    <input type="text" name="isp_b_distance_3rd_party_ducts" value="{{ $record[0]['isp_b_distance_3rd_party_ducts'] }}" id="isp_b_distance_3rd_party_ducts" class="form-control qty2">
                                </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label>ISP B LA EXISTING DUCT:</label>
                                <input type="text" name="isp_b_la_existing_duct" value="{{ $record[0]['isp_b_la_existing_duct'] }}" id="isp_b_la_existing_duct" class="form-control qty2">
                              </div>
                           </div>
                            <div class="col-3">
                            <div class="form-group">
                                <label>ISP B LA EXISTING NETWORK:</label>
                                <input type="text" name="isp_b_la_existing_network" value="{{ $record[0]['isp_b_la_existing_network'] }}" id="isp_b_la_existing_network" class="form-control qty2">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>ISP B DISTANCE - FOCUS:</label>
                                <input type="text" name="isp_b_distance_focus" value="{{ $record[0]['isp_b_distance_focus'] }}" id="isp_b_distance_focus" class="form-control qty2">
                            </div>
                        </div>
                        <div class="col-3">
                                <div class="form-group">
                                    <label>ISP B in - BUILDIN CONDUITS:</label>
                                    <input type="text" name="isp_b_in_buildin_conduits" value="{{ $record[0]['isp_b_in_buildin_conduits'] }}" id="isp_b_in_buildin_conduits" class="form-control qty2">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP B TOTAL DISTANCE:</label>
                                    <input type="text" name="isp_b_total_distance" value="{{ $record[0]['isp_b_total_distance'] }}" id="isp_b_total_distance" class="form-control block-field total2">
                                </div>
                            </div>
                          
                                                               
                          </div>  
                          <div class="col-md-4 inner-peth">                                              
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP DISTANCE - TRENCH:</label>
                                <input type="text" name="osp_distance_trench" value="{{ $record[0]['osp_distance_trench'] }}" id="osp_distance_trench" class="form-control qty3">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP DISTANCE - 3RD PARTY DUCTS:</label>
                                <input type="text" name="osp_distance_3rd_party_ducts" value="{{ $record[0]['osp_distance_3rd_party_ducts'] }}" id="osp_distance_3rd_party_ducts" class="form-control qty3">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP LA EXISTING DUCT:</label>
                                <input type="text" name="osp_la_existing_duct" value="{{ $record[0]['osp_la_existing_duct'] }}" id="osp_la_existing_duct" class="form-control qty3">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP LA EXISTING NETWORK:</label>
                                <input type="text" name="osp_la_existing_network" value="{{ $record[0]['osp_la_existing_network'] }}" id="osp_la_existing_network" class="form-control qty3">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP DISTANCE - FOCUS:</label>
                                <input type="text" name="osp_distance_focus" value="{{ $record[0]['osp_distance_focus'] }}" id="osp_distance_focus" class="form-control qty3">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP in - BUILDIN CONDUITS:</label>
                                <input type="text" name="osp_in_buildin_conduits" value="{{ $record[0]['osp_in_buildin_conduits'] }}" id="osp_in_buildin_conduits" class="form-control qty3">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>OPS TOTAL DISTANCE:</label>
                                <input type="text" name="ops_total_distance" value="{{ $record[0]['ops_total_distance'] }}" id="ops_total_distance" class="form-control block-field total3">
                            </div>
                        </div>    
                       
                      </div>
                     </div>
                    <div class="row border-box">
                     <div class="col-md-3 inner-peth">    
                    <div class="col-3">
                        <div class="form-group">
                            <label>Labour Cost ISP A:</label>
                            <input type="text" name="labour_cost_isp_a" value="{{ $record[0]['labour_cost_isp_a'] }}" id="labour_cost_isp_a" class="form-control qty4">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost ISP A:</label>
                            <input type="text" name="material_cost_isp_a" value="{{ $record[0]['material_cost_isp_a'] }}" id="material_cost_isp_a" class="form-control qty4">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value ISP A:</label>
                            <input type="text" name="total_boq_value_isp_a" value="{{ $record[0]['total_boq_value_isp_a'] }}" id="total_boq_value_isp_a" class="form-control block-field total4">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Labour Cost OSP:</label>
                            <input type="text" name="labour_cost_osp" value="{{ $record[0]['labour_cost_osp'] }}" id="labour_cost_osp" class="form-control qty5">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost OSP:</label>
                            <input type="text" name="material_cost_osp" value="{{ $record[0]['material_cost_osp'] }}" id="material_cost_osp" class="form-control qty5">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value OSP:</label>
                            <input type="text" name="total_boq_value_osp" value="{{ $record[0]['total_boq_value_osp'] }}" id="total_boq_value_osp" class="form-control block-field total5">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3 inner-peth">    
                    <div class="col-3">
                    <div class="form-group">
                        <label>Labour Cost VO ISP A :</label>
                        <input type="text" name="labour_cost_vo_isp_a" value="{{ $record[0]['labour_cost_vo_isp_a'] }}" id="labour_cost_vo_isp_a" class="form-control qty6">
                     </div>
                   </div>
                   <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost VO ISP A:</label> 
                            <input type="text" name="material_cost_vo_isp_a" value="{{ $record[0]['material_cost_vo_isp_a'] }}" id="material_cost_vo_isp_a" class="form-control qty6">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value VO ISP A:</label>
                            <input type="text" name="total_boq_value_vo_isp_a" value="{{ $record[0]['total_boq_value_vo_isp_a'] }}" id="total_boq_value_vo_isp_a" class="form-control block-field total6">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Labour Cost VO OSP:</label>
                            <input type="text" name="labour_cost_vo_osp" value="{{ $record[0]['labour_cost_vo_osp'] }}" id="labour_cost_vo_osp" class="form-control qty7">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost VO OSP:</label>
                            <input type="text" name="material_cost_vo_osp" value="{{ $record[0]['material_cost_vo_osp'] }}" id="material_cost_vo_osp" class="form-control qty7">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value VO OSP:</label>
                            <input type="text" name="total_boq_value_vo_osp" value="{{ $record[0]['total_boq_value_vo_osp'] }}" id="total_boq_value_vo_osp" class="form-control block-field total7">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3 inner-peth">    
                    <div class="col-3">
                        <div class="form-group">
                            <label>Labour Cost ISP B:</label>
                            <input type="text" name="labour_cost_isp_b" value="{{ $record[0]['labour_cost_isp_b'] }}" id="labour_cost_isp_b" class="form-control qty8">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost ISP B:</label>
                            <input type="text" name="material_cost_isp_b" value="{{ $record[0]['material_cost_isp_b'] }}" id="material_cost_isp_b" class="form-control qty8">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value ISP B:</label>
                            <input type="text" name="total_boq_value_isp_b" value="{{ $record[0]['total_boq_value_isp_b'] }}" id="total_boq_value_isp_b" class="form-control block-field total8">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3 inner-peth">    
                    <div class="col-3">
                        <div class="form-group">
                            <label>Labour Cost VO ISP B:</label>
                            <input type="text" name="labour_cost_vo_isp_b" value="{{ $record[0]['labour_cost_vo_isp_b'] }}" id="labour_cost_vo_isp_b" class="form-control qty9">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost VO ISP B:</label>
                            <input type="text" name="material_cost_vo_isp_b" value="{{ $record[0]['material_cost_vo_isp_b'] }}" id="material_cost_vo_isp_b" class="form-control qty9">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value VO ISP B:</label>
                            <input type="text" name="total_boq_value_vo_isp_b" value="{{ $record[0]['total_boq_value_vo_isp_b'] }}" id="total_boq_value_vo_isp_b" class="form-control block-field total9">
                        </div>
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