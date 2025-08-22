@extends('layouts.vertical', ['title' => 'Profil User'])

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Profil</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="align-items-center">
                    <div class="d-flex align-items-center">
  <img src="{{ asset('storage/' . (Auth::user()->avatar ?? 'default.png')) }}" 
             class="rounded-circle avatar-xxl img-thumbnail float-start" 
             alt="User Avatar">
                       <div class="overflow-hidden ms-4">
            <h4 class="m-0 text-dark fs-20">{{ Auth::user()->name }}</h4>
            <p class="my-1 text-muted fs-16">Departemen/Divisi: {{ Auth::user()->departemen }} | {{ Auth::user()->posisi }}</p>
            <span class="fs-15">
                <i class="mdi mdi-message me-2 align-middle"></i>
                Role: {{ Auth::user()->role }}
            </span>
        </div>
                    </div>
                </div>

      <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active p-2" id="profile_about_tab" data-bs-toggle="tab" href="#profile_about" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                            <span class="d-none d-sm-block">My Documents</span>
                        </a>
                    </li>

                </ul>
    <div class="tab-content text-muted bg-white">
                    <div class="tab-pane active show pt-4" id="profile_about" role="tabpanel">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="">


                <table class="table table-bordered dt-responsive table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Maker</th>
            <th>Checker</th>
            <th>Approver</th>
            <th>View File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($supportingdoc as $document)
            <tr>
  				 <td>{{ $loop->iteration }}</td>                 
				<td>{{ $document->title }}</td>
                <td>{{ $document->created_at }}</td>
                <td>{{ ucfirst($document->status) }}</td>
                <td>{{ $document->maker->name ?? 'N/A' }}</td>
                <td>{{ $document->checker->name ?? 'N/A' }}</td>
                <td>{{ $document->approver->name ?? 'N/A' }}</td>
                <td>
					 <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="action-btn btn-view">View</a>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" style="text-align: center;">No documents found.</td>
            </tr>
        @endforelse
    </tbody>
</table>		
									
                                </div>


                            </div>


                        </div>





                </div> 
            </div>
        </div>
    </div>
</div>
@endsection