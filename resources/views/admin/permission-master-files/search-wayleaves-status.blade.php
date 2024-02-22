@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.permission-master-files.permission-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/permission/search/wayleaves/status')}}" method="GET" role="search">
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
                    <th>WAYLEAVE CO-ORDINATOR</th>
                    <th>WAYLEAVE STATUS</th>
                    <th>PROJECT STATUS</th>
                    <th>PERMISSIONS STATUS</th>
                    <th>WL OSP STATUS</th>
                    <th>PROVINCE</th>
                    <th>CLIENT NAME</th>
                    <th>WAYLEAVES SUBMITTED</th>
                    <th>WAYLEAVES ESTIMATED</th>
                    <th>EXEPECTED WL RECEIVED DATE</th>
                    <th>WAYLEAVES RECEIVED</th>
                    <th>TOTAL NO OF RESPONSE OUTSTANDING</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/permission/permission-wayleaves-status-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td></td>
                            <td>{{ $record->wayleaves_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->permissions_status }}</td>
                            <td>{{ $record->wl_osp_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->province }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            <td>{{ $record->wayleaves_submitted }}</td>
                            <td>{{ $record->wayleaves_estimated }}</td>
                            <td>{{ $record->exepected_wl_received_date }}</td>
                            <td>{{ $record->wayleaves_received }}</td>
                            <td>{{ $record->total_number_of_responses_oustanding }}</td>
                           
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