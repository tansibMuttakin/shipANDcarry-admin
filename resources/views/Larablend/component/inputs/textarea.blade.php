<div class="form-group">
    <label for="{{$data->name}}">{{$data->label}} @if($data->required) <span class="text-danger">(*)</span>@endif</label>
    <textarea {{$data->required ? 'required' : ''}} class="form-control" id="{{$data->name}}" name="{{$data->name}}" placeholder="{{$data->placeholder}}"> @if(isset($data->value)) {{$data->value}} @endif</textarea>
</div>
