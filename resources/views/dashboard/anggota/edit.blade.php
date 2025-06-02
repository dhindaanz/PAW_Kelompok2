@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Edit Anggota ({{ $anggota->name }})</h1>
@endsection

@section('content')
    <div class="card pb-5">
        <div class="card-body">
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mx-4 my-2">
                    <label for="name"class="text-primary font-weight-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $anggota->name) }}">
                </div>

                @error('name')
                    <div class="alert alert-danger mx-4 my-2">{{ $message }}</div>
                @enderror

                <div class="form-group mx-4 my-2">
                    <label for="nim" class="text-md text-primary font-weight-bold">Nomor Induk Mahasiswa</label>
                    <input type="text" name="nim" class="form-control"
                        value="{{ old('nim', $anggota->profile->nim) }}">
                </div>

                @error('nim')
                    <div class="alert alert-danger mx-4 my-2">{{ $message }}</div>
                @enderror

                <div class="form-group mx-4 my-2">
                    <label for="prodi" class="text-md text-primary font-weight-bold">Program Studi</label>
                    <input type="text" name="prodi" class="form-control"
                        value="{{ old('prodi', $anggota->profile->prodi) }}">
                </div>

                @error('prodi')
                    <div class="alert alert-danger mx-4 my-2">{{ $message }}</div>
                @enderror

                <div class="form-group mx-4 my-2">
                    <label for="angkatan" class="text-md text-primary font-weight-bold">Angkatan</label>
                    <input type="number" name="angkatan" class="form-control" min="2000" max="{{ date('Y') + 1 }}"
                        value="{{ old('angkatan', $anggota->profile->angkatan) }}">
                </div>

                @error('angkatan')
                    <div class="alert alert-danger mx-4 my-2">{{ $message }}</div>
                @enderror

                <div class="form-group mx-4 my-2">
                    <label for="no_hp" class="text-md text-primary font-weight-bold">Nomor Handphone</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="{{ old('no_hp', $anggota->profile->no_hp) }}">
                </div>

                @error('no_hp')
                    <div class="alert alert-danger mx-4 my-2">{{ $message }}</div>
                @enderror

                <div class="form-group mx-4 my-2">
                    <label for="foto" class="text-md text-primary font-weight-bold">Photo Profile</label>
                    <div class="custom-file">
                        <input type="file" name="foto" id="foto"
                            value="{{ old('foto', $anggota->profile->foto) }}" accept="image/*">
                        <label class="custom-file-label" for="foto">Pilih Foto</label>
                    </div>
                </div>

                @error('foto')
                    <div class="alert alert-danger mx-4 my-2">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end">
                    <a href="{{ route('anggota.index') }}" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('foto').addEventListener('change', function() {
            var fileName = this.files[0].name;
            var nextSibling = this.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@endpush
