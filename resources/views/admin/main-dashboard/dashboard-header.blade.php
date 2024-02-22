<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/sale/dashboard') }}" class="nav-link">Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/sale/dashboard') || request()->is('admin/toc-monthly-dashboard') || request()->is('admin/toc-monthly-dashboard') || request()->is('admin/date-new-monthly-dashboard') || request()->is('admin/monthly-duration-dashboard') || request()->is('admin/project-status-duration-dashboard'))
<div class="col-md-12">
@else
<div class="col-md-12">
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/sale/dashboard') ? 'active' : '' }}"><a href="{{url('admin/sale/dashboard')}}">Home</a></li>
      <li class="{{ request()->is('admin/toc-monthly-dashboard') ? 'active' : '' }}"><a href="{{ url('admin/toc-monthly-dashboard') }}">Show Me The Money Dashboard</a></li>
      <li class="{{ request()->is('admin/toc-received-monthly-dashboard') ? 'active' : '' }}"><a href="{{ url('admin/toc-received-monthly-dashboard') }}">TOC Received Monthly Dashboard</a></li>
      <li class="{{ request()->is('admin/monthly-duration-dashboard') ? 'active' : '' }}"><a href="{{url('admin/monthly-duration-dashboard')}}">Monthly Project Duration</a></li>
     <li class="{{ request()->is('admin/project-status-duration-dashboard') ? 'active' : '' }}"><a href="{{url('admin/project-status-duration-dashboard')}}">Status Project Duration</a></li>
     <li class="{{ request()->is('admin/monthly-kam-name-dashboard') ? 'active' : '' }}"><a href="{{url('admin/monthly-kam-name-dashboard')}}">Monthly New Sales Record</a></li>
     <li class="{{ request()->is('admin/big-deal-dashboard') ? 'active' : '' }}"><a href="{{url('admin/big-deal-dashboard')}}">Big Deals Dashboard</a></li>
   </ul>
</div>
</div>
