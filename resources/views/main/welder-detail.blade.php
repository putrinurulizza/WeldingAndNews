@extends('main.layouts.main')

@section('content')
    <div class="container mt-1 mb-3 p-4">
        <div class="d-flex align-items-center mb-4">
            <div class="me-2">
                <a class="btn btn-outline-secondary btn-sm" href="/welding"><i class="fa-regular fa-chevron-left"></i></a>
            </div>
            <div class="mt-2">
                <h1 class="fw-bolder">INFORMASI DETAIL</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="{{ asset('storage/' . $welding->foto) }}" alt="" width="100%">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                <h3 class="fw-bold">{{ strtoupper($welding->name) }}</h3>
                <table class="mt-3 ">
                    <tr>
                        <td>
                            <p class="text-secondary">Pemilik</p>
                        </td>
                        <td>
                            <p class="text-secondary ms-3">: {{ strtoupper($welding->pemilik) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-secondary">Jumlah pekerja</p>
                        </td>
                        <td>
                            <p class="text-secondary ms-3">: {{ strtoupper($welding->jumlah_pekerja) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-secondary">No HP</p>
                        </td>
                        <td>
                            <p class="text-secondary ms-3">: {{ strtoupper($welding->no_hp) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-secondary">Alamat</p>
                        </td>
                        <td>
                            <p class="text-secondary ms-3">: {{ strtoupper($welding->alamat) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-secondary">Kota</p>
                        </td>
                        <td>
                            <p class="text-secondary ms-3">: {{ strtoupper($welding->kota) }}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mb-3">
            <h3 class="mt-3 fw-bold">Deskripsi</h1>
            <p class="mt-3">
                {{ $welding->deskripsi }}
            </p>
        </div>
    </div>
@endsection
