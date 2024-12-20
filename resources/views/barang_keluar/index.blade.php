@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Barang Keluar</h1>
        <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary mb-3">Tambah Barang Keluar</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Barang Keluar</th>
                    <th>Kode Barang</th>
                    <th>Quantity</th>
                    <th>Tujuan</th>
                    <th>Tanggal Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangKeluar as $item)
                    <tr>
                        <td>{{ $item->no_barang_keluar }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->destination }}</td>
                        <td>{{ $item->tanggal_keluar }}</td>
                        <td>
                            <a href="{{ route('barang_keluar.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('barang_keluar.destroy', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
