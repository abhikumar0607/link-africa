@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.financial.financial-header')
            <div class="col-md-3">
            <form class="search" action="{{ url('admin/search-financial/record') }}" method="GET" role="search">
              <div class="form-group">
               <input type="text" class="form-control" name="keyword" placeholder="Search">
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
                    <th>CIRCUIT ID</th>
                    <th>PROJECT STATUS</th>
                    <th>PLANNING STATUS</th>
                    <th>BUILD STATUS</th>
                    <th>METRO/AREA</th>
                    <th>CLIENT NAME</th>
                    <th>DATENEW</th>
                    <th>SITE A</th>
                    <th>SITE B</th>
                    <th>SERVICE TYPE</th>
                    <th>ORDER REF NO</th>
                    <th>Region</th>
                    <th>CLIENT RING</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/single-financial',$record->circuit_id) }}">{{ $record->circuit_id }}</a></td>
                            <td>{{ $record->project_status }}</td>
                            <td>@if($record->planning_record) {{ $record->planning_record->planning_status }} @endif</td>
                            <td>@if($record->build_record) {{ $record->build_record->build_status }} @endif</td>
                            <td>{{ $record->metro_area }}</td>
                            <td>{{ $record->client_name }}</td> 
                            <td>@if($record->date_new) {{ Carbon\Carbon::parse($record->date_new)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->site_a }}</td>
                            <td>{{ $record->site_b }}</td>
                            <td>{{ $record->service_type }}</td>
                            <td>{{ $record->order_ref_number }}</td>
                            <td>{{ $record->region }}</td>
                            <td>{{ $record->client_ring }}</td>
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