<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Link Africa | Admin Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('public/admin/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/admin-login.css') }}">
  
  <style>
      .error-message{
          color: red;
      }
  </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="https://pixxeluclients.com/dev/link-africa/admin-login" class="h1"><img src="{{ asset('public/admin/images/Link africa.png') }}"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in </p>
    @if (Session::has('unsuccess'))

            <div class="alert alert-danger mt-2">{{ Session::get('unsuccess') }} 
            </div>

            @endif
        
        <form id="adminloginForm" class="form" action="{{ route('admin.login.submit') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name='email' value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong> 
                </span>  
            @enderror 
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <span><input id="remember-me" name="remember-me" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}></span><span> {{ __('Remember Me') }}</span></label>
               <br>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login_check" value="login">Sign In</button>
          </div>
       
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/admin/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
