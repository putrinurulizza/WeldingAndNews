@extends('dashboard.layouts.main')
@section('page-heading', 'Kategori Berita')

@section('content')
    <div class="row">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $loop->iteration }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus{{ $loop->iteration }}">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <x-form_modal :id="'modalEdit' . $loop->iteration" title="Edit Kategori Berita" :route="route('kategori-berita.update', $kategori->id)"
                                    btnTitle="Edit" method='put' primaryBtnStyle="btn-outline-warning"
                                    secBtnStyle="btn-secondary">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Kategori</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $kategori->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </x-form_modal>
                                {{-- End Modal Edit --}}

                                {{-- Modal Hapus Kategori Berita --}}
                                <x-form_modal :id="'modalHapus' . $loop->iteration" title="Hapus Kategori Berita" :route="route('kategori-berita.destroy', $kategori->id)"
                                    btnTitle="Hapus" method='delete' primaryBtnStyle="btn-outline-danger"
                                    secBtnStyle="btn-secondary">
                                    <p class="fs-6">Apakah anda yakin akan menghapus daftar kategori berita
                                        <b>{{ $kategori->name }}</b> ?
                                    </p>
                                    <div class="alert alert-warning fade show" role="alert">
                                        <i class="fa-duotone fa-triangle-exclamation me-2"></i>
                                        Data Kategori Berita Ini Akan Terhapus!
                                    </div>
                                </x-form_modal>
                                {{-- / Modal Hapus Berita --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}

                    {{-- Modal Add --}}
                    <x-form_modal :id="'createModal'" title="Tambah Kategori Berita" :route="route('kategori-berita.store')" btnTitle="Simpan"
                        primaryBtnStyle="btn-outline-primary" secBtnStyle="btn-secondary">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </x-form_modal>
                    {{-- End Modal Add --}}

                </div>
            </div>
        </div>
    </div>
@endsection
