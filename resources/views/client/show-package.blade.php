@extends('layouts.app')
@section('content')

<a class="btn btn-primary" href="{{route('user.create-package')}}">Kurti nauja</a>
<h1>Siuntos123 </h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nr</th>
            <th>Siuntėjas</th>
            <th>Gavėjo vardas</th>
            <th>Gavėjo adresas</th>
            <th>Gavėjo miestas</th>
            <th>Gavėjo gatvė</th>
            <th>Stausas</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($packages as $package)
            <tr>
                <td>{{ $package->id}}</td>
                <td>{{ $package->sender}}</td>
                <td>{{ $package->receiver_name}}</td>
                <td>{{ $package->receiver_address}}</td>
                <td>{{ $package->city}}</td>
                <td>{{ $package->street}}</td>

                <td>{{ $package->status}}loll</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
