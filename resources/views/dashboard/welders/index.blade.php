@extends('dashboard.layouts.main')
@section('page-heading', 'Welders')

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
            <a class="btn btn-primary" href="{{ route('welder.create') }}">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>
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
                                <th>Nama</th>
                                <th>Pemilik</th>
                                <th>Jumlah Pekerja</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($welders as $welder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $welder->name }}</td>
                                    <td>{{ $welder->pemilik }}</td>
                                    <td>{{ $welder->jumlah_pekerja }}</td>
                                    <td>{{ $welder->no_hp }}</td>
                                    <td>{{ $welder->alamat }}</td>
                                    <td>{{ $welder->kota }}</td>
                                    <td>
                                        <button class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#fotoModal{{ $welder->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('welder.edit', $welder->id) }}" class="btn btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="#modalHapus{{ $welder->id }}" class="btn btn-danger"
                                            data-bs-toggle="modal">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- Foto --}}
                                <div class="modal fade" id="fotoModal{{ $welder->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Foto Welder</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        @if ($welder->foto)
                                                            <img class="rounded-3" style="object-fit: cover"
                                                                src="{{ asset('storage/' . $welder->foto) }}"
                                                                alt="" height="250" width="350">
                                                        @else
                                                            <p>Belum Ada Foto</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Foto --}}

                                {{-- Modal Hapus Welding --}}
                                <x-form_modal :id="'modalHapus' . $welder->id" title="Hapus Welder" :route="route('welder.destroy', $welder->id)" btnTitle="Hapus"
                                    method='delete' primaryBtnStyle="btn-outline-danger" secBtnStyle="btn-secondary">
                                    <p class="fs-6">Apakah anda yakin akan menghapus daftar Welder
                                        <b>{{ $welder->name }}</b> ?
                                    </p>
                                    <div class="alert alert-warning fade show" role="alert">
                                        <i class="fa-duotone fa-triangle-exclamation me-2"></i>
                                        Data Welder Ini Akan Terhapus!
                                    </div>
                                </x-form_modal>
                                {{-- / Modal Hapus Welding --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>

@endsection
