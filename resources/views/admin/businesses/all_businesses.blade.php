@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> All Businesses </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Businesses</h4>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        {{-- <th> Phone </th>
                                        <th> Email </th> --}}
                                        {{-- <th> Services Offered </th> --}}
                                        <th> Registered Date </th>
                                        <th> Business Info </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businesses as $key => $business)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $business->user->name }} </td>
                                            {{-- <td> {{ $business->user->phone }} </td>
                                            <td> {{ $business->user->email }} </td> --}}
                                            <td> {{ \Carbon\Carbon::parse($business->user->created_at)->format('M j, Y | h:i A') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#businessInfoModal-{{ $business->id }}">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="businessInfoModal-{{ $business->id }}" tabindex="-1"
                                            aria-labelledby="businessInfoModalLabel-{{ $business->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="businessInfoModalLabel-{{ $business->id }}">Business
                                                            Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Name:</strong> {{ $business->user->name }}</p>
                                                        <p><strong>Email:</strong> {{ $business->user->email }}</p>
                                                        <p><strong>Phone:</strong> {{ $business->user->phone }}</p>
                                                        <p><strong>Date Of Birth:</strong>
                                                            {{ $business->user->date_of_birth }}</p>
                                                        <hr>
                                                        <p><strong>Walk: </strong> {{ $business->walk ? 'Yes' : 'No' }}</p>
                                                        @if (!$business->walk)
                                                        <hr>
                                                            <h6>Vehicle Info</h6>
                                                            <p><strong>Mean Of Transport:</strong>
                                                                {{ $business->mean_of_transport }}</p>
                                                            <p><strong>Make:</strong> {{ $business->vehicle_make }}</p>
                                                            <p><strong>Model:</strong> {{ $business->vehicle_model }}</p>
                                                            <p><strong>Year:</strong> {{ $business->vehicle_year }}</p>
                                                            <p><strong>Plate Number:</strong> {{ $business->vehicle_plate }}
                                                            </p>
                                                            <p><strong>Color:</strong> {{ $business->vehicle_color }}</p>
                                                        @endif
                                                        <hr>
                                                        <p><strong>Photo Facial ID:</strong></p>
                                                        <a data-fancybox="gallery" href="{{ asset($business->photo_of_facial_id) }}" >
                                                            <img width="200" src="{{ asset($business->photo_of_facial_id) }}" alt="">
                                                        </a>
                                                        <p><strong>Proof Of Domicile:</strong></p>
                                                        <a data-fancybox="gallery" href="{{ asset($business->proof_of_domicile) }}" >
                                                            <img width="200" src="{{ asset($business->proof_of_domicile) }}" alt="">
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
