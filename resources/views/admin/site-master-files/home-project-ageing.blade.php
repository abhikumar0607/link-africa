@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.site-master-files.sale-header')
            <div class="col-md-4">
            <form class="search" action="{{url('admin/sale/search')}}" method="GET" role="search">
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
              <!-- /.card-header -->
              <div class="card-body La-scroll">
                  <div class="delete_responce"></div>
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped" >
                  <thead>
                  <tr class="sticky">
                  <th>CIRCUIT ID</th>
                    <th>PLANNING STATUS</th>
                    <th>PERMISSION STATUS</th>
                    <th>BUILD STATUS</th>
                    <th>SERVICE DELIVERY STATUS</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
                    <th>DATENEW</th>
                    <th>SITE A</th>
                    <th>SITE B</th>
                    <th>SERVICE TYPE</th>
                    <th>ORDER REF NO</th>
                    <th>Region</th>
                    <th>CLIENT RING</th>
                    <th>PO NRC</th>
                    <th>PO MRC</th>
                    <th>VODACOM VCM</th>
                    <th>KAM Name</th>
                    <th>Feasibility Ref No</th>
                    <th>Network Types</th>
                    <th>Special Build NRC</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/sale/single-record',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>@if($record->planning_record) {{ $record->planning_record->planning_status }} @endif</td>
                            <td>@if($record->permission_record) {{ $record->permission_record->permissions_status }} @endif</td>
                            <td>@if($record->build_record) {{ $record->build_record->build_status }} @endif</td>
                            <td> {{ $record->service_delivery_status }}</td>
                            <td>{{ $record->metro_area }}</td>
                            <td>{{ $record->client_name }}</td> 
                            <td>@if($record->date_new) {{ Carbon\Carbon::parse($record->date_new)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->site_a }}</td>
                            <td>{{ $record->site_b }}</td>
                            <td>{{ $record->service_type }}</td>
                            <td>{{ $record->order_ref_number }}</td>
                            <td>{{ $record->region }}</td>
                            <td>{{ $record->client_ring }}</td>
                            <td>{{ $record->po_nrc }}</td>
                            <td>{{ $record->po_mrc }}</td>
                            <td>{{ $record->vodacom_vcw }}</td>
                            <td>{{ $record->kam_name }}</td>
                            <td>{{ $record->feasibility_ref_nr }}</td>
                            <td>{{ $record->network_types }}</td>
                            <td>{{ $record->special_build_nrc }}</td>
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