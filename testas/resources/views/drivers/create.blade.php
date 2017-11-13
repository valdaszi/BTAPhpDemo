@extends('layouts.app')

@section('content')

<h1>Naujas vairuotojas</h1>
<form action="{{ url('/drivers')}}" method="post" > 
    {{ csrf_field() }}
    <div>
        <label for="name">Vardas:</label>
        <input id="name" name="name" require>
    </div>   
    <div>
        <label for="surname">Pavarde:</label>
        <input id="surname" name="surname" require>
    </div>
    <div>
        <label for="city">Miestas:</label>
        <input id="city" name="city" require>
    </div>
    <button>{{ __('buttons.save') }}</button>
    <a href="{{ url('/drivers')}}">Atgal</a>
</form>
    
@endsection