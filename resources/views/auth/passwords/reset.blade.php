
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

@livewireStyles

<body>

    <livewire:admin-panel.change-password />

</body>

@livewireScripts
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

</html>
