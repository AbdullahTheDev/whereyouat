@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> All Drivers </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Drivers</h4>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th> 
                                        {{-- <th> Phone </th>
                                        <th> Email </th> --}}
                                        <th> Services Offered </th>
                                        <th> Registered Date </th>
                                        <th> Rider Info </th>
                                        <th> Deliveries </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers as $key => $driver)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $driver->user->name }} </td>
                                            {{-- <td> {{ $driver->user->phone }} </td>
                                            <td> {{ $driver->user->email }} </td> --}}
                                            <td>
                                                {{ ucwords(implode(', ', str_replace('-', ' ',json_decode($driver->services, true)) ?? [])) ?: 'N/A' }}
                                            </td>                                            
                                            <td> {{ \Carbon\Carbon::parse($driver->user->created_at)->format('M j, Y | h:i A') }} </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#driverInfoModal-{{ $driver->id }}">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.drivers.deliveries', $driver->user_id) }}" class="btn btn-info btn-sm">
                                                    Deliveries
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="driverInfoModal-{{ $driver->id }}"
                                            tabindex="-1" aria-labelledby="driverInfoModalLabel-{{ $driver->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="driverInfoModalLabel-{{ $driver->id }}">Driver
                                                            Information</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Name:</strong> {{ $driver->user->name }}</p>
                                                        <p><strong>Email:</strong> {{ $driver->user->email }}</p>
                                                        <p><strong>Phone:</strong> {{ $driver->user->phone }}</p>
                                                        <p><strong>Date Of Birth:</strong> {{ $driver->user->date_of_birth }}</p>
                                                        <hr>
                                                        <h6>Packages Offered</h6>
                                                        <p>
                                                            {{ ucwords(implode(', ', str_replace('-', ' ',json_decode($driver->packages, true)) ?? [])) ?: 'N/A' }}
                                                        </p>
                                                        <hr>
                                                        <h6>Vehicle Info</h6>
                                                        <p><strong>Make:</strong> {{ $driver->vehicle_make }}</p>
                                                        <p><strong>Model:</strong> {{ $driver->vehicle_model }}</p>
                                                        <p><strong>Year:</strong> {{ $driver->vehicle_year }}</p>
                                                        <p><strong>Plate Number:</strong> {{ $driver->vehicle_plate }}</p>
                                                        <p><strong>Seats:</strong> {{ $driver->vehicle_seats }}</p>
                                                        <p><strong>Color:</strong> {{ $driver->vehicle_color }}</p>
                                                        <p><strong>Vehicle Photo:</strong></p>
                                                        <a data-fancybox="gallery" href="{{ asset($driver->vehicle_photo) }}" >
                                                            <img width="200" src="{{ asset($driver->vehicle_photo) }}" alt="">
                                                        </a>
                                                        <p><strong>License Front:</strong></p>
                                                        <a data-fancybox="gallery" href="{{ asset($driver->license_photo_front) }}" >
                                                            <img width="200" src="{{ asset($driver->license_photo_front) }}" alt="">
                                                        </a>
                                                        <p><strong>License Back:</strong></p>
                                                        <a data-fancybox="gallery" href="{{ asset($driver->license_photo_back) }}" >
                                                            <img width="200" src="{{ asset($driver->license_photo_back) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
