@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Track Deliveries </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    @foreach ($activeDeliveries as $delivery)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $delivery->departure_city }} to {{ $delivery->arrival_city }}</h4>
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
                                @foreach ($delivery->packageDetails as $packageDetail)
                                    <div class="d-flex mt-5 align-items-top">
                                        <img src="{{ asset('assets/images/faces/face3.jpg') }}"
                                            class="img-sm rounded-circle me-3" alt="image">
                                        <div class="mb-0 flex-grow">
                                            <div>
                                                <h5 class="me-2 mb-2">{{ strtoupper(str_replace('_', ' ', $packageDetail->package_type)) }}</h5>
                                                <span>
                                                    @if($packageDetail->package_type == 'mini_carton' || $packageDetail->package_type == 'other')
                                                    Weight: {{ $packageDetail->qty }} KG
                                                    @else
                                                    Quantiry: {{ $packageDetail->qty }}
                                                    @endif
                                                </span>
                                            </div>
                                            <p class="mb-0 font-weight-light">{{ $packageDetail->description }}</p>
                                        </div>
                                        <div class="ms-auto">
                                            <i class="mdi mdi-heart-outline text-muted"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
