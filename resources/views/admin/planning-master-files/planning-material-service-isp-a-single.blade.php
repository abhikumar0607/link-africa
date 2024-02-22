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
                      <h3 class="card-title">Edit Planning Material Isp A</h3>
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
                  <form action="{{ route('admin.planning.material.ispa.update',$record[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_survey_file_record" class="edit_site_master_file_record"> 
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
                                <label>Circuit ID:</label>
                                <input type="text" class="form-control block-field" name="circuit_id" id="circuit_id" value="{{ $record[0]['site_master_record']['circuit_id'] }}"> 
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Service ID:</label>
                                <input type="text" class="form-control block-field" name="service_id" id="service_id" value="{{ $record[0]['site_master_record']['service_id'] }}"> 
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                            <label>PLANNED WP2 RELEASED DATE:</label>
                            <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                                <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planned_wp2_released_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input block-field" name="planned_wp2_released_date" id="planned_wp2_released_date" data-target="#custom_date_picker">
                                            <div class="input-group-append" data-target="#custom_date_picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            </div>
                        </div>  
                        <div class="col-3">
                            <div class="form-group">
                                <label>Labour Cost ISP A:</label>
                                <input type="text" name="labour_cost_isp_a" value="{{ $record[0]['labour_cost_isp_a'] }}" id="labour_cost_isp_a" class="form-control qty4">
                            </div>
                        </div>  
                        <div class="col-3">
                            <div class="form-group">
                                <label>Labour Cost VO ISP A :</label>
                                <input type="text" name="labour_cost_vo_isp_a" value="{{ $record[0]['labour_cost_vo_isp_a'] }}" id="labour_cost_vo_isp_a" class="form-control qty6">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>PLANNING STATUS:</label>
                                    <input type="text" class="form-control block-field" name="planning_status" id="planning_status" value="{{ $record[0]['planning_status'] }}"> 
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
                                <label>Material Cost ISP A:</label>
                                <input type="text" name="material_cost_isp_a" value="{{ $record[0]['material_cost_isp_a'] }}" id="material_cost_isp_a" class="form-control qty4">
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
                            <label>REVISED PLANNED WP2 DATE:</label>
                            <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                                                <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_planned_wp2_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input block-field" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                                            <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            </div>
                        </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['site_master_record']['client_name'] }}" id="client_name" class="form-control block-field">
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
                                <label>Total BOQ Value VO ISP A:</label>
                                <input type="text" name="total_boq_value_vo_isp_a" value="{{ $record[0]['total_boq_value_vo_isp_a'] }}" id="total_boq_value_vo_isp_a" class="form-control block-field total6">
                            </div>
                        </div>    
                          <div class="col-3">
                            <div class="form-group">
                                <label>SITE A ID:</label>
                                <input type="text" name="site_a_id" value="{{ $record[0]['site_a_id'] }}" id="site_a_id" class="form-control block-field">
                            </div>
                        </div>
                      
                        <div class="col-3">
                            <div class="form-group">
                                <label>OSP PLANNERS:</label>
                                <input type="text" name="osp_planners" value="{{ $record[0]['osp_planners'] }}" id="osp_planners" class="form-control block-field">
                            </div>
                        </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Metro Area:</label>
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
                                <input type="text" name="site_b_id" value="{{ $record[0]['site_b_id'] }}" id="site_b_id" class="form-control block-field">
                            </div>
                        </div> 
                        </div>                                            
                         <div class="row border-box">                    
                         <div class="col-3">
                            <div class="form-group">
                                <label>ISP A DISTANCE - TRENCH:</label>
                                <input type="text" name="isp_a_distance_trench" value="{{ $record[0]['isp_a_distance_trench'] }}" id="isp_a_distance_trench" class="form-control qty1">
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
                                <label>ISP A DISTANCE - FOCUS:</label>
                                <input type="text" name="isp_a_distance_focus" value="{{ $record[0]['isp_a_la_existing_duct'] }}" id="isp_a_distance_focus" class="form-control qty1">
                            </div>
                        </div>
                        <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A TOTAL DISTANCE:</label>
                                    <input type="text" name="isp_a_total_distance" value="{{ $record[0]['isp_a_total_distance'] }}" id="isp_a_total_distance" class="form-control block-field total">
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
                                    <label>ISP A LA EXISTING NETWORK:</label>
                                    <input type="text" name="isp_a_la_existing_network" value="{{ $record[0]['isp_a_la_existing_network'] }}" id="isp_a_la_existing_network" class="form-control qty1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>ISP A IN - BUILDIN CONDUITS:</label>
                                    <input type="text" name="isp_a_in_buildin_conduits" value="{{ $record[0]['isp_a_in_buildin_conduits'] }}" id="isp_a_in_buildin_conduits" class="form-control qty1">
                                </div>
                            </div>
                          </div>
                         
                        <!--Material Price Start Here-->
                        <div class="material-header border-box">
                            <h2>Material Req ISP A Header</h2>
                            <button type="button" class="btn btn-primary add_new_planning_material_price" data-servive_id="{{ $record[0]['circuit_id'] }}" data-material_page_type="isp_a">Add New Material Price</button>
                            <table class="table-bordered table-striped">
                                <tr>
                                    <th>SERVICE ID</th>
                                    <th>STOCK CODE</th>
                                    <th>QUANTITY</th>
                                    <th>LIST PRICE</th>
                                    <th>EXTENDED PRICE</th>                   
                                </tr>
                                @php $material_total_price = 0; @endphp
                                @foreach($record[0]['planning_isp_a_records'] as $planning_isp_a_record)

                                    @php
                                        $list_price = 0;
                                        $planning_material_stock_code = "";
                                        $planning_material_id = "";
                                        if($planning_isp_a_record['planning_material_record']){
                                            $planning_material_id = $planning_isp_a_record['planning_material_record']['id'];
                                            $list_price = $planning_isp_a_record['planning_material_record']['list_price']; 
                                            $planning_material_stock_code = $planning_isp_a_record['planning_material_record']['stock_code'];
                                        }
                                        
                                        $new_list_price = str_replace('R ', '', $list_price);
                                        $new_list_price2 = str_replace(',', '', $new_list_price);
                                    
                                        $quantity = 1;
                                        if($planning_isp_a_record['quantity'] != 0){
                                            $quantity = $planning_isp_a_record['quantity'];
                                        }
                                        $cal_list_price = $new_list_price2*$quantity;

                                        $material_list_price = $list_price;
                                        $new_cal_list_price = number_format($cal_list_price,2,'.', ','); 
                                        $material_extended_price = "R ".$new_cal_list_price;
                                        $material_total_price +=  (int)$new_cal_list_price;

                                    @endphp
                                    <tr class="material_price_list">
                                        <td>{{ $planning_isp_a_record['circuit_id'] }}</td>
                                        <td>
                                            <select class="form-control material_stock_code" name="isp_a_material_stock_code[]">
                                                <option value="" selected="">Please Select</option>
                                                @foreach($planning_materials as $planning_material)
                                                    <option value="{{ $planning_material['stock_code'] }}" <?php if($planning_material_stock_code == $planning_material['stock_code']){ echo 'selected'; } ?>>{{ $planning_material['stock_code'] }} || {{ $planning_material['description'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="isp_a_material_a_quantity[]" value="{{ $quantity }}" class="form-control material_quantity"></td>
                                        <td>
                                            <input type="text" name="isp_a_material_list_price[]" value="{{ $material_list_price }}" class="form-control material_list_price  block-field">
                                        </td>
                                        <td>
                                            <input type="text" name="isp_a_material_extended_price[]" value="{{ $material_extended_price }}" class="form-control material_extended_price  block-field"></td>
                                    </tr>
                                @endforeach
                                </table>
                                <table class="planning_service_isp_a_res"></table>
                                <div class="meterial-price-total">
                                    Total:<input type="text" name="isp_a_material_total_price" value="{{ 'R '.$material_total_price; }}" class="form-control material_total_price  block-field">
                                </div>
                          </div>
                           <!--Material Price End Here-->

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