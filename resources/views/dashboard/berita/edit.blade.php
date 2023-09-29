@extends('dashboard.layouts.main')
@section('page-heading', 'Edit Berita')

@section('content')
    {{-- Button --}}
    <a class="btn btn-outline-secondary" href="{{ route('berita.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
    </a>
    {{-- End Button --}}

    <div class="card mb-3 mt-3">
        <div class="card-body">
            <form action="{{ route('berita.update', $beritum->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="kategoriId" class="form-label">Kategori</label>
                    <select class="form-select @error('kategoriId') is-invalid @enderror" name="kategoriId" id="kategoriId"
                        required>
                        @foreach ($kategoris as $kategori)
                            @if (old('kategoriId') == $kategori->id)
                                <option value="{{ $kategori->id }}" selected>
                                    {{ "$kategori->name" }}
                                </option>
                            @else
                                <option value="{{ $kategori->id }}">{{ "$kategori->name" }}
                                </option>
                            @endif
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
                        name="title" value="{{ old('title', $beritum->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug', $beritum->slug) }}" required>
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input type="hidden" value="{{ $beritum->thumbnail }}" name="oldImage">
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <img src="{{ asset('storage/' . $beritum->thumbnail) }}"
                        class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    <img class="img-preview1 img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail"
                        id="thumbnail" onchange="previewImage()">
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
                    <input id="isi" type="hidden" name="content" value="{{ $beritum->content }}">
                    <trix-editor input="isi"></trix-editor>
                </div>

                <button class="btn btn-primary float-end mt-3" type="submit">Edit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        function previewImage() {
            const image = document.querySelector('#thumbnail');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }

            //batas

            const image1 = document.querySelector('#thumbnail');
            const imgPreview1 = document.querySelector('.img-preview1');

            imgPreview1.style.display = 'block';

            const oFReader1 = new FileReader();
            oFReader1.readAsDataURL(image1.files[0]);

            oFReader1.onload = function(OFREvent) {
                imgPreview1.src = OFREvent.target.result;
            }
        }
    </script>
     {{-- Trix JS --}}
     <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endsection
