<header id="rpm-header" class="rpm-header-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('home')}}" class="logo"><img src="{{asset('project/user/images/logo.png')}}"
                                                              alt="RPM Logo"></a>
            </div>
            <div class="col-md-6">
                <div class="rpm-nav">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fa fa-bars"></span>
                        </button>
                        @if(!str_contains(request()->path(), 'admin'))
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    @if(!auth()->guard('manager')->check() && !auth()->guard('driver')->check())
                                        <li class="nav-item"><a class="nav-link active"
                                                                href="{{route('home')}}">Home</a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a>
                                    </li>
                                    @if(auth()->guard('manager')->check())
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ auth()->guard('manager')->user()->name }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{route('manager.dashboard')}}">Manager
                                                    Dashboard</a>
                                                <a class="dropdown-item" href="{{ route('manager.logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Manager Logout') }}
                                                </a>
                                                <a class="dropdown-item" href="#">Manager Change Password</a>

                                                <form id="logout-form" action="{{ route('manager.logout') }}"
                                                      method="POST"
                                                      class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @elseif(auth()->guard('driver')->check())
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ auth()->guard('driver')->user()->name }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('driver.logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Driver Logout') }}
                                                </a>
                                                <a class="dropdown-item" href="#">Driver Change Password</a>

                                                <form id="logout-form" action="{{ route('driver.logout') }}"
                                                      method="POST"
                                                      class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">Login</a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item"
                                                   href="{{route('driver.login.form')}}">Driver</a>
                                                <a class="dropdown-item"
                                                   href="{{route('manager.login.form')}}">Manager</a>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
