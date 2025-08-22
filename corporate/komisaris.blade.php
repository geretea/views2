@extends('layouts.vertical', ['title' => ' Direksi'])

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
        <h4 class="fs-18 fw-semibold m-0">Direksi</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Corporate</a></li>
            <li class="breadcrumb-item active">Komisaris</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Dewan Komisaris Perseroan</h5>
            </div>

            <div class="card-body">

                <table  class="table table-bordered dt-responsive table-responsive">
          <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tgl Penunjukkan</th>
               
            </tr>
        </thead>
        <tbody>
                @foreach($dir as $item)
                <tr><td>
 <a href="{{ url('corporate/profil_direksi/' . urlencode($item->nama)) }}">
        {{ $item->nama }}
					</a>     </td>
					<td>{{ $item->jabatan }}</td>
                    <td>{{  date('d M Y', strtotime($item->tgl_penunjukkan_terakhir)) }}</td>
            
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
