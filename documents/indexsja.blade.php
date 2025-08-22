
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
				
		   @php
    $jenis_data = DB::table('kebutuhan_data')->where('id', $id)->value('jenis_data');
	$sub_kategori = DB::table('kebutuhan_data')->where('id', $id)->value('sub_kategori');

    @endphp		
                <h5 class="card-title mb-0">Data Pendukung</h5>
				        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Submit Dokumen</button>
				<!--upload modal submit-->
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
	<!-- end modal submit -->
				
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
	  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Review/Reject</button>
					
    <!-- Modal Review -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Review Form (Checker) -->
        <form action="{{ route('documents.review.submit', $document->id ?? '') }}" method="POST" enctype="multipart/form-data">
            @csrf
			
			<div class="modal-header">
                    <h5 class="modal-title">Review Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
			    <div class="mb-3">
                        <label for="description" class="form-label">Checker Comments</label>
            <textarea class="form-control" name="checker_comments" placeholder="Add comments" required></textarea>
                    </div>

			  <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="review">Review</option>
                <option value="rejected">Reject</option>
            </select>
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
@endif
					
	 @if(auth()->user()->role === 'approver' && $document->status === 'review')
                    
    <button class="btn btn-success btn-approve" 
            data-bs-toggle="modal" 
            data-bs-target="#approveModal"
            >
        Approve/Reject
    </button>

<!-- Modal Approve -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{ route('documents.approve.submit', $document->id ?? '') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Approve Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <div class="mb-3">
                <label for="approver_comments" class="form-label">Approver Comments</label>
            <textarea id="approver_comments" name="approver_comments" placeholder="Add comments" class="form-control"></textarea>
    </div>
    <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="approved">Approve</option>
                <option value="rejected">Reject</option>
            </select>
    </div></div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
