@extends('layout')

@section('content')
        <h1>Edit Radar</h1>

        <form method="post" action="{{ url('radars', $radar->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input name="date" placeholder="date" value="{{$radar->date}}">
            <input name="number" placeholder="number" value="{{$radar->number}}">
            <input name="distance" placeholder="distance" value="{{$radar->distance}}">
            <input name="time" placeholder="time" value="{{$radar->time}}">
            <button type="submit">Update</button>
        </form>

        <button onclick="window.history.back();">Go Back</button>

@endsection