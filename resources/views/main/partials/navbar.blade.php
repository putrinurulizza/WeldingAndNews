<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">
      <span class="merek">WELD</span> ARGON
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link {{ Request::is('/') || Route::currentRouteName() === 'show' ? 'active' : '' }}" href="/">BERITA</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link {{ Request::is('welding*') ? 'active' : '' }}" href="/welding">WELDER</a>
        </li>
      </ul>

      @auth
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, {{ auth()->user()->name }} 👋
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item align" href="/dashboard">
                  <i class="fa-regular fa-grid-2 me-2"></i>
                  Dashboard
                </a>
              </li>
              <li class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="fa-regular fa-arrow-right-from-bracket me-2"></i>
                  Logout
                </button>
              </form>
            </li>
          </ul>
        @else
          <div class="d-flex">
            <a class="btn btn-light btn-login fw-semibold px-4 rounded-pill" href="/login">Login</a>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>
