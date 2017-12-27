@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>New Driver</h1>

        <form method="post" action="{{ url("drivers") }}">
            {{ csrf_field() }}
            <input name="name" placeholder="name">
            <input name="city" placeholder="city">
            <button type="submit">Save</button>
        </form>
    </div>
@endsection