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
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" id="fullName"
                                        placeholder="Full Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email"
                                        placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password"
                                        placeholder="Password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation"
                                        placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" id="phone"
                                        placeholder="Phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehicleMake') is-invalid @enderror" name="vehicleMake" id="vehicleMake"
                                        placeholder="Vehicle Make" value="{{ old('vehicleMake') }}" required>
                                    @error('vehicleMake')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehicleModel') is-invalid @enderror" name="vehicleModel" id="vehicleModel"
                                        placeholder="Vehicle Model" value="{{ old('vehicleModel') }}" required>
                                    @error('vehicleModel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg @error('vehicleYear') is-invalid @enderror" name="vehicleYear" id="vehicleYear"
                                        placeholder="Vehicle Year" value="{{ old('vehicleYear') }}" required>
                                    @error('vehicleYear')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehiclePlate') is-invalid @enderror" name="vehiclePlate" id="vehiclePlate"
                                        placeholder="Vehicle Plate" value="{{ old('vehiclePlate') }}" required>
                                    @error('vehiclePlate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehicleColor') is-invalid @enderror" name="vehicleColor" id="vehicleColor"
                                        placeholder="Vehicle Color" value="{{ old('vehicleColor') }}" required>
                                    @error('vehicleColor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg @error('vehicleSeats') is-invalid @enderror" name="vehicleSeats" id="vehicleSeats"
                                        placeholder="Number of Seats" value="{{ old('vehicleSeats') }}" required>
                                    @error('vehicleSeats')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>License Photo (Front)</label>
                                    <input type="file" class="form-control form-control-lg @error('licensePhotoFront') is-invalid @enderror" name="licensePhotoFront"
                                        required>
                                    @error('licensePhotoFront')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>License Photo (Back)</label>
                                    <input type="file" class="form-control form-control-lg @error('licensePhotoBack') is-invalid @enderror" name="licensePhotoBack"
                                        required>
                                    @error('licensePhotoBack')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Vehicle Photo</label>
                                    <input type="file" class="form-control form-control-lg @error('vehiclePhoto') is-invalid @enderror" name="vehiclePhoto" required>
                                    @error('vehiclePhoto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-select-lg @error('services') is-invalid @enderror" name="services" multiple required>
                                        <option value="ride-sharing">Ride Sharing</option>
                                        <option value="parcel-delivery">Parcel Delivery</option>
                                        <option value="taxi-service">Taxi Service</option>
                                    </select>
                                    @error('services')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-select-lg @error('packages') is-invalid @enderror" name="packages" multiple required>
                                        <option value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                        <option value="express">Express</option>
                                    </select>
                                    @error('packages')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('localDeliveryCity') is-invalid @enderror" name="localDeliveryCity"
                                        placeholder="Local Delivery City (Optional)" value="{{ old('localDeliveryCity') }}">
                                    @error('localDeliveryCity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
