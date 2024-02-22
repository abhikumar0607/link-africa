<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/build/dashboard') }}" class="nav-link">Build Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/build/dashboard'))
<div class="col-md-12">
@else
	<div class="col-md-9">
@endif
    <div class="top-nav-menu">
      <ul>
          <li class="{{ request()->is('admin/build/dashboard') ? 'active' : '' }}"><a href="{{url('admin/build/dashboard')}}">HOME</a></li>
          {{--<li class=""><a href="#">CAPACITY</a></li>--}}
          <li class="{{ request()->is('admin/build/build-status-page') ? 'active' : '' }}"><a href="{{url('admin/build/build-status-page')}}">BUILD STATUS</a></li>
          {{--<li class="{{ request()->is('admin/build/build-date-page') ? 'active' : '' }}"><a href="{{url('admin/build/build-date-page')}}">BUILD DATE</a></li>
          <li class="{{ request()->is('admin/build/build-osp-resources') ? 'active' : '' }}"><a href="{{url('admin/build/build-osp-resources')}}">OSP RESOURCES</a></li>
          <li class="{{ request()->is('admin/build/build-isp-a-resources') ? 'active' : '' }}"><a href="{{url('admin/build/build-isp-a-resources')}}">ISP A RESOURCES</a></li>
          <li class="{{ request()->is('admin/build/build-isp-b-resources') ? 'active' : '' }}"><a href="{{url('admin/build/build-isp-b-resources')}}">ISP B RESOURCES</a></li>
          <li class="{{ request()->is('admin/build/build-po-vo-resources') ? 'active' : '' }}"><a href="{{url('admin/build/build-po-vo-resources')}}">BUILD PO_VO STATUS</a></li>
          <li class="{{ request()->is('admin/build/build-complete') ? 'active' : '' }}"><a href="{{url('admin/build/build-complete')}}">BUILD % COMPLETE</a></li>
          <li class="{{ request()->is('admin/build/as-build-otoc') ? 'active' : '' }}"><a href="{{url('admin/build/as-build-otoc')}}">AS BUILD_OTOC</a></li>--}}
          <li class="{{ request()->is('admin/build/project-cost') ? 'active' : '' }}"><a href="{{url('admin/build/project-cost')}}">PROJECT COST</a></li>

          <li class="">
      <button class="custom-btn" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="dropdown1">Material Service<span class="arrow"></span></button>
      <ul class="dropdown" id="dropdown1">
         <li><a href="{{url('admin/build/material-service-isp-a')}}">MATERIAL SERVICE ISP A TABLE</a></li>
          <li><a href="{{url('admin/build/material-service-isp-b')}}">MATERIAL SERVICE ISP B TABLE</a></li>
          <li><a href="{{url('admin/build/material-service-isp-osp')}}">MATERIAL SERVICE ISP OSP TABLE</a></li>
      </ul>
      </li>

         
          <li class="{{ request()->is('admin/build/department-comment') ? 'active' : '' }}"><a href="{{url('admin/build/department-comment')}}">DEPARTMENT COMMENT</a></li>
          <li class="{{ request()->is('admin/build-attachment') ? 'active' : '' }}"><a href="{{url('admin/build-attachment')}}">Build Attachment</a></li>
          <li class="{{ request()->is('admin/export/planning-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/planning-master-file')}}">Export Planning Master File</a></li>
        </ul>
    </div>
</div>
