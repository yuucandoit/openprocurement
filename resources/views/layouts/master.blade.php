<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('../assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../assets/images/favicon.png') }}" type="image/x-icon">
    <title>viho - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href={{ asset('assets/css/shared/iconly.css') }}>
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/vector-map.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('../assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/responsive.css') }}">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" style="height: 30px;" src="{{ asset('assets/images/logo.svg') }}" alt=""></a><div class="eproc" style="font-size: 10px; padding-left:40px; font-weight:bolder; user-select:none;
              -moz-user-select:none;
              -ms-user-select:none;
              -khtml-user-select:none;
              -webkit-user-select:none">E-Proc</div></div>
            <div class="dark-logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" style="height: 30px;" src="{{ asset('assets/images/logo.svg') }}" alt=""></a><div class="eproc" style="font-size: 10px; padding-left:40px; font-weight:bolder; user-select:none;
                -moz-user-select:none;
                -ms-user-select:none;
                -khtml-user-select:none;
                -webkit-user-select:none">E-Proc</div></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
          </div>
          <div class="left-menu-header col">
            <ul>
              <li>
                <form class="form-inline search-form">
                  <div class="search-bg"><i class="fa fa-search"></i>
                    <input class="form-control-plaintext" placeholder="Search here.....">
                  </div>
                </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
              </li>
            </ul>
          </div>
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li>
                <div class="mode"><i class="fa fa-moon-o"></i></div>
              </li>
              <li class="onhover-dropdown p-0">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-primary-light" type="submit"><i data-feather="log-out"></i>Log out</button>
                </form>
                </a>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ asset('../assets/images/dashboard/1.png') }}" alt="">
            <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html">
              <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->name }}</h6></a>
            <p class="mb-0 font-roboto"></p>
            <ul>
              <li><span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
              </li>
              <li><span>2 year</span>
                <p>Experince</p>
              </li>
              <li><span><span class="counter">95.2</span>k</span>
                <p>Follower </p>
              </li>
            </ul>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Dashboard             </h6>
                    </div>
                  </li>
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Components             </h6>
                    </div>
                  </li>
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="bell"></i><span>Menu</span></a>
                    <ul class="nav-submenu menu-content">
                        @hasrole('user|super admin')
                        <li class=" {{ request()->is('*pengajuan-pembelian*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pengajuan-pembelian') }}" >
                                <i class="bi bi-file-text"></i>
                                <span>Pengajuan Pembelian</span>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('super user|super admin')
                        <li class=" {{ request()->is('*pengajuan-pembelian*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-taskList-atasan') }}" >
                                <i class="bi bi-file-text"></i>
                                <span>Task List</span>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('purchasing|super admin')
                        <li class=" {{ request()->is('*task-list*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-task-list') }}" >
                                <i class="bi bi-calendar-x"></i>
                                <span>Task List</span>
                                <div class="notification-box"></span></div>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-purchase-order') }}" >
                                <i class="bi bi-calendar-x"></i>
                                <span>Purchase Order</span>
                            </a>
                        </li>
                        {{-- <li class=" {{ request()->is('*quotation*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-quotation') }}" >
                                <i class="bi bi-receipt"></i>
                                <span>Quotation</span>
                            </a>
                        </li> --}}
                        <li class=" {{ request()->is('*pengajuan-dana*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pengajuan-dana') }}" >
                                <i class="bi bi-cash-coin"></i> <span>Pengajuan Dana</span>
                            </a>
                        </li>
                        @endhasrole
                        {{-- <li class=" {{ request()->is('*pembelian-barang*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pembelian-barang') }}" >
                                <i class="bi bi-currency-dollar"></i>
                                <span>Pembelian Barang</span>
                            </a>
                        </li> --}}
                    </ul>
                  </li>
                  @hasrole('admin|super admin')
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Data Master             </h6>
                    </div>
                  </li>
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Data Vendor/ Supplier</span></a>
                    <ul class="nav-submenu menu-content">
                        <li class=" {{ request()->is('*perusahaan*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-perusahaan') }}" >
                                <i class="bi bi-building"></i>
                                <span>Perusahaan</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*private-person*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-private-person') }}" >
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Private Person</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*ecommerce*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-ecommerce') }}" >
                                <i class="bi bi-cast"></i>
                                <span>Ecommerce</span>
                            </a>
                        </li>

                    </ul>
                  </li>
                  @endhasrole
                  {{-- @hasrole('super admin')
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="bell"></i><span>Menu</span></a>
                    <ul class="nav-submenu menu-content">

                        <li class=" {{ request()->is('*pengajuan-pembelian*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pengajuan-pembelian') }}" >
                                <i class="bi bi-file-text"></i>
                                <span>Pengajuan Pembelian</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*task-list*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-task-list') }}" >
                                <i class="bi bi-calendar-x"></i>
                                <span>Task List</span>
                                <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated">{{ \App\Models\CategoryPengajuanPembelian::count() }}</span></div>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-purchase-order') }}" >
                                <i class="bi bi-calendar-x"></i>
                                <span>Purchase Order</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*quotation*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-quotation') }}" >
                                <i class="bi bi-receipt"></i>
                                <span>Quotation</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*pengajuan-dana*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pengajuan-dana') }}" >
                                <i class="bi bi-cash-coin"></i> <span>Pengajuan Dana</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*pembelian-barang*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pembelian-barang') }}" >
                                <i class="bi bi-currency-dollar"></i>
                                <span>Pembelian Barang</span>
                            </a>
                        </li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Data Master</span></a>
                    <ul class="nav-submenu menu-content">

                        <li class="sidebar-title">Data Vendor / Supplier</li>
                        <li class=" {{ request()->is('*perusahaan*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-perusahaan') }}" >
                                <i class="bi bi-building"></i>
                                <span>Perusahaan</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*private-person*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-private-person') }}" >
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Private Person</span>
                            </a>
                        </li>
                        <li class=" {{ request()->is('*ecommerce*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-ecommerce') }}" >
                                <i class="bi bi-cast"></i>
                                <span>Ecommerce</span>
                            </a>
                        </li>

                    </ul>
                  </li>
                  @endhasrole --}}
          </nav>
        </header>
        <body>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
        <div id="main">
          @yield('main')
        </div>
    </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <h5 class="mb-0"><img src="{{ asset('assets/images/intek.png') }}" alt="" width="30" class="fluid">&nbsp;
                  SOLUSI INTEK INDONESIA</h5>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">Copyright &copy; 2022 | PT SOLUSI INTEK INDONESIA</p>
              </div>
            </div>
          </div>
        </footer>
        </body>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('../assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('../assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('../assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('../assets/js/config.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('../assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('../assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('../assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('../assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('../assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('../assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('../assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('../assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('../assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('../assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('../assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('../assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('../assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('../assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-au-mill.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-in-mill.js') }}"></script>
    <script src="{{ asset('../assets/js/vector-map/map/jquery-jvectormap-asia-mill.js') }}"></script>
    <script src="{{ asset('../assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('../assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('../assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('../assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('../assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('../assets/js/script.js') }}"></script>
    <script src="{{ asset('../assets/js/theme-customizer/customizer.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>

