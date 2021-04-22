@extends('larablend::layouts.app')
@section('content')
@include('larablend::components.flash')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Booking Request Status</h4>
        <div class="card-body">
            <table id="bookingRequest" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Shipper Name</th>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Driver Name</th>
                        <th class="pl-0">Booking Request Status</th>
                        <th class="pl-0 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookingRequests as $bookingRequest)
                        <tr>
                            <td class="pl-0">{{$bookingRequest->shipper->name?$bookingRequest->shipper->name:'N/A'}}</td>
                            <td class="pl-0">{{$bookingRequest->carrier->name?$bookingRequest->carrier->name:'N/A'}}</td>
                            <td class="pl-0">{{$bookingRequest->driver->name?$bookingRequest->driver->name:'N/A'}}</td>
                            <td class="pl-0">{{$bookingRequest->request_status->title?$bookingRequest->request_status->title:'N/A'}}</td>
                            <td class="pl-0 text-center">
                                <a href="/dashboard/booking_request/editStatus/{{$bookingRequest->id}}" class="action">edit</i></a>
                            </td>
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
    $('#bookingRequest').DataTable({
        "lengthMenu": [ 10, 15, 20],
        "sort": false,
    });
    
} );
@endsection