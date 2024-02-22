@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.permission-master-files.permission-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/permission/search')}}" method="GET" role="search">
                   <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="{{ app('request')->input('keyword') }}">
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
                    <th>CIRCUIT NO</th>
                    <th>PERMISSION STATUS</th>
                    <th>PROVINCE</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
                    <th>TYPE</th>
                    <th>SITE B</th>
                    <th>SITE B STATUS</th>
                    <th>SITE B LLA SUBMITTED</th>
                    <th>SITE B LLA ESTIMATED</th>
                    <th>SITE B LLA RECEIVED</th>
                    <th>OVERDUE</th>
                    <th>ISP PLANNERS</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/permission/permission-site-b-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>{{ $record->permissions_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->province }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->metro_area }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->type }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_b }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_b_status }} @endif</td>
                            <td>{{ $record->site_b_lla_submitted }}</td>
                            <td>{{ $record->site_b_lla_estimated }}</td>
                            <td>{{ $record->site_b_lla_received }}</td>
                            <td></td>
                            <td>@if($record->planning_record){{ $record->planning_record->isp_planners }} @endif</td>
                           
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