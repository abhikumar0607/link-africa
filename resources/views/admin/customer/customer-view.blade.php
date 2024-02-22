@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.customer.customer-header')
            <div class="col-md-4">
            <form class="search" action="{{url('admin/customer/record')}}" method="GET" role="search">
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
                    <th>SERVICE ID</th>
                    <th>PROJECT STATUS</th>
                    <th>CLIENT NAME</th>
                    <th>SITE A</th>
                    <th>SITE B</th>
                    <th>PROVINCE</th>
                    <th>SERVICE TYPE</th>
                    <th>DATE NEW</th>
                    <th>DATE SITE SURVEY</th>
                    <th>DATE SUBMITTED FOR LANDLORD</th>
                    <th>DATE LANDLORD APPROVAL RECEIVED</th>
                    <th>EST.COMPLETION DATE</th>
                    <th>PLANNED BUILD COMPLETION DATE</th>
                    <th>SERVICE DELIVERY COMMENTS</th>
                    <th>RESPONSIBLE</th>
                    <th>COMMENT</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                        <td><a href="{{ url('admin/single-customer/detail',$record->id ) }}">{{ $record->service_id }}</a></td>
                            <td>{{ $record->project_status }}</td>
                            <td>{{ $record->client_name }}</td>
                            <td>{{ $record->site_a }}</td>
                            <td>{{ $record->site_b }}</td>
                            <td>{{ $record->province }}</td>
                            <td>{{ $record->service_type }}</td>
                            <td>@if($record->date_new){{ Carbon\Carbon::parse($record->date_new)->format('m/d/Y') }}@endif</td>
                            <td>@if($record->site_survey_record){{ Carbon\Carbon::parse($record->site_survey_record->date_site_survey)->format('d/m/Y') }}@endif</td>
                            <td>@if($record->landlord_record){{ Carbon\Carbon::parse($record->landlord_record->date_submit_for_landlord)->format('d/m/Y') }}@endif</td>
                            <td>@if($record->landlord_record){{ Carbon\Carbon::parse($record->landlord_record->date_landlord_approval)->format('d/m/Y') }}@endif</td>
                            <td>{{ $est_complition_date ?? '' }}</td>
                            <td>@if($record->build_record->planned_build_completion_date) {{ Carbon\Carbon::parse($record->build_record->planned_build_completion_date)->format('d/m/Y') }} @endif</td>
                            <td>{{ $record->service_delivery_comments }}</td>
                            <td></td>
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