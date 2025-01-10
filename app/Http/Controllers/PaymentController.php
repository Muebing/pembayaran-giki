<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Data riwayat pembayaran (bisa diganti dengan data dinamis nanti)
        $payments = [
            ['id' => 1, 'status' => 'Lunas', 'amount' => 500000, 'date' => '2024-10-01'],
            ['id' => 2, 'status' => 'Lunas', 'amount' => 300000, 'date' => '2024-11-01'],
        ];

        // Data tagihan pembayaran (bisa diganti dengan data dinamis nanti)
        $bills = [
            ['id' => 1, 'name' => 'SPP', 'amount' => 1000000, 'due_date' => '2024-11-05'],
            ['id' => 2, 'name' => 'Uang Kegiatan', 'amount' => 250000, 'due_date' => '2024-11-10'],
        ];

        return view('users.riwayat', compact('payments', 'bills'));
    }
}
