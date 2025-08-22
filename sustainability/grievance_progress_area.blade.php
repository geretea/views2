@extends('layouts.vertical', ['title' => 'Grievance'])

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
        <h4 class="fs-18 fw-semibold m-0">Sustainability</h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="#">Sustainability</a></li>
            <li class="breadcrumb-item active">Grievance</li>
        </ol>
    </div>
</div>
<!-- Table Section -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Progress Grievance</h5>
            </div>
            <div class="card-body">

    <h3 class="mb-4">Grievance Progress Tahun {{ $tahun }}</h3>

    {{-- Tabel --}}
       <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Area</th>
                <th>Nama PT</th>

                <th>Jumlah</th>
                <th>Selesai</th>
                <th>Belum Selesai</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($processed as $item)
			   <tr>
                    <td>{{ $item['area'] }}</td>
                      <td>{{ $item['nama_pt'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>{{ $item['selesai'] }}</td>
                    <td>{{ $item['belum_selesai'] }}</td>
                    <td>{{ $item['persen'] }}%</td>
                </tr>
            @endforeach
        </tbody>
          <tfoot class="fw-bold">
        <tr>
            <td colspan="2">Total</td>
            <td>{{ $total_jumlah }}</td>
            <td>{{ $total_selesai }}</td>
            <td>{{ $total_belum_selesai }}</td>
            <td>{{ $total_persen }}%</td>
        </tr>
    </tfoot>
    </table>
    </div></div></div></div>

    <div class="row">
    <div class="col-md-6">
        <div class="card">
			 {{-- Chart Bar --}}
    <canvas id="barChart" style="height: 400px;"></canvas>

    </div></div>
     <div class="col-md-6">
        <div class="card">
            <div class="card-body">
        <div style="margin: 40px 0; display: flex; justify-content: center;">
    <div style=" height: 280px; position: relative;">
        <canvas id="pieChart"></canvas>
    </div>
</div></div></div>
   
    </div>


@include('documents.indexsja', ['supportingdoc' => $supportingdoc])


@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	 const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($barChartData['labels']) !!},
            datasets: [
                {
                    label: 'Jumlah',
                    data: {!! json_encode($barChartData['jumlah']) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Selesai',
                    data: {!! json_encode($barChartData['selesai']) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } }
        }
    });

    const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
        type: 'pie',
        data: {
			       labels: {!! json_encode($pieChartData['labels']) !!},
            datasets: [{
                data: {!! json_encode($pieChartData['data']) !!},
                backgroundColor: ['#36a2eb', '#ff6384']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection