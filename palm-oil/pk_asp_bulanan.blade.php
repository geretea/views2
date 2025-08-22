@extends('layouts.vertical', ['title' => 'ASP Bulanan'])

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
        <h4 class="fs-18 fw-semibold m-0">Palm Oil</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Kinerja Operasional</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"> PK ASP</h5>  
 </div>

            <div class="card-body">
<h5 class="mt-0">Trend ASP Bulanan</h5>

<form method="GET" class="row g-2 mb-0">
    <div class="col-md-4">
        <select name="perusahaan" class="form-select">
            <option value="all" {{ $filterPerusahaan === 'all' ? 'selected' : '' }}>All PT</option>
            @foreach ($perusahaanList as $perusahaan)
                <option value="{{ $perusahaan }}" {{ $filterPerusahaan === $perusahaan ? 'selected' : '' }}>{{ $perusahaan }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="tahun" class="form-select">
            @foreach ($tahunList as $tahun)
                <option value="{{ $tahun }}" {{ $filterTahun == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" type="submit">Tampilkan</button>
    </div>
</form>
<!-- Chart -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
               <div class="card-body">
          <canvas id="aspLineChart" height="290"></canvas>
       </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="card">
   <div class="card-body">
    <table class="table table-bordered table-sm text-end">
    <thead class="table-dark">
        <tr>
            <th>PKS</th>
            <th>Bulan</th>
            <th>ASP (Rp/Kg)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataBulanan as $row)
            @php
                $bulan = DateTime::createFromFormat('!m', $row->bulan)->format('F');
                $asp = $row->total_volume > 0 ? ($row->total_revenue / $row->total_volume) : '-';
            @endphp
            <tr>
                    <td class="text-start">{{ $filterPerusahaan === 'all' ? 'All PT' : $row->perusahaan }}</td>
</td>
                <td class="text-start">{{ $bulan }}</td>
                <td>{{ is_numeric($asp) ? number_format($asp, 3, '.', ',') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
    </div></div></div>
			
            </div>
        </div>
    </div>
</div>

@include('documents.indexsja', ['supportingdoc' => $supportingdoc])


@endsection


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('aspLineChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'ASP (Rp)',
            data: {!! json_encode($chartValues) !!},
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.2)',
            tension: 0.4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
text: 'Trend ASP per Bulan - {{ $filterPerusahaan === "all" ? "All PT" : $filterPerusahaan }} ({{ $filterTahun }})',
                font: {
                    size: 16
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const value = context.raw;
                        return new Intl.NumberFormat('id-ID', {
                            minimumFractionDigits: 3,
                            maximumFractionDigits: 3
                        }).format(value);
                    }
                }
            }
        },
         y: {
        beginAtZero: false, 
        suggestedMin: 22,
        suggestedMax: 25,
        title: {
            display: true,
            text: 'ASP (Rp/Kg)'
        }
    }
}
});
</script>

@endsection
