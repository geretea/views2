@extends('layouts.vertical', ['title' => 'Dokumen Corsec'])

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
            <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
            <li class="breadcrumb-item active">Dokumen Corsec</li>
        </ol>
    </div>
</div>

<!-- Tabel -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            @php
    $jenis_data = DB::table('kebutuhan_data')->where('id', $id)->value('jenis_data');
	$sub_kategori = DB::table('kebutuhan_data')->where('id', $id)->value('sub_kategori');

    @endphp
                <h5 class="card-title mb-0">Dokumen Corsec | {{ $sub_kategori }} | Data: {{ $jenis_data }}</h5>
            </div>
            <div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="col text-end">
@if(auth()->user()->role === 'maker')
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
        Submit Document
    </button>
				</div>
		<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
   <form action="{{ route('corporate.corsec.upload', $id) }}" method="POST" enctype="multipart/form-data">
				@csrf

                <div class="modal-header">
		     @php
    $jenis_data = DB::table('kebutuhan_data')->where('id', $id)->value('jenis_data');
    @endphp
                <h5 class="card-title mb-0">Update Dokumen {{ $jenis_data }}</h5>
            </div> 
	                 <input type="hidden" name="id_dokumen" value="{{ $id }}">

	     <div class="modal-body">
        <div class="mb-3">
        <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
    <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control"> 
</div>
<div class="mb-3">
<label for="nama_pt" class="form-label">Nama PT</label>
    <input type="text" name="nama_pt" id="nama_pt" class="form-control"> 
</div>

<div class="mb-3">
<label for="kategori" class="form-label">Kategori</label>
    <input type="text" name="kategori" id="kategori" class="form-control">
</div>
<div class="mb-3">
<label for="sub_kategori" class="form-label">Sub Kategori</label>
    <input type="text" name="sub_kategori" id="sub_kategori" class="form-control">
</div>
<div class="mb-3">
<label for="tahun" class="form-label">Tahun</label>
    <input type="number" name="tahun" id="tahun" class="form-control">
</div>
<div class="mb-3">
<label for="nama_file" class="form-label">File</label>
    <input type="file" name="nama_file" id="nama_file" class="form-control">
</div>

<div class="mb-3">
<label for="keterangan" class="form-label">Catatan</label>
    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
			 	   </div>	 
            </form>
	   </div>   
		</div>
</div>
@endif

    </div>
</div>

    <div class="card-body">

                <table class="table table-bordered dt-responsive table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>PT</th>
                <th>Tgl Upload</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Maker</th>
                <th>Checker</th>
                <th>Approver</th>
                <th>View File</th>
        @if(auth()->user()->role !== 'user') 
            <th>Actions</th> 
        @endif
            </tr>
        </thead>
        <tbody>
            @forelse($dokumen as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_dokumen }}</td>
                    <td>{{ $item->nama_pt }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->maker->name ?? 'N/A' }}</td>
                <td>{{ $item->checker->name ?? 'N/A' }}</td>
                <td>{{ $item->approver->name ?? 'N/A' }}</td>    
                <td>
				<a href="{{ asset('storage/' . $item->path) }}" target="_blank" class="action-btn btn-view">Download</a>
                </td>   

                @if(auth()->user()->role !== 'user')            
                <td>
					
				 @if(auth()->user()->role === 'maker' && $item->status === 'rejected')
                        <a href="{{ route('corporate.corsec.edit', $item->id) }}" class="action-btn btn-review">Review Ulang</a>
                @endif
					
                    @if(auth()->user()->role === 'checker' && $item->status === 'draft')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                  Review
    </button>

    <!-- Modal Review -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{ route('corporate.corsec.review.submit', $item->id ?? '') }}" method="POST">
        @csrf             
                <div class="modal-header">
                    <h5 class="modal-title">Review Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                <div class="mb-3">

                <label for="checker_comments" class="form-label">Checker Comments</label>
            <textarea id="checker_comments" name="checker_comments" placeholder="Add comments" class="form-control"></textarea>
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
					
		
                    
@if(auth()->user()->role === 'approver' && $item->status === 'review')
    <button class="btn btn-success btn-approve" 
            data-bs-toggle="modal" 
            data-bs-target="#approveModal"
            >
        Approve
    </button>


<!-- Modal Approve -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <!-- Approve Form (Approver) -->
        <form action="{{ route('corporate.corsec.approve.submit', $item->id ?? '') }}" method="POST">
            @csrf
            <label for="approver_comments">Approver Comments</label>
            <textarea id="approver_comments" name="approver_comments" placeholder="Add comments"></textarea>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="approved">Approve</option>
                <option value="rejected">Reject</option>
            </select>

            <button type="submit">Submit Approval</button>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        </div>
    </div>
</div>



</td>
                </tr>
			@endif
	@endif				
            @empty
                <tr>
                    <td colspan="11" class="text-center">Tidak ada dokumen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    </div>	
        </div>
	</div>

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
  @endsection
	  