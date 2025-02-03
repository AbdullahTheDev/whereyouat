@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('driver.profile.update') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Basic Information</h4>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" id="phone"
                                        placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" autocomplete="new-password" name="current_password" value="" id="current_password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" autocomplete="new-password" name="password" value="" id="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" autocomplete="new-password" name="confirm_password" value="" id="confirm_password"
                                        placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Driver Information</h5>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $driver->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $driver->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control" value="{{ $driver->phone }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Vehicle Information</h5>
                                        <div class="form-group">
                                            <label>Vehicle Make</label>
                                            <input type="text" name="vehicle_make" class="form-control" value="{{ $driver->vehicle_make }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle Model</label>
                                            <input type="text" name="vehicle_model" class="form-control" value="{{ $driver->vehicle_model }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle Year</label>
                                            <input type="text" name="vehicle_year" class="form-control" value="{{ $driver->vehicle_year }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle Plate</label>
                                            <input type="text" name="vehicle_plate" class="form-control" value="{{ $driver->vehicle_plate }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle Color</label>
                                            <input type="text" name="vehicle_color" class="form-control" value="{{ $driver->vehicle_color }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle Seats</label>
                                            <input type="text" name="vehicle_seats" class="form-control" value="{{ $driver->vehicle_seats }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">License Front</h5>
                                        <img src="{{ asset($driver->license_photo_front) }}" class="img-fluid mb-2" alt="License Front">
                                        <input type="file" name="license_photo_front" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">License Back</h5>
                                        <img src="{{ asset($driver->license_photo_back) }}" class="img-fluid mb-2" alt="License Back">
                                        <input type="file" name="license_photo_back" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Vehicle Photo</h5>
                                        <img src="{{ asset($driver->vehicle_photo) }}" class="img-fluid mb-2" alt="Vehicle Photo">
                                        <input type="file" name="vehicle_photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Update Driver</button>
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
