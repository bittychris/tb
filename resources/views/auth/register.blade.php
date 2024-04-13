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
                        <div class="col-lg-5 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo fw-bold text-center mb-2">
                                    <span style="color: #012a6c;">US</span> <span style="color: #c2113b;">AID</span>
                                    Afya Shirikishi
                                    {{-- <img src="../../images/logo.svg" alt="logo"> --}}
                                </div>
                                <p class="font-weight-light text-center">System Administrator registration.</p>
                                <form class="forms-sample pt-3" method="POST" action="{{ route('register') }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="first_name" name="first_name" placeholder="Enter First name">
                                                @error('first_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="last_name" name="last_name" placeholder="Enter Last name">
                                                @error('last_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control form-control-sm"
                                                    id="email" name="email" placeholder="Enter Email">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone contact</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="phone" name="phone" placeholder="Enter Phone contact">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="region_id">Region</label>
                                        <select class="form-control form-control-sm text-dark" id="region_id"
                                            name="region_id">
                                            <option value="" class="fw-bold">Select Region</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="password"
                                            name="password" placeholder="Enter password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmed">Confirm password</label>
                                        <input type="password" class="form-control form-control-sm" id="confirmed"
                                            name="confirmed" placeholder="Confirm password">
                                        @error('confirmed')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <button type="submit" class="btn w-100 btn-danger text-white"
                                            style="float: right;">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
