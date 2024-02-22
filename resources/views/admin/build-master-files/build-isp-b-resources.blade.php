@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.build-master-files.build-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/build/search')}}" method="GET" role="search">
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
                    <th>SITE B</th>
                    <th>ISP B PROJECT LEADER</th>
                    <th>SITE B ID</th>
                    <th>REVISED BUILD CO DATE</th>
                    <th>ISP B CIVIL CONTRACTOR</th>
                    <th>ISP B JETTING CONTRACTOR</th>
                    <th>ISP B RE INSTATEMENT CONTRACTOR</th>
                    <th>ISP B DRILLING CONTRACTOR</th>
                    <th>ISP B FLOATING CONTRACTOR</th>
                    <th>ISP B FOCUS CONTRACTOR</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/build/build-isp-b-resources-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->build_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->metro_area }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_a }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_b }} @endif</td>
                            <td>{{ $record->isp_b_project_leader }}</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_b_id }} @endif</td>
                            <td>{{ $record->revised_build_co_date }}</td>
                            <td>{{ $record->isp_b_civil_contractor }}</td>
                            <td>{{ $record->isp_b_jetting_contractor }}</td>
                            <td>{{ $record->isp_b_re_instatement_contractor }}</td>
                            <td>{{ $record->isp_b_drilling_contractor }}</td>
                            <td>{{ $record->isp_b_floating_contractor }}</td>
                            <td>{{ $record->isp_b_focus_contractor }}</td>
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