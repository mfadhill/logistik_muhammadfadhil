@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-4 mb-10 text-bold text-center">Daftar Stok Barang</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-hover table-dark">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Origin (Masuk)</th>
                    <th>Destination (Keluar)</th>
                    <th>Quantity Masuk</th>
                    <th>Quantity Keluar</th>
                    <th>Stok Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($stokBarang as $index => $item)
                    <tr class="table-light">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['kode_barang'] }}</td>
                        <td>
                            @foreach ($item['barang_masuk'] as $masuk)
                                <p>{{ $masuk->origin }}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item['barang_keluar'] as $keluar)
                                <p>{{ $keluar->destination }}</p>
                            @endforeach
                        </td>
                        <td>{{ $item['quantity_masuk'] }}</td>
                        <td>{{ $item['quantity_keluar'] }}</td>
                        <td>{{ $item['stok_tersedia'] }}</td>
                        <td>
                            <form action="{{ route('stok.delete', $item['kode_barang']) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
