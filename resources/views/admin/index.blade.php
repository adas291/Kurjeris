@extends('layouts.app')
@section('content')
<div>this is index of admin</div>

<a href="{{route('admin.create-operator')}}">Kurti operatoriu</a>

    <h1>Operatoriai</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operators as $operator)
                <tr>
                    <td>{{ $operator->name }}</td>
                    <td>{{ $operator->city }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
