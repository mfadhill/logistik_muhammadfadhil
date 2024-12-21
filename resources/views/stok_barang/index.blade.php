@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-4 mb-10 text-bold text-center">Daftar Stok Barang</h3>

        {{-- Tampilkan pesan sukses atau error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tabel data stok barang dengan shadow --}}
        <div class="table-responsive shadow-lg rounded">
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
                        @php
                            $maxRows = max(count($item['barang_masuk']), count($item['barang_keluar']));
                        @endphp

                        {{-- Iterasi untuk membuat baris sesuai data barang masuk dan keluar --}}
                        @for ($i = 0; $i < $maxRows; $i++)
                            <tr class="table-light">
                                {{-- Data yang hanya ditampilkan di baris pertama --}}
                                @if ($i == 0)
                                    <td rowspan="{{ $maxRows }}">{{ $index + 1 }}</td>
                                    <td rowspan="{{ $maxRows }}">{{ $item['kode_barang'] }}</td>
                                @endif

                                {{-- Data barang masuk dan keluar --}}
                                <td>{{ $item['barang_masuk'][$i]->origin ?? '' }}</td>
                                <td>{{ $item['barang_keluar'][$i]->destination ?? '' }}</td>

                                {{-- Data quantity --}}
                                <td>{{ $item['barang_masuk'][$i]->quantity ?? '' }}</td>
                                <td>{{ $item['barang_keluar'][$i]->quantity ?? '' }}</td>

                                {{-- Stok tersedia hanya di baris pertama --}}
                                @if ($i == 0)
                                    <td rowspan="{{ $maxRows }}">{{ $item['stok_tersedia'] }}</td>
                                    <td rowspan="{{ $maxRows }}">
                                        <form action="{{ route('stok.delete', $item['kode_barang']) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endfor
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
