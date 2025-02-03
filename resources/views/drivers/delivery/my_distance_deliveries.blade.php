@extends('drivers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> My Deliveries </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Deliveries</h4>
                            <a href="{{ route('driver.delivery.distance') }}">Distance Deliveries</a>
                            <a href="{{ route('driver.delivery.vicinity') }}">Vicinity Deliveries</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection