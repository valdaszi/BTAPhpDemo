@extends('layouts.app')

@section('content')

        <h1>{{ __('Radar record Nr') }} {{ $radar->id }} </h1>
        
        <div>Data: {{ $radar->date }}</div>
        <div>Numeris: {{ $radar->number }}</div>
        <div>Atstumas: {{ $radar->distance }}</div>
        <div>Laikas: {{ $radar->time }}</div>
        <div>Greitis: {{ Round($radar->distance / $radar->time * 3.6) }}</div>

        <div>Vairuotojo vardas: {{ $radar->driver ? $radar->driver->name : '' }}</div>
        <div>Vairuotojo pavardė: {{ $radar->driver ? $radar->driver->surname : '' }}</div>

        <div>Kas taisė: {{ $radar->updater->name }}</div>
        <div>Kada: {{ $radar->updated_at }}</div>

        <div>Kas sukūrė: {{ $radar->creator->name }}</div>
        <div>Kada: {{ $radar->created_at }}</div>

@endsection