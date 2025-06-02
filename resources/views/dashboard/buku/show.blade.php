@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">{{ $buku->judul }}</h1>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="row mt-5">
            <div class="col-auto ml-5 mr-5 my-4">
                @if ($buku->gambar != null)
                    <img class="img mb-3" src="{{ asset($buku->gambar) }}" style="height:200px; width:200px">
                @else
                    <img class="img mb-3" src="{{ asset('img/no-image.jpg') }}" style="height:200px; width:200px">
                @endif
            </div>
            <div class="col-auto mx-4">
                <div class="form-group mb-3">
                    <label for="judul" class="text-lg text-primary font-weight-bold">Judul Buku</label>
                    <h4>{{ $buku->judul }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="pengarang" class="text-lg text-primary font-weight-bold">Pengarang</label>
                    <h4>{{ $buku->pengarang }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="penerbit" class="text-lg text-primary font-weight-bold">Penerbit</label>
                    <h4>{{ $buku->penerbit }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="kategori" class="text-lg text-primary font-weight-bold">Kategori</label>
                    <h4>{{ $buku->kategori?->nama }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="tahun_terbit" class="text-lg text-primary font-weight-bold">Tahun Terbit</label>
                    <h4>{{ $buku->tahun_terbit }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="status" class="text-lg text-primary font-weight-bold">Kode Buku</label>
                    <h4>{{ $buku->is_available ? 'Tersedia' : 'Belum Tersedia' }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="deskripsi" class="text-lg text-primary font-weight-bold">Deskripsi</label>
                    <h4>{{ $buku->deskripsi }}</h4>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-start my-4 mx-4">
            <a href="{{ route('buku.index') }}" class="btn btn-primary px-5">Kembali</a>
        </div>
    </div>
@endsection
