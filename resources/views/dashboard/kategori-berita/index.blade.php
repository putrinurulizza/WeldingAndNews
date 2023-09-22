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
                                <th>#</th>
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
                                        <a href="" class="btn btn-sm btn-info">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="#modalHapus{{ $loop->iteration }}" class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}

                </div>
            </div>
        </div>
    </div>
@endsection
