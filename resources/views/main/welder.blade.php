@extends('main.layouts.main')

@section('style')
    <style>
        .card {
            transition: box-shadow 0.4s ease;
        }

        .card:hover {
            box-shadow: 0px 0px 30px -10px rgba(0, 0, 0, 0.63);
            -webkit-box-shadow: 0px 0px 30px -10px rgba(0, 0, 0, 0.63);
            -moz-box-shadow: 0px 0px 30px -10px rgba(0, 0, 0, 0.63);
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-lg-12">
                <h1 class=" fw-bold" style="font-size: 40px">{{ strtoupper($title) }}</h1>
                <p class="mb-3 text-secondary">Semua Informasi Tentang Welder Kami</p>
            </div>
            <div class="col-lg-12">
                <form action="/welding" method="get">
                    <input type="hidden" name="search" value="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Lokasi Kota, Kabupaten" name="search"
                            value="" autocomplete="off">
                        <button class="btn btn-primary rounded-end px-4 border-0" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        @if (isset($search))
            <p class="text-center">Hasil Carian : <span class="fw-bold">{{ $search }}</span></p>
        @endif


        @if ($welders->count() > 0)
            @foreach ($welders as $welder)
                <div class="card mb-5 border-0 bg-transparent" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-sm-6">
                                <a href="{{ route('welding.show', $welder->id) }}" class="stretched-link">
                                    <img class="rounded" src="{{ asset('storage/' . $welder->foto) }}" alt="" style="background-size: cover; width: 100%">
                                </a>
                            </div>
                            <div class="col-lg-8 col-sm-6 col-md-6">
                                <div class="d-flex mt-1">
                                    <p class="mb-2"><span class="badge bg-primary rounded-pill me-2"
                                            style="font-size: 12px">{{ $welder->kota }}</span> </p>
                                    <p class="text-secondary mt-1" style="font-size: 12px">{{ $welder->pemilik }}</p>
                                </div>
                                <h3 class="card-title fw-bold mb-2">{{ $welder->name }}</h3>
                                <p class="card-text text-secondary">
                                    {{ implode(' ', array_slice(str_word_count($welder->deskripsi, 2), 0, 15)) }}...</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="d-flex align-items-center justify-content-center" style="height: 514px !important">
                <p class="text-center fs-4">Tidak ada Welder yang ditemukan.</p>
            </div>
        @endif

        {{-- paginasi --}}
        <div class="row mb-2">
            <div class="col-12">
                <ul class="pagination justify-content-end">
                    {{-- Previous Page Link --}}
                    @if ($welders->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $welders->previousPageUrl() }}" rel="prev">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for ($i = 1; $i <= $welders->lastPage(); $i++)
                        <li class="page-item {{ $i == $welders->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $welders->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($welders->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $welders->nextPageUrl() }}" rel="next">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
