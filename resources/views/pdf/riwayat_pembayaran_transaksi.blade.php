<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .header img {
            width: 80px;
            height: auto;
        }

        .text {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        .signature {
            margin-bottom: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/img/Logo_SMK.png') }}" alt="Logo Sekolah">
        <div class="text">
            <h3>SMA GITA KIRTI 2 JAKARTA</h3>
            <p>Jl. Sunter Jaya IV/2, Kel. Sunter Jaya, Kec. Tanjung Priok Jakarta Utara</p>
            <p>Telp: 0216-508-977 | Email: sma.gitakirtti2jkt@gmail.com</p>
        </div>
    </div>

    <h4 style="text-align: center;">Bukti Pembayaran Siswa</h4>

    <table>
        <tr>
            <td><strong>Nama Siswa:</strong> {{ $siswa->name }}</td>
            <td><strong>NIS:</strong> {{ $siswa->nisn }}</td>
        </tr>
        <tr>
            <td><strong>Kelas:</strong> {{ $siswa->kelas }}</td>
            <td><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tagihan</th>
                <th>Status</th>
                <th>Nominal (Rp)</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $tagihan->jenisPembayaran->nama_pembayaran }}</td>
                <td>{{ ucfirst($tagihan->status) }}</td>
                <td class="text-right">{{ number_format($tagihan->jenisPembayaran->nominal, 0, ',', '.') }}</td>
                <td>{{ $tagihan->tanggal_pembayaran ? \Carbon\Carbon::parse($tagihan->tanggal_pembayaran)->format('d/m/Y') : '-' }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p style="text-align: right; margin-top: 20px;">Jakarta, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <div style="text-align: right; margin-top: 10px;">
            <p style="margin: 0;"><strong>H. Mujur, S.Ag.</strong></p>
            <p style="border-top: 1px solid black; display: inline-block; width: 200px; margin: 5px auto 0;"></p>
            <p style="margin: 0;">Kepala Sekolah</p>
        </div>
    </div>

</body>

</html>
