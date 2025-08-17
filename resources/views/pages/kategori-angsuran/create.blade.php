@extends('layouts.main')

@section('title', 'Tambah Kategori Angsuran')

@section('content')
<!-- breadcrumb -->
<section class="content-header">
    <h1>KATEGORI ANGSURAN</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('kategori-angsuran.index') }}">KATEGORI ANGSURAN</a></li>
        <li class="active">TAMBAH KATEGORI ANGSURAN</li>
    </ol>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">TAMBAH KATEGORI ANGSURAN</h3>
        </div>
        <form action="{{ route('kategori-angsuran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="col-md-6">

                    <!-- Kategori Pinjaman -->
                    <div class="form-group">
                        <label for="kategori_pinjaman_id">KATEGORI PINJAMAN <span class="text-red">*</span></label>
                        <select name="kategori_pinjaman_id" id="kategori_pinjaman_id" class="form-control select2" required>
                            <option value="" disabled selected>-- PILIH KATEGORI PINJAMAN --</option>
                            @foreach ($kategori_pinjaman as $kp)
                                <option value="{{ $kp->id }}" data-jumlah="{{ $kp->jumlah_pinjaman }}">
                                    {{ $kp->nama_kategori }} - Rp. {{ number_format($kp->jumlah_pinjaman, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_pinjaman_id')
                            <span class="help-block text-red">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <!-- Lama Bulan -->
                    <div class="form-group">
                        <label for="bulan">ANGSURAN SELAMA (BULAN) <span class="text-red">*</span></label>
                        <input type="number" name="bulan" id="bulan" class="form-control" min="1" value="{{ old('bulan') }}" required>
                        @error('bulan')
                            <span class="help-block text-red">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <!-- Bunga -->
                    <div class="form-group">
                        <label for="bunga">BUNGA PER BULAN (%) <span class="text-red">*</span></label>
                        <input type="number" name="bunga" id="bunga" class="form-control" step="0.01" min="0" value="{{ old('bunga') }}" required>
                        @error('bunga')
                            <span class="help-block text-red">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <!-- Nominal -->
                    <div class="form-group">
                        <label for="nominal_display">BAYARAN PER BULAN <span class="text-red">*</span></label>
                        <input type="hidden" name="nominal" id="nominal">
                        <input type="text" class="form-control" id="nominal_display" readonly>
                    </div>

                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                <a href="{{ route('kategori-angsuran.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> KEMBALI</a>
            </div>
        </form>
    </div>
</section>
@endsection

@push('after_script')
<script>
    function formatRupiah(angka, prefix = 'Rp. ') {
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    const kategoriSelect = document.getElementById('kategori_pinjaman_id');
const bulanInput = document.getElementById('bulan');
const bungaInput = document.getElementById('bunga');
const nominalInput = document.getElementById('nominal');
const nominalDisplay = document.getElementById('nominal_display');

function updateNominal() {
    const selected = kategoriSelect.options[kategoriSelect.selectedIndex];
    const jumlah = parseInt(selected?.getAttribute('data-jumlah') || 0);
    const bulan = parseInt(bulanInput?.value || 0);
    const bunga = parseFloat(bungaInput?.value || 0);

    if (jumlah > 0 && bulan > 0 && bunga >= 0) {
        // Pokok per bulan
        const pokokPerBulan = jumlah / bulan;
        // Bunga per bulan (persentase dari pokok pinjaman)
        const bungaPerBulan = jumlah * (bunga / 100);
        // Total angsuran per bulan
        const angsuranPerBulan = Math.ceil(pokokPerBulan + bungaPerBulan);

        nominalInput.value = angsuranPerBulan;
        nominalDisplay.value = formatRupiah(angsuranPerBulan);
    } else {
        nominalInput.value = '';
        nominalDisplay.value = '';
    }
}

kategoriSelect.addEventListener('change', updateNominal);
bulanInput.addEventListener('input', updateNominal);
bungaInput.addEventListener('input', updateNominal);
document.addEventListener('DOMContentLoaded', updateNominal);

</script>
@endpush
