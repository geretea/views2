@extends('layouts.vertical', ['title' => 'Profil DSNG'])

@section('content')
<div class="py-3">
    <h4 class="mb-4">Program Sustainability</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <p class="fs-18 fw-semibold mb-1">    
                                            <h2>{{ $detail->judul }}</h2>
                                        </p>
                                        <div class="d-sm-flex align-items-cneter">
                                            <div class="d-flex align-items-center flex-fill">

                                                <div>
                                                    <p class="mb-0 fw-semibold"><span class="fs-11 text-muted fw-normal">{{ $detail->created_at }}</span></p>
                                                    <p class="mb-0 text-muted"></p>
													 </div>
                                            </div>
                                            <div class="mt-sm-0 mt-2">
                                                <span class="badge bg-primary me-1">Corporate</span>
                                                <span class="badge bg-secondary">Informasi Corporate</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);">
                                           @if($detail->foto1)
   
                                        <img src="{{ asset('storage/artikel/' . $detail->foto1) }}" class="card-img rounded-0 blog-details-img" alt="...">
                                    </a>
                                     @endif
                                    <div class="card-body border-bottom border-block-end-dashed">
                                        <div class="d-sm-flex d-block align-items-center justify-content-between">


                                        </div>
                                    </div>
                                    <div class="card-body ">
                                             <blockquote class="blockquote mb-0 text-center">
                                                <p class="fs-16 fw-semibold mb-2 text-dark">
                                             "{!! $detail->sinopsis !!}"
													      </blockquote>
                                        <p class="mb-4 text-muted">
                                               {!! $detail->isi !!} 
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            Related Program
                                        </div>
                                    </div>

                                    <div class="card-body">
    <ul class="list-group">
     @foreach($relatedPosts as $post)
        <li class="list-group-item">
            <div class="d-flex gap-3 flex-wrap align-items-center">
                    <img src="{{ asset('storage/artikel/' . $post->foto1) }}" class="img-fluid" alt="...">
                <div class="flex-fill">
                    <a href="{{ route('corporate.profile_dsng.showprofil', $post->id) }}" class="fs-14 fw-semibold mb-0">
                        {{ $post->judul }}
                    </a>
                    <p class="mb-1 popular-blog-content">
                        {{ Str::limit(strip_tags($post->sinopsis), 100) }}
                    </p>
                    <span class="text-muted fs-11">
                        {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y - H:i') }}
                    </span>
                </div>
                <div>
                    <a href="{{ route('sustainability.program.show', $post->id) }}" class="btn btn-icon btn-light btn-sm rtl-rotate">
                        <i class="ri-arrow-right-s-line">Detail</i>
                    </a>
                </div>
            </div>
        </li>
        @endforeach
		
        @if($relatedPosts->count() == 0)
        <li class="list-group-item text-center text-muted">
            Tidak ada artikel terkait.
        </li>
         @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


</div>
@endsection
			