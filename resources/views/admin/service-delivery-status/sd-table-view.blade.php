@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
               @include('admin.service-delivery-status.service-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/service-delivery/search')}}" method="GET" role="search">
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
                    <th>PLANNING STATUS</th>
                    <th>BUILD STATUS</th>
                    <th>DATENEW</th>
                    <th>PROJECT STATUS</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
                    <th>SITE A</th>
                    <th>SITE B</th>
                    <th>SITE B STATUS</th>
                    <th>SITE B LLA SUBMITTED</th>
                    <th>SITE B LLA RECEIVED</th>
                    <th>SITE B SURVEY DATE</th>
                    <th>SERVICE TYPE</th>
                    <th>SERVICE MANGER</th>
                    <th>PLANNED WP2 RELEASED DATE</th>
                    <th>REVISED PALNNED WP2 DATE</th>
                    <th>WAYLEAVES SUBMITTED</th>
                    <th>WAYLEAVES RECEIVED</th>
                    <th>BUILD PLANNED COMPLETION DATES</th>
                    <th>REVISED BUILD CO DATE</th>
                    <th>TOC SUBMITTED</th>
                    <th>BUILD DAYS</th>
                    <th>PLANNING DAYS</th>
                    <th>COMMENT</th>
                    <th>COMMENTS</th>
                    <th>TOC RECEIVED</th>
                    <th>PROVINCE</th>
                    <th>SERVICE DELIVERY COMMENTS</th>
                    <th>RETURN TO SALES</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/service-delivery/sd-table-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>@if($record->planning_record){{ $record->planning_record->planning_status }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->build_status }} @endif</td>
                            <td>@if($record->date_new) {{ Carbon\Carbon::parse($record->date_new)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->project_status }}</td>
                            <td>{{ $record->metro_area }}</td>
                            <td>{{ $record->client_name }}</td>
                            <td>{{ $record->site_a }}</td>
                            <td>{{ $record->site_b }}</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_b_status }} @endif</td>
                            <td>@if($record->permission_record){{ $record->permission_record->site_b_lla_submitted }} @endif</td>
                            <td>@if($record->permission_record){{ $record->permission_record->site_b_lla_received }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_b_survey_date }} @endif</td>
                            <td>{{ $record->service_type }} </td>
                            <td>{{ $record->service_manager }} </td>
                            <td>@if($record->planning_record){{ $record->planning_record->planned_wp2_released_date }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->revised_planned_wp2_date }} @endif</td>
                            <td>@if($record->permission_record){{ $record->permission_record->wayleaves_submitted }} @endif</td>
                            <td>@if($record->permission_record){{ $record->permission_record->wayleaves_received }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->build_planned_completion_dates }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->revised_build_co_date }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->toc_submitted }} @endif</td>
                            <td></td>
                            <td></td>
                            <td>@if($record->planning_record){{ $record->planning_record->comment }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->comments }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->toc_received }} @endif</td>
                            <td>{{ $record->province }}</td>
                            <td>{{ $record->service_delivery_comments }}</td>
                            <td>{{ $record->return_to_sales }}</td>
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