@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center text-bold my-4">Daftar Barang Keluar</h3>
        <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary mb-3">Tambah Barang Keluar</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-dark table-hover">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>No Barang Keluar</th>
                    <th>Kode Barang</th>
                    <th>Quantity</th>
                    <th>Tujuan</th>
                    <th>Tanggal Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($barangKeluar as $item)
                    <tr class="table-light">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->no_barang_keluar }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->destination }}</td>
                        <td>{{ $item->tanggal_keluar }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">Edit</button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Barang Keluar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('barang_keluar.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="no_barang_keluar">No Barang Keluar</label>
                                            <input type="text" class="form-control" id="no_barang_keluar"
                                                name="no_barang_keluar" value="{{ $item->no_barang_keluar }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="kode_barang">Kode Barang</label>
                                            <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                                value="{{ $item->kode_barang }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                value="{{ $item->quantity }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="destination">Tujuan</label>
                                            <input type="text" class="form-control" id="destination" name="destination"
                                                value="{{ $item->destination }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="tanggal_keluar">Tanggal Keluar</label>
                                            <input type="date" class="form-control" id="tanggal_keluar"
                                                name="tanggal_keluar" value="{{ $item->tanggal_keluar }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Barang Keluar
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('barang_keluar.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus barang keluar ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
