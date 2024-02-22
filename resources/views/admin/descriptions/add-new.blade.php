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
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-body">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
              @if(in_array('all', $edit_access['edit_access_type']))
                  <form method="POST" action="{{ route('admin.submit.description') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
                <div class="form-group">
                  <label for="description">New Description</label>
                  <input type="text" name="description" value="" class="form-control @error('description') is-invalid @enderror">
                  @error('description') 
                    <span class="invalid-feedback" role="alert"> 
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                  <div class="col-12"> 
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']))
                      <input type="submit" value="Submit" class="btn btn-success  ">
                    @endif
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection