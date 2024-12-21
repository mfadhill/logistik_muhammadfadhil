@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow bg-light" style="width: 500px;">
            <div class="card-header text-center bg-dark text-white">
                <h4>Tambah Barang Keluar</h4>
            </div>
            <div class="card-body">
                {{-- Tampilkan pesan error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('barang_keluar.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="no_barang_keluar">No Barang Keluar <span class="text-danger">*</span></label>
                        <input type="text" name="no_barang_keluar" class="form-control"
                            value="{{ old('no_barang_keluar') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                        <select name="kode_barang" class="form-control" required>
                            <option value="" disabled selected>Pilih Kode Barang</option>
                            @foreach ($barangMasuk as $item)
                                <option value="{{ $item->kode_barang }}"
                                    {{ old('kode_barang') == $item->kode_barang ? 'selected' : '' }}>
                                    {{ $item->kode_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="destination">Tujuan (Destination) <span class="text-danger">*</span></label>
                        <input type="text" name="destination" class="form-control" value="{{ old('destination') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_keluar">Tanggal Keluar <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar') }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
