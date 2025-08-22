@extends('layouts.vertical', ['title' => 'Dokumen Pendukung'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
    ])
@endsection

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Corporate</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Dokumen</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Pendukung</h5>
				        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Document</button>

            </div>

            <div class="card-body">

                <table class="table table-bordered dt-responsive table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Maker</th>
            <th>Checker</th>
            <th>Approver</th>
            <th>Document ID</th>
            <th>View File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($supportingdoc as $document)
            <tr>
                <td>{{ $document->id }}</td>
                <td>{{ $document->title }}</td>
                <td>{{ $document->description }}</td>
                <td>{{ ucfirst($document->status) }}</td>
                <td>{{ $document->maker->name ?? 'N/A' }}</td>
                <td>{{ $document->checker->name ?? 'N/A' }}</td>
                <td>{{ $document->approver->name ?? 'N/A' }}</td>
                <td>{{ $document->documents_id }}</td> <!-- Menampilkan document_id -->
                <td>
					 <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="action-btn btn-view">Download</a>

                </td>
                <td>
                    @if(auth()->user()->role === 'checker' && $document->status === 'draft')
                        <a href="{{ route('documents.review', $document->id) }}" class="action-btn btn-review">Review</a>
                    @endif
                    @if(auth()->user()->role === 'checker' && $document->status === 'rejected')
    <a href="{{ route('documents.review', $document->id) }}" class="btn btn-warning">Review Ulang</a>
@endif
                    @if(auth()->user()->role === 'approver' && $document->status === 'review')
                        <a href="{{ route('documents.approve', $document->id) }}" class="action-btn btn-approve">Approve</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" style="text-align: center;">No documents found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
   <form action="{{ route('documents.upload', $kebutuhanData->id ?? $id ?? '') }}" method="POST" enctype="multipart/form-data">

				@csrf
                <input type="hidden" name="documents_id" value="{{ $id }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx,.xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

	
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
