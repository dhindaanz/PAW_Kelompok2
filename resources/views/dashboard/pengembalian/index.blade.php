@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Form Pengembalian Buku</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama" class="text-primary font-weight-bold">Nama Peminjam</label>
                    <select name="user_id" id="" class="form-control">
                        @if ($isAdmin)
                            <option value="" selected>Pilih Peminjam</option>
                            @forelse ($peminjam as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} ( {{ $item->profile->nim }} )</option>
                            @empty
                                <option value="" selected>Tidak ada peminjam</option>
                            @endforelse
                        @else
                            <option value="{{ $peminjam->id }}" selected>{{ $peminjam->name }} (
                                {{ $peminjam->profile->nim }} )</option>
                        @endif
                    </select>

                    @error('user_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fom-group">
                    <label for="buku_id" class="text-primary font-weight-bold">Buku yang akan dipinjam</label>
                    <select name="buku_id" id="buku_id" class="form-control">
                        @forelse ($buku as $item)
                            <option value="{{ $item->id }}">{{ $item->judul }} ( {{ $item->kode_buku }} ) -
                                {{ $item->status }}</option>
                        @empty
                            <option value="" selected>Tidak ada buku yang tersedia</option>
                        @endforelse
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ url($referrer) }}" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
