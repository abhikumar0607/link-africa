@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.history-management.header')
        <div class="col-md-4">
            <form class="search" action="{{ route('history.management.search') }}" method="GET" role="search">
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
               @if(count($all_record) >=1 )
                <table class="table table-bordered table-striped" id="">
                  <thead>
                  <tr class="sticky">
                    <th>ID</th>
                  <th>SERVICE ID</th>
                    <th>EDITOR NAME</th>
                    <th>MODULE NAME</th>
                    <th>Fields</th>
                    <th>Values</th>
                    <th>VIEW PAGE</th> 
                    <th>EDITED AT</th> 
                  </tr>
                  </thead>
                  <tbody>
                  @php
                     $count = 1;
                    @endphp
                 @foreach($all_record as $record)
                 
                        <tr>
                          <td>{{ $record->id }}</td>
                            <td><a href="{{ url($record->page_name) }}" target="_blank">{{ $record->service_id }} </a></td>
                            <td>@if($record->user_list){{  $record->user_list->name }}@endif</td>
                            <td>{{  $record->module_name }}</td>
                            <td style="text-transform: uppercase !important;">{{  $record->field }}</td>
                            <td>{{  $record->value }}</td>
                            <td><a href="{{ $record->page_name }}" target="_blank">Detail Page</a></td>
                            <td>{{  $record->updated_at }}</td>                         
                        </tr>
                    @php $count++; @endphp    
                 @endforeach
                  </tbody>
                </table>
                <div class="pagination">
                {{ $all_record->links() }}
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