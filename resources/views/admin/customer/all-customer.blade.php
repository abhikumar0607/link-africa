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
        <div class="col-md-9">
          <div class="card card-primary customer-add">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                   
                @if(count($records) >=1 )
                <table class="table table-bordered table-striped" id="customer_table">
                  <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $count = 1; @endphp
                    @foreach($records as $user)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->contact_number }}</td>
                            <td>{{ $user->email }}</td>
                            
                           <td><a href="{{ url('admin/customer/delete', $user->id)}}">Delete</a></td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                  </tbody>
                </table>
               
           @else
            <h2> No Record Found</h2>
         @endif
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