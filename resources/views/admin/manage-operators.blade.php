@extends('layouts.app')

@section('content')
<h1>Operatoriai</h1>
<a class="btn btn-primary" href="{{route('admin.create-operator')}}">Kurti nauja operatoriu</a>
<div class="container mx-auto text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operators as $operator)
                <tr>
                    <td>{{ $operator->id}}</td>
                    <td>{{ $operator->name}}</td>
                    <td>{{ $operator->city}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
