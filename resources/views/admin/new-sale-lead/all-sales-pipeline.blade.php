@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.site-master-files.sale-header')
            <!---<div class="col-md-4">
            <form class="search" action="{{url('admin/sale/search')}}" method="GET" role="search">
              <div class="form-group">
               <input type="text" class="form-control" name="keyword" placeholder="Search">
             </div>
             <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-submt">Submit</button>
            </div>
           </form>
           </div>--->

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
                    <th>Id</th>
                    <th>Date Intiated</th>
                    <th>Customer name</th>
                    <th>KAM</th>
                    <th>Segment</th>
                    <th>Province</th>
                    <th>Site Name</th>
                    <th>Lease Term Months</th>
                    <th>Expected close Month</th>
                    <th>Product</th>
                    <th>Estimated MRC</th>
                    <th>Expected Invoice Month</th>
                    <th>Sales Stage</th>
                    <th>Estimated NRC</th>
                    <th>Actual Closing Date</th>
                    <th>Probability</th>
                    <th>Actual Invoice Date</th>
                    <th>Actual Invoice Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            
                            <td><a href="{{ url('admin/sale-pipeline/single-record',$record->id) }}">{{ $record->id}}</a></td>
                            <td>@if($record->date_intiated) {{ Carbon\Carbon::parse($record->date_intiated)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->customer_name }}</td>
                            <td>{{ $record->kam }}</td>
                            <td>{{ $record->segment }}</td>
                            <td>{{ $record->province }}</td>
                            <td>{{ $record->site_name }}</td>
                            <td>{{ $record->lease_term_months }}</td>
                            <td>@if($record->expected_close_month) {{ Carbon\Carbon::parse($record->expected_close_month)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record['product'] }}</td>
                            <td>{{ $record->estimated_mrc }}</td>
                            <td>@if($record->expected_invoice_month) {{ Carbon\Carbon::parse($record->expected_invoice_month)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->sales_stage }}</td>
                            <td>{{ $record->estimated_nrc }}</td>
                            <td>@if($record->actual_closing_date) {{ Carbon\Carbon::parse($record->actual_closing_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->probability }}</td>
                            <td>@if($record->actual_invoice_date) {{ Carbon\Carbon::parse($record->actual_invoice_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->comments }}</td>
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