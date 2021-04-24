@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Carrier History</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">vehicle Brand</th>
                        <th class="pl-0">Booking Requests</th>
                        <th class="pl-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carriers as $carrier)
                        <tr>
                            <td class="pl-0">{{$carrier->name}}</td>
                            <td class="pl-0">{{$carrier->booking_requests_count}}</td>
                            <td class="pl-0">
                                <a href="/dashboard/carrier/viewHistory/{{$carrier->id}}" class="action">view details</i></a>
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
@endsection