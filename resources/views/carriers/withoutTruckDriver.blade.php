@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Carrier With No Truck</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Type</th>
                        <th class="pl-0">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carriers_without_truck as $carrier)
                        <tr>
                            <td class="pl-0">{{$carrier->name}}</td>
                            <td class="pl-0">{{$carrier->type}}</td>
                            <td class="pl-0">{{$carrier->phone}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Carrier With No Driver</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Type</th>
                        <th class="pl-0">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carriers_without_driver as $carrier)
                        <tr>
                            <td class="pl-0">{{$carrier->name}}</td>
                            <td class="pl-0">{{$carrier->type}}</td>
                            <td class="pl-0">{{$carrier->phone}}</td>
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
    $('.table').DataTable({
        "lengthMenu": [ 10, 15, 20],
        "sort": false,
    });
    
} );
@endsection