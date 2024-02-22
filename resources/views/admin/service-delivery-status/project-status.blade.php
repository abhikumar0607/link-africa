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
                    <th>PROJECT STATUS</th>
                    <th>PLANNING STATUS</th>
                    <th>PERMISSION STATUS</th>
                    <th>BUILD STATUS</th>
                    <th>SERVICE DELIVERY STATUS</th>
                    <th>ORDER TYPE</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
    
                    <th>SITE A</th>
                    <th>SITE B</th>
                    <th>SERVICE DELIVERY COMMENTS</th>
                    <th>RETURN TO SALES</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                        <td><a href="{{ url('admin/service-delivery/project-status-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>{{ $record->project_status }} </td>
                            <td>@if($record->planning_record){{ $record->planning_record->planning_status }} @endif</td>
                            <td>@if($record->permission_record){{ $record->permission_record->permissions_status }} @endif</td>
                            <td>@if($record->build_record){{ $record->build_record->build_status }} @endif</td> 
                            <td>{{ $record->service_delivery_status }}</td>
                            <td>{{ $record->order_type }}</td>
                            <td>{{ $record->metro_area }}</td>
                            <td>{{ $record->client_name }}</td>
                            
                            <td>{{ $record->site_a }}</td>
                            <td>{{ $record->site_b }}</td>
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