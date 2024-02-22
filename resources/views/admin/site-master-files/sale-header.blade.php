<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/sale/dashboard') }}" class="nav-link">Sale Dashboard</a>
     </li>
  </ul>
</nav>
@if(request()->is('admin/sale/dashboard') || request()->is('admin/site/add-new') || request()->is('admin/sale/add-new-sale') || request()->is('admin/service-type/add-new') || request()->is('admin/customer/add-new') || request()->is('admin/sale/add-new-record'))
<div class="col-md-12">
@else
<div class="col-md-8">
@endif
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/sale/dashboard') ? 'active' : '' }}"><a href="{{url('admin/sale/dashboard')}}">Home</a></li>
      {{--<li class="{{ request()->is('admin/sale/all-new-sale') ? 'active' : '' }}"><a href="{{url('admin/sale/all-new-sale')}}">Sales Pipeline</a></li>--}}
      <li class="{{ request()->is('admin/sale/all-list') ? 'active' : '' }}"><a href="{{url('admin/sale/all-list')}}">LA Projects</a></li>
      <li class="{{ request()->is('admin/department-comments') ? 'active' : '' }}"><a href="{{ url('admin/department-comments') }}">Department Comments</a></li>
      <li class="{{ request()->is('admin/site/all-listing') ? 'active' : '' }}"><a href="{{url('admin/site/all-listing')}}">LA Sites</a></li>
      <li class="{{ request()->is('admin/site/add-new') ? 'active' : '' }}"><a href="{{url('admin/site/add-new')}}">Add New LA Sites</a></li>
      <li class="{{ request()->is('admin/pending-cts/all-list') ? 'active' : '' }}"><a href="{{ url('admin/pending-cts/all-list') }}">Pending CTS</a></li>
      <li class="{{ request()->is('admin/sales-attachment') ? 'active' : '' }}"><a href="{{url('admin/sales-attachment')}}">Sales Attachment</a></li>
      {{--<li class="{{ request()->is('admin/sale/add-new-sale') ? 'active' : '' }}"><a href="{{url('admin/sale/add-new-sale')}}">New Sales Lead</a></li>--}}
      {{--<li class="{{ request()->is('admin/sale/import-records') ? 'active' : '' }}"><a href="{{url('admin/sale/import-records')}}">Import New Sale</a></li>--}}
      {{--<li class="{{ request()->is('admin/description/add-new') ? 'active' : '' }}"><a href="{{url('admin/description/add-new')}}">Add New Description</a></li> --}}
      @if (Auth::user()->user_type == "Super_Admin")
         <li class="{{ request()->is('admin/service-type/add-new') ? 'active' : '' }}"><a href="{{url('admin/service-type/add-new')}}">New Service Type</a></li>
         <li class="{{ request()->is('admin/customer/add-new') ? 'active' : '' }}"><a href="{{url('admin/customer/add-new')}}">New Customer</a></li>
         <li class="{{ request()->is('admin/all/customer') ? 'active' : '' }}"><a href="{{url('admin/all/customer')}}">All Customer</a></li>
         <li class="{{ request()->is('admin/description/add-new') ? 'active' : '' }}"><a href="{{url('admin/description/add-new')}}">New Description</a></li> 
         <li class="{{ request()->is('admin/export/solid-data-report') ? 'active' : '' }}"><a href="{{url('admin/export/solid-data-report')}}">Solid Data Report</a></li>           
      @endif 
      <li class="{{ request()->is('admin/sale/add-new-record') ? 'active' : '' }}"><a href="{{url('admin/sale/add-new-record')}}">Load LA Purchase Order</a></li>
      <li class="{{ request()->is('admin/export/planning-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/planning-master-file')}}">Export Planning Master File</a></li>
  </ul>
</div>
</div>
