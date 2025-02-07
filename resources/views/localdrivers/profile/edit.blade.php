@extends('localdrivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('driver.profile.update') }}" method="POST" class="forms-sample"
                        enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Basic Information</h4>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" id="name" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" id="email" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" id="phone" placeholder="Phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="profile_photo">Profile Photo</label>
                                                <div class="profile-photo-preview mb-2">
                                                    <img id="profileImage" src="{{ asset('drivers_profile/' . ($driver->profile_photo ?? 'default-profile.png')) }}" class="img-fluid rounded-circle" width="120" alt="Profile Photo">
                                                </div>
                                                <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*">
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Vehicle Information</h5>
                                            @foreach(['make', 'model', 'year', 'plate', 'color', 'seats'] as $field)
                                                <div class="form-group">
                                                    <label>Vehicle {{ ucfirst($field) }}</label>
                                                    <input type="text" name="vehicle_{{ $field }}" class="form-control" value="{{ old('vehicle_' . $field, $driver->{'vehicle_' . $field}) }}" required>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label>Services</label>
                                                <select class="form-select" name="services[]" multiple required>
                                                    @foreach(['ride-sharing', 'distance-delivery', 'vicinity-delivery'] as $service)
                                                        <option value="{{ $service }}" {{ in_array($service, json_decode($driver->services, true) ?? []) ? 'selected' : '' }}>{{ ucwords(str_replace('-', ' ', $service)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Packages</label>
                                                <select class="form-select" name="packages[]" multiple required>
                                                    @foreach(['mail-envelope', 'parcel-envelope', 'mini-carton', 'extra-formats'] as $package)
                                                        <option value="{{ $package }}" {{ in_array($package, json_decode($driver->packages, true) ?? []) ? 'selected' : '' }}>{{ ucwords(str_replace('-', ' ', $package)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row mt-3">
                                @foreach(['license_photo_front' => 'License Front', 'license_photo_back' => 'License Back', 'vehicle_photo' => 'Vehicle Photo'] as $field => $label)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">{{ $label }}</h5>
                                                <img src="{{ asset($driver->$field) }}" class="img-fluid mb-2" alt="{{ $label }}">
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
