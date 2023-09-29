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
        <h1 class=" text-center fw-bold">{{ strtoupper($title) }}</h1>
    </div>


    <div class="container my-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
            data-bs-delay='{"show":0,"hide":100}'>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                @foreach ($newBeritas as $new)
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/' . $new->thumbnail) }}" height="500px" class="img-fit d-block w-100" style="object-fit: cover;"">
                        <div class="carousel-caption d-none d-md-block bg-black opacity-50">
                            <h5>
                                <a class="text-decoration-none link-light stretched-link fw-bold"
                                    href="{{ route('show', $new->id) }}">{{ $new->title }}</a>
                            </h5>
                            <p> {{ \Illuminate\Support\Str::limit(strip_tags($new->content), 60) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="kategori dropdown">
                    <button class="btn btn-kategori btn-outline-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori Berita
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="list-ktgr dropdown-item" href="/">Semua Berita</a></li>
                        <li class="dropdown-divider"></li>
                        @foreach ($kategoris as $kategori)
                            <li><a class="list-ktgr dropdown-item"
                                    href="{{ route('berita.by_kategori', $kategori->id) }}">{{ $kategori->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col col-md-5">
                <form action="/" method="get">
                    <input type="hidden" name="search" value="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search.." name="search" value=""
                            autocomplete="off">
                        <button class="btn btn-primary rounded-end px-4 border-0" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($search))
            <p class="text-center">Hasil Carian : <span class="fw-bold">{{ $search }}</span></p>
        @endif
        @if ($beritas->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2 g-md-4 mt-3">
                @foreach ($beritas as $berita)
                    <div class="col">
                        <div class="card rounded-3 p-3" style="border:none" data-aos="fade-up" data-aos-duration="1000">
                            <div style="height: 200px; width: 100%; overflow: hidden;">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" class="card-img-top rounded-10 d-block"
                                alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <div class="card-body p-0 mt-3">
                                <div class="card-text d-flex ">
                                    <div class="me-2">
                                        <small class="badge bg-primary">{{ $berita->KategoriBerita->name }}</small>
                                    </div>
                                    <p class="text-secondary mt-1" style="font-size: 12px">{{ $berita->created_at->format('D M Y') }}</p>
                                </div>
                                <h5 class="card-title mb-3">
                                    <p class="text-decoration-none link-dark fw-bold">
                                        {{ $berita->title }}
                                    </p>
                                </h5>
                                <p class="card-text text-secondary">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->content), 60) }}</p>
                                <a class="btn btn-outline-secondary float-end stretched-link"
                                    href="{{ route('show', $berita->id) }}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex align-items-center justify-content-center" style="height: 614px !important">
                <p class="text-center fs-4">Tidak ada berita yang ditemukan.</p>
            </div>
        @endif


        {{-- paginasi --}}
        <div class="row my-4">
            <div class="col-12">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($beritas->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $beritas->previousPageUrl() }}" rel="prev">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for ($i = 1; $i <= $beritas->lastPage(); $i++)
                        <li class="page-item {{ $i == $beritas->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $beritas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($beritas->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $beritas->nextPageUrl() }}" rel="next">Next</a>
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
