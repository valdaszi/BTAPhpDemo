@extends('layout')

@section('content')
        <h1>New Radar</h1>

        <form method="post" action="{{ url("radars") }}">
            {{ csrf_field() }}
            <input name="date" placeholder="date">
            <input name="number" placeholder="number">
            <input name="distance" placeholder="distance">
            <input name="time" placeholder="time">
            <button type="submit">Save</button>
        </form>

@endsection