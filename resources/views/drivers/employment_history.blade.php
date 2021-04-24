@extends('larablend::layouts.app')
@section('content')
<div class="row">
    <div class="card" style="width:100%">
        <h4 class="card-category text-left p-4">Driver Employment History</h4>
        <div class="card-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="pl-0">Driver Name</th>
                        <th class="pl-0">Carrier Name</th>
                        <th class="pl-0">Start Date</th>
                        <th class="pl-0">End Date</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="pl-0"></td>
                            <td class="pl-0"></td>
                            <td class="pl-0"></td>
                            <td class="pl-0"></td>
                        </tr>
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