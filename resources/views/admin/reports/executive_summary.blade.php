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
            font-size: 11pt;
            margin: 0;
            padding: 0;
        }

        .header {
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 22pt;
            font-weight: bold;
            color: #1a365d;
            text-transform: uppercase;
            margin: 0;
        }

        .subtitle {
            font-size: 13pt;
            color: #4a5568;
            margin: 5px 0 0 0;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 4px 0;
            font-size: 10pt;
        }

        .meta-label {
            font-weight: bold;
            color: #718096;
            width: 18%;
        }

        .highlight-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 10.5pt;
        }

        h2 {
            font-size: 14pt;
            color: #1a365d;
            border-left: 4px solid #3b82f6;
            padding-left: 8px;
            margin-top: 25px;
            margin-bottom: 12px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .data-table th {
            background-color: #1a365d;
            color: white;
            font-weight: bold;
            padding: 8px 10px;
            text-align: left;
            font-size: 10pt;
            border: 1px solid #1a365d;
        }

        .data-table td {
            padding: 8px 10px;
            font-size: 10pt;
            border: 1px solid #e2e8f0;
        }

        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-right {
            text-align: right;
        }

        .signature-container {
            margin-top: 60px;
            width: 100%;
        }

        .signature-box {
            text-align: center;
            font-size: 10pt;
            float: right;
            width: 250px;
        }

        .spacer {
            height: 70px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">Lumajang Sports Club</div>
        <div class="subtitle">Laporan Ringkasan Eksekutif Global (Superadmin)</div>
    </div>

    <table class="meta-table">
        <tr>
            <td class="meta-label">Otoritas Akses:</td>
            <td>Superadmin Platform LSC</td>
            <td class="meta-label">Periode Evaluasi:</td>
            <td>{{ now()->translatedFormat('F Y') }}</td>
        </tr>
        <tr>
            <td class="meta-label">Klasifikasi Dokumen:</td>
            <td>Rahasia / Internal Manajemen</td>
            <td class="meta-label">Tanggal Cetak:</td>
            <td>{{ now()->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <div class="highlight-box">
        <strong>Deskripsi Dokumen:</strong> Laporan konsolidasi ini menyajikan ringkasan performa sistem digital LSC.
        Data mencakup total metrik interaksi pengunjung platform (*Web Visitor*) dan akumulasi total volume transaksi
        operasional pemesanan dari seluruh mitra venue olahraga yang terdaftar secara terpusat.
    </div>

    <h2>1. Analisis Trafik & Kunjungan Digital (Web Visitor)</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Metrik Monitor</th>
                <th>Total Akumulasi (Bulan Ini)</th>
                <th>Deskripsi Operasional</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Page Views</strong></td>
                <td>{{ number_format($totalPageViews, 0, ',', '.') }} Kali Dibuka</td>
                <td>Mengukur akumulasi total klik dan muat halaman oleh publik.</td>
            </tr>
            <tr>
                <td><strong>Sessions</strong></td>
                <td>{{ number_format($totalSessions, 0, ',', '.') }} Sesi Unik</td>
                <td>Mengukur jumlah perangkat/browser unik yang aktif berinteraksi.</td>
            </tr>
        </tbody>
    </table>

    <h2>2. Rekapitulasi Tren Booking Seluruh Venue (6 Bulan Terakhir)</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Periode Bulan</th>
                <th class="text-right">Total Transaksi Selesai</th>
                <th>Status Validasi Jaringan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $row)
                <tr>
                    <td>{{ $row['bulan'] }}</td>
                    <td class="text-right" style="font-weight: bold;">{{ $row['jumlah'] }} Kali Reservasi</td>
                    <td style="color: #10b981;">Terverifikasi</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature-box">
            Lumajang, {{ now()->translatedFormat('d F Y') }}<br>
            <strong>Direktur Utama LSC / Superadmin</strong>
            <div class="spacer"></div>
            (...................................................)<br>
            Otorisasi Sistem Terpusat
        </div>
    </div>

</body>

</html>
