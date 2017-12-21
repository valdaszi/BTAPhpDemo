@extends('layout')

@section('content')
        <h1>Radars</h1>
        <table>
            <tr>
                <th>Date</th>
                <th>Number</th>
                <th>Speed</th>
                <th></th>
            </tr>

        @foreach($radars as $radar)
            <tr>
                <td><a href="{{ url('radars', $radar->id) }}">{{$radar->date}}</a></td>
                <td><a href="{{ url('radars', $radar->id) }}">{{$radar->number}}</a></td>
                <td>{{round($radar->distance / $radar->time * 3.6)}}</td>
                <td>
                    <a href="{{ url('radars', [$radar->id, 'edit']) }}">Edit</a>
                    <a href="{{ url('radars', [$radar->id, 'delete']) }}">Delete</a>
                </td>
            </tr>
        @endforeach
        
        </table>
        {{ $radars->links() }}

        <br>

        <a href={{ url('radars/create') }}>Naujas</a>   
@endsection