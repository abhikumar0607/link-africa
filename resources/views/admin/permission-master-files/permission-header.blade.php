<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/permission/dashboard') }}" class="nav-link">Permission Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/permission/dashboard'))
<div class="col-md-12">
@else
<div class="col-md-9">
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/permission/dashboard') ? 'active' : '' }}"><a href="{{url('admin/permission/dashboard')}}">Home</a></li>
       <li class="{{ request()->is('admin/permission/project-status') ? 'active' : '' }}"><a href="{{url('admin/permission/project-status')}}">Project Status</a></li>
      <li class="{{ request()->is('admin/permission/permission-status') ? 'active' : '' }}"><a href="{{url('admin/permission/permission-status')}}">Permission Status</a></li>
        <li class="{{ request()->is('admin/permission/permission-site-a') ? 'active' : '' }}"><a href="{{url('admin/permission/permission-site-a')}}">Site A</a></li>
          <li class="{{ request()->is('admin/permission/permission-site-b') ? 'active' : '' }}"><a href="{{url('admin/permission/permission-site-b')}}">Site B</a></li>
           <li class="{{ request()->is('admin/permission/permission-wayleaves-status') ? 'active' : '' }}"><a href="{{url('admin/permission/permission-wayleaves-status')}}">Wayleaves Status </a></li>
            <li class="{{ request()->is('admin/permission/permission-department-comment') ? 'active' : '' }}"><a href="{{url('admin/permission/permission-department-comment')}}">Department Comments</a></li>
             <li class="{{ request()->is('admin/permission/permission-project-comment') ? 'active' : '' }}"><a href="{{ url('admin/permission/permission-project-comment') }}">Project Comments</a></li>
             <li class="{{ request()->is('admin/permission-attachment') ? 'active' : '' }}"><a href="{{url('admin/permission-attachment')}}">Permission Attachment</a></li>
             <li class="{{ request()->is('admin/export/planning-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/planning-master-file')}}">Export Planning Master File</a></li>     
            </ul>
</div>
</div>
