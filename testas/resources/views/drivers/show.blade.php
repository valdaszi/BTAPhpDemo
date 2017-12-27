@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Driver</h1>

        <div>id: {{$driver->id}}</div>
        <div>Name: {{$driver->name}}</div>
        <div>City: {{$driver->city}}</div>
        
        <br>

        <a href="{{ url('drivers') }}">Sąrašas</a>
    </div>
@endsection