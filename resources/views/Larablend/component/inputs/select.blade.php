<div class="form-group">
    <label for="{{$data->name}}">{{$data->label}} @if($data->required) <span class="text-danger">(*)</span>@endif</label>
    <select {{$data->required ? 'required' : ''}} name="{{$data->name}}" id="{{$data->name}}" class="custom-select form-control">
        @foreach($data->options as $option)

            <option value="{{$option->id}}" {{ (isset($data->value) && $data->value == $option->id) ? 'selected': '' }}>{{$option->title ? $option->title : ($option->name ? $option->name : $option->id)}}</option>

        @endforeach
    </select>
</div>
