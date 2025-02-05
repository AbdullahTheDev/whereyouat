@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> All Users </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Users</h4>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th> 
                                        <th> Phone </th>
                                        <th> Email </th>
                                        <th> Services Offered </th>
                                        <th> Registered Date </th>
                                        <th> Rider Info </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $user->name }} </td>
                                            <td> {{ $user->phone }} </td>
                                            <td> {{ $user->email }} </td>                                            
                                            <td> {{ \Carbon\Carbon::parse($user->created_at)->format('M j, Y | h:i A') }} </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#userInfoModal-{{ $user->id }}">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="userInfoModal-{{ $user->id }}"
                                            tabindex="-1" aria-labelledby="userInfoModalLabel-{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="userInfoModalLabel-{{ $user->id }}">User
                                                            Information</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Name:</strong> {{ $user->name }}</p>
                                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                                        <p><strong>Date of Birth:</strong> {{ $user->date_of_birth }}</p>
                                                        <p><strong>Address:</strong> {{ $user->userProfile->address }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
