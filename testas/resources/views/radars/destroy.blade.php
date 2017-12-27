@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Delete Radar</h1>

        <form method="post" action="{{ url('radars', $radar->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            
            <div>id: {{$radar->id}}</div>
            <div>Date: {{$radar->date}}</div>
            <div>Number: {{$radar->number}}</div>
            <div>Distance: {{$radar->distance}}</div>
            <div>Time: {{$radar->time}}</div>
            <div>Speed: {{$radar->distance / $radar->time * 3.6}}</div>

            <button type="submit">Delete</button>
        </form>

        <button onclick="window.history.back();">Go Back</button>
    </div>
@endsection