@extends('layouts.app')
@section('content')

    <a class="btn btn-primary" href="{{route('operator.create-user')}}">Kurti nauja klienta</a>
    <h1>Tavo siuntos</h1>

    <table>
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Gavėjas</th>
                <th>Adresas</th>
                <th>Adresas</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id}}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
