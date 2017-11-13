@extends('layouts.app')

@section('content')

        <h1>{{ __("Radar's data") }}</h1>
        
        <table class="table">
            <tr>
                <th>Data</th>
                <th>Numeris</th>
                <th>Greitis</th>

                <th>Vairuotojas</th>

                <th>Kas</th>
                <th>Kada</th>

                <th></th>
                <th></th>
            </tr>
            <?php foreach ($radars as $r): ?>
                <tr>
                    <td><a href="radars/{{ $r->id }}">{{ $r->date }}</a></td>
                    <td>{{ $r->number }}</td>
                    <td>{{ Round($r->distance / $r->time * 3.6) }}</td>
                    
                    <td>{{ $r->driver ? $r->driver->name . ' ' . $r->driver->surname : '' }}</td>

                    <td>{{ $r->updater->name }}</td>
                    <td>{{ $r->updated_at }}</td>

                    <td><a class="btn btn-primary" href="radars/{{ $r->id }}/edit">{{ __('buttons.edit') }}</a></td>
                    <td> 
                        <form method="post" action="{{ url('/radars', $r->id) }}">
                            {{ method_field('DELETE') }} 
                            {{ csrf_field() }}
                            <button class="btn btn-danger">{{ __('buttons.delete') }}</button> 
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        {{ $radars->links() }}

@endsection

@section('menu')
    <li><a href="radars/create">Naujas įrašas</a></li>
    <li><a href="radars">Radarų įrašai</a></li>
    <li><a href="drivers">Vairuotojai</a></li>
@endsection