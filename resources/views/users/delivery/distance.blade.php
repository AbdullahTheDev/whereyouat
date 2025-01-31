@extends('users.layouts.app')

@section('style')
    <style>
        .package-details-box {
            border: 1px solid #ddd;
            padding: 15px 0px;
            margin-bottom: 23px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }
    </style>
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Distance Delivery </h3>
                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                    </ol>
                </nav> --}}
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Have A Package Delivered</h4>
                            <form action="{{ route('user.delivery.distance.store') }}" method="POST" id="delivery-form"
                                class="form-sample">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Departure City</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="departure_city" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Arrival City</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="arrival_city" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Transaction Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="transaction_date" class="form-control"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Delivery Mode</label>
                                        <select name="delivery_mode" id="delivery-mode" class="form-select" required>
                                            <option value="direct">Direct to Driver</option>
                                            <option value="partner">Partner Area</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label class="col-form-label">Package Details</label>
                                        <div id="package-container">
                                            <div class="row package-details-box">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <select name="package_type[]" class="form-select package-type"
                                                            required>
                                                            <option value="mail_envelope">Mail Envelope</option>
                                                            <option value="parcel_envelope">Parcel Envelope</option>
                                                            <option value="mini_carton">Mini Carton</option>
                                                            <option value="other">Other Format</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="number" name="package_quantity[]"
                                                            class="form-control package-quantity" min="1"
                                                            value="1" required />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" name="package_description[]"
                                                            class="form-control" placeholder="Package Description"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="add-package" class="btn btn-primary">Add Another
                                            Package</button>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div>
                                            <p>
                                                <span>Online Booking</span>
                                                <span id="online-booking-price-show">$0.00</span>
                                            </p>
                                            <p>
                                                <span>Fixed Price</span>
                                                <span id="fixed-price-show">$0.00</span>
                                            </p>
                                            <p>
                                                <span>Carrier Price</span>
                                                <span id="carrier-booking-price-show">$0.00</span>
                                            </p>
                                            <p>
                                                <span>Tax</span>
                                                <span id="tax-show">%0</span>
                                            </p>
                                        </div>
                                        <label>Total Price</label>
                                        <input type="text" id="total-price-show" class="form-control" readonly />
                                        <input type="hidden" name="total_price" id="total-price" class="form-control"
                                            readonly />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Next</button>
                            </form>
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
            function calculatePrice() {
                let total = 0;
                let taxRate = 0.13;
                let basePricesDirect = {
                    mail_envelope: {
                        online: 15,
                        carrier: 15,
                        total: 30
                    },
                    parcel_envelope: {
                        online: 15,
                        carrier: 15,
                        total: 30
                    },
                    mini_carton: {
                        online: 25,
                        carrier: 40,
                        total: 65
                    },
                    other: {
                        online: 25,
                        carrier: 40,
                        total: 65
                    }
                };
                let basePricesPartner = {
                    mail_envelope: {
                        online: 10,
                        fixed: 5,
                        carrier: 20,
                        total: 35
                    },
                    parcel_envelope: {
                        online: 10,
                        fixed: 5,
                        carrier: 20,
                        total: 35
                    },
                    mini_carton: {
                        online: 20,
                        fixed: 5,
                        carrier: 30,
                        total: 55
                    },
                    other: {
                        online: 10,
                        fixed: 5,
                        carrier: 20,
                        total: 35
                    }
                };
                let deliveryMode = document.querySelector("select[name='delivery_mode']").value;
                document.querySelectorAll(".package-type").forEach((type, index) => {
                    let quantity = document.querySelectorAll(".package-quantity")[index].value;

                    if (deliveryMode == 'partner') {
                        total += basePricesPartner[type.value]['total'] * quantity;

                        document.getElementById("online-booking-price-show").innerHTML = "$" + (basePricesPartner[type.value]['online'] * quantity).toFixed(2);
                        document.getElementById("fixed-price-show").innerHTML = "$" + (basePricesPartner[type.value]['fixed'] * quantity).toFixed(2);
                        document.getElementById("carrier-booking-price-show").innerHTML = "$" + (basePricesPartner[type.value]['carrier'] * quantity).toFixed(2);
                    } else {
                        total += basePricesDirect[type.value]['total'] * quantity;

                        document.getElementById("online-booking-price-show").innerHTML = "$" + (basePricesPartner[type.value]['online'] * quantity).toFixed(2);
                        document.getElementById("carrier-booking-price-show").innerHTML = "$" + (basePricesPartner[type.value]['carrier'] * quantity).toFixed(2);
                    }
                });
                total += total * taxRate;
                document.getElementById("total-price-show").value = total.toFixed(2) + " CAD";
                document.getElementById("total-price").value = total.toFixed(2);

                document.getElementById("tax-show").innerHTML = "%" + (taxRate * 100).toFixed(2);


            }

            document.getElementById("add-package").addEventListener("click", function() {
                let container = document.getElementById("package-container");
                let newPackage = document.createElement("div");
                newPackage.classList.add("row");
                newPackage.classList.add("package-details-box");
                newPackage.innerHTML = `
                    <div class="col-6">
                        <div class="form-group">
                            <select name="package_type[]" class="form-select package-type" required>
                                <option value="mail_envelope">Mail Envelope</option>
                                <option value="parcel_envelope">Parcel Envelope</option>
                                <option value="mini_carton">Mini Carton</option>
                                <option value="other">Other Format</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="number" name="package_quantity[]" class="form-control package-quantity" min="1" value="1" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="package_description[]" class="form-control" placeholder="Package Description" required />
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-package" style="position: absolute; top: -17px; right: -19px;">✖</button>
                    </div>
            `;
                container.appendChild(newPackage);
            });

            document.getElementById("package-container").addEventListener("click", function(event) {
                if (event.target.classList.contains("remove-package")) {
                    event.target.closest(".package-details-box").remove();
                }
            });
            document.querySelector("#delivery-form").addEventListener("input", calculatePrice);
        });
    </script>
@endsection
