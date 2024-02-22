@extends('admin.layouts.master')
 @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          @include('admin.dropdown-managment.dropdown-header')
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
            <div class="card">
            <button type="button" class="btn btn-default drop-down-management" data-toggle="modal" data-target="#project_type">
                  Add New
                </button>
              <!-- /.card-header -->
              <div class="card-body">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped" id="customDataTable">
                  <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Project Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $count = 1; @endphp
                    @foreach($all_records as $records)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $records->project_type }}</td>
                        @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                        @if(in_array('all', $edit_access['edit_access_type']))  
                           <td><a href="{{ url('admin/project-type/delete',$records->id) }}">Delete</a></td>
                        @else
                            <td><a href="#">Delete</a></td>
                        @endif   
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                  </tbody>
                </table>
                @else
                	<h2>No Records Found</h2>
                @endif
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
    <!---kam-name--->

    <div class="modal fade" id="project_type">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Project Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
            @if(in_array('all', $edit_access['edit_access_type']))
               <form method="POST" action="{{ url('admin/project-type/submit') }}" enctype="multipart/form-data">
            @csrf
            @else
                <form method="POST" action="#" enctype="multipart/form-data">
            @endif 
                <div class="form-group">
                  <label for="service_name">Project Type</label>
                  <input type="text" name="project_type" value="{{ old('project_type') }}" class="form-control @error('project_type') is-invalid @enderror">
                  @error('project_type')
                    <span class="invalid-feedback" role="alert"> 
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                  <div class="col-12"> 
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']))
                      <input type="submit" value="Submit" class="btn btn-success">
                  @endif 
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <!-- /.content-wrapper -->
 @endsection