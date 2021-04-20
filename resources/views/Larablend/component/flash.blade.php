@if(Session::has('errors') && count(Session::get('errors'))>0)
    @foreach(Session::get('errors') as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    {{Session::forget('errors')}}
@endif

