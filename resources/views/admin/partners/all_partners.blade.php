@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> All Partners </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Partners</h4>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Phone </th>
                                        <th> Email </th>
                                        <th> Registered Date </th>
                                        <th> Business Info </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partners as $key => $partner)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $partner->user->name }} </td>
                                            <td> {{ $partner->user->phone }} </td>
                                            <td> {{ $partner->user->email }} </td>
                                            <td> {{ \Carbon\Carbon::parse($partner->user->created_at)->format('M j, Y | h:i A') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#businessInfoModal-{{ $partner->id }}">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="businessInfoModal-{{ $partner->id }}" tabindex="-1"
                                            aria-labelledby="businessInfoModalLabel-{{ $partner->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="businessInfoModalLabel-{{ $partner->id }}">Partner
                                                            Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Business Information</h6>
                                                        <p><strong>House Name:</strong> {{ $partner->house_name }}</p>
                                                        <p><strong>House Address:</strong> {{ $partner->home_address }}</p>
                                                        <hr>
                                                        <h6>Manager Information</h6>
                                                        <p><strong>Name:</strong> {{ $partner->user->name }}</p>
                                                        <p><strong>Email:</strong> {{ $partner->user->email }}</p>
                                                        <p><strong>Phone:</strong> {{ $partner->user->phone }}</p>
                                                        <p><strong>Date Of Birth:</strong>
                                                            {{ $partner->user->date_of_birth }}</p>
                                                        <hr>
                                                        @if ($partner->manager != null)
                                                            @php
                                                                $coOwner = json_decode($partner->manager, true);
                                                            @endphp
                                                            <h6>Co-Manager Info</h6>
                                                            <p><strong>Name:</strong> {{ $coOwner['name'] ?? '' }}</p>
                                                            <p><strong>Email:</strong> {{ $coOwner['email'] ?? '' }}</p>
                                                            <p><strong>Phone:</strong> {{ $coOwner['phone'] ?? '' }}</p>
                                                            <hr>
                                                        @endif
                                                        <p><strong>Ownership Proof:</strong></p>
                                                        <a data-fancybox="gallery"
                                                            href="{{ asset($partner->ownership_proof) }}">
                                                            <img width="200"
                                                                src="{{ asset($partner->ownership_proof) }}"
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
