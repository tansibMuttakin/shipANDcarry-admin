@extends('Larablend.layouts.default')
@section('content')
    <?php
        $objectVars = get_object_vars($toShow);
        var_dump($objectVars);
        die();
        ?>
@endsection
