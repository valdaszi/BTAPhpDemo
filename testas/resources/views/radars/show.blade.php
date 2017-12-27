@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Radar</h1>

        <div>id: {{$radar->id}}</div>
        <div>Date: {{$radar->date}}</div>
        <div>Number: {{$radar->number}}</div>
        <div>Distance: {{$radar->distance}}</div>
        <div>Time: {{$radar->time}}</div>
        <div>Speed: {{$radar->distance / $radar->time * 3.6}}</div>

        <br>

        <a href="{{ url("radars/$radar->id/edit") }}">Edit</a>
        <a href="{{ url('radars') }}">Sąrašas</a>
    </div>
@endsection
