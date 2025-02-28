@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <div>
                    <h3 class="page-title"> Available Deliveries </h3>
                    <small class="mt-1 text-muted d-block">You will see only the deliveries which have the packages you
                        support</small>
                </div>
            </div>
            <div class="row">
                @foreach ($activeDeliveries as $delivery)
                    @php
                        $packageNames = [];
                        foreach ($delivery->packageDetails as $package) {
                            $packageNames[] = $package->package_type;
                        }
                        if (array_diff($packageNames, $packages)) {
                            continue;
                        }
                    @endphp
                    <div class="col-12 col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <span class="text-muted">From: </span>
                                    <span style="white-space: normal;">
                                        {{ $delivery->departure_address }}
                                    </span>
                                    <br>
                                    <br>
                                    <span class="text-muted">To:</span>
                                    <span style="white-space: normal;">
                                        {{ $delivery->arrival_address }}
                                    </span>

                                </h4>
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
                                <hr>
                                <div class="mb-2 mt-3">
                                    <h4>Package Details</h4>
                                </div>
                                @foreach ($delivery->packageDetails as $packageDetail)
                                    <div class="d-flex mt-3 align-items-top px-4">
                                        <div class="mb-0 flex-grow">
                                            <div class="d-flex">
                                                <h6 class="me-2 mb-2">
                                                    {{ strtoupper(str_replace('-', ' ', $packageDetail->package_type)) }}
                                                </h6>
                                                <span class="text-muted font-weight-light">
                                                    @if ($packageDetail->package_type == 'mini_carton' || $packageDetail->package_type == 'other')
                                                        Weight: {{ $packageDetail->qty }} KG
                                                    @else
                                                        Quantity: {{ $packageDetail->qty }}
                                                    @endif
                                                </span>
                                            </div>
                                            <p class="mb-0 font-weight-light">{{ $packageDetail->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-4 mb-0">
                                    <form id="acceptDeliveryForm" action="{{ route('driver.delivery.vicinity.accept') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{ $delivery->id }}">
                                            Accept for ${{ number_format($delivery->total_price, 2) }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bootstrap Confirmation Modal -->
                    <div class="modal fade" id="confirmModal-{{ $delivery->id }}" tabindex="-1"
                        aria-labelledby="confirmModalLabel-{{ $delivery->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel-{{ $delivery->id }}">Confirm Acceptance
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to accept this delivery for
                                    ${{ number_format($delivery->total_price, 2) }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary"
                                        id="confirmAccept-{{ $delivery->id }}">Yes, Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($activeDeliveries->count() == 0)
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
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("[id^='confirmAccept-']").forEach(button => {
                button.addEventListener("click", function() {
                    let deliveryId = this.id.split("-")[1]; // Extract delivery ID
                    let form = document.querySelector(`#confirmModal-${deliveryId}`)
                        .previousElementSibling.querySelector("form");

                    if (form) {
                        form.submit(); // Submit the form
                    }
                });
            });
        });
    </script>
@endsection
