<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <object data="{{ asset('images/logo.svg') }}" type="image/svg+xml" width="125px"
                class="parkit-logo"></object>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rent">Rent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lease">Lease</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{action('UserController@profile')}}">
                            {{ __('My profile') }}
                        </a>
                        {{-- These are ADMIN only --}}
                        @if (Auth::user()->role==="admin")
                        <a class="dropdown-item" href="/leases">Leases</a>
                        <a class="dropdown-item" href="/rentables">Places</a>
                        <a class="dropdown-item" href="/users">Users</a>
                        @endif
                        {{--  --}}

                        {{-- These are USER only --}}
                        @if (Auth::user()->role==="user")
                        <a class="dropdown-item" href="{{action('LeaseController@myleases')}}">My Leases</a>
                        <a class="dropdown-item" href="{{action('RentableController@myplaces')}}">My Places</a>
                        @endif
                        {{--  --}}

                        <hr class="my-1">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
