@extends('drivers.layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Track Deliveries </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                @foreach ($activeDeliveries as $deliveries)
                    
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="d-flex">
                            <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                                <i class="mdi mdi-account-outline icon-sm me-2"></i>
                                <span>jack Menqu</span>
                            </div>
                            <div class="d-flex align-items-center text-muted font-weight-light">
                                <i class="mdi mdi-clock icon-sm me-2"></i>
                                <span>October 3rd, 2018</span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            
                        </div>
                        <div class="d-flex mt-5 align-items-top">
                            <img src="{{ asset('assets/images/faces/face3.jpg') }}" class="img-sm rounded-circle me-3"
                                alt="image">
                            <div class="mb-0 flex-grow">
                                <h5 class="me-2 mb-2">School Website - Authentication Module.</h5>
                                <p class="mb-0 font-weight-light">It is a long established fact that a reader will be
                                    distracted by the readable content of a page.</p>
                            </div>
                            <div class="ms-auto">
                                <i class="mdi mdi-heart-outline text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection