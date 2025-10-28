<nav class="navbar navbar-expand-md"
    style="margin-bottom: 30px; background-color: brown; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid px-5">
        <!-- Logo -->
        <a class="navbar-brand text-white fw-bold" href="/" style="font-size: 1.8em;">
            <img src="{{ asset('logo.svg') }}" alt="logo" style="height: 1.5em; margin-right: 8px;"> Biblioteca
        </a>

        <!-- Toggler (white hamburger) -->
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-md-0 d-flex align-items-center">
                <!-- Categories Dropdown -->
                <li class="nav-item dropdown me-md-3 mb-2 mb-md-0">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="categoriesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        @foreach ($categories as $categorie)
                        <li>
                            <a class="dropdown-item"
                                href="{{ url('/bookshelf?categorie=' . $categorie->id) }}">{{ $categorie->name }}</a>
                        </li>
                        @endforeach

                    </ul>
                </li>

                @if (Auth::user()->email === 'admin@admin.es')
           
                <li class="nav-item me-md-3 mb-2 mb-md-0">
                    <a class="btn text-white" href="{{ url('/categories') }}">Crear Categoria</a>
                </li>

                <li class="nav-item mb-2 mb-md-0">
                    <a class="btn text-white" href="{{ url('/users') }}">Veure Usuaris</a>
                </li>
                @endif
            </ul>

            <!-- Right links -->
            @auth
            <ul class="navbar-nav ms-auto mb-2 mb-md-0 text-center text-md-end">
                <li class="nav-item dropdown w-100 w-md-auto mt-2 mt-md-0">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        {{-- <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li> --}}
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                    </form>
                </li>
            </ul>
            </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>