<div class="form-group">
    <label for="{{$data->name}}">{{$data->label}} @if($data->required) <span class="text-danger">(*)</span>@endif </label>
    <input {{$data->required ? 'required' : ''}} type="text" class="form-control datetimepicker" id="{{$data->name}}" name="{{$data->name}}" @if(isset($data->value)) value="{{$data->value}}" @endif>
</div>
