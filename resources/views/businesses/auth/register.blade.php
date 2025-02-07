@extends('partners.auth.app')

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
                                <input type="hidden" name="role" id="role" value="business">

                                <h5>Business Information</h5>

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('trade_name') is-invalid @enderror"
                                        name="trade_name" id="trade_name" placeholder="Trade Name"
                                        value="{{ old('trade_name') }}" required>
                                    @error('trade_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('business_email') is-invalid @enderror"
                                        name="business_email" id="business_email" placeholder="Business Email" value="{{ old('business_email') }}"
                                        required>
                                    @error('business_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('business_phone') is-invalid @enderror"
                                        name="business_phone" id="business_phone" placeholder="BusinessPhone" value="{{ old('business_phone') }}"
                                        required>
                                    @error('business_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('business_number') is-invalid @enderror"
                                        name="business_number" id="business_number" placeholder="Business Number" value="{{ old('business_number') }}"
                                        required>
                                    @error('business_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('business_address') is-invalid @enderror"
                                        name="business_address" id="business_address" placeholder="Business Address" value="{{ old('business_address') }}"
                                        required>
                                    @error('business_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <h5>Responsible Information</h5>

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

                                <div class="form-group">
                                    <input type="date" class="form-control form-control-lg @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth"
                                        placeholder="Date of Birth" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('responsible_address') is-invalid @enderror"
                                        name="responsible_address" id="responsible_address" placeholder="Responsible Address"
                                        value="{{ old('responsible_address') }}" required>
                                    @error('responsible_address')
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

                                <hr>
                                <h5>Manager Information</h5>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('manager_name') is-invalid @enderror"
                                        name="manager_name" id="fullName" placeholder="Manager Name" value="{{ old('manager_name') }}"
                                        required>
                                    @error('manager_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('manager_email') is-invalid @enderror"
                                        name="manager_email" id="email" placeholder="Manager Email" value="{{ old('manager_email') }}"
                                        required>
                                    @error('manager_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('manager_phone') is-invalid @enderror"
                                        name="manager_phone" id="phone" placeholder="Manager Phone" value="{{ old('manager_phone') }}"
                                        required>
                                    @error('manager_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-lg @error('manager_date_of_birth') is-invalid @enderror" name="manager_date_of_birth" id="manager_date_of_birth"
                                        placeholder="Manager Date of Birth" value="{{ old('manager_date_of_birth') }}" required>
                                    @error('manager_date_of_birth')
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
                                <div class="form-group">
                                    <label class="form-label">Availability Days</label>
                                    
                                    <!-- Hidden input to ensure an empty array is sent when no checkboxes are selected -->
                                    <input type="hidden" name="availability_days" value="">
                                
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Monday" id="monday">
                                        <label class="form-check-label" for="monday">Monday</label>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Tuesday" id="tuesday">
                                        <label class="form-check-label" for="tuesday">Tuesday</label>
                                    </div>
                                
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Wednesday" id="wednesday">
                                        <label class="form-check-label" for="wednesday">Wednesday</label>
                                    </div>
                                
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Thursday" id="thursday">
                                        <label class="form-check-label" for="thursday">Thursday</label>
                                    </div>
                                
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Friday" id="friday">
                                        <label class="form-check-label" for="friday">Friday</label>
                                    </div>
                                
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Saturday" id="saturday">
                                        <label class="form-check-label" for="saturday">Saturday</label>
                                    </div>
                                
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="Sunday" id="sunday">
                                        <label class="form-check-label" for="sunday">Sunday</label>
                                    </div>
                                
                                    @error('availability_days')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Ownership Proof</label>
                                    <input type="file" class="form-control form-control-lg @error('ownership_proof') is-invalid @enderror" name="ownership_proof"
                                        required>
                                    @error('ownership_proof')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" value="1" name="terms_of_service"
                                                required> I agree to Terms Of Services
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" value="1" name="terms_approved"
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
@endsection
