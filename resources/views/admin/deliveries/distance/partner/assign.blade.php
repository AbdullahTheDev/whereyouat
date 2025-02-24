@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> All Local Drivers </h3>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 grid-margin stretch-card">
                    @foreach ($drivers as $driver)
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Driver Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> {{ $driver->user->name }}</p>
                                        <p><strong>Email:</strong> {{ $driver->user->email }}</p>
                                        <p><strong>Phone:</strong> {{ $driver->user->phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Vehicle Model:</strong> {{ $driver->vehicle_model }}</p>
                                        <p><strong>Vehicle Year:</strong> {{ $driver->vehicle_year }}</p>
                                        <p><strong>Vehicle Make:</strong> {{ $driver->vehicle_make }}</p>
                                        <p><strong>Vehicle Plate:</strong> {{ $driver->vehicle_plate }}</p>
                                        <p><strong>Vehicle Color:</strong> {{ $driver->vehicle_color }}</p>
                                        <p><strong>Vehicle Seats:</strong> {{ $driver->vehicle_seats }}</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <h6>License Front Photo</h6>
                                        <a href="{{ asset($driver->license_photo_front) }}" data-fancybox="gallery"
                                            data-caption="License Front Photo">
                                            <img src="{{ asset($driver->license_photo_front) }}"
                                                class="img-fluid rounded shadow" width="150">
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>License Back Photo</h6>
                                        <a href="{{ asset($driver->license_photo_back) }}" data-fancybox="gallery"
                                            data-caption="License Back Photo">
                                            <img src="{{ asset($driver->license_photo_back) }}"
                                                class="img-fluid rounded shadow" width="150">
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Vehicle Photo</h6>
                                        <a href="{{ asset($driver->vehicle_photo) }}" data-fancybox="gallery"
                                            data-caption="Vehicle Photo">
                                            <img src="{{ asset($driver->vehicle_photo) }}" class="img-fluid rounded shadow"
                                                width="150">
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <form action="{{ route('admin.delivery.distance.assign.driver.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="delivery_id" id=""
                                                value="{{ $delivery->id }}">
                                            <input type="hidden" name="driver_id" id=""
                                                value="{{ $driver->id }}">
                                            <button class="btn btn-primary">Assign This Driver</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if ($drivers->count() == 0)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">No Drivers</h4>
                        <p class="card-text">There are no drivers.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
