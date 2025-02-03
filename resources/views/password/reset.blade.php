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
    @if(session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{ session('status') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


   	@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>{{ $errors->first() }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>


<div class="login-container">
    <div class="login-card">
        <img src="https://diskominfo.semarangkota.go.id/img/logodiskominfo.png" alt="Logo">
        <h2>Reset Password</h2>
        <form action="{{ route('password.update') }}
" method="post">
            @csrf
<input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating mb-2">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                placeholder="name@example.com" required value="{{ old('email', $email) }}">
                <label for="email">Email</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password Baru</label>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-2">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
                <label for="password_confirmation">Konfirmasi Password</label>
            </div>
            <button class="btn btn-danger w-100 py-2" type="submit">Reset Password</button>
        </form>
              <small class="d-block text-center mt-2">Belum punya akun?
            <a href="/register" class="text-danger">Daftar Akun</a></small>
    </div>
</div>
@endsection
