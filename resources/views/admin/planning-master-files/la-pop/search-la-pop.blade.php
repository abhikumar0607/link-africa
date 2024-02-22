@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.planning-master-files.planning-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/planning/search/lapop')}}" method="GET" role="search">
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
                    <th>POP ID</th>
                    <th>AREA</th>
                    <th>AREA NAME</th>
                    <th>POP TYPE</th>
                    <th>POP NAME</th>
                    <th>POP ADDRESS</th>
                    <th>LAT</th>
                    <th>LONG</th>
                    <th>PLANNING PROGRESS STATUS</th>
                    <th>ISP CAPACITY PLANNER</th>
                    <th>SURVEY DATE</th>
                    <th>ISP PLAN DATE</th>
                    <th>SUMISSION TO PERMISSION</th>
                    <th>DATE APPROVED FROM PERMISSION</th>
                    <th>BOQ RELEASE DATE</th>
                    <th>COMMENTS</th>
                    <th>POP STATUS</th>
                    <th>LAND LORD NAME</th>
                    <th>LAND LORD CONTACT</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/planning/la-pop/single-record',$record->pop_id) }}">{{ $record->pop_id }}</a></td>
                            <td>{{ $record->area }}</td>
                            <td>{{ $record->area_name }}</td>
                            <td>{{ $record->pop_type }}</td>
                            <td>{{ $record->pop_name }}</td>
                            <td>{{ $record->pop_address }}</td>
                            <td>{{ $record->lat }}</td>
                            <td>{{ $record->long }}</td>
                            <td>{{ $record->planning_progress_status }}</td>
                            <td>{{ $record->isp_capacity_planner }}</td>
                            <td>@if($record->survey_date) {{ Carbon\Carbon::parse($record->survey_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->isp_plan_date) {{ Carbon\Carbon::parse($record->isp_plan_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->sumission_permission) {{ Carbon\Carbon::parse($record->sumission_permission)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->date_approved_from_permission) {{ Carbon\Carbon::parse($record->date_approved_from_permission)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->boq_release_date) {{ Carbon\Carbon::parse($record->boq_release_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->comments }}</td>
                            <td>{{ $record->pop_status }}</td>
                            <td>{{ $record->land_lord_name }}</td>
                            <td>{{ $record->land_lord_contact }}</td>
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