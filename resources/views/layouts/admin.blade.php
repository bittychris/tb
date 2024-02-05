<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        {{-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}


        {{-- bootstrap --}}
        {{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> --}}

        <!-- Scripts -->
        {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}


        <!-- Required meta tags -->
        <meta charset="utf-8">
        <title>@yield('title') - {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
        <!-- endinject -->
        {{-- <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" /> --}}
        <link rel="icon"
            href="https://i0.wp.com/amref.org/wp-content/uploads/2017/09/cropped-favicon.png?fit=32%2C32&amp;ssl=1"
            sizes="32x32">
        <link rel="icon"
            href="https://i0.wp.com/amref.org/wp-content/uploads/2017/09/cropped-favicon.png?fit=192%2C192&#038;ssl=1"
            sizes="192x192" />
        <link rel="apple-touch-icon"
            href="https://i0.wp.com/amref.org/wp-content/uploads/2017/09/cropped-favicon.png?fit=180%2C180&#038;ssl=1" />

        <style>
            .formData tr th {
                font-size: 11px;
                text-align: center;
            }

            .formData tr td {
                text-align: center;
            }
        </style>
        @livewireStyles

    </head>

    <body>
        <div class="container-scroller">

            @include('layouts.inc.navbar')

            <div class="container-fluid page-body-wrapper">

                @include('layouts.inc.sidebar')

                <div class="main-panel">
                    <div class="content-wrapper" style="padding: 1.04rem 1.04rem !important;">

                        @yield('admin-content')

                    </div>

                    <!-- Footer start -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
                                    href="{{ route('index') }}" class="text-danger" target="_blank"
                                    style="text-decoration: none;">USAID Afya Shirikishi </a>{{ date('Y') }}</span>
                        </div>
                    </footer>
                    <!-- Footer end-->

                </div>

            </div>

        </div>
        <!-- container-scroller -->

        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        {{-- <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script> --}}
        <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        {{-- <script src="{{asset('admin/vendors/base/vendor.bundle.base.js')}}"></script> --}}
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
        <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('admin/js/template.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        {{-- <script src="{{asset('admin/js/dashboard.js')}}"></script> --}}
        <script src="{{ asset('admin/js/data-table.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
        {{-- <script src="{{asset('admin/js/jquery.dataTables.js')}}"></script> --}}
        {{-- <script src="{{asset('admin/js/dataTables.bootstrap4.js')}}"></script> --}}
        <!-- End custom js for this page-->

        {{-- script --}}
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.addEventListener('message_alert', message => {

                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    text: message.detail,
                });

            });

            window.addEventListener('success_alert', message => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: message.detail,
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            window.addEventListener('failure_alert', message => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: message.detail,
                    showConfirmButton: true,
                });
            });

            // permissions and roles alert on add and update
            window.addEventListener('perm_success_alert', message => {
                Swal.fire({
                    text: message.detail,
                    icon: 'success',
                    showCancelButton: false,
                    // confirmButtonColor: '#ff4747',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your imaginary file has been deleted.',
                        //   'success'
                        // )
                        // Redirect to a new page
                        window.location.href = '{{ route('admin.permissions.roles') }}';
                    }
                });
            });

            // field data alert on add and update
            window.addEventListener('field_data_success_alert', message => {
                Swal.fire({
                    text: message.detail,
                    icon: 'success',
                    showCancelButton: false,
                    // confirmButtonColor: '#ff4747',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your imaginary file has been deleted.',
                        //   'success'
                        // )
                        // Redirect to a new page
                        window.location.href = '{{ route('admin.report') }}';
                    }
                });
            });

            // form attribute alert on add and update
            window.addEventListener('form_attr_success_alert', message => {
                Swal.fire({
                    text: message.detail,
                    icon: 'success',
                    showCancelButton: false,
                    // confirmButtonColor: '#ff4747',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your imaginary file has been deleted.',
                        //   'success'
                        // )
                        // Redirect to a new page
                        window.location.href = '{{ route('admin.form_attributes') }}';
                    }
                });
            });

            // admin alert on add and update
            window.addEventListener('admin_success_alert', message => {
                Swal.fire({
                    text: message.detail,
                    icon: 'success',
                    showCancelButton: false,
                    // confirmButtonColor: '#ff4747',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your imaginary file has been deleted.',
                        //   'success'
                        // )
                        // Redirect to a new page
                        window.location.href = '{{ route('admin.admins') }}';
                    }
                });
            });

            // staff alert on add and update
            window.addEventListener('staff_success_alert', message => {
                Swal.fire({
                    text: message.detail,
                    icon: 'success',
                    showCancelButton: false,
                    // confirmButtonColor: '#ff4747',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your imaginary file has been deleted.',
                        //   'success'
                        // )
                        // Redirect to a new page
                        window.location.href = '{{ route('admin.staffs') }}';
                    }
                });
            });
        </script>
        @livewireScripts

        @stack('js')

    </body>

</html>
