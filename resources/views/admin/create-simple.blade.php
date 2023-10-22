@extends('layouts.app')
@section('content')

<div class="container">
    <form action="{{ route('admin.store-operator') }}" method="post">
        @csrf
        @method('post')

        <div class="mb-3">
            <label for="name" class="form-label">Operatoriaus vardas</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Vardas">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E. pastas</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Vardas">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Slaptažodis</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Slaptažodis">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Įveskite operatoriaus miestą</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}" placeholder="Miesto pavadinimas">
            @error('city')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registruoti</button>
    </form>
</div>

@endsection
