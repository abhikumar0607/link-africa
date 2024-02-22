<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/planning/dashboard') }}" class="nav-link">Planning Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/planning/dashboard') || request()->is('admin/planning/landlord-approval/id') || request()->is('admin/planning/site-survey'))
<div class="col-md-12">
@else
<div class="col-md-9">
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/planning/dashboard') ? 'active' : '' }}"><a href="{{url('admin/planning/dashboard')}}">Home</a></li>
      <li class="{{ request()->is('admin/planning/project-status') ? 'active' : '' }}"><a href="{{url('admin/planning/project-status')}}">Project Status</a></li>
      {{--<li class="{{ request()->is('admin/planning/planning-status') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-status')}}">Planning Status</a></li>-}}
      <li class="{{ request()->is('admin/planning/planning-date') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-date')}}">Planning Dates</a></li>
      {{--<li class="{{ request()->is('admin/planning/planning-resource') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-resource')}}">Planning Resources</a></li>--}}
      {{--<li class="{{ request()->is('admin/planning/planning-isp-a') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-isp-a')}}">ISP A</a></li>--}}
      {{--<li class="{{ request()->is('admin/planning/planning-isp-b') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-isp-b')}}">ISP B</a></li>--}}
      <li class="{{ request()->is('admin/planning/planning-total-project-cost') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-total-project-cost')}}">Total Project Cost</a></li>
      <li class="">
      <button class="custom-btn" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="dropdown1">Material Service<span class="arrow"></span></button>
      <ul class="dropdown" id="dropdown1">
      <li><a href="{{url('admin/planning/planning-material-service-isp-a')}}">Material Service ISP A</a></li>
      <li><a href="{{url('admin/planning/planning-material-service-isp-b')}}">Material Service ISP B</a></li>
      <li><a href="{{url('admin/planning/planning-material-service-osp')}}">Material Service OSP</a></li> 
      </ul>
      </li>
      <li class="{{ request()->is('admin/planning/planning-department-comment') ? 'active' : '' }}"><a href="{{url('admin/planning/planning-department-comment')}}">Department Comments</a></li>
      <li class="{{ request()->is('admin/planning/la-pop/all-record') ? 'active' : '' }}"><a href="{{url('admin/planning/la-pop/all-record')}}">LA_POP</a></li>
      <li class=""><a href="#">Master File Lead Times</a></li>
      <li class="{{ request()->is('admin/planning/site-survey-list') ? 'active' : '' }}"><a href="{{url('admin/planning/site-survey-list')}}">Site Survey Records</a></li>
      <li class="{{ request()->is('admin/planning/landlord-approval-list') ? 'active' : '' }}"><a href="{{url('admin/planning/landlord-approval-list')}}">Landlord Approval Records</a></li>
      <li class="{{ request()->is('admin/planning-attachment') ? 'active' : '' }}"><a href="{{url('admin/planning-attachment')}}">Planning Attachment</a></li>
      <li class="{{ request()->is('admin/export/planning-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/planning-master-file')}}">Export Planning Master File</a></li>
      <li class="{{ request()->is('admin/export/total-project-cost-report') ? 'active' : '' }}"><a href="{{url('admin/export/total-project-cost-report')}}">Export Total Project Cost File</a></li>
   </ul>
</div>
</div>
