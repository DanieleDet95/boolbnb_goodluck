{{-- Layouts/header.blade.php --}}

{{-- Header --}}
<header>

  {{-- Bootstrap --}}
  <div class="container-fluid">
    <div class="row">

      {{-- Navigation --}}
      <nav class="navbar navbar-expand-xl fixed-top navbar-custom">

        {{-- Logo --}}
        <a class="navbar-brand" href="#">
          <div class="nav_logo">
            <img src="{{ asset("img/airbnb_black.png") }}" alt="Logo">
          </div>
        </a>
        {{-- end Logo --}}

        {{-- Hamburger menu --}}
        <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="hamburger_icon">
            <i class="fas fa-bars"></i>
          </span>
        </button>
        {{-- end Hamburger menu --}}

        {{-- Navbar list--}}
        <div class="collapse navbar-collapse bg-custom" id="navbarNav">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item active">
              <a class="nav-link" href="{{ route("suites.index")}}">
                <span>Home</span>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route("suites.search")}}">
                <span>Search</span>
              </a>
            </li>

            {{-- If auth user -> message link menu --}}
            {{-- If auth user -> create suite link menu --}}
            {{-- If auth user -> my suite link menu --}}
            @if (isset(Auth::user()->email))
              <li class="nav-item">
                <a class="nav-link" href="{{ route("admin.email.messages.index")}}">
                  <span>Messages</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route("admin.suites.create")}}">
                  <span>New suite</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route("admin.suites.mysuites")}}">
                  <span>My suites</span>
                </a>
              </li>
            @endif
            {{-- end If auth... --}}

            {{-- Register & Login --}}
            @guest
              @if (Route::has('register'))
                <li class="nav-item nav_before_log">
                  <a class="nav-link" href="{{ route('register') }}">
                    <span>{{ __('Register') }}</span>
                  </a>
                </li>
              @endif
                <li class="nav-item nav_login_logout">
                  <a class="nav-link" href="{{ route('login') }}">
                    <span>{{ __('Login')}}</span>
                  </a>
                </li>
            @else
              <li class="nav-item nav_before_log">
                <span class="user_greeting">Hi</span>
                <span class="user_name">{{ Auth::user()->name }}!</span>
              </li>
              <li class="nav-item nav_login_logout">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            @endguest
            {{-- end Register & Login --}}

          </ul>
          {{-- end Menu list --}}

        </div>
        {{-- end Navbar list --}}

      </nav>
      {{-- end Navigation --}}

    </div>
  </div>
  {{-- end Bootstrap --}}

</header>
{{-- end Header --}}
