<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwitansi Pembayaran Qurban</title>
    <style>
        @page {
            size: landscape;
            margin: 20px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #fff;
        }
        .kwitansi {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .border-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid #2C3E50;
            background: linear-gradient(45deg, #2C3E50 25%, transparent 25%) -20px 0,
                linear-gradient(-45deg, #2C3E50 25%, transparent 25%) -20px 0;
            background-size: 20px 20px;
            padding: 8px;
        }
        .content-wrapper {
            background: white;
            margin: 8px;
            padding: 15px;
            position: relative;
            z-index: 1;
            height: calc(100% - 32px);
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #2C3E50;
            padding-bottom: 15px;
            color: #2C3E50;
        }
        .header h2 {
            margin: 0 0 8px 0;
            font-size: 24px;
            color: #2C3E50;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p {
            margin: 4px 0;
            font-size: 14px;
            color: #34495E;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(44, 62, 80, 0.07);
            z-index: 0;
            white-space: nowrap;
        }
        .nomor {
            color: #2C3E50;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            background: #ECF0F1;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
        }
        .content {
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .details-table {
            width: 100%;
            margin-bottom: 15px;
        }
        .details-table td {
            padding: 6px 4px;
            vertical-align: top;
            color: #2C3E50;
            font-size: 14px;
        }
        .qurban-info {
            margin: 15px 0;
            padding: 15px;
            background: #ECF0F1;
            border-radius: 8px;
        }
        .qurban-info td:first-child {
            color: #34495E;
            font-weight: bold;
        }
        .amount-box {
            background: #2C3E50;
            color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }
        .terbilang {
            font-style: italic;
            margin: 10px 0;
            color: #7F8C8D;
            font-size: 13px;
            padding: 8px;
            border-left: 4px solid #BDC3C7;
        }
        .footer {
            margin-top: 20px;
            position: relative;
            height: 100px;
            bottom: 0;
        }
        /* .footer .date {
            position: absolute;
            left: 0;
            text-align: center;
            color: #34495E;
            width: 200px;
            font-size: 14px;
        } */
        .footer .date {
            position: absolute;
            right: 0;
            text-align: center;
            width: 200px;
            font-size: 14px;
        }
        .footer .signature {
            position: absolute;
            right: 0;
            text-align: center;
            width: 200px;
            font-size: 14px;
        }
        .signature-box {
            border-bottom: 2px solid #2C3E50;
            min-width: 180px;
            margin: 20px 0 8px 0;
            height: 35px;
        }
        .signature-name {
            color: #2C3E50;
            font-weight: bold;
            font-size: 13px;
        }
        .main-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .left-section {
            flex: 1;
            padding-right: 15px;
        }
        .right-section {
            flex: 1;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <div class="kwitansi">
        <div class="border-pattern">
            <div class="content-wrapper">
                <div class="watermark">LUNAS</div>

                <div class="header">
                    <h2>KWITANSI PEMBAYARAN QURBAN</h2>
                    <p>MASJID AR-RIDHO</p>
                    <p>Jl. Bukit Kelapa Swait Blok AA RT02/RWXI, Meteseh, Tembalang</p>
                    <p>Tahun 1446 H / 2025 M</p>
                </div>

                <div class="nomor">
                    Nomor: {{ $kwitansi->nomor_kwitansi }}
                </div>

                <div class="main-content">
                    <div class="left-section">
                        <table class="details-table">
                            <tr>
                                <td width="150">Telah Terima Dari</td>
                                <td width="10">:</td>
                                <td><strong>{{ $kwitansi->sohibulQurban->nama_sohibul }}</strong></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $kwitansi->sohibulQurban->alamat }} RT {{ $kwitansi->sohibulQurban->rt }} / RW {{ $kwitansi->sohibulQurban->rw }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="right-section">
                        <div class="qurban-info">
                            <table class="details-table">
                                <tr>
                                    <td width="150">Jenis Ibadah</td>
                                    <td width="10">:</td>
                                    <td>Qurban {{ ucfirst($kwitansi->sohibulQurban->jenis_hewan) }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td>
                                        @if($kwitansi->sohibulQurban->jenis_hewan == 'sapi')
                                            {{ $kwitansi->sohibulQurban->is_collective ? 'Kolektif (1/7 Sapi)' : 'Individual (1 Sapi Penuh)' }}
                                        @else
                                            1 Ekor Kambing
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Qurban Atas Nama</td>
                                    <td>:</td>
                                    <td>{{ $kwitansi->sohibulQurban->qurban_untuk ?: $kwitansi->sohibulQurban->nama_sohibul }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="amount-box">
                    Jumlah Pembayaran: Rp {{ number_format($kwitansi->nominal, 0, ',', '.') }},-
                </div>

                <div class="terbilang">
                    Terbilang: {{ ucwords(terbilang($kwitansi->nominal)) }} Rupiah
                </div>

                <div class="footer">
                    <div class="date">
                        {{ $kwitansi->tanggal_pembayaran->isoFormat('dddd, D MMMM Y') }}<br>
                        Penerima,<br>
                        <div class="signature-box"></div>
                        <div class="signature-name">( Pengadaan )</div>
                    </div>
                    {{-- <div class="signature">
                        Hormat Kami,<br>
                        Panitia Qurban<br>
                        <div class="signature-box"></div>
                        <div class="signature-name">( Ketua Panitia )</div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
