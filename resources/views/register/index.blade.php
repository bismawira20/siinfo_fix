@extends('layouts.main')

@section('container')
<style>
    body {
    position: relative;
    background: none;
    }

    body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('{{ asset("backend/img/diskominfo.jpg") }}') no-repeat center center fixed;
    background-size: cover;
    opacity: 0.3; /* Ubah nilai ini untuk transparansi */
    filter: blur(3px); /* Efek blur */
    z-index: -1;
    }
    
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }
    .login-card img {
        max-width: 300px;
        margin-bottom: 20px;
    }
    .login-card h2 {
        color: black;
        font-weight: bold;
    }
    .login-card button {
        background-color: red;
        border: none;
    }
    .login-card a {
        text-decoration: none;
    }
</style>

<div class="login-container">
    <div class="login-card">
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