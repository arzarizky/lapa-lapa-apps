<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapa Lapa Apps | {{ $title ?? 'Dashboard' }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('template') }}/assets/img/favicon.png"/>



  <!-- General CSS Files -->
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/@fortawesome/fontawesome-free/css/all.min.css">


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/izitoast/dist/css/iziToast.min.css">

  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/selectric/public/selectric.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="{{ asset('template') }}/node_modules/sweetalert2/dist/sweetalert2.min.css">





  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('template') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('template') }}/assets/css/lalapa-apps.css">
  <link rel="stylesheet" href="{{ asset('template') }}/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('layouts.navbar')
      @include('layouts.sidebar')
     
      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        @include('layouts.footer')
      </footer>
      
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('template') }}/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/moment/min/moment.min.js"></script>
  <script src="{{ asset('template') }}/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('template') }}/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="{{ asset('template') }}/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/izitoast/dist/js/iziToast.min.js"></script>

  <script src="{{ asset('template') }}/node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
  <script src="{{ asset('template') }}/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="{{ asset('template') }}/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/select2/dist/js/select2.full.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/selectric/public/jquery.selectric.min.js"></script>
  <script src="{{ asset('template') }}/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>

  

  <!-- Template JS File -->
  <script src="{{ asset('template') }}/assets/js/scripts.js"></script>
  <script src="{{ asset('template') }}/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  {{-- <script src="{{ asset('template') }}/assets/js/page/index.js"></script> --}}
  <script src="{{ asset('template') }}/assets/js/page/modules-toastr.js"></script>
  <script src="{{ asset('template') }}/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

  
  @stack('js')
</body>