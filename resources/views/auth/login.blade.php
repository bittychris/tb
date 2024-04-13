<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login - {{ config('app.name') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/vendors/base/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('assets/css/css/style.css') }}">
        <!-- endinject -->
        {{-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" /> --}}
        <link rel="icon"
            href="https://i0.wp.com/amref.org/wp-content/uploads/2017/09/cropped-favicon.png?fit=32%2C32&amp;ssl=1"
            sizes="32x32">

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
                                <div class="brand-logo fw-bold text-center text-danger">
                                    <div class="row mb-4 mt-0">
                                        <div class="col-12">
                                            <center>
                                                <a href="{{ route('index') }}">
                                                    <img src="{{ asset('admin/images/amref logo.png') }}"
                                                        alt="amref logo"
                                                        style="object-fit: ; width: 120px !important; height: 65px !important;" />
                                                </a>
                                            </center>
                                        </div>
                                    </div>
                                    {{-- USAID Afya Shirikishi --}}
                                    {{-- <img src="../../images/logo.svg" alt="logo"> --}}
                                </div>
                                <h4 class="text-center mb-4">Welcome to <span style="color: #012a6c;">US</span><span
                                        style="color: #c2113b;">AID</span> Afya Shirikishi
                                </h4>
                                {{-- <h6 class="font-weight-light">Sign in to continue.</h6> --}}
                                <form action="{{ route('authenticate') }}" method="POST" class="pt-3">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-lg"
                                            value="{{ old('email') }}" id="email" placeholder="Username" equired
                                            autocomplete="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                id="password" placeholder="Password" required
                                                autocomplete="current-password">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-eye" onclick="myFunction()" id="togglePassword"
                                                    style="cursor: pointer"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit"
                                            class="btn btn-block btn-danger btn-lg w-100 text-white font-weight-medium auth-form-btn">Sign
                                            In</button>
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
                                </form>
                                <span class="mt-2" style="float: right; font-size: 15px; font-weight: 400;"><span
                                        class="text-danger"><- Return</span>
                                            <a href="{{ route('index') }}" class="text-danger"><small>Home</small></a>
                                    </span>
                            </div>
                        </div>
                    </div>

                    {{-- </div> --}}
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
            <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
            <!-- endinject -->

            {{--  Show and hide password js  --}}
            <script>
                function myFunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
            </script>
    </body>

</html>
