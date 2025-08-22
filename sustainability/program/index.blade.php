@extends('layouts.vertical', ['title' => 'Artikel'])

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Program Sustainability {{ isset($kategori) ? '- ' . ucfirst($kategori) : '' }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($blogs->count())
        <div class="row g-4">
            @foreach ($blogs as $blog)
            <div class="col-md-6 col-xl-6">
                <div class="card h-100 custom-card">
                    <a href="{{ url('/sustainability/program/' . $blog->id) }}">
                        <img src="{{ asset('storage/artikel/' . $blog->foto1) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->judul }}</h5>
                        <p class="text-muted mb-1">{{ $blog->created_at->format('d M Y') }}</p>
                        <p class="card-text">{{ Str::limit(strip_tags($blog->sinopsis), 100) }}</p>
                        <a href="{{ url('/sustainability/program/' . $blog->id) }}" class="btn btn-sm btn-outline-primary mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
				    @endforeach
        </div>
    @else
        <p class="text-muted">Belum ada artikel tersedia.</p>
    @endif
</div>
@endsection