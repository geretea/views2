@extends('layouts.vertical', ['title' => 'Produksi TBS'])

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
                <h5 class="card-title mb-0">Produksi TBS</h5>
            </div>

            <div class="card-body table-responsive">

				  <table  class="table table-bordered">
                  <thead class="table-dark">
            <tr>
            <th>Perusahaan</th>
            @for ($year = 2024; $year >= 2022; $year--)
                <th colspan='3'>{{ $year }}</th>
          	 @endfor
        </tr>

					  			
						 <tr>
            <th></th>
            @for ($year = 2024; $year >= 2022; $year--)
                <th>Inti</th>
                <th>Plasma</th>
				<th>Total</th>
            @endfor
        </tr>
					  
          <tbody>
    @foreach ($groupedData as $perusahaan => $dataPerusahaan)
        @foreach ($dataPerusahaan->groupBy('perusahaan') as $area => $dataArea)
            <tr>
                <td> <a href="{{ route('palm-oil.tbs_perusahaan', ['id' => $id, 'perusahaan' => $perusahaan]) }}">
					{{ $perusahaan }}</td>
                @for ($year = 2024; $year >= 2022; $year--)
                    <td>
                        {{ number_format(optional($dataArea->firstWhere('tahun', $year))->total_aktual_inti, 0, ',', '.') ?? '-' }}
                    </td>
                    <td>
                        {{ number_format(optional($dataArea->firstWhere('tahun', $year))->total_aktual_plasma, 0, ',', '.') ?? '-' }}
                    </td>
				 <td>
                        {{ number_format(optional($dataArea->firstWhere('tahun', $year))->total, 0, ',', '.') ?? '-' }}
                    </td>
                @endfor
            </tr>
        @endforeach
    @endforeach
			  
</tbody>
<tr class="fw-bold bg-light">
                        <td class="text-center">Total Semua Tahun</td>
                        @foreach ($years as $year)
                            <td>{{ number_format($totalsPerYear[$year]['totalInti'], 0, ',', '.') }}</td>
                            <td>{{ number_format($totalsPerYear[$year]['totalPlasma'], 0, ',', '.') }}</td>
                            <td>{{ number_format($totalsPerYear[$year]['totalOverall'], 0, ',', '.') }}</td>
                        @endforeach
                    </tr>




</table>

			
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
