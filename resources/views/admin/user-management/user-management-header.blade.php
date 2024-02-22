<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/user-management/all-users') }}" class="nav-link">User Management Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/user-management/all-users') || request()->is('admin/user-management/add-new') || request()->is('admin/user/search'))
    <div class="col-md-8">
@else
    <div class="col-md-12">
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/user-management/all-users') ? 'active' : '' }}"><a href="{{url('admin/user-management/all-users')}}">All Users</a></li>
      <li class="{{ request()->is('admin/user-management/add-new') ? 'active' : '' }}"><a href="{{url('admin/user-management/add-new')}}">Add New User</a></li>
      <li class="{{ request()->is('admin/export/users') ? 'active' : '' }}"><a href="{{url('admin/export/users')}}">Export User</a></li>
      <li class="{{ request()->is('admin/reset/password') ? 'active' : '' }}"><a href="{{url('admin/reset/password')}}">Reset-Password</a></li>
	  <li class="{{ request()->is('admin/user-management/add-new-client') ? 'active' : '' }}"><a href="{{ url('admin/user-management/add-new-client') }}">Add Client As User</a></li>
  </ul>
</div>
</div>
