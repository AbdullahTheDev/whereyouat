@extends('users.layouts.app')

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
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Transaction Date </th>
                                        <th> Departure City </th>
                                        <th> Arrival City </th>
                                        <th> Amount </th>
                                        <th> Status </th>
                                        <th> Rider Status </th>
                                        <th> Rider Info </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deliveries as $key => $delivery)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $delivery->transaction_date }} </td>
                                            <td>
                                                <p style="white-space: normal;">
                                                    {{ $delivery->departure_city }}
                                                </p>
                                            </td>
                                            <td>
                                                <p style="white-space: normal;">
                                                    {{ $delivery->arrival_city }}
                                                </p>
                                            </td>
                                            <td> $ {{ number_format($delivery->total_price, 2) }} </td>
                                            <td>
                                                @if ($delivery->status == 1) 
                                                <label class="badge badge-gradient-info">ON THE WAY</label>
                                                @elseif ($delivery->status == 2) 
                                                <label class="badge badge-gradient-success">DONE</label>
                                                @else
                                                <label class="badge badge-gradient-danger">REJECTED</label>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($delivery->accepted == 1) 
                                                <label class="badge badge-gradient-info">ACCEPTED</label>
                                                @elseif ($delivery->status == 2) 
                                                <label class="badge badge-gradient-success">DELIVERED</label>
                                                @else
                                                <label class="badge badge-gradient-secondary">OPEN</label>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($delivery->accepted == 1 || $delivery->status == 2) 
                                                @if($delivery->relay_id != null)
                                                    <a class="btn btn-sm btn-primary" href="{{ route('user.delivery.distance.partner', $delivery->id) }}">View</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary" href="{{ route('user.delivery.distance.driver', $delivery->id) }}">View</a>
                                                @endif
                                                @else
                                                - -
                                                @endif
                                            </td>
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
@section('script')
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection