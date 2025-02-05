@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('admin.profile.update') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
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
                                    <input type="text" class="form-control" name="address" value="{{ $userProfile->address }}" id="address"
                                        placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date Of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ $userProfile->date_of_birth }}"
                                        id="date_of_birth" placeholder="Date Of Birth">
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

@endsection
