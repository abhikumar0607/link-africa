<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/export/dashboard') }}" class="nav-link">Report Dashboard</a>
     </li>
  </ul>
</nav>
@if( request()->is('admin/export/dashboard') || request()->is('admin/export/project-ageing') || request()->is('admin/export/la-sale-report') || request()->is('admin/export/open-book-report') || request()->is('admin/export/vs-report') ? 'menu-open active' : '')
    <div class="col-md-12">
@else
    <div class="col-md-8">
@endif
@if (session('success'))
  <p class="alert alert-success">{{ session('success') }}</p>
@endif
@if (session('unsuccess'))
    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/export/dashboard') ? 'active' : '' }}"><a href="{{url('admin/export/dashboard')}}">Home</a></li>
      <li class="{{ request()->is('admin/export/o2cap-report-download') ? 'active' : '' }}"><a href="{{url('admin/export/o2cap-report-download')}}">O2cap Reports</a></li>
      <li class="{{ request()->is('admin/export/nrc-report') ? 'active' : '' }}"><a href="{{url('admin/export/nrc-report')}}">Nrc Reports</a></li>
      <li class="{{ request()->is('admin/export/mrc-report') ? 'active' : '' }}"><a href="{{url('admin/export/mrc-report')}}">Mrc Reports</a></li>
      <li class="{{ request()->is('admin/export/older-records-report') ? 'active' : '' }}"><a href="{{url('admin/export/older-records-report')}}">90 Days Older Reports</a></li>
      <li class="{{ request()->is('admin/export/project-ageing') ? 'active' : '' }}"><a href="{{url('admin/export/project-ageing')}}">Project Ageing Report</a></li>
      <li class="{{ request()->is('admin/export/order-management-report') ? 'active' : '' }}"><a href="{{url('admin/export/order-management-report')}}">Show Me The Money</a></li>
      <li class="{{ request()->is('admin/export/la-sale-report') ? 'active' : '' }}"><a href="{{url('admin/export/la-sale-report')}}">LA Sale Report</a></li>
      <li class="{{ request()->is('admin/export/open-book-report') ? 'active' : '' }}"><a href="{{ url('admin/export/open-book-report') }}">Open Book Report</a></li>
      <li class="{{ request()->is('admin/export/vs-report') ? 'active' : '' }}"><a href="{{url('admin/export/vs-report')}}">Vc Reports</a></li>
      @if (Auth::user()->user_type == "Super_Admin")
		   <li class="{{ request()->is('admin/export/site-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/site-master-file')}}">Export Site Master File</a></li>
		   <li class="{{ request()->is('admin/export/planning-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/planning-master-file')}}">Export Planning Master File</a></li>
		   <li class="{{ request()->is('admin/export/permission-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/permission-master-file')}}">Export Permission Master File</a></li>
		   <li class="{{ request()->is('admin/export/build-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/build-master-file')}}">Export Build Master File</a></li>
       <li class="{{ request()->is('admin/export/client-report') ? 'active' : '' }}"><a href="{{url('admin/export/client-report')}}">Export Client File</a></li>
       <li class="{{ request()->is('admin/export/layer-report') ? 'active' : '' }}"><a href="{{url('admin/export/layer-report')}}">Export Layer File</a></li>
       <li class="{{ request()->is('admin/export/monthly-new-sale-report') ? 'active' : '' }}"><a href="{{url('admin/export/monthly-new-sale-report')}}">Export Monthly New Sale</a></li>
		   <?php
       //Call helper
       $check_website_status = Helper::check_website_status();
       if($check_website_status->site_status == "Down") { ?>
        <li class="{{ request()->is('admin/export/disable-comming-soon') ? 'active' : '' }}"><a href="{{url('admin/export/disable-comming-soon')}}">Disable Comming Soon</a></li>
       <?php } else { ?>
		   <li class="{{ request()->is('admin/export/enable-comming-soon') ? 'active' : '' }}"><a href="{{url('admin/export/enable-comming-soon')}}">Enable Comming Soon</a></li>
       <?php } ?>
      @endif 
  </ul>
</div>
</div>
