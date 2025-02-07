@extends('localdrivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('local_driver.profile.update') }}" method="POST"
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
                                                value="{{ old('name', $user->name) }}" id="name" placeholder="Username"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', $user->email) }}" id="email" placeholder="Email"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone', $user->phone) }}" id="phone" placeholder="Phone"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_of_birth">Date Of Birth</label>
                                            <input type="date" class="form-control" name="date_of_birth"
                                                value="{{ old('date_of_birth', $user->date_of_birth) }}" id="date_of_birth" placeholder="Date OF Birth"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" class="form-control" name="current_password"
                                                id="current_password" placeholder="Current Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password"
                                                id="confirm_password" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <label for="profile_photo">Profile Photo</label>
                                            <div class="profile-photo-preview mb-2">
                                                <img id="profileImage"
                                                    src="{{ asset($driver->profile_photo ?? 'users_profile/default-profile.png') }}"
                                                    class="img-fluid rounded-circle" width="120" alt="Profile Photo">
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
                                        <h5 class="card-title">Transport Information</h5>
                                        <div class="form-check">
                                            <input type="hidden" name="walk" class="form-check" value="0"
                                                {{ !$driver->walk ? 'checked' : '' }}>
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" class="form-check-input" name="walk"
                                                    id="walk" value="1" {{ $driver->walk ? 'checked' : '' }}>
                                                Deliver By Walk?
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Mean Of Transport</label>
                                            <input type="text" name="mean_of_transport" class="form-control"
                                                value="{{ $driver->mean_of_transport }}" required>
                                        </div>
                                        @foreach (['make', 'model', 'year', 'plate', 'color'] as $field)
                                            <div class="form-group">
                                                <label>Vehicle {{ ucfirst($field) }}</label>
                                                <input type="text" name="vehicle_{{ $field }}"
                                                    class="form-control"
                                                    value="{{ old('vehicle_' . $field, $driver->{'vehicle_' . $field}) }}"
                                                    required>
                                            </div>
                                        @endforeach
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control @error('city') is-invalid @enderror"
                                                name="city" placeholder="City"
                                                value="{{ old('city', $driver->city ?? '') }}">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control autocomplete-address form-control @error('address') is-invalid @enderror"
                                                name="address" placeholder="Address"
                                                value="{{ old('address', $driver->address ?? '') }}">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="time"
                                                class="form-control form-control @error('time_from') is-invalid @enderror"
                                                name="time_from" placeholder="time_from"
                                                value="{{ old('time_from', $driver->time_from ?? '') }}">
                                            @error('time_from')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="time"
                                                class="form-control form-control @error('time_to') is-invalid @enderror"
                                                name="time_to" placeholder="time_to"
                                                value="{{ old('time_to', $driver->time_to ?? '') }}">
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

                                            @php
                                                $availabilityDays =
                                                    json_decode($driver->availability_days, true) ?? [];
                                            @endphp

                                            <?php
                                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                            foreach ($days as $day) {
                                                $checked = in_array($day, $availabilityDays) ? 'checked' : '';
                                                echo '<div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="availability_days[]" value="' . $day . '" id="' . strtolower($day) . '" ' . $checked .'>
                                                    <label class="form-check-label" for="' .strtolower($day) . '">' . $day .'</label>
                                                    </div>';
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="row mt-3">
                    @foreach (['photo_of_facial_id' => 'Photo Of Facial ID', 'proof_of_domicile' => 'Proof Of Domicile'] as $field => $label)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $label }}</h5>
                                    <img src="{{ asset($driver->$field) }}" class="img-fluid mb-2"
                                        alt="{{ $label }}">
                                    <input type="file" name="{{ $field }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Update Driver</button>
                </div>
                </form>
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
