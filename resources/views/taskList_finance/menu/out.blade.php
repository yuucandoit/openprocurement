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
                                            <th style="color: white">Description</th>
                                            <th style="color: white">Deadline</th>
                                            <th style="color: white; text-align:center;">Status</th>
                                            <th style="color: white">Function</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Unpaid' ||
                                            $ppb->status == 'Paid' ||
                                            $ppb->status == 'Delivery Process' ||
                                            $ppb->status == 'Delivery Success')
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td>{{ $ppb->code_pengajuan }}</td>
                                                <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                <td><a href="{{ $ppb->desc }}"
                                                        target="_blank">{{ $ppb->desc }}</a>
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
                                                <td style="text-align: center;">
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                        href="{{ url('menu-tasklist-finance/detail/' . $ppb->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                </td>
                                            </tr>
                                            @foreach ($ppb->quot as $po)
                                                <tr>

                                                    @php
                                                        $po2 = \App\Models\CategoryPO::with('vendorable')->find($po->id);
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                        // $item = $po3->count();
                                                    @endphp

                                                    @if(empty($po))

                                                    @else
                                                    <td style="text-align: center">-</td>
                                                    <td>{{ $po->code_po }}</td>
                                                    <td>
                                                        @if($po->vendorable_id == 0)

                                                        @else
                                                        Vendor : {{ $po->vendorable->nama }}
                                                        @endif
                                                    </td>
                                                    <td style="font-weight: 700; white-space:nowrap;">
                                                        @foreach ($po3 as $ipo)
                                                        <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $po->quotation }}</td>
                                                    {{-- <td>Vendor : Tokopedia</td> --}}
                                                    {{-- <td>20 Item</td> --}}
                                                    {{-- <td>Quotation : 25/TAM/I/2023</td> --}}
                                                    <td colspan="2"  class="text-center"><a
                                                        class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:12">Approve</a></td>

                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
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
