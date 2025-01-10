@extends('layout_admin.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2 class="fw-bold">Daftar Siswa</h2>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        {{-- Pencarian --}}
        <div class="mb-3">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari berdasarkan nama siswa"
                    value="{{ request('search') }}">
            </div>
        </div>

        {{-- Tabel Data Siswa --}}
        <div id="siswa-table">
            {{-- Tampilkan tabel siswa --}}
            @include('siswa.partials.table', ['siswa' => $siswa])

        </div>
    </div>

    {{-- Konfirmasi Hapus --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
