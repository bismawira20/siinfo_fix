@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Tambah Bidang Kerja</h2>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/bidangs" class="mb-5">
        @csrf
        <div class="mb-3">
        <label for="name" class="form-label">Nama Bidang Kerja</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
        id="name" name="name">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
  
@endsection