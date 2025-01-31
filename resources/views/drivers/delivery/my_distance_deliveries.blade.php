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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Transaction Date </th>
                                        <th> Departure City </th>
                                        <th> Arrival City </th>
                                        <th> Amount </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yourDeliveries as $key => $delivery)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $delivery->transaction_date }} </td>
                                            <td>
                                                {{ $delivery->departure_city }}
                                            </td>
                                            <td>
                                                {{ $delivery->arrival_city }}
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

                    fetch("{{ route('driver.delivery.distance.status') }}", {
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
@endsection
