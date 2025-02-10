@extends('users.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Available Relay Points </h3>
            </div>
            <div class="row">
                @foreach ($relays as $relay)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm position-relative">
                            @if($relay->user->role == 'partner_home')
                                <span class="badge bg-primary position-absolute top-0 start-50 translate-middle px-3 py-2 shadow-sm rounded-pill">Partner Home</span>
                            @else
                                <span class="badge bg-success position-absolute top-0 start-50 translate-middle px-3 py-2 shadow-sm rounded-pill">Commercial Place</span>
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">
                                    <span class="text-muted">Place Name: </span>
                                    <span class="fw-bold">
                                        {{ $relay->home_name ?? ($relay->trade_name ?? 'N/A') }}
                                    </span>
                                </h4>
                                <p class="mb-2">
                                    <span class="text-muted">Address: </span>
                                    <span>{{ $relay->home_address ?? ($relay->business_name ?? 'N/A') }}</span>
                                </p>
                                <div class="mt-3">
                                    <p>
                                        <strong>Availability Days:</strong> 
                                        {{ strtoupper(implode(', ', json_decode($relay->availability_days))) }}
                                    </p>
                                    
                                    <p class="mb-1"><strong>Time From:</strong>
                                        {{ \Carbon\Carbon::parse($relay->time_from)->format('H:i a') }}</p>
                                    <p><strong>Time To:</strong>
                                        {{ \Carbon\Carbon::parse($relay->time_to)->format('H:i a') }}</p>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#businessInfoModal-{{ $relay->id }}">
                                                    More Details
                                                </button>
                                </div>
                                <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $relay->id }}">Select</button>

                                @if($relay->user->role == 'partner_home')
                                <div class="modal fade" id="businessInfoModal-{{ $relay->id }}" tabindex="-1"
                                    aria-labelledby="businessInfoModalLabel-{{ $relay->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="businessInfoModalLabel-{{ $relay->id }}">Partner
                                                    Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Business Information</h6>
                                                <p><strong>House Name:</strong> {{ $relay->home_name }}</p>
                                                <p><strong>House Address:</strong> {{ $relay->home_address }}</p>
                                                <hr>
                                                <h6>Manager Information</h6>
                                                <p><strong>Name:</strong> {{ $relay->user->name }}</p>
                                                <p><strong>Email:</strong> {{ $relay->user->email }}</p>
                                                <p><strong>Phone:</strong> {{ $relay->user->phone }}</p>
                                                <p><strong>Date Of Birth:</strong>
                                                    {{ $relay->user->date_of_birth }}</p>
                                                <hr>
                                                @if ($relay->manager != null)
                                                    @php
                                                        $coOwner = json_decode($relay->manager, true);
                                                    @endphp
                                                    <h6>Co-Manager Info</h6>
                                                    <p><strong>Name:</strong> {{ $coOwner['name'] ?? '' }}</p>
                                                    <p><strong>Email:</strong> {{ $coOwner['email'] ?? '' }}</p>
                                                    <p><strong>Phone:</strong> {{ $coOwner['phone'] ?? '' }}</p>
                                                    <hr>
                                                @endif
                                                <p><strong>Ownership Proof:</strong></p>
                                                <a data-fancybox="gallery"
                                                    href="{{ asset($relay->ownership_proof) }}">
                                                    <img width="200"
                                                        src="{{ asset($relay->ownership_proof) }}"
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
                                @else
                                <div class="modal fade" id="businessInfoModal-{{ $relay->id }}" tabindex="-1"
                                    aria-labelledby="businessInfoModalLabel-{{ $relay->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="businessInfoModalLabel-{{ $relay->id }}">Business
                                                    Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Name:</strong> {{ $relay->user->name }}</p>
                                                <p><strong>Email:</strong> {{ $relay->user->email }}</p>
                                                <p><strong>Phone:</strong> {{ $relay->user->phone }}</p>
                                                <p><strong>Date Of Birth:</strong>
                                                    {{ $relay->user->date_of_birth }}</p>
                                                <p><strong>Address:</strong> {{ $relay->responsible_address }}</p>
                                                <hr>
                                                <h6>Business Info</h6>
                                                <p><strong>Trade Name:</strong> {{ $relay->trade_name }}</p>

                                                <p><strong>Email:</strong> {{ $relay->business_email }}</p>
                                                <p><strong>Phone:</strong> {{ $relay->business_phone }}</p>
                                                <p><strong>Address:</strong> {{ $relay->business_address }}</p>
                                                <p><strong>Business Number:</strong>
                                                    {{ $relay->business_number }}</p>
                                                <hr>
                                                @if ($relay->co_manager_details != null)
                                                    @php
                                                        $coOwner = json_decode(
                                                            $relay->co_manager_details,
                                                            true,
                                                        );
                                                    @endphp
                                                    <h6>Co-Manager Info</h6>
                                                    <p><strong>Name:</strong> {{ $coOwner['name'] ?? '' }}</p>
                                                    <p><strong>Email:</strong> {{ $coOwner['email'] ?? '' }}</p>
                                                    <p><strong>Phone:</strong> {{ $coOwner['phone'] ?? '' }}</p>
                                                    <hr>
                                                @endif
                                                <p><strong>Ownership Proof:</strong></p>
                                                <a data-fancybox="gallery"
                                                    href="{{ asset($relay->ownership_proof) }}">
                                                    <img width="200"
                                                        src="{{ asset($relay->ownership_proof) }}"
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
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="confirmModal-{{ $relay->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirm Selection</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to select this relay?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="POST" action="{{ route('user.delivery.distance.partner.post') }}">
                                        @csrf
                                        <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
                                        <input type="hidden" name="relay_id" value="{{ $relay->id }}">
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($relays->count() == 0)
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
