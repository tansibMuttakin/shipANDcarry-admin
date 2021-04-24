@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Shippers History</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Shipper Name</th>
                        <th class="pl-0">Type</th>
                        <th class="pl-0">Trip NO</th>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Driver Name</th>
                        <th class="pl-0">Pickup Address</th>
                        <th class="pl-0">Dropoff Address</th>
                        <th class="pl-0">Dropoff Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td class="pl-0">{{$booking->shipper->name}}</td>
                            <td class="pl-0">{{$booking->shipper->type}}</td>
                            <td class="pl-0">{{$booking->trip_no}}</td>
                            <td class="pl-0">{{$booking->carrier->name}}</td>
                            <td class="pl-0">{{$booking->driver->name}}</td>
                            <td class="pl-0">{{$booking->pickup_address->address_line_1}}</td>
                            <td class="pl-0">{{$booking->dropoff_address->address_line_1}}</td>
                            <td class="pl-0">{{$booking->dropoff_datetime}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('custom-inline-script')
$(document).ready(function() {
    $('#example').DataTable({
        "lengthMenu": [ 10, 15, 20],
        "sort": false,
    });
    
} );
@endsection