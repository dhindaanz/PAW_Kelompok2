@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Detail Kategori</h1>
@endsection

@section('content')
    <div class="card">
        <h3 class="judul m-3 text-primary" style="font-weight:bold;">{{ $kategori->nama }}</h3>
        @if ($kategori->deskripsi != null)
            <p class="deskripsi m-3">{{ $kategori->deskripsi }}</p>
        @else
            <p class="deskripsi m-3">Tidak Ada Deskripsi</p>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('kategori.index') }}" class="btn btn-info mx-3 my-3">Kembali</a>
        </div>
    </div>

    <h4 class="m-3 text-primary" style="font-weight: bold;">Buku Terkait Kategori :</h4>

    <div class="card container-fluid mb-3">
        <div class="row d-flex flex-wrap justify-content-center">
            @forelse ($buku as $item)
                <div class="col-auto my-2" style="width:18rem;">
                    <div class="card mx-2 my-2" style="min-height:28rem;">
                        @if ($item->gambar != null)
                            <img class="card-img-top" style="height:200px;" src="{{ asset($item->gambar) }}">
                        @else
                            <img class="card-img-top" style="height:200px;" src="{{ asset('img/no-image.jpg') }}">
                        @endif

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="detai-buku">
                                <h5 class="card-title text-primary"><a
                                        href="{{ route('kategori.index', $item->id) }}"style="text-decoration: none; font-size:1rem;font-weight:bold;">
                                        {{ $item->judul }}</a></h5>
                                <p class = "cart-text m-0">Kode Buku : {{ $item->kode_buku }}</p>
                                <p class="card-text m-0">Pengarang : <a href="#"
                                        style="text-decoration: none;">{{ $item->pengarang }}</a></p>
                                <p class="card-text m-0">Kategori : {{ $kategori->nama }}</p>
                                <p class="card-text m-0">Status : {{ $item->status }}</p>
                            </div>
                            <div class="button-area">
                                <button class="btn-sm btn-info px-2"><a href="{{ route('buku.show', $item->id) }}"
                                        style="text-decoration: none; color:white;">Detail</a></button>

                                @if ($isAdmin)
                                    <button class="btn-sm btn-warning px-2"><a href="{{ route('buku.destroy', $item->id) }}"
                                            style="text-decoration: none;color:white">Edit</a></button>
                                    <button class="btn-sm btn-danger px-3"><a data-toggle="modal"
                                            data-target="#DeleteModal{{ $item->id }}">Delete</a></button>
                                @else
                                    <button class="btn-sm btn-danger px-4"><a a href="/peminjaman/create"
                                            style="text-decoration: none; color:white;">Pinjam Buku</a></button>
                                @endif
                            </div>

                            @if ($isAdmin)
                                <div class="modal fade" id="DeleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="ModalLabelDelete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabelDelete">Ohh No!</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-outline-danger px-4" type="submit"
                                                        value="delete">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="text-primary mt-3">Tidak ada buku</h3>
            @endforelse
        </div>
    </div>
@endsection
