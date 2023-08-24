<title>Task List Finance Out</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Task List Finance Out</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task List Finance Out</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                    <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                        <form action="{{ route('menu-tasklist-finance.SearchTaskFinanceOut') }}" method="get" class="input-group">
                                            <input type="text" name="cariout" class="form-control " placeholder="Search ..." value="{{ request('cariout') }}">
                                            <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th style="color: white">No</th>
                                            <th style="color: white">Code PR/PO</th>
                                            <th style="color: white; white-space:nowrap;">Request By</th>
                                            <th style="color: white">Item</th>
                                            <th style="color: white">Deadline</th>
                                            <th style="color: white; text-align:center;">Status</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        <tr class="bg-light">
                                            <td style="text-align: center;">{{ $no++ }}</td>
                                            <td>{{ $ppb->code_pengajuan }}</td>
                                            <td>
                                                <a href="{{ url('menu-tasklist-finance/detail/' . $ppb->id)}}"target="_blank">
                                                    <ul>
                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                        <li>{{ $ppb->desc }}</li>
                                                    </ul>
                                                </a>
                                            </td>
                                            <td>
                                            </td>
                                            <td style="text-align: center; white-space: nowrap;">
                                                @if($ppb->dateline == '≤24Jam')
                                                <strong><p>1 Hari</p></strong>
                                                @elseif ($ppb->dateline == '≤72Jam')
                                                <strong><p>2 sd 3 Hari</p></strong>
                                                @elseif ($ppb->dateline == '≤168Jam')
                                                <strong><p>4 sd 7 Hari</p></strong>
                                                @elseif ($ppb->dateline == '≤336Jam')
                                                <strong><p>7 sd 14 Hari</p></strong>
                                                @endif
                                            </td>
                                            <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Invoicing Process' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                    style="color: white; font-size:12">{{ $ppb->status }}</a></td>
                                        </tr>
                                        @foreach ($ppb->quot as $po)
                                        @if($po->status == 'Unpaid')
                                            <tr>

                                                @php
                                                    $po2 = \App\Models\CategoryPO::find($po->id);
                                                    $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                    $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                    // dd($po2->ppb_id);
                                                @endphp

                                                @if(empty($po2))

                                                @else
                                                <td style="text-align: center">-</td>
                                                <td>
                                                    <a href="{{ route('menu-tasklist-finance.po_detail',$po2->id) }}">
                                                    {{ $po->code_po }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('menu-tasklist-finance.po_detail',$po2->id) }}">
                                                    <ul>
                                                        <li>
                                                            @if($po2->vendorable_id == 0)
                                                            Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                            @else
                                                            Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? ' - ' }}
                                                            @endif
                                                        </li>
                                                        <li> Quotation : {{ $po2->quotation }}</li>
                                                    </ul>
                                                    </a>
                                                </td>
                                                <td style="font-weight: 700; white-space:nowrap;">
                                                    @foreach ($po3 as $ipo)
                                                    <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                    @endforeach
                                                </td>
                                                <td style="text-align: center">
                                                    @foreach ($po4 as $ipo)
                                                        <label>
                                                            @if($ipo->matauang == "RP")
                                                            Rp.{{ number_format($ipo->grand_total ,2) }}
                                                            @elseif ($ipo->matauang == "USD")
                                                            $ {{ number_format($ipo->grand_total ,2) }}
                                                            @endif
                                                        </label>
                                                    @endforeach
                                                </td>
                                                <td class="text-center"><a
                                                    class="badge {{ $ppb->status == 'Invoicing Process' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                    style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                @endif
                                            </tr>
                                        @endif
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
        <script>
            $(document).ready(function() {

                $('.servidelet  ebtn').click(function(e) {
                    e.preventDefault();
                    alert('hello');
                });

            });
        </script>
    </section>
@endsection
