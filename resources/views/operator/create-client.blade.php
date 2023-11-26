@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('operator.store-client') }}" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="name" class="form-label">Vardas</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Vardas">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">El. paštas</label>
                <input type="text" value="{{ old('email') }}" name="email" class="form-control" placeholder="Vardas">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Slaptažodis</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Slaptazodis">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Registruoti</button>
        </form>
    </div>
@endsection
