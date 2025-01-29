@extends('drivers.auth.app')

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
                            <form class="pt-3" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="name" id="fullName"
                                        placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                                        placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" id="password"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password_confirmation"
                                        placeholder="Confirm Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="vehicleMake" id="vehicleMake"
                                        placeholder="Vehicle Make" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="vehicleModel" id="vehicleModel"
                                        placeholder="Vehicle Model" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" name="vehicleYear" id="vehicleYear"
                                        placeholder="Vehicle Year" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="vehiclePlate" id="vehiclePlate"
                                        placeholder="Vehicle Plate" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="vehicleColor" id="vehicleColor"
                                        placeholder="Vehicle Color" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" name="vehicleSeats" id="vehicleSeats"
                                        placeholder="Number of Seats" required>
                                </div>
                                <div class="form-group">
                                    <label>License Photo (Front)</label>
                                    <input type="file" class="form-control form-control-lg" name="licensePhotoFront"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>License Photo (Back)</label>
                                    <input type="file" class="form-control form-control-lg" name="licensePhotoBack"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Vehicle Photo</label>
                                    <input type="file" class="form-control form-control-lg" name="vehiclePhoto" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-select-lg" name="services" multiple required>
                                        <option value="ride-sharing">Ride Sharing</option>
                                        <option value="parcel-delivery">Parcel Delivery</option>
                                        <option value="taxi-service">Taxi Service</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-select-lg" name="packages" multiple required>
                                        <option value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                        <option value="express">Express</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="localDeliveryCity"
                                        placeholder="Local Delivery City (Optional)">
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="terms_approved" required> I agree to all Terms &
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
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
