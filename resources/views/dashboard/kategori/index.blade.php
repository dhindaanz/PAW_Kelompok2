@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Daftar Kategori</h1>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.12.1/date-1.1.2/fc-4.1.0/r-2.3.0/sc-2.0.7/datatables.min.css" />
@endpush

@section('content')
    @if ($isAdmin)
        <a href="{{ route('kategori.index') }}" class="btn btn-info mb-3">Tambah Kategori</a>
    @endif

    <div class="col-lg-auto">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Tombol Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <button class="btn btn-info">
                                        <a href="{{ route('kategori.show', $item->id) }}"
                                            style="text-decoration: none; color:white;">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    </button>

                                    @if ($isAdmin)
                                        <button class="btn btn-warning">
                                            <a href="{{ route('kategori.index', $item->id) }}"
                                                style="text-decoration: none;color:white">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </button>

                                        <button class="btn btn-danger">
                                            <a data-toggle="modal" data-target="#DeleteModal{{ $item->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </button>

                                        <div class="modal fade" id="DeleteModal{{ $item->id }}" role="dialog"
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
                                                        <form action="{{ route('kategori.index', $item->id) }}"
                                                            method="POST" id="DeleteModal">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="submit" value="delete"
                                                                class="btn btn-outline-danger">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada kategori</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#dataTable').DataTable();
            $('#dataTableHover').DataTable();
        });
    </script>
@endpush
