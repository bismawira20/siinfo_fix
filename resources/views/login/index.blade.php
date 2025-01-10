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
            <img class="mb-4 mx-auto d-block" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
            <form>
              <div class="form-floating mb-2">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput" class="text-end">Email address</label>
              </div>
              <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword" class="text-end">Password</label>
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