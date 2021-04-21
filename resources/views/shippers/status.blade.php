@extends('larablend::layouts.app')
@section('content')
@include('larablend::components.flash')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Shippers Status</h4>
        <div class="card-body">
            <table id="shippers" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Name</th>
                        <th class="pl-0">Email</th>
                        <th class="pl-0">Type</th>
                        <th class="pl-0">Status</th>
                        <th class="pl-0 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippers as $shipper)
                        <tr>
                            <td class="pl-0">{{$shipper->name?$shipper->name:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->profile->email?$shipper->profile->email:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->type?$shipper->type:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->profile->active?'approved':'disapproved'}}</td>
                            <td class="pl-0 text-center">
                                <a href="/dashboard/shipper/statusApprove/{{$shipper->profile_id}}" class="action">approve</i></a>
                                <a href="/dashboard/shipper/statusDisapprove/{{$shipper->profile_id}}" class="action" >disapprove</i></a>
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
    $('#shippers').DataTable({
        "lengthMenu": [ 10, 15, 20],
        "sort": false,
    });
    
} );
@endsection