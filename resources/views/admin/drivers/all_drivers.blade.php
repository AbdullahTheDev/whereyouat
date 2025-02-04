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
                                        <th> Phone </th>
                                        <th> Email </th>
                                        <th> Type </th>
                                        <th> Registered Date </th>
                                        <th> Rider Info </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers as $key => $driver)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $driver->user->name }} </td>
                                            <td> {{ $driver->user->phone }} </td>
                                            <td> {{ $driver->user->email }} </td>
                                            <td>
                                                {{ implode(', ', str_replace('-', ' ',json_decode($driver->services, true)) ?? []) ?: 'N/A' }}
                                            </td>                                            
                                            <td> {{ \Carbon\Carbon::parse($driver->user->created_at) }} </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#driverInfoModal-{{ $driver->id }}">
                                                    View
                                                </button>
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
                                                                <p><strong>Name:</strong> {{ $driver->name }}</p>
                                                                <p><strong>Email:</strong> {{ $driver->email }}</p>
                                                                <p><strong>Phone:</strong> {{ $driver->phone }}</p>
                                                                <hr>
                                                                <h6>Vehicle Info</h6>
                                                                <p><strong>Make:</strong> {{ $driver->vehicle_make }}</p>
                                                                <p><strong>Model:</strong> {{ $driver->vehicle_model }}</p>
                                                                <p><strong>Year:</strong> {{ $driver->vehicle_year }}</p>
                                                                <p><strong>Plate Number:</strong> {{ $driver->vehicle_plate_number }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
