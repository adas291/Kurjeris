{{-- @extends('layouts.app') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <title>Prisijungti</title>
</head>

<style>
    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
    }

    .login-form {
        background: #f1f1f1;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        max-width: 50rem;
        width: 80%;
    }
</style>

<body>
    {{-- @section('content') --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.login-auth') }}" class="login-form" method="post">
        @csrf
        @method('post')

        <div class="mb-t">
            <label for="email" class="form-label">Pastas</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                placeholder="address@email.com">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-5">
            <label for="password" class="form-label">Slaptažodis</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Slaptažodis">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Prisijungti</button>
    </form>

</body>
</html>
