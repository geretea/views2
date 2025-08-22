@extends('layouts.vertical', ['title' => 'Monitoring Air'])

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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Monitoring Air PKS</h4>
            </div>

            <div class="card-body">

    <!-- Form Filter -->

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Pilih PKS</label>
            <select name="pks" class="form-select">
                <option value="all" {{ $filterPks == 'all' ? 'selected' : '' }}>All PKS</option>
                @foreach($listPks as $pks)
                    <option value="{{ $pks }}" {{ $filterPks == $pks ? 'selected' : '' }}>
                        {{ $pks }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tahun</label>
			 <select name="tahun" class="form-select">
                @foreach($listTahun as $tahun)
                    <option value="{{ $tahun }}" {{ $filterTahun == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
   @endforeach
            </select>
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </form>

    @foreach ($data as $pks => $items)
        <h5>PKS: {{ $pks }} - Tahun: {{ $filterTahun }}</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped small">
                <thead class="table-dark">
                    <tr>
                        <th>Item</th>
                        @foreach (range(1,12) as $b)
                            <th>{{ DateTime::createFromFormat('!m', $b)->format('M') }}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                </thead>
				   <tbody>
                    @foreach ($items as $itemName => $bulanData)

@php
    $satuan = [
        'Pemakaian Air' => '(M3)',
        'Kebutuhan Air Proses' => '(M3)',
        'Kebutuhan Air Domestik' => '(Ton)',
        'Jumlah Pengguna Air' => '(Orang)',
        'TBS Olah' => '(Ton)',
        'Produksi CPO' => '(Ton)',
        'Kebutuhan Air Proses/TBS' => '(M3/Ton)',
        'Kebutuhan Air Domestik/TBS' => '(Ton/Ton)',
        'Kebutuhan Air Proses/CPO' => '(M3/Ton)',
        'Kebutuhan Air Domestik/CPO' => '(Ton/Ton)',
        'Kebutuhan Air Domestik/Orang' => '(Ton/Orang)',
    ];
@endphp
                        <tr>

<td>{{ $itemName }} {{ $satuan[$itemName] ?? '' }}</td>

                            @php $total = 0; @endphp
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                $bulan = str_pad($i, 2, '0', STR_PAD_LEFT);
												      $nilai = $bulanData[$bulan] ?? 0;
                                $total += $nilai;
                                @endphp
@if (in_array($itemName, ['Kebutuhan Air Proses/TBS', 'Kebutuhan Air Domestik/TBS', 'Kebutuhan Air Proses/CPO',
'Kebutuhan Air Domestik/CPO', 'Kebutuhan Air Domestik/Orang']))
    <td class="text-end">{{ number_format($nilai, 2, ',', '.') }}</td>
@else
   <td class="text-end">{{ number_format($nilai, 0, ',', '.') }}</td>
@endif
				  @endfor
@if (in_array($itemName, ['Kebutuhan Air Proses/TBS', 'Kebutuhan Air Domestik/TBS', 'Kebutuhan Air Proses/CPO',
'Kebutuhan Air Domestik/CPO', 'Kebutuhan Air Domestik/Orang']))
    <td class="text-end"><strong>{{ number_format($total, 2, ',', '.') }}</strong></td>
@else
                           <td class="text-end"><strong>{{ number_format($total, 0, ',', '.') }}</strong></td>
@endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
  

        </div>
    @endforeach
</div>


</div>
</div></div></div>

@endsection

