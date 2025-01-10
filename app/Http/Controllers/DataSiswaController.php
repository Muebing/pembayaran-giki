<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    function index()
    {
        $dataSiswa = User::where('role', 'siswa')->get();

        $kelasOptions = User::where('role', 'siswa')->distinct()->pluck('kelas');

        return view('staffkepsek.data-siswa', compact('dataSiswa',  'kelasOptions'));
    }
}
