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
                            <h4 class="card-title">My Deliveries</h4>
                            @if ($distance)
                                <a class="btn btn-primary" href="{{ route('driver.delivery.distance.your') }}">Distance
                                    Deliveries</a>
                            @endif
                            @if ($vicinity)
                                <a class="btn btn-primary" href="{{ route('driver.delivery.vicinity.your') }}">Vicinity
                                    Deliveries</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
