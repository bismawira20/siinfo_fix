<!doctype html>
<html lang="en" data-bs-theme="auto">

@include('dashboard.layouts.header')

<body>
@include('dashboard.layouts.svg')

@include('dashboard.layouts.navbar')

    {{-- ini sidebar --}}
<div class="container-fluid">
  <div class="row vh-100">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">SI-INFO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/dashboard">
                  <svg class="bi"><use xlink:href="#house-fill"/></svg>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/bukutamu">
                  <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                  Buku Tamu
                </a>
              </li>
            </ul>
            <hr class="my-3">
          </div>
        </div>
      </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('container')
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>
<script src="/js/dashboard.js"></script>
  </body>
</html>
