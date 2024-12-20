@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow bg-light" style="width: 500px;">
            <div class="card-header text-center bg-dark text-white">
                <h4>Tambah Barang Masuk</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('barang_masuk.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="no_barang_masuk">No Barang Masuk <span class="text-danger">*</span></label>
                        <input type="text" name="no_barang_masuk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                        <input type="text" name="kode_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="origin">Origin (Asal Barang) <span class="text-danger">*</span></label>
                        <input type="text" name="origin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_masuk" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
