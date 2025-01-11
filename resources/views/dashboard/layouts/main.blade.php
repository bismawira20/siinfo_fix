<!doctype html>
<html lang="en" data-bs-theme="auto">

@include('dashboard.layouts.header')

<body>
@include('dashboard.layouts.svg')

    @include('dashboard.layouts.navbar')
<div class="container-fluid">
  <div class="row vh-100">
    @include('dashboard.layouts.sidebar')
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
