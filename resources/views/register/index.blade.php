@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-4">
        <main class="form-registration">
            <img class="mb-4 mx-auto d-block" src="https://diskominfo.semarangkota.go.id/img/logodiskominfo.png" 
            alt="" style="max-width: 100%; height: auto;">
            <h1 class="h3 mb-3 fw-normal text-center">Register Akun | SI-INFO</h1>
            <form action="/register" method="post">
                @csrf
                <div class="form-floating mb-2">
                    <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" 
                    id="name" placeholder="Nama" value="{{ old('name') }}">
                    <label for="name">Nama</label>
                    @error ('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-2">
                    <input type="text" name="username" class="form-control @error ('username') is-invalid @enderror" 
                    id="username" placeholder="Username" value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error ('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-2">
                    <input type="email" name="email" class="form-control @error ('email') is-invalid @enderror" 
                    id="email" placeholder="name@example.com" value="{{ old('email') }}">
                    <label for="email">Alamat Email</label>
                    @error ('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
              <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control @error ('password') is-invalid @enderror" 
                id="password" placeholder="Password">
                <label for="password">Password</label>
                @error ('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <button class="btn btn-danger w-100 py-2" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Sudah punya akun? 
                <a href="/login">Login</a></small>
          </main>
    </div>
</div>
@endsection