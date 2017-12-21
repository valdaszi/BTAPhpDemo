@extends('layout')

@section('content')
        <h1>Drivers</h1>
        <table>
            <tr>
                <th>Vardas</th><th>Miestas</th>
            </tr>

        @foreach($drivers as $driver)
            <tr>
                <td><a href="{{ url('drivers', $driver->id) }}">{{$driver->name}}</a></td>
                <td>{{$driver->city}}</td>
            </tr>
        @endforeach
        
        </table>
            
        <br>
        
        <a href={{ url('drivers/create') }}>Naujas</a>

@endsection
