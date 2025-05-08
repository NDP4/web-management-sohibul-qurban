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
    </style>
</head>
<body>
    <div class="header">
        <h2>REKAP KEUANGAN QURBAN</h2>
        <p>MASJID AR-RIDHO</p>
        <p>Tahun 1446 H / 2025 M</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Kwitansi</th>
                <th>Nama Sohibul</th>
                <th>Jenis Hewan</th>
                <th>Tipe</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($keuangan as $index => $data)
            @php $total += $data->nominal; @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->tanggal_pembayaran->format('d/m/Y') }}</td>
                <td>{{ $data->nomor_kwitansi }}</td>
                <td>{{ $data->sohibulQurban->nama_sohibul }}</td>
                <td>{{ ucfirst($data->sohibulQurban->jenis_hewan) }}</td>
                <td>
                    @if($data->sohibulQurban->jenis_hewan == 'sapi')
                        {{ $data->sohibulQurban->is_collective ? 'Kolektif (1/7)' : 'Individual' }}
                    @else
                        Individual
                    @endif
                </td>
                <td align="right">Rp {{ number_format($data->nominal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" align="right"><strong>Total Pembayaran:</strong></td>
                <td align="right"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
