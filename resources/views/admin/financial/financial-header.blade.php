<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/financial-all-list') }}" class="nav-link">Finance Dashboard</a>
     </li>
  </ul>
</nav>

<div class="col-md-8">
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/financial-all-list') ? 'active' : '' }}"><a href="{{url('admin/financial-all-list')}}">Home</a></li>
      <li class="{{ request()->is('admin/financial-attachment') ? 'active' : '' }}"><a href="{{url('admin/financial-attachment')}}">Financial Attachment</a></li>
      <li class="{{ request()->is('admin/export/prjoect-approval-report-download') ? 'active' : '' }}"><a href="{{url('admin/export/prjoect-approval-report-download')}}">Project Approval Report</a></li>
  </ul>
</div>
</div>