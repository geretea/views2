@extends('layouts.vertical', ['title' => 'Penggunaan Air'])
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
        <h4 class="fs-18 fw-semibold m-0">Air</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Sustainability</a></li>
            <li class="breadcrumb-item active">Air</li>
        </ol>
    </div>
    </div>
    <!-- Datatables -->
<div class="row"> <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Penarikan Air</h5>
                </div>
                <div class="card-body">
                    @php
                        $kategori1 = 'Penarikan Air';
                        $rows1 = $data[$kategori1] ?? collect();
                        $sumberAir = ['air_tanah'=>'Air Tanah', 'air_permukaan'=>'Air Permukaan', 'air_pam'=>'Air PAM', 'air_tampungan'=>'Air Tampungan'];
                    @endphp
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Sumber Air</th>
                                @foreach($tahunRange as $tahun)
                                    <th>{{ $tahun }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sumberAir as $field => $label)
                                <tr>
                                    <td style="text-align:left">{{ $label }}</td>
                                    @foreach($tahunRange as $tahun)
								<td>{{ number_format($rows1->firstWhere('tahun',$tahun)->{$field} ?? 0, 0, ',', '.') }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            <tr class="fw-bold table-secondary">
                                <td>Total</td>
                                @foreach($tahunRange as $tahun)
                                    <td>{{ number_format($rows1->firstWhere('tahun',$tahun)->total ?? 0, 0, ',', '.') }}</td>

                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pemakaian Air</h5>
                </div>
                <div class="card-body">
                    @php
                        $kategori2 = 'Pemakaian Air';
                        $rows2 = $data[$kategori2] ?? collect();
                    @endphp
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Sumber Air</th>
                                @foreach($tahunRange as $tahun)
                                    <th>{{ $tahun }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sumberAir as $field => $label)
                                <tr>
                                    <td style="text-align:left">{{ $label }}</td>
                                    @foreach($tahunRange as $tahun)
								<td>{{ number_format($rows2->firstWhere('tahun',$tahun)->{$field} ?? 0, 0, ',', '.') }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            <tr class="fw-bold table-secondary">
                                <td>Total</td>
                                @foreach($tahunRange as $tahun)
                                    <td>{{ number_format($rows2->firstWhere('tahun',$tahun)->total ?? 0, 0, ',', '.') }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])
@endsection
