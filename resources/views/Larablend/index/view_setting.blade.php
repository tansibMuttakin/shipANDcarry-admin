@extends('Larablend.layouts.default')
@php
    $model_name = str_replace('_', ' ', $model);
    $model_name = ucwords($model_name, ' ');
    $model_name = Str::plural($model_name);
@endphp
@section('page_title', 'All '.$model_name)
@section('content')
    <!-- Space for Errors -->
    @include('Larablend.component.flash')
    @if(count($data)>0)
        <table class="table table-striped table-bordered" id="index-table">
            <a class="btn btn-outline-success" href="/{{$model}}/create">Add New</a>
            <thead class="thead-dark">
            <tr>
                @foreach($props as $prop)
                    <th scope="col" class="text-capitalize">{{Str::contains($prop, '_id') ? str_replace('_', ' ', substr($prop, 0, strlen($prop)-3)) : $prop}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $entry)
                @if($entry->table_name == 'view_settings')
                    @continue
                @else
                    <tr>
                        @foreach($props as $prop)
                            @if(Str::contains($prop, 'show'))
                                <td>@if($entry->$prop == 1)<i class="fas fa-check"></i>@else<i class="fas fa-times"></i>@endif</td>
                            @else
                                <td>{{$entry->$prop}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="/{{$model}}/show/{{$entry->id}}" class="mx-2"><i class="fas fa-eye"></i></a>
                            <a href="/{{$model}}/update/{{$entry->id}}" class="mx-2"><i class="fas fa-eye-slash"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <alert class="alert alert-info d-block text-capitalize">No {{str_replace('_', ' ', Str::plural(($model)))}} found!</alert>
    @endif
@endsection
