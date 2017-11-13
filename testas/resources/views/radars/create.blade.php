@extends('layouts.app')

@section('content')

        <h1>{{ __('New Radar record') }}</h1>
        <form action="{{ url('/radars') }}" method="post">
            {{ csrf_field() }}
            <div>
                <label>Data:</label> <input name="date" value="{{ old('date')}}">
            </div>
            <div class="{{ $errors->get('number') ? 'error' : '' }}">
                <label>Numeris:</label><input name="number" value="{{ old('number')}}">
            </div>
            @if (count($errors) && $errors->get('number'))
                @foreach($errors->get('number') as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
            <div>
                <label>Atstumas:</label><input type="number" name="distance" value="{{ old('distance')}}">
            </div>
            <div>
                <label>Laikas:</label><input type="number" name="time" value="{{ old('time')}}">
            </div>
            @if (count($errors) && $errors->get('speed'))
                @foreach($errors->get('speed') as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
            <div>
                <button>{{ __('buttons.save') }}</button>
            </div>
        </form>

        <!-- @if (count($errors))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif -->

@endsection