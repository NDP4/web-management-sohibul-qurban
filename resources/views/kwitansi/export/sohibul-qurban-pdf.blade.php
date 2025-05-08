<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Data Sohibul Qurban</title>
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
        <h2>REKAP DATA SOHIBUL QURBAN</h2>
        <p>MASJID AR-RIDHO</p>
        <p>Tahun 1446 H / 2025 M</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>RT/RW</th>
                <th>Alamat</th>
                <th>Nama Sohibul</th>
                <th>Qurban Untuk</th>
                <th>Nomor Telepon</th>
                <th>Jenis Hewan</th>
                <th>Tipe</th>
                <th>Status Pembayaran</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sohibulQurban as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->rt }}/{{ $data->rw }}</td>
                <td>{{ $data->alamat }}</td>
                <td>{{ $data->nama_sohibul }}</td>
                <td>{{ $data->qurban_untuk ?: $data->nama_sohibul }}</td>
                <td>{{ $data->nomor_telepon ?: '-' }}</td>
                <td>{{ ucfirst($data->jenis_hewan) }}</td>
                <td>
                    @if($data->jenis_hewan == 'sapi')
                        {{ $data->is_collective ? 'Kolektif (1/7)' : 'Individual' }}
                    @else
                        Individual
                    @endif
                </td>
                <td>{{ str_replace('_', ' ', ucfirst($data->status_pembayaran)) }}</td>
                <td>{{ $data->catatan ?: '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Sohibul: {{ $sohibulQurban->count() }} orang
    </div>
</body>
</html>
