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
                                            <td> {{ $business->user->phone }} </td>
                                            <td> {{ $business->user->email }} </td>
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
                                                        <p><strong>Address:</strong> {{ $business->address }}</p>
                                                        <hr>
                                                        <h6>Business Info</h6>
                                                        <p><strong>Trade Name:</strong> {{ $business->trade_name }}</p>

                                                        <p><strong>Email:</strong> {{ $business->business_email }}</p>
                                                        <p><strong>Phone:</strong> {{ $business->business_phone }}</p>
                                                        <p><strong>Address:</strong> {{ $business->business_address }}</p>
                                                        <p><strong>Business Number:</strong>
                                                            {{ $business->business_number }}</p>
                                                        <hr>
                                                        @if ($business->co_manager_details != null)
                                                            @php
                                                                $coOwner = json_decode(
                                                                    $business->co_manager_details,
                                                                    true,
                                                                );
                                                            @endphp
                                                            <h6>Co-Manager Info</h6>
                                                            <p><strong>Name:</strong> {{ $coOwner['name'] }}</p>
                                                            <p><strong>Email:</strong> {{ $coOwner['email'] }}</p>
                                                            <p><strong>Phone:</strong> {{ $coOwner['phone'] }}</p>
                                                            <p><strong>Date Of Birth:</strong>
                                                                {{ $coOwner['date_of_birth'] }}</p>
                                                            <p><strong>Address:</strong> {{ $coOwner['address'] }}</p>
                                                            <hr>
                                                        @endif
                                                        <p><strong>Ownership Proof:</strong></p>
                                                        <a data-fancybox="gallery"
                                                            href="{{ asset($business->ownership_proof) }}">
                                                            <img width="200"
                                                                src="{{ asset($business->ownership_proof) }}"
                                                                alt="">
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
