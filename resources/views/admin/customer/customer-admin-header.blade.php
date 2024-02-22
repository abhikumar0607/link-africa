<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/all-customer') }}" class="nav-link">Client Dashboard</a>
     </li>
  </ul>
</nav>

<div class="col-md-6">
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/all-customer-record') ? 'active' : '' }}"><a href="{{url('admin/all-customer-record')}}">Home</a></li>
      <li class="{{ request()->is('admin/client-map') ? 'active' : '' }}"><a href="{{url('admin/client-map')}}">Map</a></li>
      <li class="{{ request()->is('admin/export/client-report') ? 'active' : '' }}"><a href="{{url('admin/export/client-report')}}">Export Clients</a></li>
  </ul>
</div>
</div>
