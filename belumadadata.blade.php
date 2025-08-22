@extends('layouts.error', ['title' => 'Belum Ada Data'])

@section('content')
<div class="text-center">
    <div class="mb-0 text-center">
        <a href="{{ route('any', 'index') }}" class="auth-logo">
            <img src="/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="45" />
        </a>
    </div>

    <div class="maintenance-img">
        <img src="{{ asset('storage/images/tidakada.jpg') }}" class="img-fluid" alt="Belum Ada Data">
    </div>
    
    <div class="text-center">
        <h3 class="mt-0 fw-semibold text-black text-capitalize">Datanya belum ada, bro</h3>
        <p class="text-muted">Dari Jawa Tengah ke Kalimantan<br>
                              Mampir sebentar di Balikpapan<br>
                              Datanya belum nongol di tampilan<br>
                             Sabar ya bro, sedang disiapkan.</p>
    </div>

    <a class="btn btn-primary mt-3 me-1" href="{{ route('any', 'index') }}">Back to Home</a>
</div>
@endsection