@extends('admin.layouts.master')
 @section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('admin.planning-master-files.planning-header')
               <div class="col-md-3">
                 <form class="search" action="{{url('admin/planning/search/site/survey')}}" method="GET" role="search">
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
                    <th>Circuit ID</th>
                    <th>PROJECT STATUS</th>
                    <th>DATE PO ORDER Rx</th>
                    <th>CLIENT RING</th>
                    <th>METRO AREA</th>
                    <th>PLANNING STATUS</th>
                    <th>SERVICE TYPE</th>
                    <th>PROJECT ID</th>
                    <th>ORDER REF NO</th>
                    <th>CLIENT NAME</th>
                    <th>PROVINCE</th>
                    <th>BUILD STATUS</th>
                    <th>TYPE</th>
                    <th>SITE SURVEY STATUS</th>
                    <th>LINK DEPENDENCY</th>
                    <th>SITE A</th>
                    <th>SITE A STATUS</th>
                    <th>SITE A LLA SUBMITTED</th>
                    <th>SITE A LLA ESTIMATED</th>
                    <th>SITE A LLA RECEIVED</th>
                    <th>OVERDUE A</th>
                    <th>LLA DUR SITEA</th>
                    <th>CONTACT NAME-SITE A/th>
                    <th>PHYSICAL ADDRESS-SITE A</th>
                    <th>WORK NUMBER-SITE A</th>
                    <th>MOBILE NUMBER-SITE A</th>
                    <th>EMAIL ADDRESS-SITE A</th>
                    <th>SITE B</th>
                    <th>SITE B STATUS</th>
                    <th>SITE B LLA SUBMITTED</th>
                    <th>SITE B LLA ESTIMATED</th>
                    <th>SITE B LLA RECEIVED</th>
                    <th>OVERDUE B</th>
                    <th>LLA DUR SITEB</th>
                    <th>PHYSICAL ADDRESS-SITE B</th>
                    <th>CONTACT NAME-SITE B</th>
                    <th>WORK NUMBER-SITE B</th>
                    <th>MOBILE NUMBER-SITE B</th>
                    <th>EMAIL ADDRESS-SITE B</th>
                    <th>COMMENT</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/planning/site-survey',$record->circuit_id) }}">{{ $record->service_id }}</a></td>
                            <td>{{ $record->circuit_id }}</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->project_status }} @endif</td>
                            <td>@if($record->site_master_record){{ Carbon\Carbon::parse($record->date_po_order_rx)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->client_ring }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->metro_area }} @endif</td>
                            <td>{{ $record->planning_status }}</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->service_type }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->project_id }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->order_ref_number }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->client_name }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->province }} @endif</td>
                            <td>@if($record->build_record) {{ $record->build_record->build_status }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->type }} @endif</td>
                            <td></td>
                            <td>{{ $record->link_dependency }}</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->site_a }} @endif</td>
                            <td>{{ $record->site_a_status }}</td>
                            <td>@if($record->permission_record) {{ $record->permission_record->site_a_lla_submitted }} @endif</td>
                            <td>@if($record->permission_record) {{ $record->permission_record->site_a_lla_estimated }} @endif</td>
                            <td>@if($record->permission_record) {{ $record->permission_record->site_a_lla_received }} @endif</td>
                            <td></td>
                            <td></td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->contact_name_site_a }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->physical_address_site_a }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->work_number_site_a }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->mobile_number_site_a }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->email_address_site_a }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->site_b }} @endif</td>
                            
                            <td>{{ $record->site_b_status }}</td>
                            
                            <td>@if($record->permission_record) {{ $record->permission_record->site_b_lla_submitted }} @endif</td>
                            <td>@if($record->permission_record) {{ $record->permission_record->site_b_lla_estimated }} @endif</td>
                            <td>@if($record->permission_record) {{ $record->permission_record->site_b_lla_received }} @endif</td>
                            <td></td>
                            <td></td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->physical_address_site_b }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->contact_name_site_b }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->work_number_site_b }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->mobile_number_site_b }} @endif</td>
                            <td>@if($record->site_master_record) {{ $record->site_master_record->email_address_site_b }} @endif</td>
                            <td>{{ $record->comment }}</td>                                                    
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