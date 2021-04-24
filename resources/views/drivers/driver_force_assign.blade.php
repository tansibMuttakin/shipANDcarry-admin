@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Driver Force Assign</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Trip NO</th>
                        <th class="pl-0">Vehicle Brand</th>
                        <th class="pl-0">Vehicle Model</th>
                        <th class="pl-0">Driver Name</th>
                        <th class="pl-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trips as $trip)
                        <tr>
                            <td class="pl-0">{{$trip->carrier->name}}</td>
                            <td class="pl-0">{{$trip->trip_no}}</td>
                            <td class="pl-0">{{$trip->vehicle->vehicle_brand->name}}</td>
                            <td class="pl-0">{{$trip->vehicle->vehicle_model->name}}</td>
                            <td class="pl-0">
                                <select name="driver_id" >
                                    <option value="" selected>select driver</option>
                                    @foreach ($drivers as $driver)
                                        @if ($trip->driver_id == $driver->id)
                                            <option value="{{$driver->id}}" selected>{{$driver->name}}</option>
                                        @else
                                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td class="pl-0">
                                <button type="button" onclick="send_request({{$trip->id}})" class="action">Assign</button>
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
    $('#example').DataTable({
        "lengthMenu": [ 10, 15, 20],
        "sort": false,
    });
    
} );
function send_request(id){
    axios({
        method: 'post',
        url: '/dashboard/driver/force_assign_trip_driver/'+id,
        data:{

        }
    });
}
@endsection