@extends('layouts.vertical', ['title' => 'FFA CPO'])

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
<!-- Datatables Sales Volume-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">FFA CPO</h5>  
 <a href="{{ url('palm-oil/' . $id . '/ffa_cpo_pks') }}" class="btn btn-outline-primary">
        FFA CPO Bulanan
    </a>
            </div>

            <div class="card-body">
				
			<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>PKS</th>
			<th>Area</th>
            @foreach($tahunList as $t)
                <th>{{ $t }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($pivotTahunan as $pks => $data)
            <tr>
                <td>{{ $pks }}</td>
				 <td>{{ $data['area'] ?? '-' }}</td>
                @foreach($tahunList as $t)
                    <td class="text-end">
                        {{ $data[$t] !== null ? number_format($data[$t], 2) : '-' }}
                    </td>
                @endforeach
            </tr>
        @endforeach

        {{-- Baris rata-rata semua PKS --}}
        <tr class="fw-bold table-secondary">
            <td>All PKS</td>
			<td></td>
            @foreach($tahunList as $t)
                <td class="text-end">
                    {{ $avgPerTahun[$t] !== null ? number_format($avgPerTahun[$t], 2) : '-' }}
                </td>
            @endforeach
        </tr>
    </tbody>
</table>


    <div id="detailBulanan" class="mt-4" style="display:none;">
        <h5>Detail Bulanan: <span id="titleDetail"></span></h5>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Rata FFA</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
				</div></div></div>
</div>
	
	@include('documents.indexsja', ['supportingdoc' => $supportingdoc])


	
	
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.row-tahunan').forEach(function(row) {
        row.addEventListener('click', function() {
            let pks = this.dataset.pks;
            let tahun = this.dataset.tahun;
            let detailRow = document.getElementById(`bulanan-${pks}-${tahun}`);
            let tbodyBulanan = detailRow.querySelector('tbody');

            // Toggle tampil/sembunyi
            if (detailRow.classList.contains('d-none')) {
                detailRow.classList.remove('d-none');

                // Cek apakah sudah pernah di-load
                if (!tbodyBulanan.hasChildNodes()) {
                    fetch(`/ffa-cpo/bulanan/${pks}/${tahun}`)
                        .then(res => res.json())
                        .then(data => {
                            tbodyBulanan.innerHTML = '';
                            data.forEach(item => {
                                let bulanNama = bulanLabel(item.bulan);
                                tbodyBulanan.innerHTML += `
                                    <tr>
                                        <td>${bulanNama}</td>
                                        <td>${parseFloat(item.rata_ffa).toFixed(2)}</td>
                                    </tr>
                                `;
                            });
                        })
                        .catch(err => {
                            tbodyBulanan.innerHTML = `<tr><td colspan="2">Gagal memuat data</td></tr>`;
                        });
                }
            } else {
                detailRow.classList.add('d-none');
            }
        });
    });

    function bulanLabel(bulan) {
        const namaBulan = {
            '01': 'Jan', '02': 'Feb', '03': 'Mar', '04': 'Apr',
            '05': 'Mei', '06': 'Jun', '07': 'Jul', '08': 'Agu',
            '09': 'Sep', '10': 'Okt', '11': 'Nov', '12': 'Des'
        };
        return namaBulan[bulan] || bulan;
    }
});
</script>
@endpush
			
    
@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
