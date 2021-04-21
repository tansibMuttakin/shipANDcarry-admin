@extends('larablend::layouts.app')
@section('content')
@include('larablend::components.flash')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Carrier Request Status</h4>
        <div class="card-body">
            <table id="carrierRequest" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Crrier Type</th>
                        <th class="pl-0">Carrier Request Status</th>
                        <th class="pl-0 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrierRequests as $carrierRequest)
                        <tr>
                            <td class="pl-0">{{$carrierRequest->carrier->name?$carrierRequest->carrier->name:'N/A'}}</td>
                            <td class="pl-0">{{$carrierRequest->carrier->type?$carrierRequest->carrier->type:'N/A'}}</td>
                            <td class="pl-0">{{$carrierRequest->title?$carrierRequest->title:'N/A'}}</td>
                            <td class="pl-0 text-center">
                                <a href="/dashboard/carrier-request/editStatus/{{$carrierRequest->carrier_id}}" class="action">edit</i></a>
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
    $('#carrierRequest').DataTable({
        "lengthMenu": [ 10, 15, 20],
        "sort": false,
    });
    
} );
@endsection