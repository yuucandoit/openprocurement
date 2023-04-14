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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card">
                              <div class="card-header pb-0">
                                <h5>Monthly Chart</h5>
                              </div>
                              <div class="card-body">
                                <div id="apex-user"></div>
                              </div>
                            </div>
                          </div>
                        {{-- <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Monthly
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="chrtUser"></canvas>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-xl-4 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Pie
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="pieUser"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
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

                                        @elseif(Auth::user()->id === 24)

                                        <h2 class="mb-0 counter" style="color: rgba(87, 188, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('atasan',24)->where('status','Awaiting Purchase Request Approval')->count() }}
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
                                            {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                $i->where('atasan_po', 3)->where('status','Waiting For PO Approval');
                                            })->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (Auth::user()->id === 6)

                                        <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                $i->where('atasan_po', 6)->where('status','Waiting For PO Approval');
                                            })->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (Auth::user()->id === 7)

                                        <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                $i->where('atasan_po', 7)->where('status','Waiting For PO Approval');
                                            })->count() }}
                                        </h2>
                                    @elseif (Auth::user()->id === 8)
                                    <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                            $i->where('atasan_po', 8)->where('status','Waiting For PO Approval');
                                        })->count() }}
                                    </h2>

                                    @elseif (Auth::user()->id === 9)
                                    <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                            $i->where('atasan_po', 9)->where('status','Waiting For PO Approval');
                                        })->count() }}
                                    </h2>

                                    @elseif (Auth::user()->id === 24)
                                    <h2 class="mb-0 counter" style="color: rgba(35, 96, 117, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                            $i->where('atasan_po', 24)->where('status','Waiting For PO Approval');
                                        })->count() }}
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
                                                {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                    $i->where('atasan_py', 3)->where('status','Invoicing Process');
                                                })->count() }}
                                            </h2>
                                            <i class="icon-bg" data-feather="check-circle"></i>
                                        @elseif (Auth::user()->id === 6)

                                            <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                                {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                    $i->where('atasan_py', 6)->where('status','Invoicing Process');
                                                })->count() }}
                                            </h2>
                                            <i class="icon-bg" data-feather="check-circle"></i>
                                        @elseif (Auth::user()->id === 7)

                                            <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                                {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                    $i->where('atasan_py', 7)->where('status','Invoicing Process');
                                                })->count() }}
                                            </h2>
                                        @elseif (Auth::user()->id === 8)
                                        <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                $i->where('atasan_py', 8)->where('status','Invoicing Process');
                                            })->count() }}
                                        </h2>

                                        @elseif (Auth::user()->id === 9)
                                        <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                $i->where('atasan_py', 9)->where('status','Invoicing Process');
                                            })->count() }}
                                        </h2>

                                        @elseif (Auth::user()->id === 24)
                                        <h2 class="mb-0 counter" style="color: rgba(117, 0, 184, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::whereHas('quot',function($i){
                                                $i->where('atasan_py', 24)->where('status','Invoicing Process');
                                            })->count() }}
                                        </h2>
                                        @endif
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card">
                              <div class="card-header pb-0">
                                <h5>Monthly Chart</h5>
                              </div>
                              <div class="card-body">
                                <div id="apex-bod"></div>
                              </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Monthly
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="chrtBod"></canvas>
                                </div>
                            </div>
                        </div> --}}
                    </div>
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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card">
                              <div class="card-header pb-0">
                                <h5>Monthly Chart</h5>
                              </div>
                              <div class="card-body">
                                <div id="apex-po"></div>
                              </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Monthly
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="chrtPrchs"></canvas>
                                </div>
                            </div>
                        </div> --}}
                    </div>
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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card">
                              <div class="card-header pb-0">
                                <h5>Monthly Chart</h5>
                              </div>
                              <div class="card-body">
                                <div id="apex-pd"></div>
                              </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Monthly
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="chrtFinance"></canvas>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                @endhasrole

    </section>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // column chart
    var Cuser = {
        chart: {
            height:500,
            type: 'bar',
            toolbar:{
            show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%',
                borderRadius: 3,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['transparent']
        },
        series: [{
            name: 'Purchase Request',
            data: [
                @foreach ($data_ps as $pd)
                    {{ $pd }},
                @endforeach
                        ]
        }, {
            name: 'Pending Request',
            data: [
                @foreach ($data_pndng as $pndng)
                    {{ $pndng }},
                @endforeach
            ]
        }, {
            name: 'Purchase Completed',
            data: [
                @foreach ($data_success as $success)
                    {{ $success }},
                @endforeach
            ]
        }, {
            name: 'Purchase Failed',
            data: [
                @foreach ($data_fail as $fail)
                    {{ $fail }},
                @endforeach,
            ]
        }],
        xaxis: {
            categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'],
        },
        yaxis: {
            title: {
                text: 'Value'
            }
        },
        fill: {
            opacity: 1

        },

        tooltip: {
            y: {
                formatter: function (val) {
                    return "Value " + val
                }
            }
        },
        responsive: [
        {
        breakpoint: 1000,
        options: {
            plotOptions: {
            bar: {
                horizontal: false
            }
            },
            legend: {
            position: "bottom"
            }
        }
        }
    ],
        colors:['rgba(150, 148, 255, 0.9)','rgba(255, 225, 0, 0.9)', 'rgb(12, 174, 0)', 'rgb(255, 0, 0)']
    }
    var Cbod = {
        chart: {
            height:350,
            type: 'bar',
            toolbar:{
            show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%',
                borderRadius: 3,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['transparent']
        },
        series: [{
            name: 'Task List PR',
            data: [
                @foreach ($taskBodPR as $tbpr)
                    {{ $tbpr }},
                @endforeach
            ]
        }, {
            name: 'Task List PO',
            data: [
                @foreach ($taskBodPO as $tbpo)
                    {{ $tbpo }},
                @endforeach
            ]
        }, {
            name: 'Task List PY',
            data: [
                @foreach ($taskBodPY as $tbpy)
                    {{ $tbpy }},
                @endforeach
            ]
        }],
        xaxis: {
            categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'],
        },
        yaxis: {
            title: {
                text: 'Value'
            }
        },
        fill: {
            opacity: 1

        },

        tooltip: {
            y: {
                formatter: function (val) {
                    return "Value " + val
                }
            }
        },
        colors:['rgba(150, 148, 255, 0.9)','rgba(255, 225, 0, 0.9)', 'rgb(12, 174, 0)', 'rgb(255, 0, 0)']
    }
    var Cpo = {
        chart: {
            height:500,
            type: 'bar',
            toolbar:{
            show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%',
                borderRadius: 3,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['transparent']
        },
        series: [{
            name: 'Task List PO',
            data: [
                @foreach ($data_task_po as $tpo)
                    {{ $tpo }},
                @endforeach
            ]
        }, {
            name: 'Purchase Order',
            data: [
                @foreach ($data_po as $po)
                    {{ $po }},
                @endforeach
            ]
        }, {
            name: 'Delivery Process',
            data: [
                @foreach ($data_delivery as $ddeliver)
                    {{ $ddeliver }},
                @endforeach
            ]
        }],
        xaxis: {
            categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'],
        },
        yaxis: {
            title: {
                text: 'Value'
            }
        },
        fill: {
            opacity: 1

        },

        tooltip: {
            y: {
                formatter: function (val) {
                    return "Value " + val
                }
            }
        },
        colors:['rgba(150, 148, 255, 0.9)','rgba(255, 225, 0, 0.9)', 'rgb(12, 174, 0)', 'rgb(255, 0, 0)']
    }
    var Cpd = {
        chart: {
            height:500,
            type: 'bar',
            toolbar:{
            show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%',
                borderRadius: 3,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['transparent']
        },
        series: [{
            name: 'Payment Request',
            data: [
                @foreach ($data_pymntreq as $pyreq)
                    {{ $pyreq }},
                @endforeach
            ]
        }, {
            name: 'Task List Finance',
            data: [
                @foreach ($taskFinance as $tf)
                    {{ $tf }},
                @endforeach
            ]
        }, {
            name: 'Payment Process',
            data: [
                @foreach ($data_pp as $pp)
                    {{ $pp }},
                @endforeach
            ]
        }],
        xaxis: {
            categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'],
        },
        yaxis: {
            title: {
                text: 'Value'
            }
        },
        fill: {
            opacity: 1

        },

        tooltip: {
            y: {
                formatter: function (val) {
                    return "Value " + val
                }
            }
        },
        colors:['rgba(150, 148, 255, 0.9)','rgba(255, 225, 0, 0.9)', 'rgb(12, 174, 0)', 'rgb(255, 0, 0)']
    }

    var apexUser = new ApexCharts(
        document.querySelector("#apex-user"),
        Cuser
    );
    var apexBod = new ApexCharts(
        document.querySelector("#apex-bod"),
        Cbod
    );
    var apexPO = new ApexCharts(
        document.querySelector("#apex-po"),
        Cpo
    );
    var apexPD = new ApexCharts(
        document.querySelector("#apex-pd"),
        Cpd
    );

    apexUser.render();
    apexBod.render();
    apexPO.render();
    apexPD.render();
</script>


@endsection
