@extends('layouts.app')

@section('content')

    {{-- <a class="btn btn-primary" href="{{route('operator.create-client')}}">Kurti nauja klienta</a> --}}
    <h1>Siuntos</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Kliento vardas</th>
                <th>Miestas</th>
                <th>Siuntimo trukmė dienomis</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->package_id}}</td>
                    <td>{{ $package->client_name}}</td>
                    <td>{{ $package->city}}</td>
                    <td>{{ $package->duration}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
