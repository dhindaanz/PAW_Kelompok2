@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Edit Kategori</h1>
@endsection

@section('content')
    <div class="card px-4 pt-3 pb-5">
        <form action="{{ route('kategori.show', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input name="nama" type="text" value="{{ old('nama', $kategori->nama) }}" class="form-control"
                    id="nama">
            </div>

            @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" cols="30" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>

            @error('deskripsi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-end">
                <a href="{{ route('kategori.index') }}" class="btn btn-danger mx-2 px-3">Batal</a>
                <button class="btn btn-info px-4">Simpan</button>
            </div>
        </form>
    </div>
@endsection
