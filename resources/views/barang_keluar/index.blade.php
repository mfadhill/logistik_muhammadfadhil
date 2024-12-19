@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Barang Keluar</h1>
        <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary mb-3">Tambah Barang Keluar</a>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Barang Keluar</th>
                    <th>Nama Barang</th>
                    <th>Quantity</th>
                    <th>Destination</th>
                    <th>Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangKeluar as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->no_barang_keluar }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->destination }}</td>
                        <td>{{ $item->tanggal_keluar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
