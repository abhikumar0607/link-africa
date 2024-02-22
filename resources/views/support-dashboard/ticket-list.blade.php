@extends('support-dashboard.layouts.master')
@section('content')
<div class="figure-das">
  <div class="container-fluid">
    <div class="tickt-col">
	
	<div class="row">
    <div class="col-md-6">  <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Open Tickets</a> </li>
        <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Close Tickets</a> </li>
      </ul>
      <div class="lat-tkt"> Latest Tickets <strong>(Showing 01 to 10 of 10 Tickets)</strong></div>
	</div>
	<div class="col-md-6">
	
	<div class="xpo-flax">
	<div class="sal-search"><input class="form-control" type="text" placeholder="Search"></div>
	<div class="toolbar">
	<label>Sort by:</label> <select class="form-control">
				<option value="">Date Created</option>
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
		</select>
</div>

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
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Alone Guy</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-02.png')}}" alt="#" class="gridpic"> John Doe</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Andre</td>
                    <td><span class="awai-actv">Lorem Ipsum is simply dummy text...</span></td>
                    <td><span  class="awai-act">Awaiting Reply</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-02.png')}}" alt="#" class="gridpic"> John Doe</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Andre</td>
                    <td><span class="awai-actv">Lorem Ipsum is simply dummy text...</span></td>
                    <td><span  class="awai-act">Awaiting Reply</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Andre</td>
                    <td><span class="awai-actv">Lorem Ipsum is simply dummy text...</span></td>
                    <td><span  class="awai-act">Awaiting Reply</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="panel-body">  <div class="panel-body">
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
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Alone Guy</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-02.png')}}" alt="#" class="gridpic"> John Doe</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Andre</td>
                    <td><span class="awai-actv">Lorem Ipsum is simply dummy text...</span></td>
                    <td><span  class="awai-act">Awaiting Reply</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Andre</td>
                    <td><span class="awai-actv">Lorem Ipsum is simply dummy text...</span></td>
                    <td><span  class="awai-act">Awaiting Reply</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-03.png')}}" alt="#" class="gridpic"> Andre</td>
                    <td><span class="awai-actv">Lorem Ipsum is simply dummy text...</span></td>
                    <td><span  class="awai-act">Awaiting Reply</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                  <tr>
                    <th>#5C2F94</th>
                    <td class="sorting_1"><img  src="{{URL::asset('/public/admin/images/user-01.png')}}" alt="#" class="gridpic"> Junior</td>
                    <td>Lorem Ipsum is simply dummy text...</td>
                    <td><span  class="st-act">Open</span></td>
                    <td>Mon, 06 Feb 2022 9:36 am</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div> </div>
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