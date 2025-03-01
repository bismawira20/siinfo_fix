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
    /* .login-card h2 {
        color: black;
        font-weight: bold;
    } */
    .login-card button {
        background-color: red;
        border: none;
    }
    .login-card a {
        text-decoration: none;
    }
    .alert-container {
    width: 100%;
    max-width: 400px; /* Sesuaikan dengan lebar .login-card */
    margin: 0 auto 1px auto; /* Tengah & beri jarak ke bawah */
    text-align: center;
    }
</style>

<div class="alert-container">
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
</div>

<div class="login-container">
    <div class="login-card">
        <img src="https://diskominfo.semarangkota.go.id/img/logodiskominfo.png" alt="Logo">
        <h2>Login | SI-INFO</h2>
        <form action="/login" method="post">
            @csrf
            <div class="form-floating mb-2">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                <label for="email">Email</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <button class="btn w-100 py-2" type="submit" style="background-color: #ad1717; color: white; border: none;">LOGIN</button>
        </form>
        <small class="d-block mt-3">Lupa Password? 
            <a href="/password/reset">Reset Password</a></small>
        <small class="d-block text-center mt-2">Belum punya akun? 
            <a href="/register" class="text-danger">Daftar Akun</a></small>
    </div>
</div>
@endsection
