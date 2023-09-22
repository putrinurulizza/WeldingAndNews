@extends('dashboard.layouts.main')
@section('page-heading', 'Tambah Welder')

@section('content')
    {{-- Button --}}
    <a class="btn btn-outline-secondary" href="{{ route('welder.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
    </a>
    {{-- End Button --}}

    <div class="card mb-3 mt-3">
        <div class="card-body">
            <form action="{{ route('welder.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" autofocus required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pemilik" class="form-label">Pemilik</label>
                    <input type="name" class="form-control @error('pemilik') is-invalid @enderror" id="pemilik"
                        name="pemilik" required>
                    @error('pemilik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_pekerja" class="form-label">Jumlah Pekerja</label>
                    <input type="number" class="form-control @error('jumlah_pekerja') is-invalid @enderror"
                        id="jumlah_pekerja" name="jumlah_pekerja" required>
                    @error('jumlah_pekerja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        name="no_hp" required>
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                        name="alamat" required>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="name" class="form-control @error('kota') is-invalid @enderror" id="kota"
                        name="kota" required>
                    @error('kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        name="foto" required>
                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary float-end mt-3" type="submit">Simpan</button>
            </form>

        </div>
    </div>
@endsection
