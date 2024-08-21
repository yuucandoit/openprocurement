<title>Timeline PO</title>
@extends('layouts.master')
@section('main')
<section>
        <div class="container-fluid">
          <div class="page-header">
            <div class="row">
              <div class="col-sm-6 mt-4">
                <h3>Timeline PO</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item">Timeline PO</li>
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
              <div class="card-header pb-0">
                <h5>{{ $po->code_po ?? 'PO-'.$po->id }}</h5>
              </div>
              <div class="card-body">
                <!-- cd-timeline Start-->
                <section class="cd-container" id="cd-timeline">
                  @foreach ($po->deliveryStatus as $delivr)
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture @if($po->flag_delivery == 2) bg-primary @else bg-warning @endif "><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h5>{{ $delivr->status }}</h5>
                      <span class="cd-date">{{ \Carbon\Carbon::parse($delivr->created_at)->format('D, d-m-Y H:i:s') }} - {{ $delivr->user->name ?? $delivr->creator_name ?? '-' }}</span>
                    </div>
                  </div>
                  @endforeach
                  @if($po->flag_delivery == 2)
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-verification-check"></i></div>
                  </div>
                  @endif
                </section>
                <!-- cd-timeline Ends-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid ends -->
</section>

@endsection
