@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Daftar Stok Barang</h1>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
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
            <tbody>
                @foreach ($stokBarang as $index => $item)
                    <tr>
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
                            <!-- Button Hapus -->
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
