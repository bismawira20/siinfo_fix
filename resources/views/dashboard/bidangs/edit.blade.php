@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Nama Bidang</h2>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/bidangs/{{ $bidang->id }}" class="mb-5">
        @method('put')
        @csrf
        <div class="mb-3">
        <label for="name" class="form-label">Nama Bidang</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
        id="name" name="name" value="{{ old('name', $bidang->name) }}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Bidang Kerja</button>
    </form>
</div>
  
@endsection