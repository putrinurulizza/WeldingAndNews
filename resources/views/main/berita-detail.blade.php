@extends('main.layouts.main')

@section('content')
    <div class="container px-5">
        <div class="mt-5 mb-3 d-flex">
            <div class="me-2">
                <a class="btn btn-outline-secondary" href="/"><i class="fa-regular fa-chevron-left"></i></a>
            </div>
            <h2 class=" fw-bold text-center">{{ strtoupper($berita->title) }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class=" mb-3" style="height: 400px; width: 100%; overflow: hidden;">
                    <img class="rounded" src="{{ asset('storage/' . $berita->thumbnail) }}" alt=""
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p style="text-align: justify">{!! $berita->content !!}</p>
            </div>
        </div>
    </div>
@endsection
