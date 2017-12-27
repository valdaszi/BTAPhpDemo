@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Radars') }}</h1>
        <table class="table">
            <tr>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Number') }}</th>
                <th>{{ __('Speed') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Creator') }}</th>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Updator') }}</th>
                <th>{{ __('Updated at') }}</th>
                <th></th>
            </tr>

        @foreach($radars as $radar)
            <tr>
                <td><a href="{{ url('radars', $radar->id) }}">{{$radar->date}}</a></td>
                <td><a href="{{ url('radars', $radar->id) }}">{{$radar->number}}</a></td>
                <td>{{round($radar->distance / $radar->time * 3.6)}}</td>
                <td>{{ $radar->driver ? $radar->driver->name : '' }}</td>
                <td>{{ $radar->creator->name }}</td>
                <td>{{ $radar->created_at }}</td>
                <td>{{ $radar->updator->name }}</td>
                <td>{{ $radar->updated_at }}</td>
                <td>
                    <a href="{{ url('radars', [$radar->id, 'edit']) }}">{{ __('buttons.edit') }}</a>
                    <a href="{{ url('radars', [$radar->id, 'delete']) }}">{{ __('buttons.delete') }}</a>
                </td>
            </tr>
        @endforeach
        
        </table>
        {{ $radars->links() }}

        <br>

        <a class="btn btn-primary" href={{ url('radars/create') }}>{{ __('buttons.new') }}</a>   
    </div>
@endsection