@extends('layouts.vertical', ['title' => 'Peristiwa Penting'])

@section('content')

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Informasi Corporate</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Corporate</a></li>
            <li class="breadcrumb-item active">Informasi Corporate</li>
        </ol>
    </div>
</div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Peristiwa Penting</h5>
            </div>

            <div class="card-body">
				   @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($peristiwapenting->count())
        <div class="row g-4">
            @foreach ($peristiwapenting as $blog)
            <div class="col-md-6 col-xl-6">
                <div class="card h-100 custom-card">
                    <a href="{{ url('/corporate/peristiwa_penting/' . $blog->id) }}">
                        <img src="{{ asset('storage/artikel/' . $blog->foto1) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->judul }}</h5>
<p class="mb-1">Tanggal Peristiwa Penting: {{ $blog->tanggal }}</p>
  <p class="text-muted mb-1">Created at {{ $blog->created_at->format('d M Y') }}</p>
                        <p class="card-text">{{ Str::limit(strip_tags($blog->sinopsis), 100) }}</p>
                        <a href="{{ url('/corporate/peristiwa_penting/' . $blog->id) }}" class="btn btn-sm btn-outline-primary mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
					</div>
    @else
        <p class="text-muted">Belum ada artikel tersedia.</p>
    @endif
</div>
</div></div></div></div>

@endsection
