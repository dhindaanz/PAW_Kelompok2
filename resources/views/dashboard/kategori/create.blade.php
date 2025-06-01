@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Tambah Kategori</h1>
@endsection

@section('content')
    <div class="card px-4 pt-3 pb-5">
        <form action="{{ route('kategori.index') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input name="nama" type="text" class="form-control" id="nama" value="{{ old('nama') }}">
            </div>

            @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            @error('deskripsi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <a href="{{ route('kategori.index') }}" class="btn btn-danger">Batal</a>
            <button class="btn btn-info">Tambah</button>
        </form>
    </div>
@endsection
