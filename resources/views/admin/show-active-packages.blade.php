@extends('layouts.app')

@section('content')

    <h1>Aktyvios siuntos</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Kliento vardas</th>
                <th>Miestas</th>
                <th>Statusas</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->id}}</td>
                    <td>{{ $package->user->name}}</td>
                    <td>{{ $package->city->name}}</td>
                    <td>{{ $package->status->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
