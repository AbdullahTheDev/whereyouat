@extends('users.layouts.app')
@section('style')
    <style>
        #autocomplete-list {
            position: absolute;
            border: 1px solid #ccc;
            background: white;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background: #f0f0f0;
        }
    </style>
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('user.profile.update') }}" method="POST" class="forms-sample"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Basic Information</h4>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                        id="name" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                        id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}"
                                        id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" autocomplete="new-password"
                                        name="current_password" value="" id="current_password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" autocomplete="new-password" name="password"
                                        value="" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" autocomplete="new-password"
                                        name="confirm_password" value="" id="confirm_password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <h4 class="card-title">Profile Information</h4>

                                <div class="form-group text-center">
                                    <label for="profile_photo">Profile Photo</label>
                                    <div class="profile-photo-preview mb-2">
                                        <img id="profileImage"
                                            src="{{ $userProfile->profile_photo ? asset('users_profile/' . $userProfile->profile_photo) : asset('users_profile/default-profile.png') }}"
                                            alt="Profile Photo" class="img-fluid rounded-circle" width="120">
                                    </div>
                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                        accept="image/*">
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input class="form-control" type="text" name="address" id="address-input"
                                        value="{{ $userProfile->address }}" placeholder="Start typing an address..."
                                        autocomplete="off">
                                    <div id="autocomplete-list"></div>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date Of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ $user->date_of_birth }}" id="date_of_birth" placeholder="Date Of Birth">
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                            </div>
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
    <script>
        const apiKey = "46bc8355b7f3494ebcb210ce851ba1ad";
        const input = document.getElementById("address-input");
        const list = document.getElementById("autocomplete-list");

        input.addEventListener("input", async () => {
            const query = input.value.trim();
            if (query.length < 3) {
                list.innerHTML = "";
                return;
            }
            const url =
                `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(query)}&limit=5&apiKey=${apiKey}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                list.innerHTML = "";

                if (data.features.length) {
                    data.features.forEach((feature) => {
                        const item = document.createElement("div");
                        item.classList.add("autocomplete-item");
                        item.textContent = feature.properties.formatted;
                        item.addEventListener("click", () => {
                            input.value = feature.properties.formatted;
                            list.innerHTML = "";
                        });
                        list.appendChild(item);
                    });
                }
            } catch (error) {
                console.error("Error fetching address suggestions:", error);
            }
        });

        document.addEventListener("click", (event) => {
            if (!list.contains(event.target) && event.target !== input) {
                list.innerHTML = "";
            }
        });
    </script>
@endsection
