@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> My Deliveries </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Deliveries</h4>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Transaction Date </th>
                                        <th> Departure Address </th>
                                        <th> Arrival Address </th>
                                        <th> Amount </th>
                                        <th> Status </th>
                                        <th>User Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yourDeliveries as $key => $delivery)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $delivery->transaction_date }} </td>
                                            <td>
                                                {{ $delivery->departure_address }}
                                            </td>
                                            <td>
                                                {{ $delivery->arrival_address }}
                                            </td>
                                            <td> $ {{ number_format($delivery->total_price, 2) }} </td>
                                            <td>
                                                <select class="form-select status-dropdown" data-id="{{ $delivery->id }}">
                                                    <option value="1" {{ $delivery->status == 1 ? 'selected' : '' }}>
                                                        ON THE WAY</option>
                                                    <option value="2" {{ $delivery->status == 2 ? 'selected' : '' }}>
                                                        DELIVERED</option>
                                                    <option value="0" {{ $delivery->status == 0 ? 'selected' : '' }}>
                                                        REJECTED</option>
                                                </select>
                                                <span id="status-message-{{ $delivery->id }}" class="text-success"></span>
                                            </td>
                                            <td>
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#userInfoModal-{{ $delivery->id }}">
                                                    View
                                                </button>
                                                <div class="modal fade" id="userInfoModal-{{ $delivery->id }}"
                                                    tabindex="-1" aria-labelledby="userInfoModalLabel-{{ $delivery->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="userInfoModalLabel-{{ $delivery->id }}">User
                                                                    Information</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Name:</strong> {{ $delivery->user->name }}</p>
                                                                <p><strong>Email:</strong> {{ $delivery->user->email }}</p>
                                                                <p><strong>Phone:</strong> {{ $delivery->user->phone }}</p>
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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".status-dropdown").forEach(function(dropdown) {
                dropdown.addEventListener("change", function() {
                    let deliveryId = this.getAttribute("data-id");
                    let newStatus = this.value;
                    let statusMessage = document.getElementById("status-message-" + deliveryId);

                    fetch("{{ route('driver.delivery.vicinity.status') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            body: JSON.stringify({
                                delivery_id: deliveryId,
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                statusMessage.textContent = "Updated successfully!";
                                statusMessage.classList.add("text-success");
                                setTimeout(() => statusMessage.textContent = "", 2000);
                            } else {
                                statusMessage.textContent = "Update failed!";
                                statusMessage.classList.add("text-danger");
                            }
                        })
                        .catch(error => {
                            console.error("Error updating status:", error);
                            statusMessage.textContent = "Error occurred!";
                            statusMessage.classList.add("text-danger");
                        });
                });
            });
        });
    </script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
