<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/history-management/dashboard') }}" class="nav-link">History Management Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/history-management/dashboard') || request()->is('admin/history-management/history-list'))
    <div class="col-md-8">
@else
    <div class="col-md-8">
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/history-management/dashboard') ? 'active' : '' }}"><a href="{{url('admin/history-management/dashboard')}}">Home</a></li>
      <li class="{{ request()->is('admin/history-management/history-list') ? 'active' : '' }}"><a href="{{url('admin/history-management/history-list')}}">History List</a></li>
  </ul>
</div>
</div>
