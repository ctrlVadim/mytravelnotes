<header class="bg-white shadow-sm">
    <div class="container">
        <div class="header__row">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand carmine" href="{{ url('/') }}" title="Home">
                    MyTravelNotes
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('note') }}" title="Notes">{{ __('Notes') }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" title="Login">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" title="Register">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" title="User {{ Auth::user()->name }}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" title="Logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header__row">
            <form action="{{route('search')}}" method="get" class="search-form d-flex">
                <input type="text" id="search" name="search" class="search-input w-100" style="border-radius: .25em 0 0 .25em">
                <button type="submit" class="search-button border-0 carmine-bg text-white" style="border-radius: 0 .25em .25em 0">Search</button>
            </form>
            @if (Auth::user() and  Auth::user()->role === 'author')
                <a class="create-link" href="{{route('create')}}">Create note</a>
            @endif
        </div>
    </div>

</header>
