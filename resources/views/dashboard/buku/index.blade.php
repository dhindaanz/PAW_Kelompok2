@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Daftar Buku</h1>
@endsection

@section('content')
    @if ($isAdmin)
        <a href="{{ route('buku.index') }}" class="btn btn-info mb-3">Tambah Buku</a>
    @endif

    <form class="navbar-search mb-3" action="/buku" method="GET">
        <div class="input-group">
            <input type="search" name="search" class="form-control bg-light border-1 small" placeholder="Cari Judul Buku"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

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
                                        href="{{ route('buku.show', $item->id) }}"style="text-decoration: none; font-size:1rem;font-weight:bold;">
                                        {{ $item->judul }}</a></h5>
                                <p class = "cart-text m-0">Kode Buku : {{ $item->kode_buku }}</p>
                                <p class="card-text m-0">Pengarang : {{ $item->pengarang }}</p>
                                <p class="card-text m-0">Kategori : {{ $item->kategori?->nama }}</p>
                            </div>
                            <div class="button-area">
                                <button class="btn-sm btn-info px-2"><a href="{{ route('buku.show', $item->id) }}"
                                        style="text-decoration: none; color:white;">Detail</a></button>

                                @if ($isAdmin)
                                    <button class="btn-sm btn-warning px-2"><a href="{{ route('buku.edit', $item->id) }}"
                                            style="text-decoration: none;color:white">Edit</a></button>
                                    <button class="btn-sm btn-danger px-3"><a data-toggle="modal"
                                            data-target="#DeleteModal{{ $item->id }}">Delete</a></button>
                                @else
                                    <button class="btn-sm btn-danger px-4"><a a href="/peminjaman/create"
                                            style="text-decoration: none; color:white;">Pinjam Buku</a></button>
                                @endif
                            </div>

                            <div class="modal fade" id="DeleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="ModalLabelDelete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabelDelete">Ohh No!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('buku.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger px-4" type="submit"
                                                    value="delete">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="text-primary mt-3">Tidak ada buku</h1>
            @endforelse

        </div>

        <div class="d-flex justify-content-between mx-2 my-2">
            <p class="text-primary my-2">Menampilkan {{ $buku->currentPage() }} dari {{ $buku->lastPage() }} Halaman</p>

            {{ $buku->links() }}
        </div>
    </div>
@endsection
