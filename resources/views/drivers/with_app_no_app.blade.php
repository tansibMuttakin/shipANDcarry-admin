@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Drivers With App</h4>
        <div class="card-body">
            <table class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Name</th>
                        <th class="pl-0">Email</th>
                        <th class="pl-0">Photo</th>
                        <th class="pl-0">NID</th>
                        <th class="pl-0">Driving License</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers_with_app as $driver)
                        <tr>
                            <td class="pl-0">{{$driver->name?$driver->name:'n/a'}}</td>
                            <td class="pl-0">{{$driver->profile->email?$driver->profile->email:'n/a'}}</td>
                            <td class="pl-0">{{$driver->userProfile_photo?$driver->userProfile_photo:'n/a'}}</td>
                            <td class="pl-0">{{$driver->nid_no?$driver->nid_no:'n/a'}}</td>
                            <td class="pl-0">{{$driver->driving_license_no?$driver->driving_license_no:'n/a'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Drivers With No App</h4>
        <div class="card-body">
            <table class="table" style="width:100%">
                <thead>
                    <tr>
                        <tr>
                            <th class="pl-0">Name</th>
                            <th class="pl-0">Email</th>
                            <th class="pl-0">Photo</th>
                            <th class="pl-0">NID</th>
                            <th class="pl-0">Driving License</th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers_with_Noapp as $driver)
                        
                        <tr>
                            <tr>
                                <td class="pl-0">{{$driver->name?$driver->name:'n/a'}}</td>
                                <td class="pl-0">{{$driver->profile->email?$driver->profile->email:'n/a'}}</td>
                                <td class="pl-0">{{$driver->userProfile_photo?$driver->userProfile_photo:'n/a'}}</td>
                                <td class="pl-0">{{$driver->nid_no?$driver->nid_no:'n/a'}}</td>
                                <td class="pl-0">{{$driver->driving_license_no?$driver->driving_license_no:'n/a'}}</td>
                            </tr>
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