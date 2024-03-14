<title>PRE Purchase Request</title>

@extends('layouts.master')

@section('main')
<section>
  {{-- @foreach ($datadv as $a)
  <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h2 class="modal-title" style="color: white">Delete</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
        </div>
        <div class="modal-body mx-5 mb-3">
          <span class="warning">
            <img src="assets/images/warning.png">
          </span>
          <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
        </div>
        <div class="modal-footer">
          <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
            Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  @foreach ($datapo as $po)
  <div class="modal fade" id="modalItemVendor{{ $po->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header bg-danger">

                  <h4 class="modal-title" style="color: white">List Item</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div class="modal-body mx-5 mb-3">
                  @php
                      $i = 1;
                  @endphp
                  <table class="table table-bordered table-hover">
                      <thead class="bg-primary">
                          <tr>
                              <th>Item</th>
                              <th>Qty</th>
                              <th>Uom</th>
                          </tr>
                      </thead>
                      <tbody>

                          @foreach ($po->itempo as $item)
                          <tr>
                              <td> {{ $item->item }}</td>
                              <td> {{ $item->qty }}</td>
                              <td> {{ $item->kategori }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  @endforeach --}}

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

  <!-- Page Sidebar Ends-->
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6 mt-4">
          <h3>Pre Purchase Request</h3>
          <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Pre Purchase Request</li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
            <div class="col-sm-8">
            <a href="{{ route('prepr.create') }}" class="btn btn-primary mb-3" ></i> Add <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-sm-4 ">
                <form action="{{ route('prepr.search') }}" method="get" class="input-group">
                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                </form>
            </div>
        </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover ">
                <thead class="bg-primary">
                 <tr>
                  <th>No</th>
                  <th>Project</th>
                  <th>Item</th>
                  <th>Due Date</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
               @php
               $no = 1;
               $i = 1 + $pre_pr->currentPage() * $pre_pr->perPage() - $pre_pr->perPage();
               @endphp
               @foreach($pre_pr as $pp)

               <tr style="background-color:#F1F6F5;">
                    <td>{{ $i++ }}</td>
                    <td>
                        <a href="{{ route('prepr.detail',$pp->id) }}">
                            {{ $pp->project->name ?? '' }}
                        </a>

                    </td>
                    <td>
                        <ul>
                            <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $pp->id }}">{{  $pp->partItem->count() ?? '0' }} Item </label></li>
                        </ul>
                    </td>
                    <td>
                        {{ $pp->due_date ? \Carbon\Carbon::parse($pp->due_date)->format('l, d-F-Y') : '-' }}
                    </td>
                    <td style="text-align: center;font-size:10;">
                        <a class="btn btn-iconsolid mt-1" style="background-color: #0d5e00; font-size:10;" href="{{ route('prepr.export',$pp->id) }}" title="Export Excel"><i class="icon-bookmark-alt" title="Export Excel"></i></a>
                        <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00; font-size:10;" href="{{ route('prepr.edit',$pp->id) }}"><i class="icon-pencil-alt" title="Edit"></i></a>
                        <a class="btn btn-iconsolid mt-1" style="background-color: #ff0000; font-size:10;" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $pp->id }}" ><i class="icon-trash" title="Delete"></i></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
          </table>

          @foreach($pre_pr as $pp)
          <div class="modal fade" id="modalItem{{ $pp->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">

                        <h4 class="modal-title" style="color: white">List Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        @php
                            $i = 1;
                        @endphp
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Buffer</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pp->partItem as $item)
                                <tr>
                                    <td> {{ $item->child_item }}</td>
                                    <td> {{ $item->qty }}</td>
                                    <td> {{ $item->buffer }}</td>
                                    <td> {{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>

          <div class="modal fade" id="modalDelete{{ $pp->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h2 class="modal-title" style="color: white">Delete</h2>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
                </div>
                <div class="modal-body mx-5 mb-3" style="text-align: center">
                  <span class="warning">
                    <img src="assets/images/warning.png">
                  </span>
                  <h2 style="text-align: center"> Are you sure want to delete this ?  </h2><br>
                  <p style="text-align: center">{{ $pp->project->name ?? '' }}</p>
                </div>
                <div class="modal-footer">
                  <form action="{{ route('prepr.delete',$pp->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                    Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <div class="mt-4">
          {{ $pre_pr->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <h3>Import Pre PR</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="importform"  action="{{ route('prepr.import') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputProject" >
                                    Project
                                </label>
                                <select class="js-example-basic-single" name="project" id="">
                                    @foreach ($purpose as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputDate" >
                                    Due Date
                                </label>
                                <input  class="form-control" type="date" name="due_date" value="{{ old('due_date', date('Y-m-d')) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile" >
                            Input File
                        </label>
                        <input type="file" id="file" name="file" class="@error('file')is-invalid @enderror form-control">
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{-- <p class="text-danger">{{ $errors->first('file') }}</p> --}}

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="text-end" style="margin-right: 30px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <div class="card-body">
                <div class="alert alert-warning alert-dismissible">
                    <i class="icon fa fa-warning"></i> Warning! &nbsp;
                    File Data Item Only Type (.xls, .xlsx)
                </div>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
