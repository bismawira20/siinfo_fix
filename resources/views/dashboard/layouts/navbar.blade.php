<header class="navbar sticky-top flex-md-nowrap p-0 shadow" style="background-color: #ad1717;" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="/dashboard">
        <img src="https://semarangkota.go.id/assets/img/logo-icon.png" alt="Logo" 
        style="width: 25px; height: auto;" class="d-inline-block align-text-top me-2">
        SI-INFO</a>
        <ul class="navbar-nav flex-row align-items-center">
            <li class="nav-item text-nowrap me-2">
                <form action="/logout" method="post" class="d-flex align-items-center">
                    @csrf
                    <button type="submit" class="nav-link px-3 text-white bg-transparent border-0 d-flex align-items-center">
                        <svg class="bi text-white me-1" fill="white" width="16" height="16">
                            <use xlink:href="#door-closed"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    {{-- <div id="navbarSearch" class="navbar-search w-100 collapse">
      <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div> --}}
</header>

