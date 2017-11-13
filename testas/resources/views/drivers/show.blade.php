@extends('layouts.app')

@section('content')

    <h1>Duomenys apie vairuotoją įrašą Nr {{ $driver->id }} </h1>
    
    <div>Vardas: {{ $driver->name }}</div>
    <div>Pavardė: {{ $driver->surname }}</div>
    <div>Miestas: {{ $driver->city }}</div>

@endsection