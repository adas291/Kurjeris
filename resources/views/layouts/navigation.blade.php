<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Kurjeris</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
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
                    @endswitch

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.login-auth') }}">Atsijungti</a>
                    </li>

                    <li class="nav-item">
                        {{ auth()->user()->name }}
                        id: {{ auth()->user()->id }}
                        role_id: {{ auth()->user()->user_role }}
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
