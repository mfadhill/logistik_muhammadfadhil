@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Barang Masuk</h1>
        <form action="{{ route('barang_masuk.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="no_barang_masuk">No Barang Masuk</label>
                <input type="text" name="no_barang_masuk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="origin">Origin (Asal Barang)</label>
                <input type="text" name="origin" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
@endsection
