@extends('larablend::layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/dashboard/booking_request/updateStatus/{{$bookingRequest->id}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="shipper_name">Shipper Name</label>
                  <input type="text" class="form-control" id="shipper_name" aria-describedby="emailHelp" value="{{$bookingRequest->shipper->name}}">
                </div>
                <div class="form-group">
                  <label for="carrier_name">Carrier Name</label>
                  <input type="text" class="form-control" id="carrier_name" aria-describedby="emailHelp" value="{{$bookingRequest->carrier->name}}">
                </div>
                <div class="form-group">
                  <label for="driver_name">Driver Name</label>
                  <input type="text" class="form-control" id="driver_name" aria-describedby="emailHelp" value="{{$bookingRequest->driver->name}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Booking Request Status</label>
                  <select class="js-example-basic-single" style="width: 20%" name="status_id">
                    @foreach ($statuses as $status)
                        @if ($status->id==$bookingRequest->request_status_id_status)
                            <option value="{{$status->id}}" selected>{{$status->title}}</option>
                        @else
                            <option value="{{$status->id}}">{{$status->title}}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    
@endsection
@section('custom-inline-script')
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
@endsection