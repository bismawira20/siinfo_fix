@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Kategori Berita</h1>

    @foreach ($categories as $category)
    <u>
        <li><h3><a href="/categories/{{$category->slug}}" >{{ $category->name }}</a></h3></li>   
    </u>
    @endforeach

@endsection