  <nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="/images/logo.svg" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('categories') }}">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Rewards</a>
            </li>
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
            </li>
            <li class="nav-item">
              <a
                class="btn btn-success nav-link px-4 text-white"
                href="{{ route('login') }}"
                >Sign In</a
              >
            </li>
            @endguest
          </ul>
          @auth
            <!-- Desktop Menu -->
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item dropdown">
                <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <img
                    src="/images/icon-user.png"
                    alt=""
                    class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ route('dashboard-setting-account') }}"
                    >Settings</a
                    >
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
                </li>
                <li class="nav-item">
                <a class="nav-link d-inline-block mt-2" href="#">
                    <img src="/images/icon-cart-empty.svg" alt="" />
                </a>
                </li>
            </ul>

            <!-- Mobile Menu -->
            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                <a class="nav-link" href="#">
                    Hi, Angga
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link d-inline-block" href="#">
                    Cart
                </a>
                </li>
            </ul>
          @endauth
        </div>
      </div>
    </nav>