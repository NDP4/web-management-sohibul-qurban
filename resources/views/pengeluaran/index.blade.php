@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Pengeluaran
                    <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary float-right">Tambah Pengeluaran</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengeluarans as $index => $pengeluaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pengeluaran->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $pengeluaran->keterangan }}</td>
                                    <td>Rp. {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ $pengeluaran->bukti_path }}" target="_blank" class="btn btn-info btn-sm">Lihat Bukti</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total Pengeluaran:</strong></td>
                                    <td colspan="2"><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
