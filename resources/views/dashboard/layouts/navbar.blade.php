<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="/dashboard">SI-INFO</a>
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
  
    <div id="navbarSearch" class="navbar-search w-100 collapse">
      <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
</header>

