@extends('layouts.vertical', ['title' => 'Kebutuhan Data'])

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
        <h4 class="fs-18 fw-semibold m-0">Data</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

    <h5 class="card-title mb-0">Hasil Pencarian Data "{{ $keyword }}".</h5>
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>SBU</th>
                            <th>Tujuan Laporan</th>
                            <th>Jenis Data</th>
                           <th>Penyedia Data</th>
                           <th>Pengguna Data</th>
							@if (Auth::user()->role === 'maker')
           				   <th>Action</th>
       						@endif
                        </tr>
                    </thead>
					<tbody>

        @foreach ($results as $item)
            <tr>
        <td>{{ $loop->iteration }}</td>
                <td>{{ $item->sbu }}</td>
                <td>{{ $item->tujuan_laporan }}</td>
                <td>
@if ($item->url)
    <a href="{{ url('/' . $item->kategori . '/' . $item->id . '/' . $item->url) }}">
        {{ $item->jenis_data }}
    </a>
@else
    <a href="{{ route('belumadadata') }}">
        {{ $item->jenis_data }} <span class="text-danger">(Belum Ada Data)</span>
    </a>
@endif
                </td>
                <td>{{ $item->penyedia_data }}</td>
                	<td>{{ $item->user }}</td>
				@if (Auth::user()->role === 'maker')
				
				    <td class="text-nowrap">
                        <a href="{{ route('admin.kebutuhan_data.edit', $item->id) }}?back={{ urlencode(request()->fullUrl()) }}" class="btn btn-primary btn-sm"> Edit</a>
                        <form action="{{ route('admin.kebutuhan_data.delete', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Del</button>
                        </form>
                    </td>
				@endif

            </tr>
        @endforeach
    </tbody>
</table>
			
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
