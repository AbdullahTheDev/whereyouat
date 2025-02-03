@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Available Deliveries </h3>
            </div>
            <div class="row">
                @foreach ($activeDeliveries as $delivery)
                    <div class="col-12 col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $delivery->departure_address }} to {{ $delivery->arrival_address }}
                                </h4>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                                        <i class="mdi mdi-account-outline icon-sm me-2"></i>
                                        <span>{{ $delivery->user->name }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted font-weight-light">
                                        <i class="mdi mdi-clock icon-sm me-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($delivery->transation_date)->format('Y-m-d h:i A') }}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-2 mt-3">
                                    <h4>Package Details</h4>
                                </div>
                                @foreach ($delivery->packageDetails as $packageDetail)
                                    <div class="d-flex mt-3 align-items-top px-4">
                                        <div class="mb-0 flex-grow">
                                            <div class="d-flex">
                                                <h6 class="me-2 mb-2">
                                                    {{ strtoupper(str_replace('_', ' ', $packageDetail->package_type)) }}
                                                </h6>
                                                <span class="text-muted font-weight-light">
                                                    @if ($packageDetail->package_type == 'mini_carton' || $packageDetail->package_type == 'other')
                                                        Weight: {{ $packageDetail->qty }} KG
                                                    @else
                                                        Quantity: {{ $packageDetail->qty }}
                                                    @endif
                                                </span>
                                            </div>
                                            <p class="mb-0 font-weight-light">{{ $packageDetail->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-4 mb-0">
                                    <form action="{{ route('driver.delivery.vicinity.accept') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="delivery_id" id="" value="{{ $delivery->id }}">
                                        <button class="btn btn-primary">Accept for $
                                            {{ number_format($delivery->total_price, 2) }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($activeDeliveries->count() == 0)
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
