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
    <section class="content customer-add-content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary customer-add">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                @if($edit_access['edit_access_type'] == 'all')
                  <form method="POST" action="{{ route('admin.submit.product.record') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" name="name" value="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="name">Product Type</label>
                 <input type="text" name="description" value="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="name">MTTR</label>
                  <input type="text" name="mttr" value="" class="form-control">
                </div>
                <div class="row">
                  <div class="col-12"> 
                    @if($edit_access['edit_access_type'] == 'all')
                      <input type="submit" value="Submit" class="btn btn-success">
                    @endif
                  </div>
                </div>
              </form>
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