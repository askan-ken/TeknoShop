<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ $title }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/assets/admin/vendors/feather/feather.css">
  <link rel="stylesheet" href="/assets/admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/assets/admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/assets/admin/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="/assets/admin/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="/assets/admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/assets/admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/assets/admin/images/favicon.png" />
  <style>
    body{
      background-image: url("https://www.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_13223496.htm#query=pastel%20background&position=1&from_view=keyword&track=ais") ;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              @yield('content')
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
  <script src="/assets/admin/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="/assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/assets/admin/js/off-canvas.js"></script>
  <script src="/assets/admin/js/hoverable-collapse.js"></script>
  <script src="/assets/admin/js/template.js"></script>
  <script src="/assets/admin/js/settings.js"></script>
  <script src="/assets/admin/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
