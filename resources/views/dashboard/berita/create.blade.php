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
            <form action="{{ route('berita.store') }}" method="post">
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
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" required>
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail"
                        name="thumbnail" required>
                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="editor" class="form-control @error('content') is-invalid @enderror" name="content" required></textarea>
                    @error('content')
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

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
