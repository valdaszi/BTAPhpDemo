@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>New Radar</h1>

        <form method="post" action="{{ url("radars") }}">
            {{ csrf_field() }}
            <input name="date" placeholder="date" value="{{ old('date') }}">
            <input name="number" placeholder="number" value="{{ old('number') }}">
            <input name="distance" placeholder="distance" value="{{ old('distance') }}">
            <input name="time" placeholder="time" value="{{ old('time') }}">
            <button type="submit">Save</button>
        </form>

        @if (count($errors))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
    </div>
@endsection