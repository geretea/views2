@extends('layouts.vertical', ['title' => 'Data PKS'])
@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
    ])
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {height:600px; width: 100%; }
    </style>
@endsection

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Data PKS</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
    </div>
    
        <!--Map PKS -->
<div class="row">
    <div class="col-12">
        <div class="card">

 <div class="card-header">
                <h5 class="card-title mb-0">Peta PKS DSNG </h5>  
            </div>


    <div id="map"></div>

</div></div></div></div>
<!-- End Map PKS-- >


<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Data PKS DSNG </h5>  
 <a href="{{ url('admin/datapks_edit') }}" class="btn btn-outline-primary">
        Edit Data
    </a>
            </div>

            <div class="card-body">


                <table class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama PKS</th>
                            <th>Perusahaan</th>
                            <th>Alamat</th>
                            <th>Kapasitas CPO (ton/jam)</th>
                            <th>Lokasi</th>
                            <th>Latitude</th>
                           <th>Longitude</th>
                        </tr>
                    </thead>
					<tbody>
        @foreach ($datapks as $item)
            <tr>
            <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_pks }}</td>
                <td>{{ $item->nama_pt }}</td>
                <td>{{ $item->alamat }}</td>
				<td>{{ $item->kapasitas_cpo }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
            </tr>
        @endforeach
						
				
						<tr>
							<td colspan='4' ><strong>Total Kapasitas</strong></td>
						
<td><strong>{{ $totalKapasitas[1]['total_kapasitas'] ?? 0 }}</strong></td>
							<td colspan='3'></td>
						</tr>
							
    </tbody>
</table>
			
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([1.5, 117], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Ambil data marker dari API /data
        fetch('/palm-oil/data')
            .then(res => res.json())
            .then(data => {
                data.forEach(pks => {
                    L.marker([pks.latitude, pks.longitude]).addTo(map)
                        .bindPopup(`<b>${pks.nama_pks}</b><br>${pks.nama_pt}<br>Kapasitas: ${pks.kapasitas_cpo} ton/jam`);
                });
            });
    </script>

@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection



@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection


