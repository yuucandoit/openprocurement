<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href={{ asset('assets/css/main/app.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/main/app-dark.css') }}>
    <link rel="shortcut icon" href={{ asset('assets/images/logo/favicon.svg') }} type="image/x-icon">
    <link rel="shortcut icon" href={{ asset('assets/images/logo/favicon.png') }} type="image/png">

    <link rel="stylesheet" href={{ asset('assets/css/shared/iconly.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/pages/simple-datatables.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/pages/sweetalert2.css') }}>


</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo-dash">
                            <img src="{{ asset('assets/images/logo.svg') }}" style="height: 100%; width: 80%;">
                            <div class="eproc" style="font-size:13px; padding-left: 45px; padding-bottom:0px; user-select:none;
                            -moz-user-select:none;
                            -ms-user-select:none;
                            -khtml-user-select:none;
                            -webkit-user-select:none;">
                                E-PROC
                            </div>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <style>
                       .container_gtranslate{
                        padding:5px;
                        text-align:center   ;
                       }
                </style>
                <div class="container_gtranslate">
                    Translate This Page :
                    <div id="google_translate" ></div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Dashboard</li>

                        <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                            <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Menu</li>
                        @hasrole('user')
                        <li class="sidebar-item {{ request()->is('*pengajuan-pembelian*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pengajuan-pembelian') }}" class='sidebar-link'>
                                <i class="bi bi-file-text"></i>
                                <span>Pengajuan Pembelian</span>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('purchasing')
                        <li class="sidebar-item {{ request()->is('*task-list*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-task-list') }}" class='sidebar-link'>
                                <i class="bi bi-calendar-x"></i>
                                <span>Task List</span>
                                <style>
                                    .notification{
                                    background: red;
                                    height: 25px;
                                    width: 25px;
                                   align-items: right;
                                    border-radius: 50%;
                                    color: white;
                                    display: inline-block;
                                    text-align: center;
                                    }
                                    .notification:empty {
                                    display: none;
}
                                </style>
                                <span class="notification">
                                    <p></p>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-purchase-order') }}" class='sidebar-link'>
                                <i class="bi bi-calendar-x"></i>
                                <span>Purchase Order</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('*quotation*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-quotation') }}" class='sidebar-link'>
                                <i class="bi bi-receipt"></i>
                                <span>Quotation</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('*pengajuan-dana*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pengajuan-dana') }}" class='sidebar-link'>
                                <i class="bi bi-cash-coin"></i> <span>Pengajuan Dana</span>
                            </a>
                        </li>
                        @endhasrole
                        <li class="sidebar-item {{ request()->is('*pembelian-barang*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-pembelian-barang') }}" class='sidebar-link'>
                                <i class="bi bi-currency-dollar"></i>
                                <span>Pembelian Barang</span>
                            </a>
                        </li>
                        @hasrole('admin')
                        <li class="sidebar-title">Data Vendor / Supplier</li>
                        <li class="sidebar-item {{ request()->is('*perusahaan*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-perusahaan') }}" class='sidebar-link'>
                                <i class="bi bi-building"></i>
                                <span>Perusahaan</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('*private-person*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-private-person') }}" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Private Person</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('*ecommerce*') ? 'active' : '' }}">
                            <a href="{{ url('/menu-ecommerce') }}" class='sidebar-link'>
                                <i class="bi bi-cast"></i>
                                <span>Ecommerce</span>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('super admin')
                            <li class="sidebar-title">Admin</li>
                            <li class="sidebar-item {{ request()->is('*admin*') ? 'active' : '' }}">
                                <a href="{{ url('/admin') }}" class='sidebar-link'>
                                    <i class="bi bi-person-workspace"></i>
                                    <span>Admin</span>
                                </a>
                            </li>
                        @endhasrole
                        <li class="sidebar-title">Logout</li>
                        <li class="sidebar-item {{ request()->is('*logout*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('main')

        </div>
    </div>
    <script type="text/javascript">
        function googleTranslateInit() {
            new google.translate.TranslateElement({pageLanguange: 'id'}, 'google_translate');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateInit"></script>
    <script src={{ asset('assets/js/app.js') }}></script>
    <script src={{ asset('assets/js/pages/dashboard.js') }}></script>
    <script src={{ asset('assets/js/extensions/simple-datatables.js') }}></script>
    <script src={{ asset('assets/js/extensions/ui-apexchart.js') }}></script>
    <script src={{ asset('assets/js/app.js') }}></script>
    <script src={{ asset('assets/js/extensions/sweetalert2.js') }}></script>

    @include('sweetalert::alert')
</body>

</html>
