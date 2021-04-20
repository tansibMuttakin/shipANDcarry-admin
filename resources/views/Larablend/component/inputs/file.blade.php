<div class="form-group">
    <label class="text-capitalize">{{substr($data->name, 0, strlen($data->name) - 5)}} @if($data->required) <span class="text-danger">(*)</span>@endif</label>
    <div class="custom-file">
        <input {{$data->required ? 'required' : ''}} type="file" class="custom-file-input" id="{{$data->name}}" name="{{$data->name}}">
        <label class="custom-file-label" for="{{$data->name}}">Choose file</label>
    </div>
</div>
