<title>Detail Pre-PR</title>

@extends('layouts.master')

@section('main')

    <section>
        <div class="modal fade" id="modalAddItemPR" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-secondary">
                  <h2 class="modal-title" style="color: white">Add Pr Item</h2>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
                </div>
                <form action="{{ url('/pre-pr/add-pr-item') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @php
                            $prs = \App\Models\CategoryPengajuanPembelian::where('purpose_type', App\Models\ReferensiNamaProject::class)
                            ->where('purpose_id', $pre_pr->project->id) // Ganti '123' dengan ID yang ingin dicari
                            ->where('status','Awaiting Purchase Request Approval')
                            ->get();
                        @endphp
                        <div class="form-group">
                            <label for="">PR</label>
                            <select name="pr" id="" class="pr js-example-basic-single">
                                @foreach ($prs as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->code_pengajuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                        No</th>
                                    <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                        Item</th>
                                    <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                        Qty</th>
                                    <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                        Unit</th>
                                    <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                        File</th>
                                    <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                        Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamicTable">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="item[]" id="" class="pr js-example-basic-single">
                                                @foreach ($pre_pr->partItem as $item)
                                                    {{-- Jika Barang ada status rejected from logistic maka jangan tampilkan apa apa.. --}}
                                                    @if($item->status == 'Rejected From Logistics')

                                                    @else
                                                    <option value="{{ $item->id }}">{{ $item->child_item }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="width: 60px;" required/>
                                        </td>
                                        <td>
                                            <select class="form-select " placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                                                @foreach ($uom as $u)
                                                    <option value="{{ $u->name }}">{{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
                                            @error('path_file')
                                            <div class='mt-1'>
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            </div>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" name="add" id="addRow" class="btn btn-success">
                                                <i class="icofont icofont-ui-add"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
            </div>
        </div>

        <style>
            .AllComment {
                box-sizing: border-box;
                border: 2px solid rgb(236, 236, 236);
                border-radius: 10px;
                padding: 15px 10px;
            }
        </style>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header" style="margin-bottom: -20px;">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details {{ $pre_pr->project->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/pre-pr') }}">Pre PR</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-body ">
                                {{-- <p>{{ $data_pengajuan->status }}</p> --}}
                                <table class="table table-bordered" style="">
                                    <tbody>
                                        <tr>
                                            <td>Created By</td>
                                            {{-- {{ dd(Auth::user()->roles->pluck('name')[0] ?? '-') }} --}}
                                            <td>{{ $pre_pr->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Project</td>
                                            <td>{{ $pre_pr->project->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Due Date</td>
                                            <td>{{ $pre_pr->due_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Has Comments</td>
                                            <td>
                                                <input type="checkbox" name="has_comment" id="has_comments" onchange="filterComments()">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="mt-4">
                                    <div class="input-group">
                                        <input class="form-control" id="search-input" type="text" placeholder="search item">
                                        <button class="btn btn-disabled" style=" background-color: rgb(164, 164, 164); color:white;" disabled><i class="icon-search"></i></button>
                                    </div>
                                </div>

                                <div class="order-history table-responsive wishlist prepritems">
                                    <table class="table table-bordered mt-4 mb-4">
                                        <thead>
                                            <tr class="text-center" style="font-size: 17; font-weight: bold;">
                                                @if(Auth::user()->roles->pluck('name')[0] != 'purchasing')
                                                <th><input type="checkbox" id="head-cb"></th>
                                                @endif
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Buffer</th>
                                                <th>Belum dibeli</th>
                                                <th>Sudah dibeli</th>
                                                <th>Logs</th>
                                                <th>Description</th>
                                                <th>Link</th>
                                                <th>Creator</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody id="part-item-table">
                                            @foreach ($pre_pr->partItem as $p)
                                                <tr class="part-item-row" data-child-item="{{ $p->child_item }}" data-has-comments="{{ $p->comments->isNotEmpty() ? 'true' : 'false' }}">
                                                    @if(Auth::user()->roles->pluck('name')[0] != 'purchasing')
                                                    <td><input type="checkbox" class="child-cb" value="{{ $p->id }}" {{ $p->status == 'Rejected From Logistics' || $p->is_check == 1 || $p->total == 0 ? 'disabled' : '' }}></td>
                                                    @endif
                                                    <td style="text-align: center;">{!! nl2br($p->child_item) !!}</td>
                                                    <td style="text-align: center;">{{ $p->qty }}</td>
                                                    <td style="text-align: center;">{{ $p->buffer }}</td>
                                                    <td style="text-align: center;">{{ $p->total }}</td>
                                                    <td style="text-align: center;">{{ $p->prItems->sum('qty') }}</td>
                                                    <td>
                                                        <ul style="list-style: none; white-space: nowrap;">
                                                            @if($p->prItems)
                                                                @foreach ($p->prItems as $pr)
                                                                    @if($pr->ppb)
                                                                    <a target="_blank" href="{{ route('menu-pengajuan-pembelian.detail', $pr->ppb->id) }}">
                                                                        <li>PR {{ $pr->ppb->code_pengajuan }} : (-{{ $pr->qty }})</li>
                                                                    </a>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </td>
                                                    <td style="text-align: center;">{{ $p->desc }}</td>
                                                    <td style="text-align: center;"><a target="_blank" href="{!! $p->link !!}">{{ $p->link }}</a></td>
                                                    <td style="text-align: center;">{{ $p->creator->name ?? $p->creator_name ?? '-' }}</td>
                                                    {{-- <td style="text-align: center;">
                                                        @if($p->is_check == 1)
                                                            @if($p->status == 'Rejected From Logistics')
                                                            <a class="badge bg-danger mt-1"style="color: white; font-size:12">{{ $p->status }}</a>
                                                            <a class="badge bg-secondary mt-1"style="color: white; font-size:12">{{ $p->notes ?? '' }}</a>
                                                            @else
                                                            <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Inventory Check</a>
                                                            @endif
                                                        @else
                                                        <a class="badge mt-1" style="background-color:green; color: white; font-size:12">Ready</a>
                                                        @endif
                                                    </td> --}}
                                                    <td style="text-align: center; white-space:nowrap;">
                                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalSeeComment{{ $p->id }}" onclick="markAsRead({{ $p->id }}, {{ $p->comments }})">
                                                            See
                                                            @if($p->comments->isNotEmpty())
                                                                @php
                                                                    $unreadCount = $p->unreadCommentsCount();
                                                                @endphp
                                                                @if($unreadCount > 0)
                                                                    <span class="badge rounded-pill badge-danger">{{ $unreadCount }}</span>
                                                                @endif
                                                            @endif
                                                        </button>
                                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddComment{{ $p->id }}">Add</button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="modalAddComment{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                          <h2 class="modal-title" style="color: white">Add Comment</h2>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                          aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-5 mb-3">
                                                            <form action="{{ route('preprComent.store') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="id_prepr" value="{{ $p->pre_pr_id }}">
                                                                <input type="hidden" name="id_item" value="{{ $p->id }}">
                                                                <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
                                                                <div class="mt-4" style="text-align: end;">
                                                                    <button type="submit" class="btn btn-success">Comment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">

                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="modalSeeComment{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                      <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                          <h2 class="modal-title" style="color: white">Comments</h2>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                          aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-5 mb-3">
                                                            <div class="AllComment" id="comment">
                                                                <div class="container">
                                                                    @foreach ($p->comments as $c)
                                                                        <ul>
                                                                            <li>
                                                                                <p>
                                                                                    <strong>
                                                                                        @if (empty($c->users->name))
                                                                                        @else
                                                                                            - {{ $c->users->name }}
                                                                                        @endif
                                                                                    </strong>
                                                                                    @if (empty($c->created_at))
                                                                                    @else
                                                                                        &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('| l | d-m-Y | H:i:s |') }}
                                                                                    @endif
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                @if (empty($c->comment))
                                                                                @else
                                                                                    <p>{{ $c->comment }}</p>
                                                                                @endif
                                                                            </li>
                                                                            <hr>
                                                                        </ul>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="button" style="float: right;">
                                    @if(Auth::user()->roles->pluck('name')[0] != 'purchasing')
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAddItemPR">Add Item PR</button>
                                    <button type="button" id="button-generate-selected" disabled class="btn btn-danger" onclick="generatePR()">Generate PR</button>
                                    @endif
                                    <a href="{{ route('prepr.export',$pre_pr->id) }}"
                                        class="btn btn-success" style="align-self: flex-end;" target="_blank"> Export to Excel</a>

                                    <a type="reset" class="btn btn-dark"
                                        href="{{ url('pre-pr/') }}">Back</a>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
    </section>
<script>
    function filterComments() {
        var checkbox = document.getElementById('has_comments');
        var rows = document.querySelectorAll('.part-item-row');

        rows.forEach(row => {
            // Cek apakah baris memiliki komentar
            var hasComments = row.getAttribute('data-has-comments') === 'true';
            console.log(hasComments);
            if (checkbox.checked) {
                if (!hasComments) {
                    row.style.display = 'none'; // Sembunyikan baris tanpa komentar
                } else {
                    row.style.display = ''; // Tampilkan baris dengan komentar
                }
            } else {
                row.style.display = ''; // Tampilkan semua baris saat checkbox tidak dicentang
            }
        });
    }
</script>

<script>
    function markAsRead(itemId, comments) {
        comments.forEach(comment => {
            const postData = {
                user_id: "{{ auth()->id() }}",
                id_pre_pr_items: itemId,
                comment_id: comment.id,
                is_read: true
            };

            fetch("{{ url('/prepr_comment/mark-as-read') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify(postData)
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => {
            console.error('Error:', error);
            if (error.response) {
                error.response.text().then(function (text) {
                    console.error('Failed to parse:', text);
                });
            } else {
                console.error('No response received');
            }
        });
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const tableBody = document.getElementById('part-item-table');
        const rows = tableBody.getElementsByClassName('part-item-row');

        // Event listener untuk pencarian
        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();

            Array.from(rows).forEach(row => {
                const childItem = row.dataset.childItem.toLowerCase();

                if (childItem.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        //Checkbox Check All
        $("#head-cb").on('click', function() {
            var isChecked = $('#head-cb').prop('checked');

            $(".child-cb").each(function() {
                if (!$(this).prop('disabled')) {  // Only check if not disabled
                    $(this).prop('checked', isChecked);
                }
            });

            // Enable or disable the button based on checkboxes that are not disabled
            let hasChecked = $(".child-cb:checked").not(':disabled').length > 0;
            $("#button-generate-selected").prop('disabled', !hasChecked);
        });

        $(".prepritems").on('click', '.child-cb', function() {
            if (!$(this).prop('checked')) {
                $("#head-cb").prop('checked', false);
            }

            // Enable or disable the button based on checkboxes that are not disabled
            let hasChecked = $(".child-cb:checked").not(':disabled').length > 0;
            $("#button-generate-selected").prop('disabled', !hasChecked);
        });

        function generatePR() {
            let checkbox_terpilih = $(".prepritems .child-cb:checked").not(':disabled');
            let semua_id = [];
            $.each(checkbox_terpilih, function(index, elm) {
                semua_id.push(elm.value);
            });
            let ids = semua_id.join(',');

            // Get project value from Blade
            let project = "{{ $pre_pr->project->id }}";

            // Form the URL and redirect
            let url = `/menu-pengajuan-pembelian/create?project=${encodeURIComponent(project)}&items=${ids}`;
            window.location.href = url;
        }

        // Generate PR button event listener
        $("#button-generate-selected").on('click', generatePR);
    });

</script>
{{-- <script>
    $(document).ready(function() {
        //Checkbox Cek All
        $("#head-cb").on('click', function() {
            var isChecked = $('#head-cb').prop('checked');
            $(".child-cb").prop('checked', isChecked);
            $("#button-generate-selected").prop('disabled', !isChecked);
        });

        $(".prepritems").on('click', '.child-cb', function() {
            if (!$(this).prop('checked')) {
                $("#head-cb").prop('checked', false);
            }
            let semua_checkbox = $(".prepritems .child-cb:checked");
            let button_approve_selected = (semua_checkbox.length > 0);

            $("#button-generate-selected").prop('disabled', !button_approve_selected);
        });

        function generatePR() {
            let checkbox_terpilih = $(".prepritems .child-cb:checked");
            let semua_id = [];
            $.each(checkbox_terpilih, function(index, elm) {
                semua_id.push(elm.value);
            });
            let ids = semua_id.join(',');

            // Dapatkan nilai project dari elemen Blade
            let project = "{{ $pre_pr->project->id }}";

            // Bentuk URL dan redirect
            let url = `/menu-pengajuan-pembelian/create?project=${encodeURIComponent(project)}&items=${ids}`;
            window.location.href = url;
        }

        // Tombol generate PR event listener
        $("#button-generate-selected").on('click', generatePR);
    });

</script> --}}

<script>
    $(document).ready(function () {
    let i = 1; // Counter untuk row ID

    $('#addRow').click(function () {
        i++;
        let newRow = `
            <tr>
                <td>${i}</td>
                <td>
                    <select name="item[]" id="" class="pr js-example-basic-single">
                        @foreach ($pre_pr->partItem as $item)
                        <option value="{{ $item->id }}">{{ $item->child_item }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="width: 60px;" required/>
                </td>
                <td>
                    <select class="form-select " placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                        @foreach ($uom as $u)
                            <option value="{{ $u->name }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
                </td>
                <td style="text-align: center;">
                    <button type="button" name="add" class="btn btn-danger remove-input-field">
                        <i class="icofont icofont-ui-close"></i>
                    </button>
                </td>
            </tr>
        `;

        $('#dynamicTable').append(newRow);
        $('#dynamicTable .js-example-basic-single').select2();
    });

    $(document).on('click', '.remove-input-field', function () {
        $(this).closest('tr').remove();
    });
});
</script>
@endsection
