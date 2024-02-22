<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/customer/detail') }}" class="nav-link">Client Dashboard</a>
     </li>
  </ul>
</nav>

<div class="col-md-6">
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/customer/detail') ? 'active' : '' }}"><a href="{{url('admin/customer/detail')}}">Home</a></li>
      <li class="{{ request()->is('customer-map') ? 'active' : '' }}"><a href="{{url('customer-map')}}">Map</a></li>
      <li class="{{ request()->is('admin/export/single-client-report') ? 'active' : '' }}"><a href="{{url('admin/export/single-client-report')}}">Export Client Report</a></li>

  </ul>
</div>
</div>
