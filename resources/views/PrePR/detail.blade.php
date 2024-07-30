<title>Detail Pre-PR</title>

@extends('layouts.master')

@section('main')
    <section>
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

                                <div class="order-history table-responsive wishlist">
                                    <table class="table table-bordered mt-4 mb-4">
                                        <thead>
                                            <tr class="text-center" style="font-size: 17; font-weight: bold;">
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Buffer</th>
                                                <th>Belum dibeli</th>
                                                <th>Sudah dibeli</th>
                                                <th>Logs</th>
                                                <th>Description</th>
                                                <th>Link</th>
                                                <th>Creator</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pre_pr->partItem as $p)
                                                <tr class="part-item-row" data-has-comments="{{ $p->comments->isNotEmpty() ? 'true' : 'false' }}">
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
                                                                    <a target="_blank" href="{{ route('menu-pengajuan-pembelian.detail',$pr->ppb->id) }}">
                                                                        <li>PR {{ $pr->ppb->code_pengajuan }} : (-{{ $pr->qty }})</li>
                                                                    </a>
                                                                    @else

                                                                    @endif
                                                                @endforeach
                                                            @else

                                                            @endif
                                                        </ul>
                                                    </td>

                                                    <td style="text-align: center;">{{ $p->desc }}</td>
                                                    <td style="text-align: center;"><a  target="_blank" href="{!! $p->link !!}">{{ $p->link }}</a></td>
                                                    <td style="text-align: center;">{{ $p->creator->name ?? $p->creator_name  ?? '-' }}</td>
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

                                    <hr>
                                    <div class="button" style="float: right;">
                                        <a href="{{ route('prepr.export',$pre_pr->id) }}"
                                            class="btn btn-success" style="align-self: flex-end;" target="_blank"> Export to Excel</a>

                                        <a type="reset" class="btn btn-dark"
                                            href="{{ url('pre-pr/') }}">Back</a>
                                    </div>
                                   <!-- Container-fluid Ends-->
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
@endsection
