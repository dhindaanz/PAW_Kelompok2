@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Daftar Anggota</h1>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.12.1/date-1.1.2/fc-4.1.0/r-2.3.0/sc-2.0.7/datatables.min.css" />
@endpush

@section('content')
    <div class="col-lg-auto">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Anggota</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tombol Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggota as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->profile->nim }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <button class="btn btn-info">
                                        <a href="{{ route('anggota.show', $item->id) }}"
                                            style="text-decoration: none; color:white;">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    </button>

                                    @if ($isAdmin)
                                        <button class="btn btn-warning">
                                            <a href="{{ route('anggota.edit', $item->id) }}"
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
                                                        <p>Apakah Anda yakin ingin menghapus?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('anggota.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
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
                                <td colspan="7" class="text-center">Tidak ada data Anggota</td>
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
