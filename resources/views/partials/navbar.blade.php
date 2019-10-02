<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="logo_color">
                <img src="{{ asset('/assets/img/koala.png') }}" class="logo_img">
                {{ config('app.name', 'Koala Jobs') }}
            </span>

           
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === 'jobs.index' ? 'active' : '' }}" href=" {{ route('jobs.index') }}">{{ __('Jobs') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>{{ __('Sign up') }}</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->is_employer)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employers.jobs.create') }}">Post a Job</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Welcome, {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->is_employer)
                                <a class="dropdown-item" href="{{ route('employers.homepage') }}">My Homepage</a>
                                <a class="dropdown-item" href="{{ route('employers.jobs.index') }}">Jobs</a>
                                <a class="dropdown-item" href="{{ route('employers.applications.index') }}">Applications</a>
                            @else
                                <a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>

                                <a class="dropdown-item" href="{{ route('users.savedJobs') }}">
                                    Saved Jobs
                                </a>      
                                <a class="dropdown-item" href="{{ route('employees.applications.index') }}">Applications</a>
                       
                            @endif
                        
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
                @endguest
            </ul>
        </div>
    </div>
</nav>

