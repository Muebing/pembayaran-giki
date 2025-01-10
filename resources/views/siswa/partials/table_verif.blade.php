<tbody>
    @forelse ($daftar as $key => $pembayaran)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $pembayaran['nama_siswa'] }}</td>
            <td>{{ $pembayaran['jenis_pembayaran'] }}</td>
            <td>Rp {{ number_format($pembayaran['nominal'], 0, ',', '.') }}</td>
            <td>{{ $pembayaran['tenggat_waktu'] }}</td>
            <td><span class="badge bg-secondary">{{ $pembayaran['status'] }}</span></td>
            <td>
                <span class="badge {{ $pembayaran['verifikasi'] == 1 ? 'bg-success' : 'bg-warning' }}">
                    {{ $pembayaran['verifikasi'] == 1 ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                </span>
            </td>
            <td>
                <a href="{{ route('verif.pembayaran.show', $pembayaran['id']) }}" class="btn btn-info btn-sm">Lihat</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">Tidak ada data pembayaran untuk diverifikasi.</td>
        </tr>
    @endforelse
</tbody>
