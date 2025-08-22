@extends('layouts.vertical', ['title' => 'Timeline'])

@section('content')

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Jejak Langkah </h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Corporate</a></li>
            <li class="breadcrumb-item active">Informasi Corporate</li>
        </ol>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xxl-10">
        <div class="timeline-page position-relative">

           @foreach ($milestone as $index => $item)
    <div class="timeline-section mt-4">
        <div class="row">
            @if ($index % 2 === 0)
                {{-- EVEN = Label kiri, deskripsi kanan --}}
			 <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="duration label-left fs-16 fw-medium position-relative p-2 px-4 fst-italic rounded-2">
                        {{ $item->tanggal }}
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card description-right border-0 overflow-hidden float-start">
                        <div class="card-body">
                            <h6 class="title mb-1 text-capitalize">{{ $item->judul }}</h6>
                            <p class="timeline-subtitle mt-3 mb-0 text-muted">{!! $item->isi !!}</p>

                            @if ($item->foto)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="" class="img-fluid rounded" style="max-height:150px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                {{-- ODD = Deskripsi kiri, label kanan --}}
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card description-left border-0 overflow-hidden float-start">
                        <div class="card-body">
							            <h6 class="title mb-1 text-capitalize">{{ $item->judul }}</h6>
                            <p class="timeline-subtitle mt-3 mb-0 text-muted">{!! $item->isi !!}</p>

                            @if ($item->foto)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="" class="img-fluid rounded" style="max-height:150px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="duration label-right fs-16 fw-medium position-relative p-2 px-4 fst-italic rounded-2">
                        {{ $item->tanggal }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endforeach
			

        </div>
    </div>
</div>

@endsection
