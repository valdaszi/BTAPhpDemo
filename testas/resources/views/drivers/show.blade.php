@extends('layout')

@section('content')
        <h1>Driver</h1>

        <div>id: {{$driver->id}}</div>
        <div>Name: {{$driver->name}}</div>
        <div>City: {{$driver->city}}</div>
        
        <br>

        <a href="{{ url('drivers') }}">Sąrašas</a>
@endsection