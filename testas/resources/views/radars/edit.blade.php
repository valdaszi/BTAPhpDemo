@extends('layout')

@section('content')
        <h1>Edit Radar</h1>

        <form method="post" action="{{ url('radars', $radar->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input name="date" placeholder="date" value="{{ old('date', $radar->date) }}">
            <input name="number" placeholder="number" value="{{ old('number', $radar->number) }}">
            <input name="distance" placeholder="distance" value="{{ old('distance', $radar->distance) }}">
            <input name="time" placeholder="time" value="{{ old('time', $radar->time) }}">
            <button type="submit">Update</button>
        </form>

        @if (count($errors))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <button onclick="window.history.back();">Go Back</button>

@endsection