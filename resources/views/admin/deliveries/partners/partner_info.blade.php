@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h3 class="page-title">Partner Info</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Partner Details</h4>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $relay->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $relay->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $relay->user->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                                @if ($relay->user->role == 'partner_home')
                                    <h5 class="text-primary">Business Information</h5>
                                    <p><strong>House Name:</strong> {{ $relay->home_name }}</p>
                                    <p><strong>House Address:</strong> {{ $relay->home_address }}</p>
                                    <hr>
                                    <h5 class="text-primary">Manager Information</h5>
                                    <p><strong>Name:</strong> {{ $relay->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $relay->user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $relay->user->phone }}</p>
                                    <p><strong>Date Of Birth:</strong> {{ $relay->user->date_of_birth }}</p>
                                    <hr>
                                    @if ($relay->manager != null)
                                        @php $coOwner = json_decode($relay->manager, true); @endphp
                                        <h5 class="text-primary">Co-Manager Info</h5>
                                        <p><strong>Name:</strong> {{ $coOwner['name'] ?? 'N/A' }}</p>
                                        <p><strong>Email:</strong> {{ $coOwner['email'] ?? 'N/A' }}</p>
                                        <p><strong>Phone:</strong> {{ $coOwner['phone'] ?? 'N/A' }}</p>
                                        <hr>
                                    @endif
                                    <p><strong>Ownership Proof:</strong></p>
                                    <a data-fancybox="gallery" href="{{ asset($relay->ownership_proof) }}">
                                        <img class="img-fluid rounded shadow" width="200" src="{{ asset($relay->ownership_proof) }}" alt="Ownership Proof">
                                    </a>
                                @else
                                    <h5 class="text-primary">Business Information</h5>
                                    <p><strong>Trade Name:</strong> {{ $relay->trade_name }}</p>
                                    <p><strong>Email:</strong> {{ $relay->business_email }}</p>
                                    <p><strong>Phone:</strong> {{ $relay->business_phone }}</p>
                                    <p><strong>Address:</strong> {{ $relay->business_address }}</p>
                                    <p><strong>Business Number:</strong> {{ $relay->business_number }}</p>
                                    <hr>
                                    @if ($relay->co_manager_details != null)
                                        @php $coOwner = json_decode($relay->co_manager_details, true); @endphp
                                        <h5 class="text-primary">Co-Manager Info</h5>
                                        <p><strong>Name:</strong> {{ $coOwner['name'] ?? 'N/A' }}</p>
                                        <p><strong>Email:</strong> {{ $coOwner['email'] ?? 'N/A' }}</p>
                                        <p><strong>Phone:</strong> {{ $coOwner['phone'] ?? 'N/A' }}</p>
                                        <hr>
                                    @endif
                                    <p><strong>Ownership Proof:</strong></p>
                                    <a data-fancybox="gallery" href="{{ asset($relay->ownership_proof) }}">
                                        <img class="img-fluid rounded shadow" width="200" src="{{ asset($relay->ownership_proof) }}" alt="Ownership Proof">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
