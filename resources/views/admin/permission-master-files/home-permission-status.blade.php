@extends('admin.layouts.master')
@section('content')
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
    <section class="content">
      <div class="row">
        <div class="col-md-12">
              <div class="card-body La-scroll">
                  <div class="delete_responce"></div>
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr class="sticky">
                    <th>CIRCUIT NO</th>
                    <th>PROJECT STATUS</th>
                    <th>PERMISSION STATUS</th>
                    <th>CLIENT NAME</th>
                    <th>TYPE</th>
                    <th>SITE A</th>
                    <th>SITE B</th>
                    <th>PROVINCE</th>
                    <th>SITE A STATUS</th>
                    <th>SITE B STATUS</th>
                    <th>WAYLEAVES STATUS</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/permission/permission-status-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->permissions_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->type }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_a }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_b }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->province }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_a_status }} @endif</td>
                            <td>@if($record->planning_record){{ $record->planning_record->site_b_status }} @endif</td>
                            <td>{{ $record->wayleaves_status }}</td>
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
        </div>
      </div>
    </section>
  </div>
</div>
@endsection