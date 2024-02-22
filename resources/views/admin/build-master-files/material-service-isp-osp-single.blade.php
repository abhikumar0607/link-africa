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
                      <h3 class="card-title">Edit Material Service Isp Osp</h3>
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
                    <form action="{{ route('admin.planning.material.osp.update',$record[0]['circuit_id'])}}" method="POST" enctype="multipart/form-data" id="add_site_survey_file_record" class="edit_site_master_file_record"> 
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
                                <label>Service ID:</label>
                                <input type="text" class="form-control block-field" name="circuit_id" id="circuit_id" value="{{ $record[0]['site_master_record']['service_id'] }}"> 
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
                                <label>PLANNING STATUS:</label>
                                <input type="text" name="planning_status" value="{{ $record[0]['planning_record']['planning_status'] }}" id="planning_status" class="form-control block-field">
                            </div>
                        </div>
                           
                            <div class="col-3">
                            <div class="form-group">
                                <label>Labour Cost OSP:</label>
                                <input type="text" name="labour_cost_osp" value="{{ $record[0]['planning_record']['labour_cost_osp'] }}" id="labour_cost_osp" class="form-control qty7">
                            </div>
                        </div> 
                        
                        <div class="col-3">
                                <div class="form-group">
                                    <label>Labour Cost VO OSP:</label>
                                    <input type="text" name="labour_cost_vo_osp" value="{{ $record[0]['planning_record']['labour_cost_vo_osp'] }}" id="labour_cost_vo_osp" class="form-control qty8">
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
                                <label>REVISED PLANNED WP2 DATE:</label>
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planning_record']['revised_planned_wp2_date'])->format('m/d/Y') }}" class="form-control block-field" name="revised_planned_wp2_date" id="revised_planned_wp2_date">  
                                </div>
                        </div> 
                        <div class="col-3">
                        <div class="form-group">
                            <label>Material Cost VO OSP:</label> 
                            <input type="text" name="material_cost_vo_osp" value="{{ $record[0]['planning_record']['material_cost_vo_osp'] }}" id="material_cost_vo_osp" class="form-control qty7">
                        </div>
                    </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Material Cost OSP:</label>
                                <input type="text" name="material_cost_osp" value="{{ $record[0]['planning_record']['material_cost_osp'] }}" id="material_cost_osp" class="form-control qty8">
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
                                <label>SITE A ID:</label>
                                <input type="text" name="site_a_id" value="{{ $record[0]['planning_record']['site_a_id'] }}" id="site_a_id" class="form-control block-field">
                            </div>
                        </div> 

                        <div class="col-3">
                            <div class="form-group">
                                <label>Total BOQ Value VO OSP:</label>
                                <input type="text" name="total_boq_value_vo_osp" value="{{ $record[0]['planning_record']['total_boq_value_vo_osp'] }}" id="total_boq_value_vo_osp" class="form-control block-field total7">
                            </div>
                        </div>

                        <div class="col-3">
                        <div class="form-group">
                            <label>Total BOQ Value OSP:</label>
                            <input type="text" name="total_boq_value_osp" value="{{ $record[0]['planning_record']['total_boq_value_osp'] }}" id="total_boq_value_osp" class="form-control total8 block-field">
                            </div>
                        </div> 
                         
                      
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP PLANNERS:</label>
                                <input type="text" name="osp_planners" value="{{ $record[0]['planning_record']['osp_planners'] }}" id="osp_planners" class="form-control block-field">
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
                                <label>SITE B:</label>                                
                                <input type="text" name="site_b" value="{{ $record[0]['site_master_record']['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                          </div> 
                         
                        <div class="col-3">
                            <div class="form-group">
                                <label>SITE B ID:</label>
                                <input type="text" name="site_b_id" value="{{ $record[0]['planning_record']['site_b_id'] }}" id="site_b_id" class="form-control block-field">
                            </div>
                        </div> 
                       
                         </div>  
                          <div class="row border-box">
                           <div class="col-md-3 inner-peth"> 
                           <div class="col-3">
                            <div class="form-group">
                                <label>OSP DISTANCE TRENCH:</label>
                                <input type="text" name="osp_asb_trench" value="{{ $record[0]['planning_record']['osp_distance_trench'] }}" id="osp_distance_trench" class="form-control qty2">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP DISTANCE 3RD PARTY DUCTS:</label>
                                <input type="text" name="osp_distance_3rd_party_ducts" value="{{ $record[0]['planning_record']['osp_distance_3rd_party_ducts'] }}" id="osp_distance_3rd_party_ducts" class="form-control qty2">
                            </div>
                           </div>
                          </div>
                          <div class="col-md-3 inner-peth">
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP LA EXISTING DUCT:</label>
                                <input type="text" name="osp_la_existing_duct" value="{{ $record[0]['planning_record']['osp_la_existing_duct'] }}" id="osp_la_existing_duct" class="form-control qty2">
                            </div>
                        </div>
                        <div class="col-3">
                                <div class="form-group">
                                    <label>OSP B LA EXISTING NETWORK:</label>
                                    <input type="text" name="osp_la_existing_network" value="{{ $record[0]['planning_record']['osp_la_existing_network'] }}" id="osp_la_existing_network" class="form-control qty2">
                                </div>
                            </div>
                         </div>
                         <div class="col-md-3 inner-peth">
                            <div class="col-3">
                            <div class="form-group">
                                <label>OSP DISTANCE - FOCUS:</label>
                                <input type="text" name="osp_distance_focus" value="{{ $record[0]['planning_record']['osp_distance_focus'] }}" id="osp_distance_focus" class="form-control qty2">
                            </div>
                        </div>
                        <div class="col-3">
                                <div class="form-group">
                                    <label>OSP IN - BUILDIN CONDUITS:</label>
                                    <input type="text" name="osp_in_buildin_conduits" value="{{ $record[0]['planning_record']['osp_in_buildin_conduits'] }}" id="osp_in_buildin_conduits" class="form-control qty2">
                                </div>
                            </div>
                          </div>
                            <div class="col-md-3 inner-peth">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>OPS TOTAL DISTANCE:</label>
                                    <input type="text" name="ops_total_distance" value="{{ $record[0]['planning_record']['ops_total_distance'] }}" id="ops_total_distance" class="form-control block-field total2">
                                </div>
                            </div>
                           </div>
                       </div>


                      <!--Material Price Start Here-->
                      <div class="material-header border-box">
                        <h2>Material Req OSP Header</h2>
                        <button type="button" class="btn btn-primary add_new_planning_material_price" data-servive_id="{{ $record[0]['circuit_id'] }}" data-material_page_type="osp">Add New Material Price</button>
                        <table class="table-bordered table-striped">
                            <tr>
                                <th>SERVICE ID</th>
                                <th>STOCK CODE</th>
                                <th>QUANTITY</th>
                                <th>LIST PRICE</th>
                                <th>EXTENDED PRICE</th>                   
                            </tr>
                            @php $material_total_price = 0; @endphp
                            @foreach($record[0]['planning_osp_records'] as $planning_osp_record)

                                @php
                                    $list_price = 0;
                                    $planning_material_stock_code = "";
                                    $planning_material_id = "";
                                    if($planning_osp_record['planning_material_record']){
                                        $planning_material_id = $planning_osp_record['planning_material_record']['id'];
                                        $list_price = $planning_osp_record['planning_material_record']['list_price']; 
                                        $planning_material_stock_code = $planning_osp_record['planning_material_record']['stock_code'];
                                    }
                                    
                                    $new_list_price = str_replace('R ', '', $list_price);
                                    $new_list_price2 = str_replace(',', '', $new_list_price);
                                
                                    $quantity = 1;
                                    if($planning_osp_record['quantity'] != 0){
                                        $quantity = $planning_osp_record['quantity'];
                                    }
                                    $cal_list_price = $new_list_price2*$quantity;

                                    $material_list_price = $list_price;
                                    $new_cal_list_price = number_format($cal_list_price,2,'.', ','); 
                                    $material_extended_price = "R ".$new_cal_list_price;
                                    $material_total_price += (int)$new_cal_list_price;

                                @endphp
                                <tr class="material_price_list">
                                    <td>{{ $planning_osp_record['circuit_id'] }}</td>
                                    <td>
                                        <select class="form-control material_stock_code" name="osp_material_stock_code[]" id="osp_material_stock_code">
                                            <option value="" selected="">Please Select</option>
                                            @foreach($planning_materials as $planning_material)
                                                <option value="{{ $planning_material['stock_code'] }}" <?php if($planning_material_stock_code == $planning_material['stock_code']){ echo 'selected'; } ?>>{{ $planning_material['stock_code'] }} || {{ $planning_material['description'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="osp_material_quantity[]" value="{{ $quantity }}" id="osp_material_quantity" class="form-control material_quantity"></td>
                                    <td>
                                        <input type="text" name="osp_material_list_price[]" value="{{ $material_list_price }}" id="osp_material_list_price" class="form-control material_list_price block-field">
                                    </td>
                                    <td><input type="text" name="osp_material_extended_price[]" value="{{ $material_extended_price }}" class="form-control material_extended_price block-field"></td>
                                </tr>
                            @endforeach
                            </table>
                            <table class="planning_service_isp_a_res"></table>
                            <div class="meterial-price-total">
                                Total:<input type="text" name="osp_material_total_price" value="{{ 'R '.$material_total_price; }}" class="form-control material_total_price block-field">
                            </div>
                      </div>
                      <!--Material Price End Here-->
                       
                         
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
 @endsection