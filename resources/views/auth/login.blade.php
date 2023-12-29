
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Majestic Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            @if (session()->has('success'))
              @include('partial.alert')

            @elseif (session()->has('error'))
              @include('partial.alert')

            @endif
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo fw-bold text-center">
                USAID Afya Shirikishi
                {{-- <img src="../../images/logo.svg" alt="logo"> --}}
              </div>
              <h4>Welcome to Health Africa</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form action="{{ route('authenticate') }}" method="POST" class="pt-3">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  {{-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div> --}}
                  {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                </div>
                {{-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook me-2"></i>Connect using website
                  </button>
                </div> --}}
                {{-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  {{-- <script src="{{ asset('assets/vendor/vendors/base/vendor.bundle.base.js') }}"></script> --}}
  <!-- endinject -->
  <!-- inject:js -->
  {{-- <script src="{{ asset('assets/js/js/off-canvas.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/js/hoverable-collapse.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/js/template.js') }}"></script> --}}
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <!-- endinject -->
</body>

</html>
