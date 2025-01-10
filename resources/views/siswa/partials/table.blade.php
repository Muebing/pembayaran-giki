<table class="table table-striped table-hover table-bordered text-center align-middle table-custom">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 25%;">Nama</th>
            <th style="width: 15%;">NISN</th>
            <th style="width: 15%;">Kelas</th>
            <th style="width: 20%;">Jenis Kelamin</th>
            <th style="width: 20%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($siswa as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-capitalize">{{ $item->name }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ $item->kelas }}</td>
                <td>{{ ucfirst($item->jenis_kelamin) }}</td>
                <td>
                    <a href="{{ route('siswas.show', $item->id) }}" class="btn btn-info btn-custom">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('siswas.edit', $item->id) }}" class="btn btn-warning btn-custom">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('siswas.destroy', $item->id) }}" method="POST" style="display:inline-block;"
                        id="delete-form-{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-custom"
                            onclick="confirmDelete({{ $item->id }})">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Tidak ada data siswa tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Link pagination --}}
<div class="d-flex justify-content-center">
    {{ $siswa->links() }}
</div>
