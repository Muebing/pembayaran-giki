@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h1>Edit Jenis Pembayaran</h1>
        <form action="{{ route('jenis-pembayaran.update', $jenisPembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_pembayaran" class="form-label">Nama Pembayaran</label>
                <input type="text" name="nama_pembayaran" class="form-control"
                    value="{{ $jenisPembayaran->nama_pembayaran }}" placeholder="Nama Pembayaran" required>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" name="nominal" class="form-control" value="{{ $jenisPembayaran->nominal }}"
                    placeholder="Masukkan nominal pembayaran" required>
            </div>

            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" required>
                    <option value="Bank Mandiri"
                        {{ $jenisPembayaran->metode_pembayaran == 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                    <option value="Bank BCA" {{ $jenisPembayaran->metode_pembayaran == 'Bank BCA' ? 'selected' : '' }}>Bank
                        BCA</option>
                    <option value="Bank BRI" {{ $jenisPembayaran->metode_pembayaran == 'Bank BRI' ? 'selected' : '' }}>Bank
                        BRI</option>
                    <option value="Bank BNI" {{ $jenisPembayaran->metode_pembayaran == 'Bank BNI' ? 'selected' : '' }}>Bank
                        BNI</option>
                    <option value="Bank CIMB Niaga"
                        {{ $jenisPembayaran->metode_pembayaran == 'Bank CIMB Niaga' ? 'selected' : '' }}>Bank CIMB Niaga
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="virtual_account" class="form-label">Nomor Virtual Account</label>
                <input type="number" name="virtual_account" class="form-control"
                    value="{{ $jenisPembayaran->virtual_account }}" placeholder="Masukkan nomor virtual account" required>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
@endsection
