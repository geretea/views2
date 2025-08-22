@extends('layouts.vertical', ['title' => 'New Planting'])

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
        <h4 class="fs-18 fw-semibold m-0">Area Statement</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Update Informasi</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Perkembangan New Planting Bulanan </h4>
</h5>
            </div>

            <div class="card-body" style="overflow-x: auto;">

    <h4>New Planting:  {{ $perusahaan }}</h4>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Tahun</th>
                <th></th>
                @foreach (range(1, 12) as $i)
                    <th>{{ DateTime::createFromFormat('!m', $i)->format('M') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($data as $tahun => $items)
            {{-- Inti --}}
            <tr>
                <td rowspan='2'>{{ $tahun }}</td>
                <td>Inti</td>
                @php $total = 0; @endphp
                @foreach (range(1, 12) as $i)
                    @php
                        $bulan = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $row = $items->firstWhere('bulan', $bulan);

                        $val = isset($row->new_planting_inti) ? floatval(str_replace(',', '.', $row->new_planting_inti)) : 0;
                        $total += $val;
                    @endphp
                    <td>{{ number_format($val, 0, ',', '.') }}</td>
                @endforeach
            </tr>
            {{-- Plasma --}}
            <tr>
                <td>Plasma</td>
                @php $total = 0; @endphp
                @foreach (range(1, 12) as $i)
                    @php
                        $bulan = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $row = $items->firstWhere('bulan', $bulan);
                        $val = isset($row->new_planting_plasma) ? floatval(str_replace(',', '.', $row->new_planting_plasma)) : 0;
                        $total += $val;
                    @endphp
             <td>{{ number_format($val, 0, ',', '.') }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection