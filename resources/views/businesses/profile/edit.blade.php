@extends('businesses.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('businesses.profile.update') }}" method="POST"
                        class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Basic Information</h4>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" id="name" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" id="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $user->phone }}" id="phone" placeholder="Phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" class="form-control" name="responsible_address"
                                                value="{{ $business->responsible_address }}" id="name"
                                                placeholder="Home address">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Date Of Birth</label>
                                            <input type="date" class="form-control" name="date_of_birth"
                                                value="{{ $user->date_of_birth }}" id="date_of_birth"
                                                placeholder="Date Of Birth">
                                        </div>
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" class="form-control" autocomplete="new-password"
                                                name="current_password" value="" id="current_password"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" autocomplete="new-password"
                                                name="password" value="" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" autocomplete="new-password"
                                                name="confirm_password" value="" id="confirm_password"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <label for="profile_photo">Profile Photo</label>
                                            <div class="profile-photo-preview mb-2">
                                                <img id="profileImage"
                                                    src="{{ $business->profile_photo ? asset($business->profile_photo) : asset('users_profile/default-profile.png') }}"
                                                    alt="Profile Photo" class="img-fluid rounded-circle" width="120">
                                            </div>
                                            <input type="file" class="form-control" id="profile_photo"
                                                name="profile_photo" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Business Information</h4>
                                        <div class="form-group">
                                            <label for="name">Trade Name</label>
                                            <input type="text" class="form-control" name="trade_name"
                                                value="{{ $business->trade_name }}" id="name"
                                                placeholder="Trade name">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="business_email"
                                                value="{{ $business->business_email }}" id="business_email"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="business_phone"
                                                value="{{ $business->business_phone }}" id="business_phone"
                                                placeholder="Phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Address</label>
                                            <input type="text" class="form-control autocomplete-address" name="business_address"
                                                value="{{ $business->business_address }}" id="business_address"
                                                placeholder="Address">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Business Number</label>
                                            <input type="text" class="form-control" name="business_number"
                                                value="{{ $business->business_number }}" id="business_number"
                                                placeholder="Business Number">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Business City</label>
                                            <input type="text" class="form-control autocomplete-city" name="city"
                                                value="{{ $business->city }}" id="city"
                                                placeholder="Business Number">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Business Zipcode</label>
                                            <input type="text" class="form-control" name="zipcode"
                                                value="{{ $business->zipcode }}" id="zipcode"
                                                placeholder="Business Number">
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Manager Information</h5>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="manager_name" class="form-control"
                                                value="{{ $manager['name'] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="manager_email" class="form-control"
                                                value="{{ $manager['email'] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="manager_phone" class="form-control"
                                                value="{{ $manager['phone'] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Date Of Birth</label>
                                            <input type="text" name="manager_date_of_birth" class="form-control"
                                                value="{{ $manager['date_of_birth'] }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        // Decode the stored JSON availability days
                        $availabilityDays = json_decode($business->availability_days, true) ?? [];
                        ?>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Availability</h5>
                                        <div class="form-group">
                                            <label class="form-label">Availability Days</label>
                                            <input type="hidden" name="availability_days" value="">

                                            <?php
                                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                            foreach ($days as $day) {
                                                $checked = in_array($day, $availabilityDays) ? 'checked' : '';
                                                echo '
                                                                                                                                                                                    <div class="form-check">
                                                                                                                                                                                        <input type="checkbox" class="form-check-input" name="availability_days[]" value="' .
                                                    $day .
                                                    '" id="' .
                                                    strtolower($day) .
                                                    '" ' .
                                                    $checked .
                                                    '>
                                                                                                                                                                                        <label class="form-check-label" for="' .
                                                    strtolower($day) .
                                                    '">' .
                                                    $day .
                                                    '</label>
                                                                                                                                                                                    </div>';
                                            }
                                            ?>

                                        </div>

                                        <div class="form-group">
                                            <input type="time"
                                                class="form-control form-control-lg @error('time_from') is-invalid @enderror"
                                                name="time_from" placeholder="time_from"
                                                value="{{ old('time_from', \Carbon\Carbon::parse($business->time_from)->format('H:i')) }}">
                                        </div>

                                        <div class="form-group">
                                            <input type="time"
                                                class="form-control form-control-lg @error('time_to') is-invalid @enderror"
                                                name="time_to" placeholder="time_to"
                                                value="{{ old('time_to', \Carbon\Carbon::parse($business->time_to)->format('H:i')) }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Ownership Proof</h5>
                                        <img src="{{ asset($business->ownership_proof) }}" class="img-fluid mb-2"
                                            alt="Ownership Proof">
                                        <input type="file" name="ownership_proof" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Update Partner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById("profile_photo").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("profileImage").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
