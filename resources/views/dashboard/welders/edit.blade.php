@extends('dashboard.layouts.main')
@section('page-heading', 'Edit Welder')

@section('content')
    {{-- Button --}}
    <a class="btn btn-outline-secondary" href="{{ route('welder.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
    </a>
    {{-- End Button --}}

    <div class="card mb-3 mt-3">
        <div class="card-body">
            <form action="{{ route('welder.update', $welder->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $welder->name) }}" autofocus required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pemilik" class="form-label">Pemilik</label>
                    <input type="name" class="form-control @error('pemilik') is-invalid @enderror" id="pemilik"
                        name="pemilik" value="{{ old('pemilik', $welder->pemilik) }}" required>
                    @error('pemilik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_pekerja" class="form-label">Jumlah Pekerja</label>
                    <input type="number" class="form-control @error('jumlah_pekerja') is-invalid @enderror"
                        id="jumlah_pekerja" name="jumlah_pekerja"
                        value="{{ old('jumlah_pekerja', $welder->jumlah_pekerja) }}" required>
                    @error('jumlah_pekerja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        name="no_hp" value="{{ old('no_hp', $welder->no_hp) }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                        name="alamat" value="{{ old('alamat', $welder->alamat) }}" required>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="name" class="form-control @error('kota') is-invalid @enderror" id="kota"
                        name="kota" value="{{ old('kota', $welder->kota) }}" required>
                    @error('kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input type="hidden" value="{{ $welder->foto }}" name="oldImage">
                <div class="mb-3">
                    <label for="foto" class="form-label">foto</label>
                    <img src="{{ asset('storage/' . $welder->foto) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    <img class="img-preview1 img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto"
                        id="foto" onchange="previewImage()">
                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                        name="deskripsi" style="height: 100px" required>{{ old('deskripsi', $welder->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary float-end mt-3" type="submit">Edit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }

            //batas

            const image1 = document.querySelector('#foto');
            const imgPreview1 = document.querySelector('.img-preview1');

            imgPreview1.style.display = 'block';

            const oFReader1 = new FileReader();
            oFReader1.readAsDataURL(image1.files[0]);

            oFReader1.onload = function(OFREvent) {
                imgPreview1.src = OFREvent.target.result;
            }
        }
    </script>
@endsection
