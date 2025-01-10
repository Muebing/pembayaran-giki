@extends('layout_admin.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2 class="fw-bold">Rekap Laporan Pembayaran</h2>
        </div>
        <form action="{{ route('laporan.pembayaran.generate') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="periode_awal">Periode Awal</label>
                <input type="date" class="form-control" name="periode_awal" required>
            </div>
            <div class="form-group">
                <label for="periode_akhir">Periode Akhir</label>
                <input type="date" class="form-control" name="periode_akhir" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="form-control" name="kelas">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k }}">{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Laporan</button>
        </form>
    </div>
@endsection
