@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-4">
        <main class="form-signin w-100 m-auto">

          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <span>{{ session('success') }}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if(session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span>{{ session('loginError') }}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

            <img class="mb-4 mx-auto d-block" src="https://diskominfo.semarangkota.go.id/img/logodiskominfo.png" 
            alt="" style="max-width: 100%; height: auto;">
            <h1 class="h3 mb-3 fw-normal text-center">Login | SI-INFO</h1>
            <form action="/login" method="post">
              @csrf
              <div class="form-floating mb-2">
                <input type="email" name="email" class="form-control @error ('email') is-invalid @enderror" id="email"
                placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                <label for="email" class="text-end">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating mb-2">
                <input type="password"  name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password" class="text-end">Password</label>
              </div>
          
              {{-- <div class="form-check my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Remember me
                </label>
              </div> --}}
              <button class="btn btn-danger w-100 py-2" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3">Belum punya akun? 
                <a href="/register">Daftar Akun</a></small>
          </main>
    </div>
</div>
@endsection