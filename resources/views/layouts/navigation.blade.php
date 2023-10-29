<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Kurjeris</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if(Auth::check())
                <ul class="navbar-nav">
                    <?php $role = auth()->user()->user_role; ?>
                    @switch($role)
                        @case(1)
                            @include('client.nav-links')
                            @break
                        @case(2)
                            @include('operator.nav-links')
                            @break
                        @case(3)
                            @include('admin.nav-links')
                            @break
                        @default
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.login') }}">Prisijungti</a>
                                </li>
                            </ul>
                    @endswitch

                </ul>

                    @if (auth()->check())
                    <div class="ms-auto nav-item d-flex flex-direction-row align-items-center gap-4">
                        <div class="nav-item ms-auto">
                            <span>{{session('role_name')}} {{ auth()->user()->name }}</span>
                        </div>

                        <div class="nav-item ms-auto">
                            <form action="{{route('user.logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Atsijungti</button>
                            </form>
                        </div>
                    </div>
                    @endif

            @endif
            @unless (Auth::check())
                <div class="nav-item ms-auto">
                    <a href="{{route('user.login')}}" class="btn btn-primary">Prisijungti</a>
                    {{-- <form action="{{route('user.login')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Prisijungti</button>
                    </form> --}}
                </div>
            @endunless
        </div>
    </div>
</nav>
