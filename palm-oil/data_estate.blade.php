@extends('layouts.vertical', ['title' => 'Data Estates'])
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
        <h4 class="fs-18 fw-semibold m-0">Data Estates</h4>
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
                <h5 class="card-title mb-0">Peta Estates DSNG </h5>  
            </div>
<div id="map_estate" style="height: 500px;"></div>

</div></div></div></div>
<!-- End Map PKS-- >


<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Data Estates DSNG </h5>  
 <a href="{{ url('admin/agro/admin_data_estate') }}" class="btn btn-outline-primary">
        Edit Data
    </a>
            </div>

            <div class="card-body">

 <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama PT</th>
                            <th>Nama Estates</th>
                            <th>Alamat</th>
                           <th>Lokasi</th>
							<th>Latitude</th>
                            <th>Longitude</th>
                            <th>Koordinat X</th>
                            <th>Koordinat Y</th>
                           <th>Luas</th>
							 <th>Luas RSPO</th>
                           <th>Luas ISPO</th>

                        </tr>
                    </thead>
					<tbody>
						
        @foreach ($dataestates as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->nama_pt }}</td>
                <td>{{ $item->nama_estate }}({{ $item->akronim }})</td>
				<td>{{ $item->alamat }}</td>
				<td>{{ $item->lokasi }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
				<td>{{ $item->koordinat_x }}</td>
                <td>{{ $item->koordinat_y }}</td>
                <td>{{ $item->luas }}</td>
                <td>{{ $item->luas_rspo }}</td>
                <td>{{ $item->luas_ispo }}</td>

            </tr>

        @endforeach
					
							
    </tbody>
</table>
			
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map_estate').setView([1.5, 117], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

   fetch('/palm-oil/dataest')
    .then(res => res.json())
    .then(data => {
        const markerGroup = L.featureGroup(); 

        data.forEach(estate => {
            const lat = parseFloat(estate.koordinat_y);
            const lng = parseFloat(estate.koordinat_x);

            if (!isNaN(lat) && !isNaN(lng)) {
                const marker = L.marker([lat, lng])
                    .bindPopup(`
                        <b>${estate.nama_estate}</b><br>
                        ${estate.nama_pt}<br>
                        Luas: ${estate.luas ?? 'Tidak diketahui'} ha
                    `);
                
                marker.addTo(markerGroup); 
            }
        });

        markerGroup.addTo(map);
        map.fitBounds(markerGroup.getBounds()); 
    });

</script>


@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection



@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection


