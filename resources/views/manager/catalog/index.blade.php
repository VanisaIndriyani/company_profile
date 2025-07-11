@extends('layouts.manager')

@section('content')
<style>
    .catalog-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        background: #fffbe6;
    }
    .catalog-table th {
        background: #6f4e37;
        color: #fffbe6;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
    }
    .catalog-table td {
        vertical-align: middle;
        border: none;
        background: #fff;
    }
    .catalog-table tr {
        transition: background 0.2s;
    }
    .catalog-table tr:hover {
        background: #f5e9da;
    }
    .catalog-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 2px 8px #b4845c33;
        background: #fffbe6;
    }
    .btn-sm {
        border-radius: 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 4px 14px;
    }
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 8px 32px rgba(111, 78, 55, 0.2);
    }
    .modal-header {
        background: #6f4e37;
        color: #fffbe6;
        border-radius: 20px 20px 0 0;
        border: none;
    }
    .modal-title {
        font-weight: 800;
        letter-spacing: 1px;
    }
    .form-control {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 12px 16px;
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #6f4e37;
        box-shadow: 0 0 0 0.2rem rgba(111, 78, 55, 0.25);
    }
    .btn-primary {
        background: #6f4e37;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .btn-primary:hover {
        background: #5a3e2e;
        transform: translateY(-1px);
    }
    .btn-secondary {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .modal-dialog.modal-lg {
        max-width: 900px;
    }
    .modal-body {
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
    }
    .mb-3 {
        margin-bottom: 1.5rem !important;
    }
</style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 style="color:#6f4e37;font-weight:800;letter-spacing:1px;">Katalog Produk</h2>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">+ Tambah Katalog</button>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card">
        <div class="card-body p-0">
            <table class="table catalog-table mb-0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catalogs as $catalog)
                        <tr>
                            <td>
                                @if($catalog->image)
                                    <img src="{{ asset('catalog_image/'.$catalog->image) }}" class="catalog-img">
                                @endif
                            </td>
                            <td style="font-weight:600;color:#6f4e37;">{{ $catalog->name }}</td>
                            <td><span class="badge badge-warning" style="font-size:0.95em;">{{ $catalog->category }}</span></td>
                            <td>{{ $catalog->description }}</td>
                            <td>Rp{{ number_format($catalog->price) }}</td>
                            <td>
                                {{ $catalog->stock }}
                                @if($catalog->stock <= 5 && $catalog->stock > 0)
                                    <span class="badge badge-warning ml-1">Rendah</span>
                                @elseif($catalog->stock == 0)
                                    <span class="badge badge-danger ml-1">Habis</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" onclick="editCatalog({{ $catalog->id }}, '{{ $catalog->name }}', '{{ $catalog->category }}', '{{ $catalog->description }}', {{ $catalog->price }}, {{ $catalog->stock }})" data-toggle="modal" data-target="#editModal">Edit</button>
                                <form action="{{ route('manager.catalog.destroy', $catalog) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Katalog Baru</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('manager.catalog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="font-weight-bold">Nama Produk</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Kategori</label>
                                    <select class="form-control" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Coffee">Coffee</option>
                                        <option value="Vape">Vape</option>
                                        <option value="Snack">Snack</option>
                                        <option value="Minuman">Minuman</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Harga</label>
                                    <input type="number" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="font-weight-bold">Stok</label>
                                    <input type="number" class="form-control" name="stock" required>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Gambar</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Deskripsi</label>
                                    <textarea class="form-control" name="description" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Katalog</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="font-weight-bold">Nama Produk</label>
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Kategori</label>
                                    <select class="form-control" name="category" id="edit_category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Coffee">Coffee</option>
                                        <option value="Vape">Vape</option>
                                        <option value="Snack">Snack</option>
                                        <option value="Minuman">Minuman</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Harga</label>
                                    <input type="number" class="form-control" name="price" id="edit_price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="font-weight-bold">Stok</label>
                                    <input type="number" class="form-control" name="stock" id="edit_stock" required>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Gambar</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Deskripsi</label>
                                    <textarea class="form-control" name="description" id="edit_description" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editCatalog(id, name, category, description, price, stock) {
            document.getElementById('editForm').action = `/manager/catalog/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_stock').value = stock;
        }
    </script>
@endsection 