@extends('Larablend.layouts.default')
@section('page_title', 'Create '.Str::ucfirst($model))
@section('content')
    <!-- Space for Errors -->
    @include('Larablend.component.form', ['data' => $data])
@endsection
