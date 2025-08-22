@extends('layouts.vertical', ['title' => 'TBS Chart'])

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
        <h4 class="fs-18 fw-semibold m-0">Data Palm Oil</h4>
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
                <h5 class="card-title mb-0">Data Estates</h5>
            </div>

<div class="container">
    <h4 class="mb-4">📊 Grafik TBS Diterima & FFB Processed</h4>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="pks" class="form-label">Pilih PKS</label>
            <select class="form-select" name="pks" id="pks">
                <option value="all" {{ request('pks') == 'all' ? 'selected' : '' }}>All PKS</option>
                @foreach($allPks as $pks)
                    <option value="{{ $pks }}" {{ request('pks') == $pks ? 'selected' : '' }}>{{ $pks }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="mode" class="form-label">Mode</label>
            <select class="form-select" name="mode" id="mode">
                <option value="bulanan" {{ request('mode') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                         <option value="tahunan" {{ request('mode') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-select" name="tahun" id="tahun">
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    <div class="row">
        <div class="col-md-6">
            <canvas id="tbsDiterimaChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="ffbProcessedChart"></canvas>
        </div>
    </div>  <div class="mt-5">
        <h5>📋 Total TBS Diterima & FFB Processed per Bulan</h5>
        <table class="table table-bordered text-end">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Bulan</th>
                    <th>TBS Diterima</th>
                    <th>FFB Processed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $i => $bulan)
                <tr>
                    <td class="text-start">{{ $bulan }}</td>
                    <td>{{ number_format($tbsTotal[$i], 0, ',', '.') }}</td>
                    <td>{{ number_format($ffbTotal[$i], 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="table-secondary">
                    <th class="text-start">Total</th>
                    <th>{{ number_format(array_sum($tbsTotal), 0, ',', '.') }}</th>
                    <th>{{ number_format(array_sum($ffbTotal), 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const tbsData = @json($tbsTotal);
    const ffbData = @json($ffbTotal);

    new Chart(document.getElementById('tbsDiterimaChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'TBS Diterima',
                data: tbsData,
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
    new Chart(document.getElementById('ffbProcessedChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'FFB Processed',
                data: ffbData,
                backgroundColor: '#28a745'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>

         </div>
        </div>
    </div>
</div>


@endsection


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection