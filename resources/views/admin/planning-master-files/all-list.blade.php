@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.planning-master-files.planning-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/planning/search')}}" method="GET" role="search">
                   <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search">
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
                    <th>SERVICE ID</th>
                    <th>Circuit ID</th>
                    <th>DATENEW</th>
                    <th>PLANNING STATUS</th>
                    <th>Rx IN PLANNING</th>
                    <th>PLANNING WP2 WL SUBMISSION</th>
                    <th>PLANNED WP2 RELEASED DATE</th>
                    <th>REVISED PLANNED WP2 DATE</th>
                    <th>WP2 APPROVAL REQUESTED</th>
                    <th>WP2 APPROVAL RECEIVED</th>
                    <th>ISP A WP2 APPROVAL RECEIVED</th>
                    <th>ISP A WP2 APPROVAL REQUESTED</th>
                    <th>ISP B WP2 APPROVAL RECEIVED</th>
                    <th>ISP B WP2 APPROVAL REQUESTED</th>
                    <th>OSP PLANNERS</th>
                    <th>ISP PLANNERS</th>
                    <th>SURVEYORS</th>
                    <th>ISP DISTANCE</th>
                    <th>OSP PLANNERS2</th>
                    <th>ISP PLANNERS2</th>
                    <th>SURVEYORS2</th>
                    <th>SITE A ID</th>
                    <th>SITE A STATUS</th>
                    <th>SITE A SURVEY DATE</th>
                    <th>SITE A ISP SUBMISSION</th>
                    <th>SITE A COMMENT</th>
                    <th>SITE B ID</th>
                    <th>SITE B STATUS</th>
                    <th>SITE B SURVEY DATE</th>
                    <th>SITE B ISP SUBMISSION</th>
                    <th>SITE B COMMENT</th>
                    <th>COMMENT</th>
                    <th>Cost PM</th>
                    <th>PROVINCE</th>
                    <th>Labour Cost OSP</th>
                    <th>Material Cost OSP</th>
                    <th>Total BOQ Value OSP</th>
                    <th>Labour Cost VO OSP</th>
                    <th>Material Cost VO OSP</th>
                    <th>Total BOQ Value VO OSP</th>
                    <th>Labour Cost VO ISP A</th>
                    <th>Material Cost VO ISP A</th>
                    <th>Total BOQ Value VO ISP A</th>
                    <th>Labour Cost VO ISP B</th>
                    <th>Material Cost VO ISP B</th>
                    <th>Total BOQ Value VO ISP B</th>
                    <th>Total Project Cost</th>
                    <th>OSP STATUS PANNING</th>
                    <th>OSP DISTANCE - TRENCH</th>
                    <th>OSP DISTANCE - 3RD PARTY DUCTS</th>
                    <th>OSP LA EXISTING DUCT</th>
                    <th>OSP LA EXISTING NETWORK</th>
                    <th>OSP DISTANCE - FOCUS</th>
                    <th>OSP in - Buildin Conduits</th>
                    <th>OPS TOTAL DISTANCE</th>
                    <th>ISP A DISTANCE - TRENCH</th>
                    <th>ISP A DISTANCE - 3RD PARTY DUCTS</th>
                    <th>ISP A LA EXISTING DUCT</th>
                    <th>ISP A LA EXISTING NETWORK</th>
                    <th>ISP A DISTANCE - FOCUS</th>
                    <th>ISP A in - Buildin Conduits</th>
                    <th>ISP A TOTAL DISTANCE</th>
                    <th>ISP B DISTANCE - TRENCH</th>
                    <th>ISP B DISTANCE - 3RD PARTY DUCTS</th>
                    <th>ISP B LA EXISTING DUCT</th>
                    <th>ISP B LA EXISTING NETWORK</th>
                    <th>ISP B DISTANCE - FOCUS</th>
                    <th>ISP B in - Buildin Conduits</th>
                    <th>ISP B TOTAL DISTANCE</th>
                    <th>Labour Cost ISP A</th>
                    <th>Material Cost ISP A</th>
                    <th>Total BOQ Value ISP A</th>
                    <th>Labour Cost ISP B</th>
                    <th>Material Cost ISP B</th>
                    <th>Total BOQ Value ISP B</th>
                    <th>Link dependency</th>
                    <th>Mat</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/planning/project-status',$record->id) }}">{{ $record->service_id }}</a></td>
                            <td>{{ $record->circuit_id }}</td>
                            <td>@if($record->datenew) {{ Carbon\Carbon::parse($record->datenew)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->planning_status }}</td>
                            <td>@if($record->rx_in_planning) {{ Carbon\Carbon::parse($record->rx_in_planning)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->planning_wp2_wl_submission) {{ Carbon\Carbon::parse($record->planning_wp2_wl_submission)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->planned_wp2_released_date) {{ Carbon\Carbon::parse($record->planned_wp2_released_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->revised_planned_wp2_date) {{ Carbon\Carbon::parse($record->revised_planned_wp2_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->wp2_approval_requested) {{ Carbon\Carbon::parse($record->wp2_approval_requested)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->wp2_approval_received) {{ Carbon\Carbon::parse($record->wp2_approval_received)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->isp_a_wp2_approval_received) {{ Carbon\Carbon::parse($record->isp_a_wp2_approval_received)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->isp_a_wp2_approval_requested) {{ Carbon\Carbon::parse($record->isp_a_wp2_approval_requested)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->isp_b_wp2_approval_received) {{ Carbon\Carbon::parse($record->isp_b_wp2_approval_received)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->isp_b_wp2_approval_requested) {{ Carbon\Carbon::parse($record->isp_b_wp2_approval_requested)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->osp_planners }}</td>
                            <td>{{ $record->isp_planners }}</td>
                            <td>{{ $record->surveyors }}</td>
                            <td>{{ $record->isp_distance }}</td>
                            <td>{{ $record->osp_planners2 }}</td>
                            <td>{{ $record->isp_planners2 }}</td>
                            <td>{{ $record->surveyors2 }}</td>
                            <td>{{ $record->site_a_id }}</td>
                            <td>{{ $record->site_a_status }}</td>
                            <td>@if($record->site_a_survey_date) {{ Carbon\Carbon::parse($record->site_a_survey_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_a_isp_submission) {{ Carbon\Carbon::parse($record->site_a_isp_submission)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->site_a_comment }}</td>
                            <td>{{ $record->site_b_id }}</td>
                            <td>{{ $record->site_b_status }}</td>
                            <td>@if($record->site_b_survey_date) {{ Carbon\Carbon::parse($record->site_b_survey_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_b_isp_submission) {{ Carbon\Carbon::parse($record->site_b_isp_submission)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->site_b_comment }}</td>
                            
                            <td>{{ $record->comment }}</td>
                            <td>{{ $record->cost_pm }}</td>
                            <td>{{ $record->province }}</td>
                            <td>{{ $record->labour_cost_osp }}</td>
                            <td>{{ $record->material_cost_osp }}</td>
                            <td>{{ $record->total_boq_value_osp }}</td>
                            <td>{{ $record->labour_cost_vo_osp }}</td>
                            <td>{{ $record->material_cost_vo_osp }}</td>
                            <td>{{ $record->total_boq_value_vo_osp }}</td>
                            <td>{{ $record->labour_cost_vo_isp_a }}</td>
                            <td>{{ $record->material_cost_vo_isp_a }}</td>
                            <td>{{ $record->total_boq_value_vo_isp_a}}</td>
                            <td>{{ $record->labour_cost_vo_isp_b }}</td>
                            <td>{{ $record->material_cost_vo_isp_b }}</td>
                            <td>{{ $record->total_boq_value_vo_isp_b }}</td>
                            <td>{{ $record->total_project_cost }}</td>
                            <td>{{ $record->osp_status_panning }}</td>
                            <td>{{ $record->osp_distance_trench }}</td>
                            <td>{{ $record->osp_distance_3rd_party_ducts }}</td>
                            <td>{{ $record->osp_la_existing_duct }}</td>
                            <td>{{ $record->osp_la_existing_network }}</td>
                            <td>{{ $record->osp_distance_focus }}</td>
                            <td>{{ $record->osp_in_buildin_conduits }}</td>
                            <td>{{ $record->ops_total_distance }}</td>
                            <td>{{ $record->isp_a_distance_trench }}</td>
                            <td>{{ $record->isp_a_distance_3rd_party_ducts }}</td>
                            <td>{{ $record->isp_a_la_existing_duct }}</td>
                            <td>{{ $record->isp_a_la_existing_network }}</td>
                            <td>{{ $record->isp_a_distance_focus }}</td>
                            <td>{{ $record->isp_a_in_buildin_conduits }}</td>
                            <td>{{ $record->isp_a_total_distance }}</td>
                            <td>{{ $record->isp_b_distance_trench }}</td>
                            <td>{{--isp_b_distance_3rd_party_ducts--}} {{ $record->isp_b_distance_3rd_party_ducts }}</td>
                            <td>{{ $record->isp_b_la_existing_duct }}</td>
                            <td>{{ $record->isp_b_la_existing_network }}</td>
                            <td>{{ $record->isp_b_distance_focus }}</td>
                            <td>{{ $record->isp_b_in_buildin_conduits }}</td>
                            <td>{{ $record->isp_b_total_distance }}</td>
                            <td>{{ $record->labour_cost_isp_a }}</td>
                            <td>{{ $record->material_cost_isp_a }}</td>
                            <td>{{ $record->total_boq_value_isp_a }}</td>
                            <td>{{ $record->labour_cost_isp_b }}</td>
                            <td>{{ $record->material_cost_isp_b }}</td>
                            <td>{{ $record->total_boq_value_isp_b }}</td>
                            <td>{{ $record->link_dependency }}</td>
                            <td>{{ $record->mat }}</td>
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