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
                  <th>SERVICE ID</th>
                    <th>PROJECT STATUS</th>
                    <th>PLANNING STATUS</th>
                    <th>CLIENT NAME</th>
                    <th>SERVICE TYPE</th>
                    <th>TYPE</th>
                 
                    <th>OSP STATUS PLANNING</th>
                    <th>SITE A</th>
                    <th>SITE A STATUS</th>
					 <th>SITE B</th>
                    <th>SITE B STATUS</th>
                    <th>PLANNED WP2 RELEASED DATE</th>
                    <th>REVISED PLANNED WP2 DATE</th>
                    <th>PROJECT COMMENT</th>
                    <th>PO MRC</th>
                    <th>PO NRC</th>
                    <th>OSP PLANNERS</th>
                    <th>ISP PLANNERS</th>
                    <th>SURVEYORS</th>
                    <th>RX IN PLANNING</th>
                    <th>SITE A SURVEY DATE</th>
                    <th>SITE A ISP SUBMISSION</th>
                    <th>SITE B SURVEY DATE</th>
                    <th>SITE B ISP SUBMISSION</th>
                    <th>SPECIAL BUILD NRC</th>
                    <th>WAYLEAVES SUBMITTED</th>
                    <th>WAYLEAVES ESTIMATED</th>
                    <th>WAYLEAVES RECEVIED</th>
                    <th>WAYLEAVES STATUS</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                        <td><a href="{{ url('admin/planning/planning-status',$record->id) }}">{{ $record->service_id }}</a></td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->planning_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                             <td>@if($record->site_master_record){{ $record->site_master_record->service_type }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->type }} @endif</td>
                         
                            <td>{{ $record->osp_status_panning }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_a }} @endif</td>
                            <td>{{ $record->site_a_status }}</td>
							<td>@if($record->site_master_record){{ $record->site_master_record->site_b }} @endif</td>
                            <td>{{ $record->site_b_status }}</td>
                            <td>@if($record->planned_wp2_released_date) {{ Carbon\Carbon::parse($record->planned_wp2_released_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->revised_planned_wp2_date) {{ Carbon\Carbon::parse($record->revised_planned_wp2_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->comment }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->po_mrc }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->po_nrc }} @endif</td>
                            <td>{{ $record->osp_planners }}</td>
                            <td>{{ $record->isp_planners }}</td>
                            <td>{{ $record->surveyors }}</td>
                            <td>@if($record->rx_in_planning) {{ Carbon\Carbon::parse($record->rx_in_planning)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_a_survey_date) {{ Carbon\Carbon::parse($record->site_a_survey_date)->format('m/d/Y') }} @endif </td>
                            <td>@if($record->site_b_isp_submission) {{ Carbon\Carbon::parse($record->site_b_isp_submission)->format('m/d/Y') }} @endif </td>
                            <td>@if($record->site_b_survey_date) {{ Carbon\Carbon::parse($record->site_b_survey_date)->format('m/d/Y') }} @endif </td>                            <td>{{ $record->site_b_isp_submission }}</td>
                            <td>@if($record->site_master_record){{$record->site_master_record->special_build_nrc }} @endif</td>
                            <td>@if($record->permission_record){{ Carbon\Carbon::parse($record->permission_record->wayleaves_submitted)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->permission_record){{ $record->permission_record->wayleaves_estimated }} @endif</td>
                            <td>@if($record->permission_record){{ Carbon\Carbon::parse($record->permission_record->wayleaves_received)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->permission_record){{$record->permission_record->wayleaves_status }} @endif</td>
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