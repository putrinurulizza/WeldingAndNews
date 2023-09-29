@extends('dashboard.layouts.main')
@section('page-heading', 'Tambah Berita')

@section('content')
    {{-- Button --}}
    <a class="btn btn-outline-secondary" href="{{ route('berita.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
    </a>
    {{-- End Button --}}

    <div class="card mb-3 mt-3">
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="kategoriId" class="form-label">Kategori</label>
                    <select class="form-select @error('kategoriId') is-invalid @enderror" name="kategoriId" id="kategoriId"
                        required>
                        <option disabled selected value="">Pilih Kategori Berita</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ "$kategori->name" }}</option>
                        @endforeach
                    </select>
                    @error('kategoriId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" required>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail"
                        name="thumbnail" onchange="previewImage()" required>
                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Content</label>
                    @error('isi')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="isi" type="hidden" name="content" value="{{ old('isi') }}">
                    <trix-editor input="isi"></trix-editor>
                </div>

                <button class="btn btn-primary float-end mt-3" type="submit">Simpan</button>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage() {
            const image = document.querySelector('#thumbnail');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }
        }
    </script>
    {{-- Trix JS --}}
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endsection
