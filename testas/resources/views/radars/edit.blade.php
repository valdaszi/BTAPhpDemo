@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Edit Radar') }}</h1>

        <form method="post" action="{{ url('radars', $radar->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input name="date" placeholder="{{ __('Date') }}" value="{{ old('date', $radar->date) }}">
            <input name="number" placeholder="{{ __('Number') }}" value="{{ old('number', $radar->number) }}">
            <input name="distance" placeholder="{{ __('Distance') }}" value="{{ old('distance', $radar->distance) }}">
            <input name="time" placeholder="{{ __('Time') }}" value="{{ old('time', $radar->time) }}">
            <button type="submit">{{ __('Update') }}</button>
        </form>

        @if (count($errors))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <button onclick="window.history.back();">{{ __('Go Back') }}</button>
    </div>
@endsection