@extends('layouts.app')

@section('content')

    <a class="btn btn-primary" href="{{route('operator.create-client')}}">Kurti nauja klienta</a>
    <h1>Siuntos</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Gavejas</th>
                <th>Adresas</th>
                <th>Siuntejas</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->id}}</td>
                    <td>{{ $package->receiver_name}}</td>
                    <td>{{ $package->receiver_address}}</td>
                    <td>{{ $package->user->name}}</td>
                    <td><a href="{{route('operator.show-package', ['id' => $package->id])}}">Keisti statusa</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
