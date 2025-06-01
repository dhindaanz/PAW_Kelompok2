@extends('layouts.dashboard')

@section('judul')
    <h1 class="text-primary">Edit Profile</h1>
@endsection

@section('content')
    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card pb-5">
            <div class="form-group mx-4 my-2">
                <label for="nama" class="text-md text-primary font-weight-bold mt-2">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            @error('name')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="nim" class="text-md text-primary font-weight-bold">Nomor Induk Mahasiswa</label>
                <input type="text" name="nim" class="form-control" value="{{ old('nim', $user->profile->nim) }}">
            </div>

            @error('nim')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="prodi" class="text-md text-primary font-weight-bold">Program Studi</label>
                <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $user->profile->prodi) }}">
            </div>

            @error('prodi')
                <div class="alert-danger mx-2"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="angkatan" class="text-md text-primary font-weight-bold">Angkatan</label>
                <input type="number" name="angkatan" class="form-control" min="2000" max="{{ date('Y') + 1 }}"
                    value="{{ old('angkatan', $user->profile->angkatan) }}">
            </div>

            @error('angkatan')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="no_hp" class="text-md text-primary font-weight-bold">Nomor Handphone</label>
                <input type="text" name="no_hp" class="form-control"
                    value="{{ old('no_hp', $user->profile->no_hp) }}">
            </div>

            @error('no_hp')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="foto" class="text-md text-primary font-weight-bold">Photo Profile</label>
                <div class="custom-file">
                    <input type="file" name="foto" id="foto" value="{{ old('foto', $user->profile->foto) }}" accept="image/*">
                    <label class="custom-file-label" for="foto">Pilih Foto</label>
                </div>
            </div>

            @error('foto')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="button-save d-flex justify-content-end">
                <a href="{{ route('profile.index') }}" class="btn btn-danger mt-4 py-1 px-4">Batal</a>
                <button type="submit"class="btn btn-primary mt-4 mx-2 px-5 py-1">Simpan</button>
            </div>
        </div>
    </form>
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
