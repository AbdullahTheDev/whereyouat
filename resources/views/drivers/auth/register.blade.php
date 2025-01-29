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
                                <input type="hidden" name="role" id="role" value="driver">
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
                                    <input type="text" class="form-control form-control-lg @error('vehicle_make') is-invalid @enderror" name="vehicle_make" id="vehicle_make"
                                        placeholder="Vehicle Make" value="{{ old('vehicle_make') }}" required>
                                    @error('vehicle_make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehicle_model') is-invalid @enderror" name="vehicle_model" id="vehicle_model"
                                        placeholder="Vehicle Model" value="{{ old('vehicle_model') }}" required>
                                    @error('vehicle_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg @error('vehicle_year') is-invalid @enderror" name="vehicle_year" id="vehicle_year"
                                        placeholder="Vehicle Year" value="{{ old('vehicle_year') }}" required>
                                    @error('vehicle_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehicle_plate') is-invalid @enderror" name="vehicle_plate" id="vehicle_plate"
                                        placeholder="Vehicle Plate" value="{{ old('vehicle_plate') }}" required>
                                    @error('vehicle_plate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('vehicle_color') is-invalid @enderror" name="vehicle_color" id="vehicle_color"
                                        placeholder="Vehicle Color" value="{{ old('vehicle_color') }}" required>
                                    @error('vehicle_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg @error('vehicle_seats') is-invalid @enderror" name="vehicle_seats" id="vehicle_seats"
                                        placeholder="Number of Seats" value="{{ old('vehicle_seats') }}" required>
                                    @error('vehicle_seats')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>License Photo (Front)</label>
                                    <input type="file" class="form-control form-control-lg @error('license_photo_front') is-invalid @enderror" name="license_photo_front"
                                        required>
                                    @error('license_photo_front')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>License Photo (Back)</label>
                                    <input type="file" class="form-control form-control-lg @error('license_photo_back') is-invalid @enderror" name="license_photo_back"
                                        required>
                                    @error('license_photo_back')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Vehicle Photo</label>
                                    <input type="file" class="form-control form-control-lg @error('vehicle_photo') is-invalid @enderror" name="vehicle_photo" required>
                                    @error('vehicle_photo')
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
