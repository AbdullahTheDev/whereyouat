@extends('users.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Available Relay Points </h3>
            </div>
            <div class="row">
                @foreach ($relays as $relay)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <span class="text-muted">Place Name: </span>
                                    <span class="fw-bold">
                                        {{ $relay->home_name ?? ($relay->trade_name ?? 'N/A') }}
                                    </span>
                                </h4>
                                <p class="mb-2">
                                    <span class="text-muted">Address: </span>
                                    <span>{{ $relay->home_address ?? ($relay->business_name ?? 'N/A') }}</span>
                                </p>
                                <div class="mt-3">
                                    <p class="mb-1"><strong>Availability Days:</strong>
                                        {{ json_decode($relay->availibility_days) }}</p>
                                    <p class="mb-1"><strong>Time From:</strong>
                                        {{ \Carbon\Carbon::parse($relay->time_from)->format('H:i') }}</p>
                                    <p><strong>Time To:</strong>
                                        {{ \Carbon\Carbon::parse($relay->time_to)->format('H:i') }}</p>
                                </div>
                                <form method="POST"
                                    action="{{ route('user.delivery.distance.partner.post', $relay->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 mt-3">Select</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($relays->count() == 0)
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
