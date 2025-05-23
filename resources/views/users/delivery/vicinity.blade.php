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
                <h3 class="page-title"> Vicinity Delivery </h3>
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
                            <form action="{{ route('user.delivery.vicinity.store') }}" method="POST" id="delivery-form"
                                class="form-sample">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Departure Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="departure_address" class="form-control autocomplete-address"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Arrival Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="arrival_address" class="form-control autocomplete-address"
                                                    required />
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
                                            <div class="row package-details-box">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <select name="package_type[]" class="form-select package-type"
                                                            required>
                                                            <option value="mail_envelope">Mail Envelope</option>
                                                            <option value="parcel_envelope">Parcel Envelope</option>
                                                            <option value="mini_carton">Mini Carton</option>
                                                            <option value="extra_formats">Other Format</option>
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
                                                <span>Fixed Price</span>
                                                <span id="fixed-price-show">$0.00</span>
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
                let price = 7;
                let taxRate = 0.13;


                document.querySelectorAll(".package-type").forEach((type, index) => {
                    let quantity = document.querySelectorAll(".package-quantity")[index].value;

                    total += price * quantity;
                    
                });
                
                document.getElementById("fixed-price-show").innerHTML = "$" + total.toFixed(2);
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
                                <option value="extra_formats">Other Format</option>
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
