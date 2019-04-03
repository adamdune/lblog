<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a href="{{ url('/') }}" class="navbar-brand">{{ config('app.name', 'LBLOG') }}</a>
  <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="navbar-toggler-icon"></span>
  </button>
  <!--Navbar-collapse-->
  <div class="collapse navbar-collapse" id="navbar-collapse">
    <!--Navbar-right-->
    <ul class="navbar-nav ml-auto">
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
      </li>
      @endif @else
      <li class="nav-item">
        <a href="/dashboard" class="nav-link mr-2"><i class="fas fa-home mr-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a href="/posts/create" class="nav-link mr-2"><i class="fas fa-plus mr-2"></i>Add Post</a>
      </li>
      <li class="nav-item dropdown">
        <a id="navbar-dropdown" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src={{Auth::user()->profile_picture}} style="height: 2rem; width: 2rem;" class="rounded mx-2"/>
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown">
          <a href="/profile/{{Auth::user()->id}}" class="dropdown-item">My Profile</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
</nav>