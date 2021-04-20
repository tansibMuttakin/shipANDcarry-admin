@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Driver History</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Driver Name</th>
                        <th class="pl-0">Driving License No</th>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Trip NO</th>
                        <th class="pl-0">Trip Type</th>
                        <th class="pl-0">Vehicle Brand</th>
                        <th class="pl-0">Vehicle Model</th>
                        <th class="pl-0">Pickup Address</th>
                        <th class="pl-0">Dropoff Address</th>
                        <th class="pl-0">Dropoff Time</th>
                    </tr>
                </thead>
                <tbody>
                    
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