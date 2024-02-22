@extends('support-dashboard.layouts.master')
@section('content')
<div class="figure-das">
   <div class="container-fluid">
      <div class="tickt-col">
         <div class="row">
            <div class="col-md-6">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Open Tickets</a> </li>
                  <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Close Tickets</a> </li>
                  @php 
                  $edit_access =  Helper::manage_edit_pages_access();
                  $is_department =  Helper::is_department_access();
                  @endphp
                    @if(in_array('all', $edit_access['edit_access_type']) OR  $is_department == 'IT')
                  <li class="nav-item"> <a class="nav-link"  aria-selected="false" href="{{ url('admin/export/ticket') }}">Export</a> </li>
                   @endif
               </ul>
               <div class="lat-tkt"><strong>Latest Tickets</strong></div>
            </div>
            <div class="col-md-6">
               <!--<div class="xpo-flax">
                  <div class="sal-search"><input class="form-control" type="text" placeholder="Search"></div>
                  <div class="toolbar">
                  <label>Sort by:</label> <select class="form-control">
                  			<option value="">Date Created</option>
                  			<option value="all">Export All</option>
                  			<option value="selected">Export Selected</option>
                  	</select>
                  </div>-->
            </div>
         </div>
      </div>
      <div class="tab-content dta-tackt" id="myTabContent">
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Names</th>
                           <th>Subjects</th>
                           <th>Status</th>
                           <th>Create Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($records as $record)
                        <tr data-href="{{ url('/single-ticket',Crypt::encryptString($record->ticket_id)); }}">
                           <th>#{{$record->ticket_id}}</a></th>
                           <td><img src="{{ URL::asset('public/admin/images/user-03.png') }}" alt="#" class="gridpic">
                              @if($record->user_name)
                              {{$record->user_name->name}}
                              @endif
                           </td>
                           <td>{{$record->subject}}</td>
                           <td><span  class="st-act">Open</span></td>
                           <td><time datetime="{{ date('Y-m-dTH:i', strtotime($record->created_at->toDateTimeString())) }}"> {{ $record->created_at->diffForHumans() }}</time></td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  {!! $records->links() !!}
               </div>
               <!-- /.table-responsive --> 
            </div>
         </div>
         <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="panel-body">
               <div class="panel-body">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Names</th>
                              <th>Subjects</th>
                              <th>Status</th>
                              <th>Create Date</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($records_closed as $record)
                           <tr data-href="{{ url('/single-ticket',Crypt::encryptString($record->ticket_id)); }}">
                              <th>#{{$record->ticket_id}}</a></th>
                              <td><img src="{{ URL::asset('/public/admin/images/user-03.png') }}" alt="#" class="gridpic">
                                 @if($record->user_name)
                                 {{$record->user_name->name}}
                                 @endif
                              </td>
                              <td>{{$record->subject}}</td>
                              <td><span  class="awai-act">Ticket Closed</span></td>
                              <td>{{date('Y-m-dTH:i', strtotime($record->created_at->toDateTimeString()))}}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <!-- /.table-responsive --> 
               </div>
            </div>
         </div>
      </div>
      <div class="pag-nav">
         <nav aria-label="Page navigation example">
            <ul class="pagination">
               <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a> </li>
               <li class="page-item"><a class="page-link" href="#">1</a></li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
            </ul>
         </nav>
      </div>
   </div>
</div>
</div>
@endsection