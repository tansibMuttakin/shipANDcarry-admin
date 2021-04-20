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
    <div class="d-flex justify-content-end justify-content-lg-start">
        <a class="btn btn-outline-success" href="/{{$model}}/create">Add New</a>
    </div>
    @if(count($data)>0)
        <table class="table table-striped table-bordered" id="index-table">
            <thead class="thead-light">
                <tr>
                    @foreach($props as $prop)
                        <th scope="col" class="text-capitalize">{{Str::contains($prop, '_id') ? str_replace('_', ' ', substr($prop, 0, strlen($prop)-3)) : str_replace('_', ' ', $prop)}}</th>
                    @endforeach
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $entry)
                    <tr>
                        @foreach($props as $prop)
                            @if(Str::contains($prop, '_id'))
                                <?php $prop = substr($prop, 0, strlen($prop)-3) ?>
                                <td>{{$entry->$prop->title ? $entry->$prop->title : $entry->$prop->name}}</td>
                            @elseif(Str::contains($prop, '_file'))
                                <td><img src="{{Storage::url($entry->$prop)}}" class="img-fluid" alt="{{$prop}}" style="max-height: 100px"></td>
                            @else
                                <td>{{$entry->$prop}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="/{{$model}}/show/{{$entry->id}}" class="mx-2"><i class="fas fa-eye"></i></a>
                            <a href="/{{$model}}/edit/{{$entry->id}}" class="mx-2"><i class="fas fa-edit"></i></a>
                            <a href="/{{$model}}/delete/{{$entry->id}}" class="mx-2"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <alert class="alert alert-info d-block text-capitalize">No {{str_replace('_', ' ', Str::plural(($model)))}} found!</alert>
    @endif
@endsection
