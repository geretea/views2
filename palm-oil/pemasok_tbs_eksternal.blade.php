@extends('layouts.vertical', ['title' => 'Pemasok TBS Eksternal'])
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
        #map_pemasoktbs {height:600px; width: 100%; }
    </style>
@endsection
@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Palm Oil</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Update Informasi</li>
        </ol>
    </div>
    </div>
    
        <!--Map PKS -->
<div class="row">
    <div class="col-12">
        <div class="card">

 <div class="card-header">
                <h5 class="card-title mb-0">Peta Pemasok PKS </h5>  
            </div>


    <div id="map_pemasoktbs"></div>

</div></div></div>
<!-- End Map PKS-- >


<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Petani Pemasok TBS Eksternal</h5>
            </div>

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>PKS</th>
                            <th>Nama Pemasok</th>
                            <th>Status</th>
                            <th>Latitude</th>
                           <th>Longitude</th>
                        </tr>
                    </thead>
					<tbody>
						
@foreach ($datapemasok as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pks }}</td>
                <td>{{ $item->nama_pemasok }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
            </tr>

        @endforeach
											
    </tbody>
</table>
        </div>
    </div>
</div></div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map_pemasoktbs').setView([1.5, 117], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    fetch('/palm-oil/data_pemasok') // route ke data_pemasok()
        .then(res => res.json())
        .then(data => {
            const markerGroup = L.featureGroup();
            let hasValidMarker = false;

            data.forEach(pemasok => {
                const lat = parseFloat(pemasok.latitude);
                const lng = parseFloat(pemasok.longitude);

                if (!isNaN(lat) && !isNaN(lng)) {
                    hasValidMarker = true;
                    const marker = L.marker([lat, lng]).bindPopup(`
                        <b>${pemasok.nama_pemasok}</b><br>${pemasok.pks}<br>${pemasok.status}
                    `);
                    markerGroup.addLayer(marker);
                }
            });

        markerGroup.addTo(map);

            if (hasValidMarker) {
                map.fitBounds(markerGroup.getBounds());
            } else {
                map.setView([-2.5489, 118.0149], 5); // fallback view jika tidak ada marker valid
            }
        })
        .catch(error => {
            console.error('Gagal memuat data pemasok:', error);
        });
</script>

@endsection

