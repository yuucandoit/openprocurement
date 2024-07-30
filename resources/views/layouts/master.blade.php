<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/LogoSII.png') }}" type="image/x-icon">
    <title>PT.Solusi Intek Indonesia</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/fontawesome.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/date-picker.css') }}">
    <!-- Plugins css Ends-->
    <!-- Select2 css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <!-- End Select2 css-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('../assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/responsive.css') }}">


</head>

<body onload="realTimeClock()">
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
                    <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                style="height: 38px;" src="{{ asset('assets/images/Logo-Intek-8K.png') }}"
                                alt=""></a>
                        <div class="eproc"
                            style="font-size: 10px; padding-left:40px; font-weight:bolder; user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        -khtml-user-select:none;
        -webkit-user-select:none">
                            E-Procurement</div>
                    </div>
                    <div class="dark-logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                style="height: 30px;" src="{{ asset('assets/images/Logo-Intek-8K.png') }}"
                                alt=""></a>
                        <div class="eproc"
                            style="font-size: 10px; padding-left:40px; font-weight:bolder; user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        -khtml-user-select:none;
        -webkit-user-select:none">
                            E-Procurement</div>
                    </div>
                    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                            id="sidebar-toggle"></i>
                    </div>
                </div>
                <div class="nav-right col pull-right right-menu p-0">
                    <ul class="nav-menus">
                        <li style="color: green; font-weight: bold; font-size: 13px; margin-bottom: 5px;">
                            <i data-feather="calendar"></i>&nbsp;
                            <?php
                            $time_sekarang = time();
                            echo date('d F Y', strtotime('+0 days', $time_sekarang));
                            ?>
                        </li>
                        <h5 style="margin-bottom: 4px; margin-right: 12px; margin-bottom: 5px;">|</h5>
                        {{-- <li style="font-weight: bold; font-size: 13px; margin-bottom: 5px;">
                            <i class="icofont icofont-time"></i>&nbsp;
                            <?php
                            date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                            echo date('H : i : s a'); // menampilkan jam sekarang
                            ?>
                        </li> --}}
                        <li id="clock" style="font-weight: bold; font-size: 14px;">
                        </li>
                        @php
                           $coment_ppb = App\Models\Comment::groupBy('ppb_id')->get();
                           $comment_id = App\Models\CommentRead::orderBy('created_at','DESC')->     groupBy('comment_id')->get();
                           $comment_user_id = App\Models\CommentRead::where('id', '!=', auth()->id())->get();
                        @endphp
                        <style>
                            .my-custom-scrollbar {
                            position: relative;
                            height: 550px;
                            overflow: auto;
                            }
                            .table-wrapper-scroll-y {
                            display: block;
                            }
                        </style>

            @hasrole('user|admin project')

                    <li class="onhover-dropdown">
                            <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>

                            <ul class="notification-dropdown onhover-show-div">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <li>
                                        <p class="f-w-700 mb-0">You have {{ $comment_id->count() }} Notifications<span class="pull-right badge badge-primary badge-pill">4</span></p>
                                    </li>
                                    @foreach ($comment_id as $cid)
                                    @if(!empty($cid->comment->ppb->user_id))
                                    @if($cid->comment->ppb->user_id == Auth::user()->id)
                                    @if($cid->is_read_user == 1)

                                    @else
                                    <form action="{{ url('/comment/is_read/'.$cid->id) }}" id="form-user" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <a onclick="document.getElementById('form-user').submit();">
                                            <li class="noti-success" style="overflow:scroll;">
                                            <div class="media"><span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                                                <div class="media-body" style="font-size: 8;">
                                                <p style="font-size: 10;">{{ $cid->comment->users->name }}</p>
                                                <p style="font-size: 10;">{{ $cid->comment->ppb->purpose->name }}</p><span style="font-size: 10">{{ $cid->comment->comment }} </span>

                                                </div>
                                                <i data-feather="chevron-right" class="mt-3"><button type="submit" style="opacity: 0;"></button></i>
                                            </div>

                                            </li>
                                            <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">

                                        </a>
                                    </form>
                                    @endif
                                    @endif
                                    @else
                                    @endif
                                    @endforeach
                                </div>
                             </ul>
                        </li>
            @endhasrole

            @hasrole('purchasing')
                    <li class="onhover-dropdown">
                            <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                            <ul class="notification-dropdown onhover-show-div">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <li>
                                        <p class="f-w-700 mb-0">You have {{ $comment_id->count() }} Notifications<span class="pull-right badge badge-primary badge-pill">4</span></p>
                                    </li>
                                    @foreach ($comment_id as $cid)
                                    @if(!empty($cid))
                                    @if($cid->is_read_purchase == 1)

                                    @else
                                    <form action="{{ url('/comment/is_read/'.$cid->id) }}" id="form-purchase" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <a onclick="document.getElementById('form-purchase').submit();">
                                        <li class="noti-success" style="overflow:scroll;">
                                        <div class="media"><span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                                            <div class="media-body" style="font-size: 8;">
                                            <p style="font-size: 10;">{{ $cid->comment->users->name ?? '-' }}</p>
                                            <p style="font-size: 10;">{{ $cid->comment->ppb->purpose->name ?? '-' }}</p><span style="font-size: 10">{{ $cid->comment->comment }} </span>

                                            </div>
                                        </div>
                                        </li>
                                        <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                    </a>
                                    </form>
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                             </ul>
                        </li>
            @endhasrole

            @hasrole('finance')
                <li class="onhover-dropdown">
                        <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                        <ul class="notification-dropdown onhover-show-div">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <li>
                                    <p class="f-w-700 mb-0">You have {{ $comment_id->count() }} Notifications<span class="pull-right badge badge-primary badge-pill">4</span></p>
                                </li>
                                @foreach ($comment_id as $cid)
                                @if($cid->is_read_finance == 1)

                                @else
                                    <form action="{{ url('/comment/is_read/'.$cid->id) }}" id="form-finance" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <a onclick="document.getElementById('form-finance').submit();">
                                            <li class="noti-success" style="overflow:scroll;">
                                                <div class="media"><span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                                                    <div class="media-body" style="font-size: 8;">
                                                    <p style="font-size: 10;">{{ $cid->comment->users->name ?? '-' }}</p>
                                                    <p style="font-size: 10;">{{ $cid->comment->ppb->purpose->name ?? '-' }}</p><span style="font-size: 10">{{ $cid->comment->comment }} </span>

                                                    </div>
                                                </div>
                                            </li>
                                            <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                        </a>
                                    </form>
                                @endif
                                @endforeach
                            </div>
                         </ul>
                    </li>
            @endhasrole

            @hasrole('super user|General Manager Business|super admin')
                    <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>

                    <ul class="notification-dropdown onhover-show-div">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <li>
                                <p class="f-w-700 mb-0">You have Notifications {{ $comment_user_id->count() }}<span class="pull-right badge badge-primary badge-pill"></span></p>

                            </li>
                                @foreach ($comment_id as $c)
                                @if($c->is_read_bod == 1)

                                @else
                                <form action="{{ url('/comment/is_read/'.$c->id) }}" id="form-bod" method="post" enctype="multipart/form-data">
                                    @csrf
                                <a onclick="document.getElementById('form-bod').submit();">
                                    <li class="noti-success" style="overflow:scroll;">
                                    <div class="media"><span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                                        <div class="media-body" style="font-size: 8;">
                                        <p style="font-size: 10;">{{ $c->comment->users->name }}</p>
                                        <p style="font-size: 10;">{{ $c->comment->ppb->purpose->name }}</p><span style="font-size: 10">{{ $c->comment->comment }} </span>
                                        <form action="{{ url('/comment/is_read/'.$c->item_ppid) }}" id="formAdd" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                        </form>
                                        </div>
                                    </div>
                                    </li>
                                    </a>
                                </form>
                                @endif
                                @endforeach
                            </div>
                            </ul>
                        </li>

            @endhasrole

                        <li style="margin-bottom: 5px;">
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i data-feather="maximize"></i></a>
                        </li>
                        <li style="margin-bottom: 5px;">
                            <div class="mode"><i data-feather="moon"></i></div>
                        </li>
                        <li class="onhover-dropdown p-0">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-primary-light" type="submit"><i
                                            data-feather="log-out"></i>Log out</button>
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
                <div class="sidebar-user text-center">
                    {{-- <a class="setting-primary sembunyi" href="javascript:void(0)"><i
                            data-feather="settings"></i></a> --}}
                    <img class="img-90 rounded-circle" src="{{ asset('../assets/images/dashboard/1.png') }}"
                        alt="">
                    <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a
                        href="user-profile.html">
                        <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->name }}</h6>
                    </a>
                    <p class="mb-0 font-roboto "></p>
                    <style>
                        .sembunyi {
                            opacity: 0;
                        }
                    </style>

                </div>

                <nav>
                    <div class="main-navbar">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="mainnav">
                            <ul class="nav-menu custom-scrollbar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i data-feather="chevron-right" class="ps-2" aria-hidden="true"></i></div>
                                </li>


                                <!--Menu-->
                                @hasrole('super admin')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Menu</h6>
                                        </div>
                                    </li>
                                @endhasrole

                                @hasrole('user|admin project')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Menu</h6>
                                        </div>
                                    </li>
                                @endhasrole

                                @hasrole('user|super admin|admin project|super purchase|purchasing')
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*dashboard*') ? 'active' : '' }}"
                                            href="{{ url('/dashboard') }}">
                                            <i data-feather="home"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    @hasrole('user|super admin|super purchase|purchasing')
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*pre-pr*') ? 'active' : '' }} {{ request()->is('*pre-pr/search?=*') ? 'active' : '' }}"
                                            href="{{ url('/pre-pr') }}">
                                            <i data-feather="file-minus"></i>
                                            <span>Pre PR</span>
                                        </a>
                                    </li>
                                    @endhasrole
                                    @hasrole('user|super admin')
                                    <li class="dropdown">
                                        <a class="nav-link {{ request()->is('menu-pengajuan-pembelian') ? 'active' : '' }}{{ request()->is('menu-pengajuan-pembelian/create') ? 'active' : '' }}{{ request()->is('menu-pengajuan-pembelian/detail/*') ? 'active' : '' }}{{ request()->is('menu-pengajuan-pembelian/po_detail/*') ? 'active' : '' }}"
                                            href="{{ url('menu-pengajuan-pembelian') }}">
                                            <i data-feather="file-text"></i>
                                            <span>Purchase Request </span>
                                        </a>
                                    </li>
                                    @endhasrole
                                @endhasrole

                                @hasrole('admin project')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Menu</h6>
                                        </div>
                                    </li>
                                    {{-- <li class="dropdown">
                                        <a class="nav-link {{ request()->is('project-code') ? 'active' : '' }}{{ request()->is('project-code/create') ? 'active' : '' }}{{ request()->is('project-code/edit/*') ? 'active' : '' }}"
                                            href="{{ url('project-code') }}">
                                            <i data-feather="file-text"></i>
                                            <span>Project Code </span>
                                        </a>
                                    </li> --}}
                                @endhasrole

                                @hasrole('super purchase|purchasing')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Menu</h6>
                                        </div>
                                    </li>
                                @endhasrole
                                @php
                                $po          =  App\Models\CategoryPengajuanPembelian::where('status', 'Purchase Proses')->count();
                                $checkpo     =  App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('status','Cross Check PO');})->count();
                                $pyreq       =  App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('status','PO Approved');})->where('status', 'not like', '%Rejected%')->count();
                                $pyprocess   =  App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('status','Unpaid');})->where('status', 'not like', '%Rejected%')->count();
                                $delivery    =  App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('status','Paid');})->where('status', 'not like', '%Rejected%')->count();
                                $checkpr     =  App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('logistic_check', 1)->count();
                                @endphp
                                @hasrole('super purchase|purchasing|super admin')

                                    <li class="dropdown">
                                        <a class="nav-link menu-title {{ request()->is('menu-purchase-order') ? 'active' : '' }} {{ request()->is('menu-purchase-order/out') ? 'active' : '' }} {{ request()->is('menu-purchase-order/detail/*') ? 'active' : '' }}">
                                            <i data-feather="file-text"></i>
                                            <span>Purchase Order</span>
                                            @if($po == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 8">{{ $po }}</span>
                                            @endif
                                        </a>
                                        @if (request()->is('menu-purchase-order') || request()->is('menu-purchase-order/out') || request()->is('menu-purchase-order/detail/*') ? 'active' : '')
                                            <ul class="nav-submenu menu-content " style="display: block">
                                                <li>
                                                    <a class=" {{ request()->is('menu-purchase-order') || request()->is('menu-purchase-order/detail/*') ? 'active' : '' }}"
                                                        href="{{ url('/menu-purchase-order') }}">
                                                        <span>Purchase Order In</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class=" {{ request()->is('menu-purchase-order/out') || request()->is('menu-purchase-order/detail/*') ? 'active' : '' }}"
                                                        href="{{ url('/menu-purchase-order/out') }}">
                                                        <span>Purchase Order Out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                        <ul class="nav-submenu menu-content ">
                                            <li>
                                                <a class=" {{ request()->is('menu-purchase-order') ? 'active' : '' }}"
                                                    href="{{ url('/menu-purchase-order') }}">
                                                    <span>Purchase Order In</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class=" {{ request()->is('menu-purchase-order/out') ? 'active' : '' }}"
                                                    href="{{ url('/menu-purchase-order/out') }}">
                                                    <span>Purchase Order Out</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                @endhasrole

                                @hasrole('finance')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Menu</h6>
                                        </div>
                                    </li>
                                @endhasrole
                                @hasrole('finance')
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*dashboard*') ? 'active' : '' }}"
                                            href="{{ url('/dashboard') }}">
                                            <i data-feather="home"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                @endhasrole


                                @hasrole('finance|super admin')

                                    <li class="dropdown">
                                        {{-- <a class="nav-link menu-title {{ request()->is('payment_request') ? 'active' : '' }} {{ request()->is('payment_request/out') ? 'active' : '' }}
                                            {{ request()->is('payment_request/search/paymentreq_in') ? 'active' : '' }} {{ request()->is('payment_request/out/search/paymentreq_out') ? 'active' : '' }}"
                                            href="javascript:void(0)">
                                            <i data-feather="dollar-sign"></i>

                                            <span>Payment Request</span>
                                            @if($pyreq == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 8">{{ $pyreq }}</span>
                                            @endif
                                        </a> --}}
                                        @if (request()->is('payment_request') || request()->is('payment_request/out') || request()->is('payment_request/search/paymentreq_in') || request()->is('payment_request/out/search/paymentreq_out') ? 'active' : '')
                                            <ul class="nav-submenu menu-content" style="display: block;">
                                                <li
                                                    class="dropdown {{ request()->is('*payment_request*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('payment_request') || request()->is('payment_request/search/paymentreq_in') ? 'active' : '' }}"
                                                        href="{{ url('/payment_request') }}">
                                                        <span>Payment Request In</span>
                                                    </a>
                                                </li>
                                                <li
                                                    class="dropdown {{ request()->is('*payment_request*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('payment_request/out') || request()->is('payment_request/out/search/paymentreq_out') ? 'active' : '' }}"
                                                        href="{{ url('/payment_request/out') }}">
                                                        <span>Payment Request Out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                        <ul class="nav-submenu menu-content">
                                            <li class="dropdown {{ request()->is('*payment_request*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('payment_request') ? 'active' : '' }}"
                                                    href="{{ url('/payment_request') }}">
                                                    <span>Payment Request In</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*payment_request*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('payment_request/out') ? 'active' : '' }}"
                                                    href="{{ url('/payment_request/out') }}">
                                                    <span>Payment Request Out</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title {{ request()->is('menu-pengajuan-dana') ? 'active' : '' }} {{ request()->is('menu-pengajuan-dana/out') ? 'active' : '' }}
                                            {{ request()->is('menu-pengajuan-dana/search/pd_in') ? 'active' : '' }} {{ request()->is('menu-pengajuan-dana/search/pd_out') ? 'active' : '' }} "
                                            href="javascript:void(0)" style="white-space: nowrap;">
                                            <i data-feather="dollar-sign"></i>
                                            <span>Payment Process</span>
                                            @if($pyprocess == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 8">{{ $pyprocess }}</span>
                                            @endif
                                        </a>

                                        @if (request()->is('menu-pengajuan-dana') || request()->is('menu-pengajuan-dana/out') || request()->is('menu-pengajuan-dana/search/pd_in') || request()->is('menu-pengajuan-dana/search/pd_out') ? 'active' : '')
                                            <ul class="nav-submenu menu-content" style="display: block;">
                                                <li
                                                    class="dropdown {{ request()->is('*pengajuan-dana*') || request()->is('*pengajuan-dana/search/*')  ? 'active' : '' }} ">
                                                    <a class="{{ request()->is('menu-pengajuan-dana') || request()->is('*pengajuan-dana/search/pd_in') ? 'active' : '' }}"
                                                        href="{{ url('/menu-pengajuan-dana') }}">
                                                        <span> Payment Process In</span>
                                                    </a>
                                                </li>
                                                <li
                                                    class="dropdown {{ request()->is('*pengajuan-dana*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('menu-pengajuan-dana/out') || request()->is('*pengajuan-dana/search/pd_out') ? 'active' : '' }}"
                                                        href="{{ url('/menu-pengajuan-dana/out') }}">
                                                        <span> Payment Process Out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                        <ul class="nav-submenu menu-content">
                                            <li class="dropdown {{ request()->is('*pengajuan-dana*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('menu-pengajuan-dana') ? 'active' : '' }}"
                                                    href="{{ url('/menu-pengajuan-dana') }}">
                                                    <span> Payment Process In</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*pengajuan-dana*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('menu-pengajuan-dana/out') ? 'active' : '' }}"
                                                    href="{{ url('/menu-pengajuan-dana/out') }}">
                                                    <span> Payment Process Out</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endhasrole



                                {{-- <li class="dropdown">
                                    <a class="nav-link menu-title {{ request()->is('*track-dhl*') ? 'active' : '' }} {{ request()->is('*track-fedex*') ? 'active' : '' }}
                                        href="javascript:void(0)">
                                        <i data-feather="file"></i>
                                        <span>Trace Package</span></a>
                                    @if (request()->is('*track-dhl*') || request()->is('*track-fedex*') ? 'active': '')
                                        <ul class="nav-submenu menu-content" style="display: block;">
                                            <li class="dropdown">
                                                <a class="{{ request()->is('*track-dhl*') ? 'active' : '' }}"
                                                    href="{{ url('delivery/track-dhl') }}">
                                                    <i data-feather="check-circle"></i>
                                                    DHL
                                                </a>
                                            </li>

                                            <li class="dropdown">
                                                <a class="{{ request()->is('*track-fedex*') ? 'active' : '' }}"
                                                    href="{{ url('delivery/track-fedex') }}">
                                                    <i data-feather="check-circle"></i>
                                                    FedEx
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    <ul class="nav-submenu menu-content">
                                        <li class="dropdown">
                                            <a class="{{ request()->is('*track-dhl*') ? 'active' : '' }}"
                                                href="{{ url('delivery/track-dhl') }}">
                                                <i data-feather="check-circle"></i>
                                                DHL
                                            </a>
                                        </li>

                                        <li class="dropdown">
                                            <a class="{{ request()->is('*track-fedex*') ? 'active' : '' }}"
                                                href="{{ url('delivery/track-fedex') }}">
                                                <i data-feather="check-circle"></i>
                                                FedEx
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                @hasrole('super purchase|super admin')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Cross Check PO</h6>
                                        </div>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('check_po') ? 'active' : '' }}"
                                            href="{{ url('/check_po') }}">
                                            <i class="icofont icofont-tasks-alt"></i>
                                            <span>Check PO</span>
                                            @if($checkpo == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 8">{{ $checkpo }}</span>
                                            @endif
                                        </a>
                                    </li>

                                @endhasrole

                                <!--Menu-->

                                @hasrole('super user|General Manager Business')
                                    <li class="sidebar-main-title">
                                        <div>
                                        <h6>Home</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*dashboard*') ? 'active' : '' }}"
                                        href="{{ url('/dashboard') }}">
                                        <i data-feather="home"></i>
                                        <span>Dashboard</span>
                                        </a>
                                    </li>
                                @endhasrole

                                <!--TaskList-->
                                @hasrole('super purchase|super user|super admin|purchasing|finance|General Manager Business')
                                        <li class="sidebar-main-title">
                                            <div>
                                                <h6>Tasks</h6>
                                            </div>
                                        </li>


                                        @php
                                            $taskpr         = App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('atasan',Auth::user()->id)->get();
                                            $taskpo         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_po', Auth::user()->id)->where('status','Waiting For PO Approval');})->get();
                                            $taskpd         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_py', Auth::user()->id)->where('status','Invoicing Process');})->get();

                                            $taskprsindu         = App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('atasan',6)->get();
                                            $taskposindu         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_po', 6)->where('status','Waiting For PO Approval');})->get();
                                            $taskpdsindu         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_py', 6)->where('status','Invoicing Process');})->get();

                                            $taskprbayu         = App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('atasan',7)->get();
                                            $taskpobayu         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_po', 7)->where('status','Waiting For PO Approval');})->get();
                                            $taskpdbayu         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_py', 7)->where('status','Invoicing Process');})->get();

                                            $taskprvictor         = App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('atasan',8)->get();
                                            $taskpovictor         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_po', 8)->where('status','Waiting For PO Approval');})->get();
                                            $taskpdvictor         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_py', 8)->where('status','Invoicing Process');})->get();

                                            $taskprerwin         = App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('atasan',9)->get();
                                            $taskpoerwin         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_po', 9)->where('status','Waiting For PO Approval');})->get();
                                            $taskpderwin         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_py', 9)->where('status','Invoicing Process');})->get();

                                            $taskprtriyani         = App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('atasan',24)->get();
                                            $taskpotriyani         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_po', 24)->where('status','Waiting For PO Approval');})->get();
                                            $taskpdtriyani         = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->where('atasan_py', 24)->where('status','Invoicing Process');})->get();

                                            $taskpurchase   = App\Models\CategoryPengajuanPembelian::where('status', 'Purchase Request Approved')->get();
                                            $taskfinance    = App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){$i->whereIn('status',['Payment Approved','PO & Payment Approved']);})->where('status', 'not like', '%Rejected%')->get();
                                            // $pendingProjectCode = App\Models\ProjectCodeCreates::where('status','Waiting Approval')->count();

                                        @endphp

                                        @hasrole('super user|General Manager Business|super admin')
                                                <li class="dropdown">
                                                    <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan') ? 'active' : '' }} {{ request()->is('menu-taskList-atasan/out') ? 'active' : '' }}"
                                                        href="{{ url('/menu-taskList-atasan') }}">
                                                        <i data-feather="check-circle"></i>
                                                        Task List Super User Purchase Request
                                                        @if($taskpr->count() == 0)

                                                        @else
                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpr->count() }}</span>
                                                        @endif
                                                    </a>
                                                </li>

                                                <li class="dropdown">
                                                    <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po') ? 'active' : '' }} "
                                                        href="{{ url('/menu-taskList-atasan-po') }}">
                                                        <i data-feather="check-circle"></i>
                                                        Task List Super User Purchase Order
                                                        @if($taskpo->count() == 0)

                                                        @else
                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpo->count() }}</span>
                                                        @endif
                                                    </a>
                                                </li>

                                                <li class="dropdown">
                                                    <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment') ? 'active' : '' }}"
                                                        href="{{ url('menu-taskList-atasan-payment') }}">
                                                        <i data-feather="check-circle"></i>
                                                        Task List Super User Payment Request
                                                        @if($taskpd->count() == 0)

                                                        @else
                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpd->count() }}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                        @endhasrole
                                        @hasrole('super admin|General Manager Business')
                                            {{-- <li class="sidebar-main-title">
                                                <div>
                                                <h6>Task List Project Code</h6>
                                                </div>
                                            </li>
                                            <li class="dropdown">
                                                <a class="nav-link menu-title link-nav {{ request()->is('*project-code/approval*') ? 'active' : '' }}"
                                                href="{{ url('project-code/approval') }}">
                                                <i data-feather="home"></i>
                                                    Task List Code
                                                    @if($pendingProjectCode == 0)
                                                    @else
                                                    <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $pendingProjectCode }}</span>
                                                    @endif
                                                </a>
                                            </li> --}}
                                        @endhasrole
                                    <li class="dropdown">
                                        @hasrole('super purchase|purchasing|super admin|finance')
                                                <a class="nav-link menu-title
                                                        {{ request()->is('menu-task-list') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}
                                                        {{ request()->is('menu-tasklist-finance/out') ? 'active' : '' }} {{ request()->is('menu-tasklist-finance') ? 'active' : '' }}
                                                        {{ request()->is('menu-tasklist-finance/search/task-finance') ? 'active' : '' }} {{ request()->is('menu-tasklist-finance/out/search/task-finance-Out') ? 'active' : '' }}
                                                        {{ request()->is('menu-tasklist-finance/po_detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }}
                                                        {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}"
                                                        href="javascript:void(0)">
                                                        <i data-feather="check-circle"></i>
                                                        <span>Task List</span></a>
                                                    @if (request()->is('menu-tasklist-finance/out') || request()->is('menu-tasklist-finance') ||request()->is('menu-task-list') ||
                                                    request()->is('menu-task-list/out') || request()->is('menu-task-list/detail/*') ||
                                                    request()->is('menu-tasklist-finance/out/search/task-finance-Out')||
                                                    request()->is('menu-tasklist-finance/search/task-finance')||
                                                    request()->is('menu-task-list/upcoming') ||
                                                    request()->is('menu-task-list/upcoming/detail/*') ||
                                                    request()->is('menu-task-list/search/upcoming*')||
                                                    request()->is('menu-tasklist-finance/po_detail/*')? 'active': '')
                                                        <ul class="nav-submenu menu-content" style="display: block">

                                                            @hasrole('super purchase|purchasing|super admin')
                                                                <li class="dropdown">
                                                                    <a class="submenu-title {{ request()->is('menu-task-list') ? 'active' : '' }}{{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }} {{ request()->is('menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}"
                                                                        href="javascript:void(0)">
                                                                        Task List Purchasing
                                                                        {{-- @dd($taskpurchase) --}}
                                                                        @if($taskpurchase->count() == 0 )

                                                                        @else
                                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpurchase->count() }}</span>
                                                                        @endif
                                                                        <span class="sub-arrow"><i
                                                                                data-feather="chevron-right"></i></span></a>
                                                                    @if (request()->is('menu-task-list') || request()->is('menu-task-list/out') || request()->is('menu-task-list/upcoming')  || request()->is('menu-task-list/detail/*')  || request()->is('menu-task-list/upcoming/detail/*') || request()->is('menu-task-list/search/upcoming*') ? 'active' : '')
                                                                        <ul class="nav-sub-childmenu submenu-content"
                                                                            style="display: block;">
                                                                            @hasrole('super purchase|super admin')
                                                                            {{-- Only Super Purchase and Super Admin --}}
                                                                            <li
                                                                                class=" {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}">
                                                                                <a href="{{ url('/menu-task-list/upcoming') }}"
                                                                                    class="{{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}">
                                                                                    <span style="white-space: nowrap;">Task List Up Comming</span>
                                                                                </a>
                                                                            </li>
                                                                            @endhasrole
                                                                            <li
                                                                                class=" {{ request()->is('menu-task-list') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                                                <a href="{{ url('/menu-task-list') }}"
                                                                                    class="{{ request()->is('menu-task-list') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                                                    <span>Task List In</span>
                                                                                </a>
                                                                            </li>
                                                                            <li
                                                                                class=" {{ request()->is('/menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }}">
                                                                                <a href="{{ url('/menu-task-list/out') }}"
                                                                                    class="{{ request()->is('menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }}">
                                                                                    <span>Task List Out</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    @endif
                                                                    <ul class="nav-sub-childmenu submenu-content">
                                                                        @hasrole('super purchase|super admin')
                                                                        {{-- Only Super Purchase and Super Admin --}}
                                                                        <li class=" {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}">
                                                                            <a href="{{ url('/menu-task-list/upcoming') }}"
                                                                                class="{{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}">
                                                                                <span style="white-space: nowrap;">Task List Up Comming</span>
                                                                            </a>
                                                                        </li>
                                                                        @endhasrole
                                                                        <li
                                                                            class=" {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                                            <a href="{{ url('/menu-task-list') }}"
                                                                                class="{{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                                                <span>Task List In</span>
                                                                            </a>
                                                                        </li>
                                                                        <li
                                                                            class=" {{ request()->is('/menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }}">
                                                                            <a href="{{ url('/menu-task-list/out') }}"
                                                                                class="{{ request()->is('menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }}">
                                                                                <span>Task List Out</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            @endhasrole
                                                            @hasrole('finance|super admin')
                                                                <li class="dropdown">
                                                                    <a class="submenu-title {{ request()->is('menu-tasklist-finance') ? 'active' : '' }} {{ request()->is('menu-tasklist-finance/out') ? 'active' : '' }}"
                                                                        href="javascript:void(0)">
                                                                        Task List Finance
                                                                        @if($taskfinance->count() == 0)

                                                                        @else
                                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskfinance->count() }}</span>
                                                                        @endif
                                                                        <span class="sub-arrow"><i
                                                                                data-feather="chevron-right"></i></span></a>
                                                                    @if (request()->is('menu-tasklist-finance') || request()->is('menu-tasklist-finance/out') || request()->is('menu-tasklist-finance/out/search/task-finance-Out')
                                                                    ||request()->is('menu-tasklist-finance/po_detail/*')|| request()->is('menu-tasklist-finance/search/task-finance') ? 'active' : '')
                                                                        <ul class="nav-sub-childmenu submenu-content"
                                                                            style="display: block;">
                                                                            <li
                                                                                class=" {{ request()->is('menu-tasklist-finance') ? 'active' : '' }}">
                                                                                <a href="{{ url('/menu-tasklist-finance') }}"
                                                                                    class="{{ request()->is('menu-tasklist-finance') || request()->is('menu-tasklist-finance/search/task-finance') ? 'active' : '' }}">
                                                                                    <span>Task List In</span>
                                                                                </a>
                                                                            </li>
                                                                            <li
                                                                                class=" {{ request()->is('/menu-tasklist-finance/out') ? 'active' : '' }}">
                                                                                <a href="{{ url('/menu-tasklist-finance/out') }}"
                                                                                    class="{{ request()->is('menu-tasklist-finance/out') || request()->is('menu-tasklist-finance/out/search/task-finance-Out') ? 'active' : '' }}">
                                                                                    <span>Task List Out</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    @endif
                                                                    <ul class="nav-sub-childmenu submenu-content">
                                                                        <li
                                                                            class=" {{ request()->is('menu-tasklist-finance') ? 'active' : '' }}">
                                                                            <a href="{{ url('/menu-tasklist-finance') }}"
                                                                                class="{{ request()->is('menu-tasklist-finance') ? 'active' : '' }}">
                                                                                <span>Task List In</span>
                                                                            </a>
                                                                        </li>
                                                                        <li
                                                                            class=" {{ request()->is('/menu-tasklist-finance/out') ? 'active' : '' }}">
                                                                            <a href="{{ url('/menu-tasklist-finance/out') }}"
                                                                                class="{{ request()->is('menu-tasklist-finance/out') ? 'active' : '' }}">
                                                                                <span>Task List Out</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            @endhasrole
                                                        </ul>
                                                    @endif
                                                </a>
                                        @endhasrole
                                        <ul class="nav-submenu menu-content">

                                            @hasrole('super purchase|purchasing|super admin')
                                                <li class="dropdown">
                                                    <a class="submenu-title {{ request()->is('menu-task-list') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }} {{ request()->is('menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}"
                                                        href="javascript:void(0)">
                                                        Task List Purchasing
                                                        @if($taskpurchase->count() == 0)

                                                        @else
                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpurchase->count() }}</span>
                                                        @endif
                                                        <span class="sub-arrow"><i data-feather="chevron-right"></i></span></a>

                                                    <ul class="nav-sub-childmenu submenu-content">
                                                        @hasrole('super purchase|super admin')
                                                            {{-- Only Super Purchase and Super Admin --}}
                                                            <li class=" {{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}">
                                                                <a href="{{ url('/menu-task-list/upcoming') }}"
                                                                    class="{{ request()->is('menu-task-list/upcoming') ? 'active' : '' }} {{ request()->is('menu-task-list/upcoming/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/upcoming*') ? 'active' : '' }}">
                                                                    <span style="white-space: nowrap;">Task List Up Comming</span>
                                                                </a>
                                                            </li>
                                                        @endhasrole
                                                        <li class=" {{ request()->is('menu-task-list') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                            <a href="{{ url('/menu-task-list') }}"
                                                                class="{{ request()->is('menu-task-list') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                                <span>Task List In</span>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class=" {{ request()->is('/menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                            <a href="{{ url('/menu-task-list/out') }}"
                                                                class="{{ request()->is('menu-task-list/out') ? 'active' : '' }} {{ request()->is('menu-task-list/detail/*') ? 'active' : '' }} {{ request()->is('menu-task-list/search/taskPOIn') ? 'active' : '' }}">
                                                                <span>Task List Out</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endhasrole
                                            @hasrole('finance|super admin')
                                                <li class="dropdown">
                                                    <a class="submenu-title {{ request()->is('menu-tasklist-finance') ? 'active' : '' }} {{ request()->is('menu-tasklist-finance/out') ? 'active' : '' }}"
                                                        href="javascript:void(0)">
                                                        Task List Finance
                                                        @if($taskfinance->count() == 0)

                                                        @else
                                                        <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskfinance->count() }}</span>
                                                        @endif
                                                        <span class="sub-arrow"><i data-feather="chevron-right"></i></span></a>
                                                    <ul class="nav-sub-childmenu submenu-content">
                                                        <li
                                                            class=" {{ request()->is('menu-tasklist-finance') ? 'active' : '' }}">
                                                            <a href="{{ url('/menu-tasklist-finance') }}"
                                                                class="{{ request()->is('menu-tasklist-finance') ? 'active' : '' }}">
                                                                <span>Task List In</span>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class=" {{ request()->is('/menu-tasklist-finance/out') ? 'active' : '' }}">
                                                            <a href="{{ url('/menu-tasklist-finance/out') }}"
                                                                class="{{ request()->is('menu-tasklist-finance/out') ? 'active' : '' }}">
                                                                <span>Task List Out</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endhasrole
                                        </ul>
                                    </li>
                                @endhasrole



                                @hasrole('super admin')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Tasks Sindu Irawan</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan/taskSindu') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan/taskSindu') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Request
                                            @if($taskprsindu->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskprsindu->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po/taskPoSindu') ? 'active' : '' }} "
                                            href="{{ url('/menu-taskList-atasan-po/taskPoSindu') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Order
                                            @if($taskposindu->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskposindu->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment/taskPySindu') ? 'active' : '' }}"
                                            href="{{ url('menu-taskList-atasan-payment/taskPySindu') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Payment Request
                                            @if($taskpdsindu->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpdsindu->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Tasks Bayu Nugraha</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan/taskBayu') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan/taskBayu') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Request
                                            @if($taskprbayu->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskprbayu->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po/taskPoBayu') ? 'active' : '' }} "
                                            href="{{ url('/menu-taskList-atasan-po/taskPoBayu') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Order
                                            @if($taskpobayu->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpobayu->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment/taskPyBayu') ? 'active' : '' }}"
                                            href="{{ url('menu-taskList-atasan-payment/taskPyBayu') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Payment Request
                                            @if($taskpdbayu->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpdbayu->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Tasks Victor</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan/taskVictor') ? 'active' : '' }} {{ request()->is('menu-taskList-atasan/out') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan/taskVictor') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Request
                                            @if($taskprvictor->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskprvictor->count() }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po/taskPoVictor') ? 'active' : '' }} "
                                            href="{{ url('/menu-taskList-atasan-po/taskPoVictor') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Order
                                            @if($taskpovictor->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpovictor->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment/taskPyVictor') ? 'active' : '' }}"
                                            href="{{ url('menu-taskList-atasan-payment/taskPyVictor') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Payment Request
                                            @if($taskpdvictor->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpdvictor->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Tasks Erwin Danuaji</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan/taskErwin') ? 'active' : '' }} {{ request()->is('menu-taskList-atasan/out') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan/taskErwin') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Request
                                            @if($taskprerwin->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskprerwin->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po/taskPoErwin') ? 'active' : '' }} "
                                            href="{{ url('/menu-taskList-atasan-po/taskPoErwin') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Order
                                            @if($taskpoerwin->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpoerwin->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment/taskPyErwin') ? 'active' : '' }}"
                                            href="{{ url('menu-taskList-atasan-payment/taskPyErwin') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Payment Request
                                            @if($taskpderwin->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpderwin->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Tasks Triyani</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan/taskTriyani') ? 'active' : '' }} {{ request()->is('menu-taskList-atasan/out') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan/taskTriyani') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Request
                                            @if($taskprtriyani->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskprtriyani->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po/taskPoTriyani') ? 'active' : '' }} "
                                            href="{{ url('/menu-taskList-atasan-po/taskPoTriyani') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Purchase Order
                                            @if($taskpotriyani->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpotriyani->count() }}</span>
                                            @endif
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment//taskPyTriyani') ? 'active' : '' }}"
                                            href="{{ url('menu-taskList-atasan-payment//taskPyTriyani') }}">
                                            <i data-feather="check-circle"></i>
                                            Task List Super User Payment Request
                                            @if($taskpdtriyani->count() == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $taskpdtriyani->count() }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endhasrole
                                <!--End TaskList-->

                                <!--Admin-->
                                @hasrole('admin|super admin')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Admin</h6>
                                        </div>
                                    </li>

                                    <li class="sidebar-item {{ request()->is('*admin*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('admin') ? 'active' : '' }}"
                                            href="{{ url('/admin') }}">
                                            <i class="bi bi-person-workspace"></i>
                                            <span>+Add Users</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item {{ request()->is('*role*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('role') ? 'active' : '' }}"
                                            href="{{ url('/role') }}">
                                            <i class="bi bi-person-workspace"></i>
                                            <span>Add Roles</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item {{ request()->is('*pengajuan_pembelian*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('pengajuan_pembelian') ? 'active' : '' }}"
                                            href="{{ url('/pengajuan_pembelian') }}">
                                            <i class="bi bi-person-workspace"></i>
                                            <span>List History Item</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item {{ request()->is('*item-history*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('item-history') ? 'active' : '' }}"
                                            href="{{ url('/item-history') }}">
                                            <i class="bi bi-person-workspace"></i>
                                            <span>List Stock Item</span>
                                        </a>
                                    </li>
                                @endhasrole
                                <!--End Admin-->

                                <!--Data Master-->
                                @hasrole('admin|super admin|purchasing')

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Master Supplier</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title {{ request()->is('menu-perusahaan') }} {{ request()->is('menu-private-person') }} {{ request()->is('menu-ecommerce') }}"
                                            href="javascript:void(0)">
                                            <i data-feather="package"></i>
                                            <span>Suppliers</span></a>
                                        @if (request()->is('menu-perusahaan') || request()->is('menu-private-person') || request()->is('menu-ecommerce')
                                            ? 'active'
                                            : '')
                                            <ul class="nav-submenu menu-content" style="display: block;">
                                                <li class="{{ request()->is('menu-perusahaan') }}">
                                                    <a class="{{ request()->is('menu-perusahaan') ? 'active' : '' }}"
                                                        href="{{ url('/menu-perusahaan') }}">
                                                        <i class="icofont icofont-building-alt"></i>
                                                        <span> &nbsp;&nbsp;&nbsp;&nbsp; Company</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="{{ request()->is('menu-private-person') ? 'active' : '' }}"
                                                        href="{{ url('/menu-private-person') }}">
                                                        <i data-feather="user-check"></i>
                                                        <span>Private Person</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="{{ request()->is('menu-ecommerce') ? 'active' : '' }}"
                                                        href="{{ url('/menu-ecommerce') }}">
                                                        <i data-feather="shopping-cart"></i>
                                                        <span>E-commerce</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                        <ul class="nav-submenu menu-content">
                                            <li class="{{ request()->is('menu-perusahaan') }}">
                                                <a class="{{ request()->is('menu-perusahaan') ? 'active' : '' }}"
                                                    href="{{ url('/menu-perusahaan') }}">
                                                    <i class="icofont icofont-building-alt"></i>
                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp; Company</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ request()->is('menu-private-person') ? 'active' : '' }}"
                                                    href="{{ url('/menu-private-person') }}">
                                                    <i data-feather="user-check"></i>
                                                    <span>Private Person</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ request()->is('menu-ecommerce') ? 'active' : '' }}"
                                                    href="{{ url('/menu-ecommerce') }}">
                                                    <i data-feather="shopping-cart"></i>
                                                    <span>E-commerce</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Master Bank </h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*bank*') ? 'active' : '' }}"
                                            href="{{ url('/bank') }}">
                                            <i class="icofont icofont-bank"></i> &nbsp;&nbsp;&nbsp;
                                            <span>Bank</span>
                                        </a>
                                    </li>

                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Master Currency </h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*currency*') ? 'active' : '' }}"
                                            href="{{ url('/currency') }}">
                                            <i data-feather="dollar-sign"></i> &nbsp;&nbsp;&nbsp;
                                            <span>Currency</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Master Uom </h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('*uom*') ? 'active' : '' }}"
                                            href="{{ url('/uom') }}">
                                            <i class="icofont icofont-settings-alt"></i> &nbsp;&nbsp;&nbsp;
                                            <span>Uom</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('admin|super admin')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Data Master Submission</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title {{ request()->is('who-submitted') ? 'active' : '' }} {{ request()->is('project-reference') ? 'active' : '' }} {{ request()->is('office') ? 'active' : '' }} {{ request()->is('workshop') ? 'active' : '' }} {{ request()->is('inventory') ? 'active' : '' }} {{ request()->is('RnD') ? 'active' : '' }} {{ request()->is('department') ? 'active' : '' }} {{ request()->is('travel') ? 'active' : '' }}"
                                            href="javascript:void(0)">
                                            <i data-feather="file"></i>
                                            <span>Submissions</span></a>
                                        @if (request()->is('who-submitted') ||
                                        request()->is('project-reference') ||
                                        request()->is('office') ||
                                        request()->is('workshop') ||
                                        request()->is('inventory') ||
                                        request()->is('RnD') ||
                                        request()->is('department') ||
                                        request()->is('travel')
                                            ? 'active'
                                            : '')
                                            <ul class="nav-submenu menu-content" style="display: block;">
                                                <li
                                                    class="dropdown {{ request()->is('*who-submitted*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('who-submitted') ? 'active' : '' }}"
                                                        href="{{ url('/who-submitted') }}">
                                                        <i data-feather="user"></i>
                                                        <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Who Submitted</span>
                                                    </a>
                                                </li>
                                                <li
                                                    class="dropdown {{ request()->is('*project-reference*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('project-reference') ? 'active' : '' }}"
                                                        href="{{ url('/project-reference') }}">
                                                        <i data-feather="airplay"></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Project</span>
                                                    </a>
                                                </li>
                                                <li class="dropdown {{ request()->is('*office*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('office') ? 'active' : '' }}"
                                                        href="{{ url('/office') }}">
                                                        <i class="icofont icofont-building-alt"></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Office</span>
                                                    </a>
                                                </li>
                                                <li class="dropdown {{ request()->is('*workshop*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('workshop') ? 'active' : '' }}"
                                                        href="{{ url('/workshop') }}">
                                                        <i class="icofont icofont-people"></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Workshop</span>
                                                    </a>
                                                </li>
                                                <li class="dropdown {{ request()->is('*inventory*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('invetory') ? 'active' : '' }}"
                                                        href="{{ url('/inventory') }}">
                                                        <i class="icofont icofont-list"></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Inventory</span>
                                                    </a>
                                                </li>
                                                <li class="dropdown {{ request()->is('*RnD*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('RnD') ? 'active' : '' }}"
                                                        href="{{ url('/RnD') }}">
                                                        <i class="icofont icofont-presentation-alt  "></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose R&D</span>
                                                    </a>
                                                </li>
                                                <li class="dropdown {{ request()->is('*department*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('department') ? 'active' : '' }}"
                                                        href="{{ url('/department') }}">
                                                        <i data-feather="briefcase"></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Department</span>
                                                    </a>
                                                </li>
                                                <li class="dropdown {{ request()->is('*travel*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('travel') ? 'active' : '' }}"
                                                        href="{{ url('/travel') }}">
                                                        <i class="icofont icofont-airplane-alt"></i>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp; Travel</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                        <ul class="nav-submenu menu-content">
                                            <li class="dropdown {{ request()->is('*who-submitted*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('who-submitted') ? 'active' : '' }}"
                                                    href="{{ url('/who-submitted') }}">
                                                    <i data-feather="user"></i>
                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Who Submitted</span>
                                                </a>
                                            </li>
                                            <li
                                                class="dropdown {{ request()->is('*project-reference*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('project-reference') ? 'active' : '' }}"
                                                    href="{{ url('/project-reference') }}">
                                                    <i data-feather="airplay"></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Project</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*office*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('office') ? 'active' : '' }}"
                                                    href="{{ url('/office') }}">
                                                    <i class="icofont icofont-building-alt"></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Office</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*workshop*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('workshop') ? 'active' : '' }}"
                                                    href="{{ url('/workshop') }}">
                                                    <i class="icofont icofont-people"></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Workshop</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*inventory*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('invetory') ? 'active' : '' }}"
                                                    href="{{ url('/inventory') }}">
                                                    <i class="icofont icofont-list"></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Inventory</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*RnD*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('RnD') ? 'active' : '' }}"
                                                    href="{{ url('/RnD') }}">
                                                    <i class="icofont icofont-presentation-alt  "></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose R&D</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*department*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('department') ? 'active' : '' }}"
                                                    href="{{ url('/department') }}">
                                                    <i data-feather="briefcase"></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Department</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*travel*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('travel') ? 'active' : '' }}"
                                                    href="{{ url('/travel') }}">
                                                    <i class="icofont icofont-airplane-alt"></i>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Purpose Travel</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endhasrole
                                <!--end Data Master-->


                                {{-- Dashboard Logistic Check --}}
                                @hasrole('Logistic Checker')
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>Dashboard</h6>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav {{ request()->is('*dashboard*') ? 'active' : '' }}"
                                        href="{{ url('/dashboard') }}">
                                        <i data-feather="home"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                @endhasrole
                                {{-- End Logistic Check --}}


                                {{-- Menu Logistic Check --}}
                                @hasrole('super admin|Logistic Checker')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Inventory Checker</h6>
                                        </div>
                                    </li>

                                    <li class="dropdown">
                                        <a class="nav-link menu-title link-nav {{ request()->is('check-logistic') ? 'active' : '' }}"
                                            href="{{ route('logistic.index') }}">
                                            <i data-feather="check-circle"></i>
                                            Inventory Check
                                            @if($checkpr == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 10">{{ $checkpr }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endhasrole
                                {{-- End Menu Logistic Check --}}

                                {{-- Delivery --}}

                                @hasrole('Logistic Checker|super admin|purchasing|super purchase')
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Delivery</h6>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-link menu-title {{ request()->is('delivery') ? 'active' : '' }} {{ request()->is('delivery/out') ? 'active' : '' }}"
                                            href="javascript:void(0)">
                                            <i data-feather="truck"></i>
                                            <span>Delivery</span>
                                            @if($delivery == 0)

                                            @else
                                            <span class="badge rounded-pill badge-danger" style="font-size: 8">{{ $delivery }}</span>
                                            @endif
                                        </a>
                                        @if (request()->is('delivery') || request()->is('delivery/out') ? 'active' : '')
                                            <ul class="nav-submenu menu-content" style="display: block">
                                                <li
                                                    class="dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('delivery') ? 'active' : '' }}"
                                                        href="{{ url('/delivery') }}">
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;Delivery In</span>
                                                    </a>
                                                </li>
                                                <li
                                                    class="dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                                    <a class="{{ request()->is('delivery/out') ? 'active' : '' }}"
                                                        href="{{ url('/delivery/out') }}">
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;Delivery Out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                        <ul class="nav-submenu menu-content">
                                            <li class="dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('delivery') ? 'active' : '' }}"
                                                    href="{{ url('/delivery') }}">
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Delivery In</span>
                                                </a>
                                            </li>
                                            <li class="dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                                <a class="{{ request()->is('delivery/out') ? 'active' : '' }}"
                                                    href="{{ url('/delivery/out') }}">
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Delivery Out</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endhasrole

                                {{-- End Delivery --}}


                                <!--History-->
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>History</h6>
                                    </div>
                                </li>

                                @hasrole('user|super admin|admin project')
                                    <li
                                        class="dropdown {{ request()->is('*/menu-pengajuan-pembelian/history*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-pengajuan-pembelian/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-pengajuan-pembelian/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Purchase Request Success</span>
                                        </a>
                                    </li>
                                    <li
                                        class="dropdown {{ request()->is('*/menu-pengajuan-pembelian/history-fail*') || request()->is('menu-pengajuan-pembelian/search/historyfailprq') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-pengajuan-pembelian/history-fail') || request()->is('menu-pengajuan-pembelian/search/historyfailprq') ? 'active' : '' }}"
                                            href="{{ url('/menu-pengajuan-pembelian/history-fail') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Purchase Request Fail</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('super user|General Manager Business|super admin')
                                    <li
                                        class="dropdown  {{ request()->is('menu-taskList-atasan/history') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Task List Purchase Request </span>
                                        </a>
                                    </li>
                                    <li
                                        class="dropdown {{ request()->is('menu-taskList-atasan-po/history') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-po/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan-po/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Task List Purchase Order</span>
                                        </a>
                                    </li>
                                    <li
                                        class="dropdown {{ request()->is('menu-taskList-atasan-payment/history') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-taskList-atasan-payment/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-taskList-atasan-payment/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Task List Payment Request</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('purchasing|super admin')
                                    <li class=" dropdown {{ request()->is('*menu-task-list*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-task-list/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-task-list/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Purchase Task</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('purchasing|super admin')
                                    <li class=" dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-purchase-order/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-purchase-order/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Purchase Order</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('super purchase|super admin')
                                    <li class=" dropdown {{ request()->is('/check_po/history') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('check_po/history') ? 'active' : '' }}"
                                            href="{{ route('check_po.history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Check PO</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('finance|super admin')
                                    <li class=" dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('payment_request/history') ? 'active' : '' }}"
                                            href="{{ url('/payment_request/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Payment Reqs</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('finance|super admin')
                                    <li
                                        class=" dropdowns {{ request()->is('*menu-tasklist-finance*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-tasklist-finance/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-tasklist-finance/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Finance Task</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('super purchase|purchasing|finance|super admin')
                                    <li class=" dropdowns {{ request()->is('*menu-pengajuan-dana*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('menu-pengajuan-dana/history') ? 'active' : '' }}"
                                            href="{{ url('/menu-pengajuan-dana/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Payment Process</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('Logistic Checker|super admin|purchasing|super purchase')
                                    <li class=" dropdown {{ request()->is('*purchase-order*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('delivery/history') ? 'active' : '' }}"
                                            href="{{ url('/delivery/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Delivery</span>
                                        </a>
                                    </li>
                                @endhasrole

                                @hasrole('super admin|Logistic Checker')
                                    <li class=" dropdown {{ request()->is('*check-logistic/history*') ? 'active' : '' }}">
                                        <a class="nav-link menu-title link-nav {{ request()->is('check-logistic/history') ? 'active' : '' }}"
                                            href="{{ url('/check-logistic/history') }}">
                                            <i data-feather="activity"></i>
                                            <span>History Inventory Check</span>
                                        </a>
                                    </li>
                                @endhasrole

                                <!--End History-->
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </div>
                </nav>
            </header>
            <!--End Settings-->

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
                            <h5 style="font-weight: bold; font-size: 8;" class="mb-0"><img
                                    src="{{ asset('../assets/images/Logo-Intek-8K.png') }}" alt=""
                                    width="79" height="25" class="fluid">&nbsp;&copy;SOLUSI INTEK INDONESIA
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <p class="pull-right mb-0" style="color: green;">
                                <mark
                                    style="background-color: black; color: #FFFFFF; font-weight: bold; font-size:10px;">E-Procurement</mark>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
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
    <script src="{{ asset('../assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('../assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('../assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('../assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>


    <!-- Theme js-->
    <script src="{{ asset('../assets/js/script.js') }}"></script>
    {{-- <script src="{{ asset('../assets/js/theme-customizer/customizer.js') }}"></script> --}}

    <script src="{{ asset('../assets/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('assets/js/jam.js') }}"></script>
    <script src="{{ asset('../assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('../assets/js/tooltip-init.js') }}"></script>

    <script src="{{ asset('../assets/js/tooltip-init.js') }}"></script>
    <!-- Plugins JS Ends-->
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script>
        var form = document.getElementById("form-user");
        function submitUser(){
            form.submit();
        }
    </script>

    @yield('scripts')
</body>

</html>
