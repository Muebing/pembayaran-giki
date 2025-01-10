@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h1>Tambah Jenis Pembayaran</h1>
        <form action="{{ route('jenis-pembayaran.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pembayaran">Nama Pembayaran</label>
                <select class="form-control" name="nama_pembayaran" required>
                    <option value="">Pilih Nama Pembayaran</option>
                    <option value="SPP">SPP (Sumbangan Pembinaan Pendidikan)</option>
                    <option value="Uang Seragam">Uang Seragam</option>
                    <option value="Uang Kegiatan">Uang Kegiatan</option>
                    <option value="MPLS">MPLS</option>
                    <option value="Foto & Map Rapot">Foto & Map Rapot</option>
                    <option value="LKS Muslim">LKS Muslim</option>
                    <option value="LKS Non-Muslim">LKS Non-Muslim</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" name="nominal" class="form-control" placeholder="Masukkan nominal pembayaran"
                    required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" id="metodePembayaran" required>
                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>

            <div class="mb-3" id="bank-selection" style="display: none;">
                <label for="bank_transfer" class="form-label">Bank Transfer</label>
                <select name="bank_transfer" class="form-control">
                    <option value="" disabled selected>Pilih Bank</option>
                    <option value="Bank Mandiri">Bank Mandiri</option>
                    <option value="Bank BCA">Bank BCA</option>
                    <option value="Bank BRI">Bank BRI</option>
                    <option value="Bank BNI">Bank BNI</option>
                    <option value="Bank CIMB Niaga">Bank CIMB Niaga</option>
                </select>
            </div>

            <script>
                const metodePembayaran = document.getElementById('metodePembayaran');
                const bankSelection = document.getElementById('bank-selection');

                metodePembayaran.addEventListener('change', function() {
                    if (this.value === 'Bank Transfer') {
                        bankSelection.style.display = 'block';
                    } else {
                        bankSelection.style.display = 'none';
                    }
                });
            </script>



            <div class="mb-3">
                <label for="virtual_account" class="form-label">Nomor Virtual Account</label>
                <input type="number" name="virtual_account" class="form-control"
                    placeholder="Masukkan nomor virtual account" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        document.querySelector('select[name="metode_pembayaran"]').addEventListener('change', function() {
            const cicilanDetails = document.getElementById('cicilan-details');
            const nominalInput = document.querySelector('input[name="nominal"]');
            const cicilanInput = document.querySelector('input[name="cicilan_per_bulan"]');

            if (this.value === 'Cicilan') {
                cicilanDetails.style.display = 'block';
                nominalInput.addEventListener('input', function() {
                    cicilanInput.value = (this.value / 6).toFixed(2);
                });
            } else {
                cicilanDetails.style.display = 'none';
                cicilanInput.value = '';
            }
        });
    </script>
@endsection
