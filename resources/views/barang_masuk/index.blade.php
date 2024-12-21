@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center my-4">Daftar Barang Masuk</h3>
        <a href="{{ route('barang_masuk.create') }}" class="btn btn-primary mb-3">Tambah Barang Masuk</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive shadow-lg rounded">
            <table class="table table-hover table-dark">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>No Barang Masuk</th>
                        <th>Kode Barang</th>
                        <th>Quantity</th>
                        <th>Origin</th>
                        <th>Tanggal Masuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($barangMasuk as $item)
                        <tr class="table-light">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_barang_masuk }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->origin }}</td>
                            <td>{{ $item->tanggal_masuk }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered shadow-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Barang Masuk
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('barang_masuk.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="no_barang_masuk">No Barang Masuk</label>
                                                <input type="text" class="form-control" id="no_barang_masuk"
                                                    name="no_barang_masuk" value="{{ $item->no_barang_masuk }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="kode_barang">Kode Barang</label>
                                                <input type="text" class="form-control" id="kode_barang"
                                                    name="kode_barang" value="{{ $item->kode_barang }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                    value="{{ $item->quantity }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="origin">Origin</label>
                                                <input type="text" class="form-control" id="origin" name="origin"
                                                    value="{{ $item->origin }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                                <input type="date" class="form-control" id="tanggal_masuk"
                                                    name="tanggal_masuk" value="{{ $item->tanggal_masuk }}" required>
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

                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered shadow-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Barang Masuk
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('barang_masuk.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus barang masuk ini?
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
    </div>
@endsection
