<title>Dashboard</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Dashboard</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid general-widget">
            <div class="row">
                @hasrole('super admin')
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-pengajuan-pembelian') }}"></a>
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgba(150, 148, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgba(150, 148, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgba(150, 148, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        REQUEST</h6>
                                    <h2 class="mb-0 counter" style="color: rgba(150, 148, 255, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-4"
                            style="border-left: 10px solid rgba(87, 212, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="check-circle"
                                        style="color: rgba(87, 212, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    @if (\App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (\App\Models\CategoryPengajuanPembelian::where('status', 'Purchase Submission Approved'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (\App\Models\CategoryPengajuanPembelian::where('status', 'Waiting For PO Approval'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid red;">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: red;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: red; font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        ORDER</h6>
                                    <h2 class="mb-0 counter" style="color: red;">
                                        {{ \App\Models\CategoryPO::count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(251, 140, 1);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="dollar-sign"
                                        style="color: rgb(251, 140, 1);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(251, 140, 1); font-family: 'Times New Roman', Times, serif;">
                                        PAYMENT <br>
                                        PROSES</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(251, 140, 1);">
                                        {{ \App\Models\CategoryPD::count() }}</h2>
                                    <i class="icon-bg" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endhasrole
                @hasrole('user')
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-pengajuan-pembelian') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgba(150, 148, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgba(150, 148, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgba(150, 148, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        REQUEST</h6>
                                    <h2 class="mb-0 counter" style="color: rgba(150, 148, 255, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-pengajuan-pembelian') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgba(255, 225, 0, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgba(255, 225, 0, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgba(255, 225, 0, 0.9); font-family: 'Times New Roman', Times, serif;">
                                        PENDING <br>
                                        REQUEST</h6>
                                    <h2 class="mb-0 counter" style="color: rgba(255, 230, 0, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status', 'Awaiting Purchase Request Approval')->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-pengajuan-pembelian') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgb(12, 174, 0);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgb(12, 174, 0);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgb(12, 174, 0); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        COMPLETED</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(12, 174, 0);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status', 'Delivery Success')->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-pengajuan-pembelian') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgb(255, 0, 0);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgb(255, 0, 0);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgb(255, 0, 0); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        FAILED</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(255, 0, 0);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status','like',"%Rejected%")->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                @endhasrole
                @hasrole('super user|super admin')
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('menu-taskList-atasan') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-4"
                            style="border-left: 10px solid rgba(87, 188, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="check-circle"
                                        style="color: rgba(87, 188, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                        <h6
                                            style="color: rgba(87, 188, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br>
                                            PURCHASE REQUEST</h6>
                                       @if (Auth::user()->id === 3)

                                        <h2 class="mb-0 counter" style="color: rgba(87, 188, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan',3)->where('status','Awaiting Purchase Request Approval')->count() }}
                                        </h2>

                                        @elseif(Auth::user()->id === 6)

                                        <h2 class="mb-0 counter" style="color: rgba(87, 188, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan',6)->where('status','Awaiting Purchase Request Approval')->count() }}
                                        </h2>

                                        @elseif(Auth::user()->id === 7)

                                        <h2 class="mb-0 counter" style="color: rgba(87, 188, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan',7)->where('status','Awaiting Purchase Request Approval')->count() }}
                                        </h2>

                                        @elseif(Auth::user()->id === 8)

                                        <h2 class="mb-0 counter" style="color: rgba(87, 188, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan',8)->where('status','Awaiting Purchase Request Approval')->count() }}
                                        </h2>

                                        @elseif(Auth::user()->id === 9)

                                        <h2 class="mb-0 counter" style="color: rgba(87, 188, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan',9)->where('status','Awaiting Purchase Request Approval')->count() }}
                                        </h2>

                                        @endif
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                 </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-taskList-atasan-po') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-4"
                            style="border-left: 10px solid rgba(35, 96, 117, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="check-circle"
                                        style="color: rgba(35, 96, 117, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                        <h6
                                            style="color: rgba(35, 96, 117, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br>PURCHASE ORDER</h6>
                                    @if(Auth::user()->id === 3)
                                        <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan_po',3)->where('status','Waiting For PO Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (Auth::user()->id === 6)

                                        <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan_po',6)->where('status','Waiting For PO Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (Auth::user()->id === 7)

                                        <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan_po',7)->where('status','Waiting For PO Approval')->count() }}
                                        </h2>
                                    @elseif (Auth::user()->id === 8)
                                    <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('atasan_po',8)->where('status','Waiting For PO Approval')->count() }}
                                    </h2>

                                    @elseif (Auth::user()->id === 9)
                                    <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('atasan_po',9)->where('status','Waiting For PO Approval')->count() }}
                                    </h2>
                                    @endif
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-taskList-atasan-payment') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-4"
                            style="border-left: 10px solid rgba(117, 0, 184, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="check-circle"
                                        style="color: rgba(117, 0, 184, 0.9);"></i>
                                </div>
                                <div class="media-body">

                                        <h6
                                            style="color: rgba(117, 0, 184, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> PAYMENT REQUEST</h6>
                                        @if(Auth::user()->id === 3)
                                            <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                                {{ \App\Models\CategoryPengajuanPembelian::where('atasan_py',3)->where('status','Invoicing Process')->count() }}
                                            </h2>
                                            <i class="icon-bg" data-feather="check-circle"></i>
                                        @elseif (Auth::user()->id === 6)

                                            <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                                {{ \App\Models\CategoryPengajuanPembelian::where('atasan_py',6)->where('status','Invoicing Process')->count() }}
                                            </h2>
                                            <i class="icon-bg" data-feather="check-circle"></i>
                                        @elseif (Auth::user()->id === 7)

                                            <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                                {{ \App\Models\CategoryPengajuanPembelian::where('atasan_py',7)->where('status','Invoicing Process')->count() }}
                                            </h2>
                                        @elseif (Auth::user()->id === 8)
                                        <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan_py',8)->where('status','Invoicing Process')->count() }}
                                        </h2>

                                        @elseif (Auth::user()->id === 9)
                                        <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan_py',9)->where('status','Invoicing Process')->count() }}
                                        </h2>
                                        @endif
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                @endhasrole
                @hasrole('purchasing|super purchase')

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-task-list') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid red;">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: red;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: red; font-family: 'Times New Roman', Times, serif;">
                                        TASK LIST <br>
                                        PURCHASE</h6>
                                    <h2 class="mb-0 counter" style="color: red;">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('status','Purchase Request Approved')->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-purchase-order') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid  rgba(87, 212, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="shopping-cart"
                                        style="color:  rgba(87, 212, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color:  rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        ORDER</h6>
                                    <h2 class="mb-0 counter" style="color:  rgba(87, 212, 255, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('status','Purchase Proses')->count() }}</h2>
                                    <i class="icon-bg" data-feather="shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/payment_request') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(254, 159, 56);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgb(254, 159, 56);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(254, 159, 56); font-family: 'Times New Roman', Times, serif;">
                                        PAYMENT <br>
                                        REQUEST</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(254, 159, 56);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('status','PO Approved')->count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/delivery') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(21, 180, 18);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="truck"
                                        style="color: rgb(21, 180, 18);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(21, 180, 18); font-family: 'Times New Roman', Times, serif;">
                                        DELIVERY <br>
                                    PROCES</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(21, 180, 18);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('status','Paid')->count() }}</h2>
                                    <i class="icon-bg" data-feather="truck"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>

                @endhasrole
                @hasrole('finance')

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-tasklist-finance') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(251, 9, 1);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="dollar-sign"
                                        style="color: rgb(251, 9, 1);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(251, 9, 1); font-family: 'Times New Roman', Times, serif;">
                                        TASK LIST <br>
                                        FINANCE</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(251, 9, 1);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('status','Payment Approved')->count() }}</h2>
                                    <i class="icon-bg" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ url('/menu-pengajuan-dana') }}">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(37, 178, 68);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="dollar-sign"
                                        style="color: rgb(37, 178, 68);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(37, 178, 68); font-family: 'Times New Roman', Times, serif;">
                                        PAYMENT <br>
                                        PROCESS</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(37, 178, 68);">
                                        {{ \App\Models\CategoryPengajuanPembelian::where('status','Unpaid')->count() }}</h2>
                                    <i class="icon-bg" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>

                @endhasrole


                {{-- <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgba(150, 148, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgba(150, 148, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgba(150, 148, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        REQUEST</h6>
                                    <h2 class="mb-0 counter" style="color: rgba(150, 148, 255, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-4"
                            style="border-left: 10px solid rgba(87, 212, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="check-circle"
                                        style="color: rgba(87, 212, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    @if (\App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (\App\Models\CategoryPengajuanPembelian::where('status', 'Purchase Submission Approved'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (\App\Models\CategoryPengajuanPembelian::where('status', 'Waiting For PO Approval'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid red;">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: red;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: red; font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        ORDER</h6>
                                    <h2 class="mb-0 counter" style="color: red;">
                                        {{ \App\Models\CategoryPO::count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(251, 140, 1);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="dollar-sign"
                                        style="color: rgb(251, 140, 1);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(251, 140, 1); font-family: 'Times New Roman', Times, serif;">
                                        FUND <br>
                                        SUBMISSION</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(251, 140, 1);">
                                        {{ \App\Models\CategoryPD::count() }}</h2>
                                    <i class="icon-bg" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Monthly
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="Po"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        const dataPo = {
            labels: labels,
            datasets: [{

                    label: 'Purchase Request',
                    backgroundColor: 'rgba(150, 148, 255, 0.9)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_ps as $ps)
                            {{ $ps }},
                        @endforeach
                    ],
                },
                {
                    label: 'Task List',
                    backgroundColor: 'rgba(87, 212, 255, 0.9)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_qu as $qu)
                            {{ $qu }},
                        @endforeach
                    ],
                },


                {
                    label: 'Purchase Order',
                    backgroundColor: 'rgb(255, 0, 0)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_po as $po)
                            {{ $po }},
                        @endforeach
                    ],
                },


                {
                    label: 'Payment Process',
                    backgroundColor: 'rgb(255, 255, 0)',
                    borderColor: 'rgb(93, 218, 180)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_pd as $pd)
                            {{ $pd }},
                        @endforeach
                    ],
                },
            ]
        };
    </script>

    <script>
        const po = {
            type: 'bar',
            data: dataPo,
            options: {
                // fill: true,
                tension: 0.4,
                responsive: true,
                animations: {
                    radius: {
                        duration: 400,
                        easing: 'linear',
                        loop: (context) => context.active
                    }
                },
                hoverRadius: 5,
                hoverBackgroundColor: 'rgb(67, 94, 190)',
                interaction: {
                    mode: 'nearest',
                    intersect: false,
                    axis: 'x'
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month',
                            color: 'rgb(255, 121, 118)',
                            font: {
                                family: 'Nunito',
                                size: 15,
                                weight: 'bold',
                                lineHeight: 1.2,
                            },
                            padding: {
                                top: 20,
                                left: 0,
                                right: 0,
                                bottom: 0
                            }
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Value',
                            color: 'rgb(255, 121, 118)',
                            font: {
                                family: 'Nunito',
                                size: 15,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {
                                top: 30,
                                left: 0,
                                right: 0,
                                bottom: 0
                            }
                        }
                    }
                }
            },
        };
    </script>

    <script>
        const datawarga = {
            labels: ['Januari', 'Februari', 'Maret', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November',
                'Desember'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [
                    11, 12, 15, 43, 53, 32, 10, 45, 12
                ],
                fill: true,
                borderColor: 'rgb(86, 182, 247)',
                tension: 0.3
            }]
        };

        const warga = {
            type: 'line',
            data: datawarga,
            options: {
                responsive: true,
            }
        };
    </script>

    <script>
        const chartPo = new Chart(
            document.getElementById('Po'),
            po
        );
    </script>
    <script>
        const chartWarga = new Chart(
            document.getElementById('warga'),
            warga
        );
    </script>
@endsection
