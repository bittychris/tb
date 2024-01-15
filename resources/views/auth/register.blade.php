
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
            @php
              $editMode = false;
            @endphp
            
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo fw-bold text-center">
                USAID Afya Shirikishi
                {{-- <img src="../../images/logo.svg" alt="logo"> --}}
              </div>
              <h4>Welcome to Health Africa</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="forms-sample" wire:submit.prevent="saveAdmin">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First ame</label>
                            <input type="text" wire:model="first_name" class="form-control form-control-sm" id="first_name" placeholder="Enter First name">
                            @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" wire:model="last_name" class="form-control form-control-sm" id="last_name" placeholder="Enter Last name">
                            @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" wire:model="email" class="form-control form-control-sm" id="email" placeholder="Enter Email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone contact</label>
                            <input type="text" wire:model="phone" class="form-control form-control-sm" id="phone" placeholder="Enter Phone contact">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="region_id">Region</label>
                            <select wire:model="region_id" class="form-control form-control-sm text-dark" id="region_id">
                                <option value="" class="fw-bold">Select Position</option>
                                {{-- @foreach ($regions as $region)
                                
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
        
                                @endforeach --}}
                            </select>
                            @error('region_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role_id">Position</label>
                            <select wire:model="role_id" class="form-control form-control-sm text-dark" id="role_id">
                                <option value="" class="fw-bold">Select Position</option>
                                {{-- @foreach ($roles as $role)
                                
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
        
                                @endforeach --}}
                            </select>
                            @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>       
                <div class="mt-3 mb-2">
                    @if($editMode)
                        <button type="submit" class="btn btn-success text-white" style="float: right;">Update</button>
                    @else
                        <button type="submit" class="btn btn-primary text-white" style="float: right;">Save</button>
                    @endif
                </div>
            </form>
              <form action="{{ route('authenticate') }}" method="POST" class="pt-3">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" id="email" placeholder="Username" equired autocomplete="email" autofocus>
                </div>
                <div class="form-group">
                  <div class="input-group mb-3">
                      <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" required autocomplete="current-password">
                      <span class="input-group-text">
                          <i class="mdi mdi-eye" onclick="myFunction()" id="togglePassword"
                          style="cursor: pointer"></i>
                      </span>
                  </div>
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
