@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ route('operator.update-status') }}" method="post">
        @csrf
        {{-- @method('patch') --}}


        <div class="mb-3">
            <label for="receiver_address" class="form-label">Gavėjo adresas</label>
            <input disabled ="text" name="receiver_address" id="receiver_address" class="form-control" value="{{ old('receiver_address') }}" placeholder="Gavėjo adresas">
            @error('receiver_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="receiver_name" class="form-label">Gavėjo vardas</label>
            <input disabled type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{ old('receiver_name') }}" placeholder="Gavėjo pavadinimas">
            @error('receiver_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Gavėjo miestas</label>
            <input disabled type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{$package->city->name}}" placeholder="Gavėjo pavadinimas">
            @error('receiver_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city_id" class="form-label">Gavėjo miestas</label>
            <table class="table ">
                <thead>
                    <tr>
                        <td>Laikas</td>
                        <td>Statusas</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packageHistory as $packageStatus)
                    <tr>
                        <td>{{$packageStatus->time}}</td>
                        <td>{{$packageStatus->status->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($nextStatus)
            <input hidden type="number" name="packageId" value="{{$package->id}}">
            <input hidden type="number" name="statusId" value="{{$nextStatus->id}}">
            <button type="submit" class="btn btn-primary">{{$nextStatus->name}}</button>
        @endif
    </form>
</div>
@endsection
