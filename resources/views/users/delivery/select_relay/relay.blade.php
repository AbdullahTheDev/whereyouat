@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Available Relay Points </h3>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 grid-margin stretch-card">
                    @foreach ($relays as $relay)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <span class="text-muted">Place Name: </span>
                                    <span style="white-space: normal;">
                                        {{ $relay->home_name ?? $relay->trade_name ?? 'N/A' }}
                                    </span>
                                    <br>
                                    <br>
                                     <span class="text-muted">Address:</span>
                                    <span style="white-space: normal;">
                                        {{ $relay->home_address ?? $relay->business_name ?? 'N/A' }}
                                    </span>
                                </h4>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                                        <i class="mdi mdi-account-outline icon-sm me-2"></i>
                                        <span>Availibility Days</span>
                                        <p>{{ json_decode($relay->availibility_days) }}</p>
                                        <span>Time From</span>
                                        <p>{{ \Carbon\Carbon::parse($relay->time_from)->format('H:i') }}</p>
                                        <span>Time To</span>
                                        <p>{{ \Carbon\Carbon::parse($relay->time_to)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($activeDeliveries->count() == 0)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">No Active Deliveries</h4>
                        <p class="card-text">There are no active deliveries.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
