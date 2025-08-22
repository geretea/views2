
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Pendukung</h5>
				        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Submit Dokumen</button>

            </div>

            <div class="card-body">

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
                <td>
                    @if(auth()->user()->role === 'checker' && $document->status === 'draft')
                        <a href="{{ route('documents.review', $document->id) }}" class="action-btn btn-review">Review/Reject</a>
                    @endif

                    @if(auth()->user()->role === 'approver' && $document->status === 'review')
                        <a href="{{ route('documents.approve', $document->id) }}" class="action-btn btn-approve">Approve/Reject</a>
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