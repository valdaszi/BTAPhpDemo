@extends('layouts.app')

@section('content')

<h1>Taisyti radaro įrašą</h1>
<form action="{{ url('/radars', $radar->id) }}" method="post" > 
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div>
        <label for="date">Data:</label>
        <input id="date" name="date" value="{{ old('date', $radar->date) }}" require>
    </div>
    <div>
        <label for="number">Numeris:</label>
        <input id="number" name="number" value="{{ old('number', $radar->number) }}" require>
    </div>
    <div>
        <label for="distance">Nuvažiuotas atstumas (m):</label>
        <input type="number" id="distance" name="distance" value="{{ old('distance', $radar->distance) }}" require>
    </div>
    <div>
        <label for="time">Laikas (s):</label>
        <input type="number" id="time" name="time" value="{{ old('time', $radar->time) }}" require>
    </div>
    
    <button>{{ __('buttons.save') }}</button>
    <a href="{{ url('/radars')}}">Atgal</a>
</form>

@if (count($errors))
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach
@endif

@endsection