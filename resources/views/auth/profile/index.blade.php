@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Profile</h4>
        </div>
        <div class="row">
            <div class="col-auto ml-5 mr-5 my-4">
                @if ($user->profile?->foto != null)
                    <img src="{{ asset($user->profile->foto) }}"
                        style="width:150px;height:150px;border-radius:100px">
                @else
                    <img src="{{ asset('template/img/boy.png') }}" style="width:100px;height:100px;border-radius:50px">
                @endif
            </div>
            <div class="col-auto mx-4">
                <div class="form-group mb-3">
                    <label for="nama" class="text-lg text-primary font-weight-bold">Nama Lengkap</label>
                    <h4>{{ $user->name }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="nim" class="text-lg text-primary font-weight-bold">Nomor Induk Mahasiswa</label>
                    <h4>{{ $user->profile->nim }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="prodi" class="text-lg text-primary font-weight-bold">Program Studi</label>
                    <h4>{{ $user->profile->prodi }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="angkatan" class="text-lg text-primary font-weight-bold">Angkatan</label>
                    <h4>{{ $user->profile->angkatan }}</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="no_hp" class="text-lg text-primary font-weight-bold">Nomor Handphone</label>
                    <h4>{{ $user->profile->no_hp }}</h4>
                </div>
            </div>
        </div>

        <div class="edit d-flex justify-content-end my-4 mx-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary px-5">Edit Profile</a>
        </div>
    </div>
@endsection
