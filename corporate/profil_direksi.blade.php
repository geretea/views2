@extends('layouts.vertical', ['title' => 'Direksi'])

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Profile</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Corporate</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="/images/board/{{ $direksi->foto }}" class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                        <div class="overflow-hidden ms-4">
                            <h4 class="m-0 text-dark fs-20">{{ $direksi->nama }}</h4>
                            <p class="my-1 text-muted fs-16">{{ $direksi->jabatan }}</p>
                       
                        </div>
                    </div>
                </div>

                <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active p-2" id="profile_ind_tab" data-bs-toggle="tab" href="#profile_ind" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                            <span class="d-none d-sm-block">Indonesia</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-2" id="profile_eng_tab" data-bs-toggle="tab" href="#profile_eng" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-sitemap-outline"></i></span>
                            <span class="d-none d-sm-block">English</span>
                        </a>
                    </li>
                  
                </ul>

                <div class="tab-content text-muted bg-white">
                    <div class="tab-pane active show pt-4" id="profile_ind" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-md-6 mb-4">
                                <div class="">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Biodata</h5>
                                    <p>{{ $direksi->biodata_ind }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					
					  <div class="tab-pane active show pt-4" id="profile_eng" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-md-6 mb-4">
                                <div class="">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Biodata</h5>
                                    <p>{{ $direksi->biodata_eng }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>



                </div> <!-- Tab panes -->
            </div>
        </div>
    </div>
</div>
@endsection
