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
  <link rel="stylesheet" href="/assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/assets/admin/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/assets/admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  {{-- <link rel="shortcut icon" href="/assets/admin/images/favicon.png" /> --}}
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('dashboard.partials.topbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      @include('dashboard.partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper px-3">

          <div class="card">
            <div class="card-body">
              <h2 class="h4 fw-bold mb-3">{{ $title }}</h2>
              @yield('content')
            </div>
          </div>


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">&nbsp;</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023.  TeknoShop.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="/assets/admin/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="/assets/admin/vendors/chart.js/Chart.min.js"></script>
  <script src="/assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="/assets/admin/vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/assets/admin/js/off-canvas.js"></script>
  <script src="/assets/admin/js/hoverable-collapse.js"></script>
  <script src="/assets/admin/js/template.js"></script>
  <!-- endinject -->
  <script src="<?= url('') ?>/assets/js/jquery.min.js"></script>
  {{-- additional scripts --}}
  @yield('script')
</body>

</html>

