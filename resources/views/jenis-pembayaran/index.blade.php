@extends('layout_admin.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Daftar Jenis Pembayaran</h1>
            <a href="{{ route('jenis-pembayaran.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Jenis Pembayaran
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-hover table-bordered text-center align-middle table-custom">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama Pembayaran</th>
                    <th style="width: 15%;">Nominal</th>
                    <th style="width: 20%;">Metode Pembayaran</th>
                    <th style="width: 20%;">Virtual Account</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jenisPembayaran as $jenis)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jenis->nama_pembayaran }}</td>
                        <td>Rp {{ number_format($jenis->nominal, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($jenis->metode_pembayaran) }}</td>
                        <td>{{ $jenis->virtual_account }}</td>
                        <td>
                            <a href="{{ route('jenis-pembayaran.edit', $jenis->id) }}" class="btn btn-warning btn-custom">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('jenis-pembayaran.destroy', $jenis->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-custom"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted">Tidak ada data jenis pembayaran tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
