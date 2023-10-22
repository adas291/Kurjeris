
@extends('layouts.app')

@section('content')

    <a class="btn btn-primary" href="{{route('operator.create-client')}}">Kurti nauja klienta</a>
    <h1>Klientai</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Vardas</th>
                <th>E. pastas</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id}}</td>
                    <td>{{ $client->name}}</td>
                    <td>{{ $client->email}}</td>
                    {{-- <td><a href="{{route('operator.show-package', ['id' => $package->id])}}">Keisti statusa</a></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
