@extends('localdrivers.auth.app')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/logo.svg') }}">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" enctype="multipart/form-data" method="POST"
                                action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="role" id="role" value="local_driver">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        name="name" id="fullName" placeholder="Full Name" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation"
                                        placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}"
                                        required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input @error('walk') is-invalid @enderror"
                                            name="walk" id="walk" placeholder="Walk" value="1" required>
                                        Deliver By Walk?
                                        @error('walk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('mean_of_transport') is-invalid @enderror"
                                        name="mean_of_transport" id="mean_of_transport" placeholder="Mean of Transport"
                                        value="{{ old('mean_of_transport') }}" required>
                                    @error('mean_of_transport')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('vehicle_make') is-invalid @enderror"
                                        name="vehicle_make" id="vehicle_make" placeholder="Vehicle Make"
                                        value="{{ old('vehicle_make') }}" required>
                                    @error('vehicle_make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('vehicle_model') is-invalid @enderror"
                                        name="vehicle_model" id="vehicle_model" placeholder="Vehicle Model"
                                        value="{{ old('vehicle_model') }}" required>
                                    @error('vehicle_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number"
                                        class="form-control form-control-lg @error('vehicle_year') is-invalid @enderror"
                                        name="vehicle_year" id="vehicle_year" placeholder="Vehicle Year"
                                        value="{{ old('vehicle_year') }}" required>
                                    @error('vehicle_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('vehicle_plate') is-invalid @enderror"
                                        name="vehicle_plate" id="vehicle_plate" placeholder="Vehicle Plate"
                                        value="{{ old('vehicle_plate') }}" required>
                                    @error('vehicle_plate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('vehicle_color') is-invalid @enderror"
                                        name="vehicle_color" id="vehicle_color" placeholder="Vehicle Color"
                                        value="{{ old('vehicle_color') }}" required>
                                    @error('vehicle_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('city') is-invalid @enderror"
                                        name="city" placeholder="City" value="{{ old('city') }}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="time"
                                        class="form-control form-control-lg @error('time_from') is-invalid @enderror"
                                        name="time_from" placeholder="time_from" value="{{ old('time_from') }}">
                                    @error('time_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="time"
                                        class="form-control form-control-lg @error('time_to') is-invalid @enderror"
                                        name="time_to" placeholder="time_to" value="{{ old('time_to') }}">
                                    @error('time_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="terms_approved"
                                                required> I agree to all Terms &
                                            Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">REGISTER</button>
                                </div>
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
            let walkCheckbox = document.getElementById("walk");
            let vehicleFields = document.querySelectorAll(
                "#mean_of_transport, #vehicle_make, #vehicle_model, #vehicle_year, #vehicle_plate, #vehicle_color");

            function toggleVehicleFields() {
                let isChecked = walkCheckbox.checked;
                vehicleFields.forEach(field => {
                    field.closest(".form-group").style.display = isChecked ? "none" : "block";
                    field.required = !isChecked;
                });
            }

            walkCheckbox.addEventListener("change", toggleVehicleFields);
            toggleVehicleFields(); // Call on page load to set initial state
        });
    </script>
@endsection
