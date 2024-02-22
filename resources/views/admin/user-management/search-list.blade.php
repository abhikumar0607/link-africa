@extends('admin.layouts.master')
 @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.user-management.user-management-header')
            <div class="col-md-4">
            <form class="search" action="{{url('admin/user/search')}}" method="GET" role="search">
              <div class="form-group">
               <input type="text" class="form-control" name="keyword" placeholder="Search">
             </div>
             <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-submt">Submit</button>
            </div>
           </form>
           </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company Rule</th>
                    <th>Cost Centre</th>
                    <th>Department</th>
                    <th>Team</th>
                    <th>Status</th>
                    <th>Edit Access Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $count = 1; @endphp
                    @foreach($all_records as $user)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->company_rule }}</td>
                            <td>{{ $user->cost_centre }}</td>
                            <td>{{ $user->department }}</td>
                            <td>{{ $user->team }}</td>
                            <td>{{ $user->user_status }}</td>
                            <td>{{ $user->edit_form_access }}</td>
                           <td><a href="{{ url('admin/user-management/single-user',$user->id)}}">Edit</a> || <a href="{{ url('admin/user-management/delete-user',$user->id)}}">Delete</a></td>
                        </tr>
                        @php $count++; @endphp
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