@extends('larablend::layouts.app')
@section('content')
    {{-- <div class="row p-3 card shadow">
        @include('larablend::components.form', ['data' => $carrierRequests])
    </div> --}}
    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group">
                  <label for="carrier_name">Carrier Name</label>
                  <input type="text" class="form-control" id="carrier_name" aria-describedby="emailHelp" value="{{$carrierRequest->carrier->name}}">
                </div>
                <div class="form-group">
                  <label for="carrier_type">Carrier Type</label>
                  <input type="text" class="form-control" id="carrier_type" value="{{$carrierRequest->carrier->type}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Carrier Status</label>
                  <select class="js-example-basic-single" style="width: 20%" name="status_id">
                    @foreach ($statuses as $status)
                        @if ($status->id==$carrierRequest->timeline->status_id)
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