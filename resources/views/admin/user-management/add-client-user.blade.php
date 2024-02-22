@extends('admin.layouts.master')
 @section('content')

  <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.user-management.user-management-header')
            </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content service-add-content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary service-add">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
               
                @if(in_array('all', $edit_access['edit_access_type']))
                  <form method="POST" action="{{ route('admin.user-management.submit-new-client') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
                <div class="form-group">
               <div class="form-group">
                  <label for="last_name">Client Name</label>
                 
                 <select name="client_name" value="{{ old('client_name') }}" id="client_name" class="form-control @error('client_name') is-invalid @enderror">
                 <option value="">Please Select</option>
                  @foreach($records as $record)
                  <option value="{{ $record->name }}">{{ $record->name }}</option>
                 @endforeach   
                </select>
                  @error('client_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" value="" id="password" class="form-control  @error('password') is-invalid @enderror">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong> 
                    </span>  
                  @enderror 
               </div>
                <div class="row">
                  <div class="col-12"> 
                  @if(in_array('all', $edit_access['edit_access_type']))
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