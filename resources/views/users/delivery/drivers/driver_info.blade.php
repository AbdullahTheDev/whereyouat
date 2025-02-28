@extends('users.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Driver Info </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h4 class="card-title">Driver Details</h4>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>
                            </div>
                            @if($localDriver)
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $driver->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $driver->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $driver->user->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $driver->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $driver->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $driver->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Model</th>
                                        <td>{{ $driver->vehicle_model }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Year</th>
                                        <td>{{ $driver->vehicle_year }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Make</th>
                                        <td>{{ $driver->vehicle_make }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Plate</th>
                                        <td>{{ $driver->vehicle_plate }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Color</th>
                                        <td>{{ $driver->vehicle_color }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Seats</th>
                                        <td>{{ $driver->vehicle_seats }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4 row">
                                @php
                                function getImageUrl($path) {
                                    return Str::startsWith($path, ['http://', 'https://']) ? $path : asset($path);
                                }
                            @endphp
                            
                            <div class="col-12 col-md-4">
                                <h5>License Front Photo</h5>
                                <a href="{{ getImageUrl($driver->license_photo_front) }}" data-fancybox="gallery" data-caption="License Front Photo">
                                    <img src="{{ getImageUrl($driver->license_photo_front) }}" class="img-fluid" width="200">
                                </a>
                            </div>
                            
                            <div class="col-12 col-md-4">
                                <h5 class="mt-3">License Back Photo</h5>
                                <a href="{{ getImageUrl($driver->license_photo_back) }}" data-fancybox="gallery" data-caption="License Back Photo">
                                    <img src="{{ getImageUrl($driver->license_photo_back) }}" class="img-fluid" width="200">
                                </a>
                            </div>
                            
                            <div class="col-12 col-md-4">
                                <h5 class="mt-3">Vehicle Photo</h5>
                                <a href="{{ getImageUrl($driver->vehicle_photo) }}" data-fancybox="gallery" data-caption="Vehicle Photo">
                                    <img src="{{ getImageUrl($driver->vehicle_photo) }}" class="img-fluid" width="200">
                                </a>
                            </div>
                            
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection