<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Keuangan Qurban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 12px;
        }
        th {
            background-color: #f0f0f0;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>REKAP KEUANGAN QURBAN</h2>
        <p>MASJID AR-RIDHO</p>
        <p>Tahun 1446 H / 2025 M</p>
    </div>

    <h3>Pemasukan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Kwitansi</th>
                <th>Tanggal</th>
                <th>Nama Sohibul</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keuangan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nomor_kwitansi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y') }}</td>
                <td>{{ $item->sohibulQurban->nama_sohibul }}</td>
                <td class="text-right">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="4" class="text-right"><strong>Total Pemasukan:</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <h3>Pengeluaran</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluaran as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d/m/Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="3" class="text-right">Total Pengeluaran:</td>
                <td class="text-right">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <tr class="total">
            <td colspan="3" class="text-right">Saldo:</td>
            <td class="text-right" style="width: 150px;">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>
