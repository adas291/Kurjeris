@extends('layouts.app')

@section('content')
<h1>Operatoriai</h1>
<a class="btn btn-primary" href="{{route('admin.create-operator')}}">Kurti nauja operatoriu</a>
<div class="container mx-auto text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Pavadinimas</th>
                <th>Miestas</th>
                <th>Gatvė</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operators as $operator)
                <tr>
                    <td>{{ $operator->id}}</td>
                    <td>{{ $operator->user->name}}</td>
                    <td>{{ $operator->city->name}}</td>
                    <td>{{ $operator->street->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
