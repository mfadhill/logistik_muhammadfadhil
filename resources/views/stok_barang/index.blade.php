@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Stok Barang</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Stok Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->stok_tersedia }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
