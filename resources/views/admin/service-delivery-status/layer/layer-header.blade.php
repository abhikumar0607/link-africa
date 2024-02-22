<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/layer/all-list') }}" class="nav-link">Layer Dashboard</a>
     </li>
  </ul>
</nav>

<div class="col-md-8">
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/layer/all-list') ? 'active' : '' }}"><a href="{{url('admin/layer/all-list')}}">Home</a></li>
      <li class="{{ request()->is('admin/layer-attachment') ? 'active' : '' }}"><a href="{{url('admin/layer-attachment')}}">Layer Attachment</a></li>
  </ul>
</div>
</div>
