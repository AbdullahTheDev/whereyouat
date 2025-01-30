@extends('generalUsers.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Track Deliveries </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Deliveries</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Transaction Date </th>
                                        <th> Departure City </th>
                                        <th> Arrival City </th>
                                        <th> Amount </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deliveries as $key => $delivery)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $delivery->transaction_date }} </td>
                                            <td>
                                                {{ $delivery->departure_city }}
                                            </td>
                                            <td>
                                                {{ $delivery->arrival_city }}
                                            </td>
                                            <td> $ {{ number_format($delivery->amount) }} </td>
                                            <td> {{ $delivery->status }} </td>
                                        </tr>
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
