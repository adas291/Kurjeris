@extends('layouts.app')
@section('content')

<a class="btn btn-primary" href="{{route('client.create-package')}}">Kurti nauja</a>
<h1>Siuntos</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nr</th>
            <th>Gavėjo vardas</th>
            <th>Gavėjo adresas</th>
            <th>Gavėjo miestas</th>
            <th>Stausas</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($packages as $package)
            <tr>
                <td>{{ $package->id}}</td>
                <td>{{ $package->receiver_name}}</td>
                <td>{{ $package->receiver_address}}</td>
                <td>{{ $package->city}}</td>
                <td>{{ $package->status}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
