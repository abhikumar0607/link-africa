<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--> 

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/jqvmap/jqvmap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/css/custom-style.css') }}">
<!---custom sale--->
<link rel="stylesheet" href="{{ asset('public/admin/css/sale-custom.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/css/support.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/css/link-dasdstyle.css') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/admin/images/favicon.ico') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!---Call Pusher js--->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
      var base_url = '{{ url("admin/") }}';
      var base_url2 = '{{ url("/") }}';  
  </script> 
<!--Custom Script--> 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="{{ asset('public/admin/js/custom-script.js') }}"></script> 
<script src="{{ asset('public/admin/js/custom-ajax.js') }}"></script>
<script>
$(document).ready(function () {
    $('#search-input').on('keyup', function () {
        var searchTerm = $(this).val();
        $.ajax({
            url: base_url2 + '/search-users',
            type: 'GET',
            data: { search: searchTerm },
            success: function (response) {
              $('.hide-users').html("");
              $('.show-user').html(response);
            },
            error: function (error) {
                console.error('Error during search request:', error);
            }
        });
    });
});
</script>
</head>

<!--[Header]-->