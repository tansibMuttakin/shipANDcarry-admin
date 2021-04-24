@extends('larablend::layouts.app')
@section('content')
<div class="row" style="column-gap:2em;">
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-spaceship text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Shipper</p>
                    <p class="card-title">{{count($shippers_data->shippers)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-circle-10 text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Active Shipper</p>
                    <p class="card-title">{{count($shippers_data->shippers_active)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-circle-10 text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Inactive Shipper </p>
                    <p class="card-title">{{count($shippers_data->shippers_inactive)}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-spaceship text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Individual Shipper</p>
                    <p class="card-title">{{count($shippers_data->shippers_individual)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-spaceship text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Company Shipper</p>
                    <p class="card-title">{{count($shippers_data->shippers_company)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-user-run text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Carrier</p>
                    <p class="card-title">{{count($carriers_data->carriers)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-user-run text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Individual Carrier</p>
                    <p class="card-title">{{count($carriers_data->carriers_individual)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-user-run text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Company Carrier</p>
                    <p class="card-title">{{count($carriers_data->carriers_company)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width:16rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-bus-front-12 text-warning"></i>
                </div>
                <div>
                    <p class="card-category">Total Registered Drivers</p>
                    <p class="card-title">{{count($drivers)}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4 font-weight-bold">Registered Shippers</h4>
        <div class="card-body">
            <table cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Sort BY:</td>
                        <td>
                            <select name="range" id="">
                                <option value="" selected>Choose...</option>
                                <option value="last_day">Last Day</option>
                                <option value="last_week">Last Week</option>
                                <option value="last_month">Last Month</option>
                                <option value="last_year">Last year</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="shippers" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Name</th>
                        <th class="pl-0">Email</th>
                        <th class="pl-0">Gender</th>
                        <th class="pl-0">NID</th>
                        <th class="pl-0">Address</th>
                        <th class="pl-0">Type</th>
                        <th class="pl-0">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippers_data->shippers as $shipper)
                        <tr>
                            <td class="pl-0">{{$shipper->name?$shipper->name:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->profile->email?$shipper->profile->email:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->profile->gender?$shipper->profile->gender:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->nid_no?$shipper->nid_no:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->address->address_line_1?$shipper->address->address_line_1:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->user->type?$shipper->user->type:'N/A'}}</td>
                            <td class="pl-0">{{$shipper->created_at?$shipper->created_at:'N/A'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4 font-weight-bold">Registered Carriers</h4>
        <div class="card-body">
            <table id="carriers" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Name</th>
                        <th class="pl-0">Email</th>
                        <th class="pl-0">Photo</th>
                        <th class="pl-0">NID</th>
                        <th class="pl-0">Address</th>
                        <th class="pl-0">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carriers_data->carriers as $carrier)
                        <tr>
                            <td class="pl-0">{{$carrier->name?$carrier->name:'n/a'}}</td>
                            <td class="pl-0">{{$carrier->profile->email?$carrier->profile->email:'n/a'}}</td>
                            <td class="pl-0">{{$carrier->userProfile_photo?$carrier->userProfile_photo:'n/a'}}</td>
                            <td class="pl-0">{{$carrier->nid_no?$carrier->nid_no:'n/a'}}</td>
                            <td class="pl-0">{{$carrier->address->address_line_1?$carrier->address->address_line_1:'n/a'}}</td>
                            <td class="pl-0">{{$carrier->created_at?$carrier->created_at:'n/a'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4 font-weight-bold">Registered Drivers</h4>
        <div class="card-body">
            <table id="drivers" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Name</th>
                        <th class="pl-0">Email</th>
                        <th class="pl-0">Photo</th>
                        <th class="pl-0">NID</th>
                        <th class="pl-0">Address</th>
                        <th class="pl-0">Driving License</th>
                        <th class="pl-0">Registered By</th>
                        <th class="pl-0">Status</th>
                        <th class="pl-0">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers as $driver)
                        <tr>
                            <td class="pl-0">{{$driver->name?$driver->name:'n/a'}}</td>
                            <td class="pl-0">{{$driver->profile->email?$driver->profile->email:'n/a'}}</td>
                            <td class="pl-0">{{$driver->userProfile_photo?$driver->userProfile_photo:'n/a'}}</td>
                            <td class="pl-0">{{$driver->nid_no?$driver->nid_no:'n/a'}}</td>
                            <td class="pl-0">{{$driver->address->address_line_1?$driver->address->address_line_1:'n/a'}}</td>
                            <td class="pl-0">{{$driver->driving_license_no?$driver->driving_license_no:'n/a'}}</td>
                            <td class="pl-0">{{$driver->registered_by_carrier?'carrier':'self-registered'}}</td>
                            <td class="pl-0">{{$driver->profile->active?'active':'inactive'}}</td>
                            <td class="pl-0">{{$driver->created_at?$driver->created_at:'n/a'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4 font-weight-bold">Registered Vehicles</h4>
        <div class="card-body">
            <table id="vehicles" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Owner Name</th>
                        <th class="pl-0">Model</th>
                        <th class="pl-0">Brand</th>
                        <th class="pl-0">Type</th>
                        <th class="pl-0">Reg NO</th>
                        <th class="pl-0">BRTA NO</th>
                        <th class="pl-0">Fitness NO</th>
                        <th class="pl-0">Location</th>
                        <th class="pl-0">On Trip</th>
                        <th class="pl-0">Reg Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td class="pl-0">{{$vehicle->owner_name?$vehicle->owner_name:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->vehicle_model->name?$vehicle->vehicle_model->name:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->vehicle_brand->name?$vehicle->vehicle_brand->name:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->vehicle_type->name?$vehicle->vehicle_type->name:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->registration_no?$vehicle->registration_no:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->brta_certificate_no?$vehicle->brta_certificate_no:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->fitness_certificate_no?$vehicle->fitness_certificate_no:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->address->address_line_1?$vehicle->address->city:'n/a'}}</td>
                            <td class="pl-0">{{$vehicle->onTrip?'yes':'no'}}</td>
                            <td class="pl-0">{{$vehicle->created_at?$vehicle->created_at:'n/a'}}</td>
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
        "lengthMenu": [ 5, 10, 15, 20],
        "sort":false,
    });
    
    
} );
@endsection