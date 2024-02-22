@extends('admin.layouts.master')
 @section('content')
 
 <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.build-master-files.build-header')
            </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content customer-add-content">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary customer-add">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                @if(in_array('all', $edit_access['edit_access_type']))
                  <form method="post" action="{{ route('admin.build.submit.import.records') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
                <div class="form-group">
                  <label for="import_file">Import File</label>
                  <input type="file" name="import_file" value="" class="form-control @error('import_file') is-invalid @enderror">
                  @error('import_file')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                  <div class="col-12"> 
                  @if(in_array('all', $edit_access['edit_access_type']))
                      <input type="submit" value="Submit" class="btn btn-success  ">
                    @endif
                  </div>
                </div>
              </form>
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