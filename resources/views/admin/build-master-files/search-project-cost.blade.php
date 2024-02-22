@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.build-master-files.build-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/build/search/project/cost')}}" method="GET" role="search">
                   <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                   </div>
                   <div class="form-group">
                      <select class="form-control" name="region">
                        <option value="" selected="">Please Select Region</option>
                        <option value="Eastern Region">Eastern Region</option>
                        <option value="Northern Region">Northern Region</option>
                        <option value="Western Region">Western Region</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-submt">Submit</button>
                  </div>
                 </form>
               </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
              <!-- /.card-header -->
              <div class="card-body La-scroll">
                  <div class="delete_responce"></div>
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr class="sticky">
                    <th>CIRCUIT ID</th>
                    <th>PROJECT STATUS</th>
                    <th>BUILD STATUS</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
                    <th>SITE A</th>
                    <th>SITE A ID</th>
                    <th>SITE B</th>
                    <th>SITE B ID</th>
                    <th>REVISED BUILD CO DATE</th>
                    <th>LABOUR COST OSP</th> 
                    <th>TOTAL BOQ VALUE OSP</th>
                    <th>LABOUR COST VO OSP</th>
                    <th>MATERIAL COST VO OSP</th>
                    <th>TOTAL BOQ VALUE VO OSP</th>
                    <th>LABOUR COST VO ISP A</th> 
                    <th>MATERIAL COST VO ISP A</th>
                    <th>TOTAL BOQ VALUE VO ISP A</th>   
                    <th>MATERIAL COST VO ISP B</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/build/project-cost-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->build_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->metro_area }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_a }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_a_id }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_b }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_b_id }} @endif</td>
                            <td>{{ $record->revised_build_co_date }}</td>
                            <td>@if($record->planning_record){{ $record->labour_cost_osp }} @endif</td>
                            <td>@if($record->planning_record){{ $record->total_boq_value_osp }} @endif</td>
                            <td>@if($record->planning_record){{ $record->labour_cost_vo_osp }} @endif</td>
                            <td>@if($record->planning_record){{ $record->material_cost_vo_osp }} @endif</td>
                            <td>@if($record->planning_record){{ $record->total_boq_value_vo_osp }} @endif</td>
                            <td>@if($record->planning_record){{ $record->labour_cost_vo_isp_a }} @endif</td>
                            <td>@if($record->planning_record){{ $record->material_cost_vo_isp_a }} @endif</td>
                            <td>@if($record->planning_record){{ $record->total_boq_value_vo_isp_a }} @endif</td>
                            <td>@if($record->planning_record){{ $record->material_cost_vo_isp_b }} @endif</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="pagination">
                	{{ $all_records->render() }}
                </div>
                @else
                	<h2>No Records Found</h2>
                @endif
            </div>
            <!-- /.card-body -->
          
          <!-- /.card -->
          
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection