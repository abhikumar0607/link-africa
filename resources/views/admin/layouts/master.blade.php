@include('admin.layouts.head')
<body class="hold-transition sidebar-mini layout-fixed">
    <!--Loader-->
    <div class="admin-loader" style="display:none;">
        <img src="{{ asset('public/admin/images/loader-img.gif') }}" class="loading-image">
    </div>
   <div class="wrapper">
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }}" alt="Wait.." height="60" width="60">
   </div>
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('admin/sale/dashboard') }}" class="brand-link">
      <img src="{{ asset('public/admin/images/Link Africa Logo.png') }} " alt="Link Africa Admin" class="brand-image img-circle elevation-3">
      <br><p>O2CAP - Oder To Cash Automation Platform</p>
      <span class="brand-text font-weight-light"></span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
         @if (Auth::user()->user_type == "Super_Admin" || Auth::user()->user_type == "Admin" || Auth::user()->user_type == "Customer")
            @include('admin.sidebar.admin-sidebar')
         @endif  
      </div>
      <!-- /.sidebar -->
   </aside>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper ">
      <!-- Content Header (Page header) -->
         <!--content-header-->
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <!--<h1 class="m-0">Dashboard</h1>-->
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @yield('content')
      <footer class="main-footer ">
         <strong>Copyright &copy; 2021-2022 <a href="https://pixxelu.com/" target="_blank">Pixxelu</a>.</strong>All rights reserved.
      </footer>
   </div>
   <!-- ./wrapper -->
   <!-- jQuery -->
   <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   <!-- jQuery UI 1.11.4 -->
   <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
      $.widget.bridge('uibutton', $.ui.button)
   </script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- ChartJS -->
   <script src="{{ asset('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
   <!-- Sparkline -->
   <script src="{{ asset('public/admin/plugins/sparklines/sparkline.js') }}"></script>
   <!-- JQVMap -->
   <script src="{{ asset('public/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
   <!-- jQuery Knob Chart -->
   <script src="{{ asset('public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
   <!-- daterangepicker -->
   <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
   <!-- Tempusdominus Bootstrap 4 -->
   <script src="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
   <!-- Summernote -->
   <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
   <!-- overlayScrollbars -->
   <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
   <!-- bootstrap color picker -->
   <script src="{{ asset('public/admin/plugins//bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="{{ asset('public/admin/dist/js/pages/dashboard.js') }}"></script>
   <script>
      $(function () {
        // Page Desc
        $('#page_description').summernote()
        // Page Short desc
        $('#page_short_desc').summernote()
        $('.description').summernote()
      })
   </script>
   <!-- DataTables  & Plugins -->
   <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/jszip/jszip.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

   <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#example2").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        $("#customDataTable").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#customDataTable2").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
   </script>
<script>
    $(document).ready(function() {
        $("#customer_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                'csv' // Add 'csv' button
            ]
        }).buttons().container().appendTo('#customer_table_wrapper .col-md-6:eq(0)');

        $("#site_a_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                'csv' // Add 'csv' button
            ]
        }).buttons().container().appendTo('#site_a_table_wrapper .col-md-6:eq(0)');

        $("#site_b_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                'csv' // Add 'csv' button
            ]
        }).buttons().container().appendTo('#site_b_table_wrapper .col-md-6:eq(0)');
    });
</script>

   <!-- Page specific script -->
   <script>
      $(function () {
         //Colorpicker
         $('.my-colorpicker1').colorpicker()
         //Date picker
        $('#custom_date_picker').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker1').datetimepicker({
            format: 'L'
        });
         $('#custom_date_picker2').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker3').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker4').datetimepicker({
            format: 'L'   
        });
        $('#custom_date_picker100').datetimepicker({
            format: 'L',
            maxDate: new Date()     
        });
        $('#custom_date_picker5').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker6').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker7').datetimepicker({
            format: 'L'
        });
         $('#custom_date_picker8').datetimepicker({
            format: 'L'
        });
         $('#custom_date_picker9').datetimepicker({
            format: 'L'
        });
         $('#custom_date_picker10').datetimepicker({
            format: 'L'
        });
         $('#custom_date_picker11').datetimepicker({
            format: 'L'
        });
         $('#custom_date_picker12').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker13').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker14').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker15').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker16').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker17').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker18').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker19').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker20').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker21').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker22').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker14').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker23').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker24').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker25').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker26').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker27').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker28').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker29').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker30').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker31').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker32').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker33').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker34').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker35').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker36').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker37').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker38').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker39').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker40').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker41').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker42').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker43').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker44').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker45').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker46').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker47').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker48').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker49').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker50').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker51').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker52').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker53').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker54').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker55').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker56').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker57').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker58').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker59').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker60').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker61').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker62').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker63').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker64').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker65').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker66').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker67').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker68').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker69').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker70').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker71').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker72').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker98').datetimepicker({
            format: 'L'
        });
        $('#start_time').datetimepicker({
            format: 'HH:mm a'
        });
        $('#end_time').datetimepicker({
            format: 'HH:mm a'
        });
       
        $('#servicesmulti').multiselect({
            nonSelectedText: 'Select Services',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'400px',
            maxHeight: 200,
            selectAll: true
        });
        
          $('#firmservicesmulti').multiselect({
                nonSelectedText: 'Select Services',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'400px',
                maxHeight: 200,
                selectAll: true
         });
      });
      
   </script>
</body>
</html>