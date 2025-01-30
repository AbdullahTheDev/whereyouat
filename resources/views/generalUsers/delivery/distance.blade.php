@extends('generalUsers.layouts.app')

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
                            <form id="delivery-form" class="form-sample">
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
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label class="col-form-label">Package Details</label>
                                        <div id="package-container">
                                            <div class="row">
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
                                                        <input type="number" name="package_quantity[]"
                                                            class="form-control package-quantity" min="1" value="1"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <button type="button" id="add-package" class="btn btn-primary">Add Another
                                            Package</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Delivery Mode</label>
                                        <select name="delivery_mode" class="form-control" required>
                                            <option value="direct">Direct to Driver</option>
                                            <option value="partner">Partner Area</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label>Total Price</label>
                                        <input type="text" id="total-price" class="form-control" readonly />
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
                let basePrices = {
                    mail_envelope: {
                        partner: 35,
                        direct: 30
                    },
                    parcel_envelope: {
                        partner: 40,
                        direct: 35
                    },
                    mini_carton: {
                        partner: 55,
                        direct: 50
                    },
                    other: {
                        partner: 75,
                        direct: 65
                    }
                };
                let deliveryMode = document.querySelector("select[name='delivery_mode']").value;
                document.querySelectorAll(".package-type").forEach((type, index) => {
                    let quantity = document.querySelectorAll(".package-quantity")[index].value;
                    total += basePrices[type.value][deliveryMode] * quantity;
                });
                total += total * taxRate;
                document.getElementById("total-price").value = total.toFixed(2) + " CAD";
            }

            document.getElementById("add-package").addEventListener("click", function() {
                let container = document.getElementById("package-container");
                let newPackage = document.createElement("div");
                newPackage.classList.add("form-group");
                newPackage.innerHTML = `
                <select name="package_type[]" class="form-control package-type" required>
                    <option value="mail_envelope">Mail Envelope</option>
                    <option value="parcel_envelope">Parcel Envelope</option>
                    <option value="mini_carton">Mini Carton</option>
                    <option value="other">Other Format</option>
                </select>
                <input type="number" name="package_quantity[]" class="form-control package-quantity" min="1" value="1" required />
            `;
                container.appendChild(newPackage);
            });

            document.querySelector("#delivery-form").addEventListener("input", calculatePrice);
        });
    </script>
@endsection
