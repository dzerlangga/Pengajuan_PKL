<!DOCTYPE html>

<html lang="en" >

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ url('assets/img/favicon.png') }}">
  <title>
   Persuratan Praktik Kerja Lapangan | SMK ANGKASA 1 Margahayu
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ url('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Font Awesome Icons -->
  <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link href="{{ url('css/app.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ url('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100 {{ (Request::is('virtual-reality') ? 'virtual-reality' : '') }} ">

    @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/solid.js" integrity="sha512-wTKWhN+VZ9nkKVKB7LqTQnPKKgX837ydhwB4qg5a2eW2+Aw/OyS00j7EBBWZvT1ph8NEIJfxxPcr+RdMi7ZT8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ url('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

</body>


</html>
