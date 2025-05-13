@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Pengeluaran</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pengeluaran.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                   id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                            @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah (Rp)</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                   id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
                            @error('jumlah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bukti">Bukti Pengeluaran</label>
                            <input type="file" class="form-control @error('bukti') is-invalid @enderror"
                                   id="bukti" name="bukti" required>
                            @error('bukti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
