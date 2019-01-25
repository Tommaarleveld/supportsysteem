<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{request()->is('tickets') ? 'active' : ''}}">
                    <a class="nav-link" href="/tickets">Openstaande Tickets</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->points < 10)
                            <p class="dropdown-item">Rookie ({{ Auth::user()->points }})</p>
                            @elseif(Auth::user()->points >= 10 && Auth::user()->points < 20)
                            <a class="dropdown-item">Semi-pro ({{ Auth::user()->points }})</a>
                            @elseif(Auth::user()->whereBetween('points', [20, 30]))
                            <a class="dropdown-item">Pro ({{ Auth::user()->points }})</a>
                            @elseif(Auth::user()->points >= 30)
                            <a class="dropdown-item">Expert ({{ Auth::user()->points }})</a>
                            @endif
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="/dashboard">Dashboard</a>

                            <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit">Edit</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    {{-- Admin Part --}}
                    @if(Auth::user()->isAdmin == 1)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="text-info">Admin Panel </span><span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/tickets/create">Maak een ticket aan</a>
                            <a class="dropdown-item" href="/admin/tickets">Ticket overzicht</a>
                        </div>
                    </li>
                    @endif
                @endguest    
            </ul>
        </div>
    </div>
</nav>