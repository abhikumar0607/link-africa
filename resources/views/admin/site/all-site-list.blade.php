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
    <section class="content">
      <div class="row">
        <div class="col-md-12">
              <!-- /.card-header -->
              <div class="row">
              <div class="col-md-6">
              <div class="card-body La-scroll">
                  <div class="delete_responce"></div>
                @if(count($site_a_records) >=1 )
                <table class="table table-bordered table-striped" id="site_a_table">
                  <thead>
                  <tr class="sticky">
                    <th>SITE A NAME</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($site_a_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/site/edit-page', $record->id) }}">{{ $record->site_name }}</a></td>
                        </tr>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                	<h2>No Records Found</h2>
                @endif
            </div>
           </div>
            <!-- /.card-body -->
             <!-- /.card-header -->
             <div class="col-md-6">
              <div class="card-body La-scroll">
                  <div class="delete_responce"></div>
                @if(count($site_b_records) >=1 )
                <table class="table table-bordered table-striped" id="site_b_table">
                  <thead>
                  <tr class="sticky">
                    <th>SITE B NAME</th>  
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($site_b_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/site/edit-page', $record->id) }}">{{ $record->site_name }}</a></td>    
                        </tr>
                    @endforeach
                  </tbody>
                </table>            
                @else
                	<h2>No Records Found</h2>
                @endif
            </div>
           </div>
            <!-- /.card-body -->
          <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection