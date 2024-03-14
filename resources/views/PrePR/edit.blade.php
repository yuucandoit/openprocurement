<title>Purchase Request</title>
@extends('layouts.master')

@section('main')
<style>
    .hide {
       width: 0;
       height: 0;
       opacity: 0;
       display: none;
    }

    .page {
        height: 50px;
    }

    .custom-loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    }

    .loader {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #fff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }


</style>
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<section>
    @if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('error') }}
</div>
@elseif ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@elseif(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('message') }}
    </div>
@endif
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <h3>Edit Pre PR {{ $pre_pr->project->name }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('menu-pengajuan-pembelian.index') }}">Pre Purchase Request</a></li>
                        <li class="breadcrumb-item">Edit Pre Purchase Request</li>
                    </ol>
                </div>
                <div class="col-sm-6 mt-2">
                </div>
            </div>
        </div>
    </div>

    <div class="loader-3"></div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div id="loadingScreen" class="custom-loader">
                            <div class="loader"></div>
                        </div> --}}
                        <form action="{{ route('prepr.update',$pre_pr->id) }}" id="formAdd" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="floatingTanggal"><i class="fa fa-calendar"></i> Due Date :</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="floatingTanggal" placeholder="Tanggal" name="due_date" value="{{ $pre_pr->due_date ? \Carbon\Carbon::parse($pre_pr->due_date)->format('Y-m-d') : '' }}">
                                        @error('date_ps')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingwhosubmitted"><i class="icofont icofont-macbook"></i> Project:</label>
                                        {{-- Project Dropdown --}}
                                        <div id="selectedInput">
                                        <select class= "js-example-basic-single mt-2"  name="project" disabled>
                                            @foreach ($purpose as $p)
                                                @if($p->id == $pre_pr->project_id)
                                                <option value="{{ $p->id }}" selected>{{ $p->name }}</option>
                                                @else
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                         </div>
                                        {{-- End Project Dropdown --}}
                                    </div>
                                </div>
                                <style>
                                    .page {
                                        height: 58px;
                                    }
                                </style>
                                <br>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered item order-entry">
                                        <tr style="text-align: center;">
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                No</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Item</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Desc</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Link</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Status</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Qty</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Buffer</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Total</th>
                                            <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Action</th>

                                        </tr>
                                        @php
                                            $uid = 1;
                                        @endphp
                                        @foreach ($pre_pr->partItem as $items)
                                        <input type="hidden" name="id[]" value="{{ $items->id }}">
                                        <tr class="form-row">
                                            <td style="text-align:center;">
                                                {{ $uid++ }}
                                            </td>
                                            <td class="text">
                                                <textarea name="item[]" id="" class="form-control" rows="2">{{ $items->child_item }}</textarea>
                                            </td>
                                            <td><textarea name="desc[]" id="" class="form-control" rows="2">{{ $items->desc }}</textarea>
                                            </td>
                                            <td><input type="text" name="link[]" placeholder="Link Item" class="form-control" style="text-align: center;" value="{{ $items->link }}"/>
                                            </td>
                                            <td><input type="text" name="status[]" placeholder="Status" class="form-control" style="text-align: center;" value="{{ $items->status }}"/>
                                            </td>
                                            <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-qty" style="text-align: center;" value="{{ $items->qty }}"/>
                                            </td>
                                            <td>
                                                <input type="number" name="buffer[]" placeholder="Input Buffer" class="form-control form-buff" style="text-align: center;" value="{{ $items->buffer }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="total[]" placeholder="Total" class="form-control total" style="text-align: center;" value="{{ $items->total }}"/>
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" name="add" class="btn btn-danger remove-input-field">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="mt-2">
                                    <button type="button" name="add" class="addItem btn btn-outline-primary">
                                        Add New Item
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn_add mt-3" id="submitBtn">Submit</button>
                                    <a href="{{ route('menu-pengajuan-pembelian.index') }}" class="btn btn-dark mt-3">Back</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript Item -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>

    <script type="text/javascript">
        // Math

        document.querySelectorAll('.form-row').forEach(row => {
            row.addEventListener('input', (e) => updateFileds(e, row));
        });

        function updateFileds(event, row) {
            const total = row.querySelector('.total');
            const qty = parseInt(row.querySelector('.form-qty').value) || 0;
            const buffer = parseInt(row.querySelector('.form-buff').value) || 0;

            total.value = qty + buffer;

        }

        // End Math

        let $i = {{ $pre_pr->partItem->count() }} +  1;
        //Add Form
        $(".addItem").on('click', function() {
            addItem();
        });

        function addItem() {
            var item =
                `<tr class="form-row">
                    <td style="text-align:center;">
                        `+ $i +`
                    </td>
                    <td>
                        <textarea name="item[]" id="" class="form-control" rows="2"></textarea>
                    </td>
                    <td><textarea name="desc[]" id="" class="form-control" rows="2"></textarea>
                    </td>
                    <td><input type="text" name="link[]" placeholder="Link Item" class="form-control" style="text-align: center;"/>
                    </td>
                    <td><input type="text" name="status[]" placeholder="Status" class="form-control" style="text-align: center;" />
                    </td>
                    <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" />
                    </td>
                    <td>
                        <input type="number" name="buffer[]" placeholder="Input Buffer" class="form-control form-calc form-buff" style="text-align: center;" />
                    </td>
                    <td>
                        <input type="number" name="total[]" placeholder="Total" class="form-control form-calc total" style="text-align: center;" />
                    </td>
                    <td style="text-align: center;">
                    <button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button>
                </td> `;
            $(".item").append(item)

            $i++
            $(".form-row").last().find(".form-qty, .form-buff").on("input", function() {
                updateFileds(null, $(".form-row").last()[0]);
            });
        }
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
</section>
@endsection

