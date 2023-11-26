@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('client.store-package') }}" method="post">
            @csrf
            @method('post')


            <div class="mb-3">
                <label for="receiver_name" class="form-label">Gavėjo vardas</label>
                <input type="text" name="receiver_name" id="receiver_name" class="form-control"
                    value="{{ old('receiver_name') }}" placeholder="Gavėjo pavadinimas">
                @error('receiver_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="weight" class="form-label">Siuntos svoris</label>
                <input type="text" name="weight" id="weight" class="form-control" value="{{ old('weight') }}"
                    placeholder="Siuntos svoris">
                @error('weight')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city_id" class="form-label">Gavėjo miestas</label>
                <select name="city_id" id="cityDropdown" class="form-select">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="streetDropdown" class="form-label">Gavėjo gatvė</label>
                <select name="street_id" id="streetDropdown" class="form-select" aria-placeholder="pasirinkite gatve">
                    {{-- <option value="">Nepasirinkta</option> --}}
                </select>
                @error('street')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="receiver_address" class="form-label">Namo, buto, nr.</label>
                <input type="text" name="receiver_address" id="receiver_address" class="form-control"
                    value="{{ old('receiver_address') }}" placeholder="Gavėjo adresas">
                @error('receiver_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Registruoti</button>
        </form>
    </div>

    <script>
        $(document).ready(() => {

            var cityDropdown = document.getElementById('cityDropdown');
            var streetDropdown = document.getElementById('streetDropdown');

            function fetchStreets(cityId) {
                fetch('/getStreets/' + cityId)
                    .then(response => response.json())
                    .then(streets => {
                        streetDropdown.innerHTML = '';

                        for (const street of streets) {
                            var option = document.createElement('option');
                            option.value = street.id;
                            option.text = street.name;
                            streetDropdown.appendChild(option);
                        }
                    })
                    .catch(error => console.error('Error fetching streets:', error));
            }

            // Call the function on initial load
            fetchStreets(cityDropdown.value);

            cityDropdown.addEventListener('change', (event) => {
                // Call the function when the city dropdown changes
                fetchStreets(event.target.value);
            });

        })
    </script>
@endsection
