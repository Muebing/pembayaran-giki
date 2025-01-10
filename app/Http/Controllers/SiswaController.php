<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Tentukan jumlah data per halaman
        $perPage = 10;

        // Query data siswa dengan role 'siswa' dan filter pencarian jika ada
        $siswa = User::where('role', 'siswa')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate($perPage); // Menambahkan pagination

        // Jika permintaan berasal dari AJAX (pada pencarian), render partial view
        if ($request->ajax()) {
            return view('siswa.partials.table', compact('siswa'))->render();
        }

        // Kirim data siswa dengan pagination saat halaman awal dimuat
        return view('siswa.index', compact('siswa'));
    }


    // public function create()

    // {
    //     return view('siswa.create');
    // }

    // public function store(Request $request)

    // {
    //     $request->validate([
    //         'nama' => 'required',
    //         'nisn' => 'required',
    //         'alamat' => 'required',
    //         'kelas' => 'required',
    //         'jenis_kelamin' => 'required',
    //         'agama' => 'required',
    //         'tempat_lahir' => 'required',
    //         'tanggal_lahir' => 'required',
    //         'no_telp' => 'required',
    //         'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $siswa = new Siswa();
    //     $siswa->nama = $request->nama;
    //     $siswa->nisn = $request->nisn;
    //     $siswa->alamat = $request->alamat;
    //     $siswa->kelas = $request->kelas;
    //     $siswa->jenis_kelamin = $request->jenis_kelamin;
    //     $siswa->agama = $request->agama;
    //     $siswa->tempat_lahir = $request->tempat_lahir;
    //     $siswa->tanggal_lahir = $request->tanggal_lahir;
    //     $siswa->no_telp = $request->no_telp;

    //     if ($request->hasFile('foto')) {
    //         $fotoPath = $request->file('foto')->store('fotos', 'public');
    //         $siswa->foto = basename($fotoPath);
    //     }

    //     $siswa->save();

    //     return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dissimpan');
    // }

    public function show($siswa)

    {
        $siswa = User::find($siswa);
        return view('siswa.show', compact('siswa'));
    }

    public function edit($siswa)

    {
        $siswa = User::findOrFail($siswa);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name' => 'required',
            'nisn' => 'required',
            'alamat' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'nisn', 'alamat', 'kelas', 'jenis_kelamin', 'agama', 'tempat_lahir', 'tanggal_lahir', 'no_telp']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::exists('public/' . $siswa->foto)) {
                Storage::delete('public/' . $siswa->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('foto', 'public'); // Simpan ke storage/foto
            $data['foto'] = $fotoPath; // Simpan path foto baru ke array data
        }

        $siswa->update($data);

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil diupdate');
    }

    public function destroy($siswa)

    {
        $siswa = User::find($siswa);
        $siswa->delete();
        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
