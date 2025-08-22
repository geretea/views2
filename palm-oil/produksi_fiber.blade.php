@extends('layouts.vertical', ['title' => 'Produksi Fiber'])

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
        <h4 class="fs-18 fw-semibold m-0">Produksi Fiber PKS</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
                     <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>



<div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Produksi Fiber 2024       </div>
            <div class="card-body">

               <table class="table table-striped w-100 nowrap">
    <thead class="table-dark">
        <tr>
            <th rowspan="2">PKS</th>
            @foreach($bulanList as $bln)
                <th colspan="2">{{ DateTime::createFromFormat('!m', $bln)->format('F') }}</th>
            @endforeach
            <th colspan="2">TOTAL</th>
        </tr>
        <tr>
            @foreach ($bulanList as $bln)
                <th>Prod</th>
                <th>App</th>
            @endforeach
            <th>Prod</th>
            <th>App</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $pks => $data)
            <tr>
                <td>{{ $pks }}</td>
                @php
                    $totalProd = 0;
                    $totalApp = 0;
                @endphp
                @foreach ($bulanList as $bln)
                    <td>{{ number_format($data['produksi'][$bln] ?? 0, 2) }}</td>
                    <td>{{ number_format($data['aplikasi'][$bln] ?? 0, 2) }}</td>
                    @php
                        $totalProd += $data['produksi'][$bln] ?? 0;
                        $totalApp += $data['aplikasi'][$bln] ?? 0;
                    @endphp
                @endforeach
                <td class="fw-bold">{{ number_format($totalProd, 2) }}</td>
                <td class="fw-bold">{{ number_format($totalApp, 2) }}</td>
            </tr>
        @endforeach

        {{-- Grand Total --}}
        <tr class="table-warning fw-bold">
            <td>TOTAL</td>
            @php
                $gtProd = 0;
                $gtApp = 0;
            @endphp
            @foreach ($bulanList as $bln)
                <td>{{ number_format($totalPerBulan[$bln]['produksi'] ?? 0, 2) }}</td>
                <td>{{ number_format($totalPerBulan[$bln]['aplikasi'] ?? 0, 2) }}</td>
                @php
                    $gtProd += $totalPerBulan[$bln]['produksi'] ?? 0;
                    $gtApp += $totalPerBulan[$bln]['aplikasi'] ?? 0;
                @endphp
            @endforeach
            <td>{{ number_format($gtProd, 2) }}</td>
            <td>{{ number_format($gtApp, 2) }}</td>
        </tr>
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