@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Kategori Berita</h1>
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-4">
                <a href="/categories/{{ $category->slug}}">
                    <div class="card text-bg-dark">
                        <img src="https://th.bing.com/th/id/OIP.W6IfZ9U8aIW8ox3um1Ou9wHaHa?w=188&h=188&c=7&r=0&o=5&dpr=1.5&pid=1.7"
                        class="card-img" alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="card-title text-center flex-fill p-4 fs-3" 
                        style="background-color: rgba(0, 0, 0, 0.7)">
                            {{ $category->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection