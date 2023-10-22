{{-- @extends('layouts.app') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prisijungti</title>
</head>

<body>
    {{-- @section('content') --}}
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.login-auth') }}" method="post">
            @csrf
            @method('post')

            <div class="mb-3">
                <label for="email" class="form-label">Pastas</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                    placeholder="address@email.com">
                {{-- @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror --}}
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Slaptažodis</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Slaptažodis">
                {{-- @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror --}}
            </div>


            <button type="submit" class="btn btn-primary">Registruoti</button>
        </form>
    </div>

    {{-- @endsection --}}

</body>

</html>
