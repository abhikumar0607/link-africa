@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
             @include('admin.planning-master-files.planning-header')
            <div class="col-md-3">
            <form class="search" action="{{url('admin/planning/search/department/comment')}}" method="GET" role="search">
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
    <section class="content all-xontent">
      <div class="row">
        <div class="col-md-12">
            {{--<div class="card">--}}
              <!-- /.card-header -->
              <div class="card-body La-scroll">
                  <div class="delete_responce"></div>
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped" >
                  <thead>
                  <tr class="sticky">
                  <th>SERVICE ID</th>
                    <th>Project STATUS</th>
                    <th>PLANNING STATUS</th>
                    <th>PERMISSION STATUS</th>
                    <th>BUILD STATUS</th>
                    <th>SERVICE DELIVERY STATUS</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
                  
                    <th>PLANNING COMMENTS</th>
                    <th>BUILD COMMENTS</th>
                    <th>PERMISSION COMMENTS</th>
                    <th>SERVICE DELIVERY COMMENTS</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                        <td><a href="{{ url('admin/planning/planning-department-comment-single',$record->id) }}">{{ $record->service_id }}</a></td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->planning_status }}</td>
                            <td>@if($record->permission_record){{ $record->permission_record->permissions_status }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->build_status }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->service_delivery_status }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->metro_area }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            
                            <td>@if($record->department_record) {{ $record->department_record->planning_comment }}  @endif </td>
                            <td>@if($record->department_record) {{ $record->department_record->build_comment }} @endif</td>
                            <td>@if($record->department_record) {{ $record->department_record->permission_comment }} @endif</td>
                            <td>@if($record->department_record) {{ $record->department_record->service_delivery_comment }} @endif</td>
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
          {{--</div>--}}
          <!-- /.card -->
          
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection