@extends('layouts.app')

@section('content')

    <h1>Vairuotojai</h1>
    
    <table class="table">
        <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Miestas</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($drivers as $d): ?>
            <tr>
                <td><a href="drivers/{{ $d->id }}">{{ $d->name }}</a></td>
                <td>{{ $d->surname }}</td>
                <td>{{ $d->city }}</td>
                <td><a class="btn btn-primary" href="drivers/{{ $d->id }}/edit">{{ __('buttons.edit') }}</a></td>
                <td> 
                    <form method="post" action="{{ url('/drivers', $d->id) }}">
                        {{ method_field('DELETE') }} 
                        {{ csrf_field() }}
                        <button class="btn btn-danger">{{ __('buttons.delete') }}</button> 
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    {{ $drivers->links() }}

@endsection

@section('menu')
    <li><a href="drivers/create">Naujas vairuotojas</a></li>
    <li><a href="radars">Radarų įrašai</a></li>
    <li><a href="drivers">Vairuotojai</a></li>
@endsection