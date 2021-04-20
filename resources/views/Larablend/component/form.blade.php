<form action="{{$data->action}}" method="POST" {{ isset($data->enctype) ? "enctype=".$data->enctype : '' }}>
    @include('Larablend.component.flash')
    @csrf
    @foreach($data->fields as $data)
        @include('Larablend.component.inputs.'.$data->type, ['data' => $data])
    @endforeach
    @yield('custom_fields')
    <button class="btn btn-success border border-success" type="submit">Save</button>
    <a class="btn border border-warning text-warning bg-light" href="{{ url()->previous() }}">Cancel</a>
</form>
