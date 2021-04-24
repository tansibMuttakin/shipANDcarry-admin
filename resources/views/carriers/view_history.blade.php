@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">History Details</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Trip NO</th>
                        <th class="pl-0">Driver Name</th>
                        <th class="pl-0">Vehicle Brand</th>
                        <th class="pl-0">Vehicle Model</th>
                        <th class="pl-0">Pickup Address</th>
                        <th class="pl-0">Dropoff Address</th>
                        <th class="pl-0">Dropoff Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carriers as $carrier)
                        <tr>
                            <td class="pl-0">{{$carrier->trip_no}}</td>
                            <td class="pl-0">{{$carrier->driver->name}}</td>
                            <td class="pl-0">{{$carrier->vehicle->vehicle_brand->name}}</td>
                            <td class="pl-0">{{$carrier->vehicle->vehicle_model->name}}</td>
                            <td class="pl-0">{{$carrier->pickup_address->address_line_1}}</td>
                            <td class="pl-0">{{$carrier->dropoff_address->address_line_1}}</td>
                            <td class="pl-0">{{$carrier->dropoff_datetime}}</td>
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