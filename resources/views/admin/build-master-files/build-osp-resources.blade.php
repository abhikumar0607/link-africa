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
                    <th>OSP PROJECT LEADER</th>
                    <th>REVISED BUILD COMPLETION DATE</th>
                    <th>OSP CIVIL CONTRACTOR</th>
                    <th>OSP JETTING CONTRACTOR</th>
                    <th>OSP RE INSTATEMENT CONTRACTOR</th>
                    <th>OSP DRILLING CONTRACTOR</th>
                    <th>OSP FLOATING CONTRACTOR</th>
                    <th>OSP FOCUS CONTRACTOR</th>
                    <th>PALNNED BUILD COMPLETION DATE</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/build/build-osp-resources-single',$record->id) }}">{{ $record->circuit_id }}</a></td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->project_status }} @endif</td>
                            <td>{{ $record->build_status }}</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->metro_area }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->client_name }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_a }} @endif</td>
                            <td>@if($record->site_master_record){{ $record->site_master_record->site_b }} @endif</td>
                            <td>{{ $record->osp_project_leader }}</td>
                            <td>{{ $record->revised_build_co_date }}</td>
                            <td>{{ $record->osp_civil_contractor }}</td>
                            <td>{{ $record->osp_jetting_contractor }}</td>
                            <td>{{ $record->osp_re_instatement_contractor }}</td>
                            <td>{{ $record->osp_drilling_contractor }}</td>
                            <td></td>
                            <td>{{ $record->osp_focus_contractor }}</td>
                            <td></td>
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