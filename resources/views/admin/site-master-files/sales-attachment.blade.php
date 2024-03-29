@extends('admin.layouts.master')
 @section('content')
   <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.site-master-files.sale-header')

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
                @if(count($sales_attachment) >=1 )
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                <table class="table table-bordered table-striped" id="customDataTable" >
                  <thead>
                  <tr class="sticky">
                    <th>CIRCUIT ID</th>
                    <th>Name</th>
                    <th>Attachment Name</th>
                    <th>Page Type</th>
                    <th>Type</th>
                    <th>File Name</th>
                    @if(in_array('all', $edit_access['edit_access_type']))
                     <th>Action</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($sales_attachment as $record)
                        <tr>
                            <td>{{ $record->circuit_id }}</td>
                            <td>{{ $record->name }}</td>
                            <td><a href="{{ url('admin/download-attachment', $record->id) }}"><i class="fa fa-file" aria-hidden="true"></i> &nbsp; View Attachment</a></td>
                            <td>{{ $record->page_type }}</td>
                            <td>{{ $record->form_type }}</td>
                            <td>{{ $record->attachment_name }}</td>
                            @if(in_array('all', $edit_access['edit_access_type']))
                             <td><a href="{{ url('admin/delete/attachment', $record->id) }}">Delete</a></td>
                            @endif
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                	<h2>No Attachment Found</h2>
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