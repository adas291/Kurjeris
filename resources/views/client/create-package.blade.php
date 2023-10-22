@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('client.store-package') }}" method="post">
        @csrf
        @method('post')

        <div class="mb-3">
            <label for="receiver_address" class="form-label">Gavėjo adresas</label>
            <input type="text" name="receiver_address" id="receiver_address" class="form-control" value="{{ old('receiver_address') }}" placeholder="Gavėjo adresas">
            @error('receiver_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="receiver_name" class="form-label">Gavėjo vardas</label>
            <input type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{ old('receiver_name') }}" placeholder="Gavėjo pavadinimas">
            @error('receiver_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city_id" class="form-label">Gavėjo miestas</label>
            <select name="city_id" id="city_id" class="form-select">
                @foreach ($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registruoti</button>
    </form>
</div>
@endsection
