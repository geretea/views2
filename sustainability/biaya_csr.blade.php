@extends('layouts.vertical', ['title' => 'Biaya CSR'])
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
        <h4 class="fs-18 fw-semibold m-0">CSR</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Sustainability</a></li>
            <li class="breadcrumb-item active">CSR</li>
        </ol>
    </div>
    </div>
    <!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Biaya CSR</h5>  
             </div>

            <div class="card-body">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Biaya CSR</th>
            <th>{{ $tahunList[0] }}</th>
            <th>{{ $tahunList[1] }}</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $kategori => $items)
            <tr><th colspan="4">{{ $kategori }}</th></tr>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['sub_kategori'] }}</td>
                    <td>{{ number_format($item['tahun2024'], 0, ',', '.') }}</td>
                    <td>{{ number_format($item['tahun2023'], 0, ',', '.') }}</td>
                    <td>{{ $item['persen'] }}%</td>
                </tr>
            @endforeach
        @endforeach
        <tr style="font-weight: bold; background:#eee;">
            <td>Total</td>
            <td>{{ number_format($total2024, 0, ',', '.') }}</td>
            <td>{{ number_format($total2023, 0, ',', '.') }}</td>
            <td></td>
        </tr>
    </tbody>
</table>

            </div>
        </div>
    </div>
</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])
@endsection
