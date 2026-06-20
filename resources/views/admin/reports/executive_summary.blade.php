<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ringkasan Eksekutif Superadmin - LSC</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #2d3748;
            line-height: 1.4;
            font-size: 10.5pt;
            margin: 0;
            padding: 0;
        }

        .header {
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .title {
            font-size: 22pt;
            font-weight: bold;
            color: #1a365d;
            text-transform: uppercase;
            margin: 0;
        }

        .subtitle {
            font-size: 12pt;
            color: #4a5568;
            margin: 5px 0 0 0;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 3px 0;
            font-size: 9.5pt;
        }

        .meta-label {
            font-weight: bold;
            color: #718096;
            width: 20%;
        }

        .highlight-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .highlight-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 10pt;
        }

        .income-box {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 11pt;
            color: #065f46;
            margin-top: 10px;
        }

        h2 {
            font-size: 13pt;
            color: #1a365d;
            border-left: 4px solid #3b82f6;
            padding-left: 8px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .data-table th {
            background-color: #1a365d;
            color: white;
            font-weight: bold;
            padding: 7px 10px;
            text-align: left;
            font-size: 9.5pt;
            border: 1px solid #1a365d;
        }

        .data-table td {
            padding: 7px 10px;
            font-size: 9.5pt;
            border: 1px solid #e2e8f0;
        }

        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .signature-container {
            margin-top: 40px;
            width: 100%;
        }

        .signature-box {
            text-align: center;
            font-size: 9.5pt;
            float: right;
            width: 250px;
        }

        .spacer {
            height: 60px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">Lumajang Sports Club</div>
        <div class="subtitle">Laporan Konsolidasi Eksekutif Global (Superadmin)</div>
    </div>

    <table class="meta-table">
        <tr>
            <td class="meta-label">Otoritas Akses:</td>
            <td>{{ Auth::user()->name }} - {{ Auth::user()->role->role_name }}</td>
            <td class="meta-label">Periode Evaluasi:</td>
            <td>{{ now()->translatedFormat('F Y') }}</td>
        </tr>
        <tr>
            <td class="meta-label">Klasifikasi Dokumen:</td>
            <td>Internal Manajemen</td>
            <td class="meta-label">Tanggal Cetak:</td>
            <td>{{ now()->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <div class="highlight-container">
        <div class="highlight-box">
            <strong>Deskripsi Dokumen:</strong> Laporan berkala ini menyajikan analisis performa ekosistem digital LSC
            secara terpusat. Mencakup statistik peninjauan trafik situs web publik, status pertumbuhan kuantitas
            keanggotaan pengguna, volume reservasi sewa aset lapangan, serta nilai konversi profit finansial transaksi
            kelas komunitas olahraga.
        </div>

        <div class="income-box">
            <strong>Ringkasan Finansial:</strong> Total Akumulasi Penghasilan Komunitas (6 Bulan Terakhir):
            <strong style="font-size: 13pt;">Rp{{ number_format($grandTotalPenghasilan, 0, ',', '.') }}</strong>
        </div>
    </div>

    <h2>1. Ikhtisar Status Operasional & Pengguna Aktif (Bulan Ini)</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Indikator Parameter</th>
                <th>Capaian Angka Sistem</th>
                <th>Cakupan Deskripsi Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total Pengguna</strong></td>
                <td style="font-weight: bold;">{{ number_format($totalPengguna, 0, ',', '.') }} Akun</td>
                <td>Akumulasi kuantitas masyarakat umum yang memiliki profil aktif di sistem LSC.</td>
            </tr>
            <tr>
                <td><strong>Page Views (Trafik Klik Halaman)</strong></td>
                <td>{{ number_format($totalPageViews, 0, ',', '.') }} Akses Halaman</td>
                <td>Total volume intensitas halaman web dikunjungi oleh publik luar.</td>
            </tr>
            <tr>
                <td><strong>Sessions (Sesi Perangkat Unik)</strong></td>
                <td>{{ number_format($totalSessions, 0, ',', '.') }} Sesi Unik</td>
                <td>Jumlah identitas browser unik yang terekam melakukan interaksi riil.</td>
            </tr>
        </tbody>
    </table>

    <h2>2. Rekapitulasi & Tren Produktivitas Jaringan LSC (6 Bulan Terakhir)</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Periode Bulan</th>
                <th class="text-center">Volume Booking Lapangan</th>
                <th class="text-center">Transaksi Sukses Komunitas</th>
                <th class="text-right">Omzet</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $row)
                <tr>
                    <td>{{ $row['bulan'] }}</td>
                    <td class="text-center">{{ $row['booking_count'] }} Kali</td>
                    <td class="text-center">{{ $row['komunitas_count'] }} Transaksi</td>
                    <td class="text-right" style="font-weight: bold; color: #047857;">
                        Rp{{ number_format($row['pemasukan'], 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature-box">
            Lumajang, {{ now()->translatedFormat('d F Y') }}<br>
            <strong> Superadmin</strong>
            <div class="spacer"></div>
            (...................................................)<br>
            Otorisasi Sistem Terpusat
        </div>
    </div>

</body>

</html>
