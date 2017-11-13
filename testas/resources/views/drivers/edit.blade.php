@extends('layouts.app')

@section('content')

<h1>Naujas vairuotojo įrašas</h1>
<form action="{{ url('/drivers', $driver->id)}}" method="post" > 
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div>
        <label for="name">Vardas:</label>
        <input id="name" name="name" value="{{ $driver->name }}" require>
    </div>   
    <div>
        <label for="surname">Pavarde:</label>
        <input id="surname" name="surname" value="{{ $driver->surname }}" require>
    </div>
    <div>
        <label for="city">Miestas:</label>
        <input id="city" name="city" value="{{ $driver->city }}" require>
    </div>
    <button>{{ __('buttons.save') }}</button>
    <a href="{{ url('/drivers')}}">Atgal</a>
</form>
    
@endsection