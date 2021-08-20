<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto topnav">
      <li class="nav-item {{ (str_contains(url()->current(), '/cinemas') || request()->is('/')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('cinemas.index') }}">{{ __('Cinemas') }}</a>
      </li>
      <li class="nav-item {{ str_contains(url()->current(), '/movies') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('movies.index') }}">{{ __('Movies') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
      </li>
    </ul>
  </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>
