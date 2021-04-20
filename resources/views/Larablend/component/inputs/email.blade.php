<div class="form-group">
    <label for="{{$data->name}}">{{$data->label}} @if($data->required) <span class="text-danger">(*)</span>@endif</label>
    <input {{$data->required ? 'required' : ''}} type="email" class="form-control" id="{{$data->name}}" name="{{$data->name}}" placeholder="{{$data->placeholder}}" @if(isset($data->value)) value="{{$data->value}}" @endif>
</div>
