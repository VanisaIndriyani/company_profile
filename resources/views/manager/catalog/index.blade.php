@extends('layouts.manager')

@section('content')
<style>
    /* Modern Catalog Management Styling */
    .catalog-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(111, 78, 55, 0.15);
        background: #fffbe6;
        border: none;
    }
    
    .catalog-table th {
        background: linear-gradient(135deg, #6f4e37 0%, #8b6b4a 100%);
        color: #fffbe6;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
        font-size: 0.95rem;
    }
    
    .catalog-table td {
        vertical-align: middle;
        border: none;
        background: #fff;
        padding: 1rem;
        transition: all 0.3s ease;
    }
    
    .catalog-table tr {
        transition: all 0.3s ease;
    }
    
    .catalog-table tr:hover {
        background: #f5e9da;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.1);
    }
    
    .catalog-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.2);
        border: 2px solid #fffbe6;
        transition: all 0.3s ease;
    }
    
    .catalog-img:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(111, 78, 55, 0.3);
    }
    
    .btn-sm {
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 6px 16px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
        color: white;
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #ff8c00 0%, #ff6b00 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    
    .btn-danger:hover {
        background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }
    
    /* Enhanced Modal Styling */
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 20px 60px rgba(111, 78, 55, 0.3);
        overflow: hidden;
    }
    
    .modal-header {
        background: linear-gradient(135deg, #6f4e37 0%, #8b6b4a 100%);
        color: #fffbe6;
        border-radius: 24px 24px 0 0;
        border: none;
        padding: 1.5rem 2rem;
        position: relative;
    }
    
    .modal-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #ffc107, #ff8c00, #ffc107);
    }
    
    .modal-title {
        font-weight: 800;
        letter-spacing: 1px;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .modal-title::before {
        content: '📝';
        font-size: 1.5rem;
    }
    
    .close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }
    
    .modal-body {
        padding: 2.5rem;
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        font-weight: 700;
        color: #6f4e37;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }
    
    .form-label::before {
        font-size: 1.1rem;
    }
    
    .form-label[for="edit_name"]::before { content: '🏷️'; }
    .form-label[for="edit_category"]::before { content: '📂'; }
    .form-label[for="edit_price"]::before { content: '💰'; }
    .form-label[for="edit_stock"]::before { content: '📦'; }
    .form-label[for="edit_description"]::before { content: '📝'; }
    
    .form-control {
        border-radius: 16px;
        border: 2px solid #e9ecef;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(111, 78, 55, 0.05);
    }
    
    .form-control:focus {
        border-color: #6f4e37;
        box-shadow: 0 0 0 0.2rem rgba(111, 78, 55, 0.15), 0 4px 16px rgba(111, 78, 55, 0.1);
        outline: none;
        transform: translateY(-1px);
    }
    
    .form-control:hover {
        border-color: #8b6b4a;
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.1);
    }
    
    select.form-control {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236f4e37' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 40px;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }
    
    .file-input-label {
        display: block;
        padding: 14px 18px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #6f4e37;
        border-radius: 16px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6f4e37;
        font-weight: 600;
    }
    
    .file-input-label:hover {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        border-color: #8b6b4a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.1);
    }
    
    .file-input-label::before {
        content: '📁 Pilih File Gambar';
        display: block;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .modal-footer {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-top: 1px solid #dee2e6;
        padding: 1.5rem 2rem;
        border-radius: 0 0 24px 24px;
    }
    
    .btn {
        border-radius: 16px;
        padding: 12px 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.95rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6f4e37 0%, #8b6b4a 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #8b6b4a 0%, #6f4e37 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(111, 78, 55, 0.4);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }
    
    .btn-secondary:hover {
        background: linear-gradient(135deg, #5a6268 0%, #495057 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    }
    
    .modal-dialog.modal-lg {
        max-width: 900px;
    }
    
    /* Animation */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .modal.show .modal-content {
        animation: slideInUp 0.4s ease-out;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-header {
            padding: 1rem 1.5rem;
        }
        
        .modal-footer {
            padding: 1rem 1.5rem;
        }
        
        .form-control {
            padding: 12px 16px;
        }
    }
    
    /* Badge Styling */
    .badge {
        border-radius: 20px;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    
    .badge-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
        color: white;
    }
    
    .badge-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
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
                                <div class="form-group">
                                    <label class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="name" required 
                                           placeholder="Masukkan nama produk">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-control" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Coffee">☕ Coffee</option>
                                        <option value="Vape">🚬 Vape</option>
                                        <option value="Snack">🍿 Snack</option>
                                        <option value="Minuman">🥤 Minuman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" name="price" required 
                                           placeholder="Masukkan harga produk">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="stock" required 
                                           placeholder="Masukkan jumlah stok">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gambar Produk</label>
                                    <div class="file-input-wrapper">
                                        <label for="create_image" class="file-input-label">
                                            <span class="file-text">Pilih file gambar atau drag & drop</span>
                                            <small class="d-block mt-2 text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                        </label>
                                        <input type="file" id="create_image" name="image" accept="image/*" 
                                               onchange="updateFileName(this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="description" rows="4" required 
                                              placeholder="Masukkan deskripsi produk"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Simpan
                        </button>
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
                                <div class="form-group">
                                    <label class="form-label" for="edit_name">Nama Produk</label>
                                    <input type="text" class="form-control" name="name" id="edit_name" required 
                                           placeholder="Masukkan nama produk">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="edit_category">Kategori</label>
                                    <select class="form-control" name="category" id="edit_category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Coffee">☕ Coffee</option>
                                        <option value="Vape">🚬 Vape</option>
                                        <option value="Snack">🍿 Snack</option>
                                        <option value="Minuman">🥤 Minuman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="edit_price">Harga (Rp)</label>
                                    <input type="number" class="form-control" name="price" id="edit_price" required 
                                           placeholder="Masukkan harga produk">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit_stock">Stok</label>
                                    <input type="number" class="form-control" name="stock" id="edit_stock" required 
                                           placeholder="Masukkan jumlah stok">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gambar Produk</label>
                                    <div class="file-input-wrapper">
                                        <label for="edit_image" class="file-input-label">
                                            <span class="file-text">Pilih file gambar atau drag & drop</span>
                                            <small class="d-block mt-2 text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                        </label>
                                        <input type="file" id="edit_image" name="image" accept="image/*" 
                                               onchange="updateFileName(this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="edit_description">Deskripsi</label>
                                    <textarea class="form-control" name="description" id="edit_description" rows="4" required 
                                              placeholder="Masukkan deskripsi produk"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update
                        </button>
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
        
        function updateFileName(input) {
            const file = input.files[0];
            const label = input.parentElement.querySelector('.file-input-label');
            const fileText = label.querySelector('.file-text');
            
            if (file) {
                fileText.textContent = `File dipilih: ${file.name}`;
                label.style.background = 'linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%)';
                label.style.borderColor = '#28a745';
                label.style.color = '#155724';
            } else {
                fileText.textContent = 'Pilih file gambar atau drag & drop';
                label.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';
                label.style.borderColor = '#6f4e37';
                label.style.color = '#6f4e37';
            }
        }
        
        // Add drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = document.querySelectorAll('.file-input-wrapper');
            
            fileInputs.forEach(wrapper => {
                const label = wrapper.querySelector('.file-input-label');
                const input = wrapper.querySelector('input[type="file"]');
                
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    label.addEventListener(eventName, preventDefaults, false);
                });
                
                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                
                ['dragenter', 'dragover'].forEach(eventName => {
                    label.addEventListener(eventName, highlight, false);
                });
                
                ['dragleave', 'drop'].forEach(eventName => {
                    label.addEventListener(eventName, unhighlight, false);
                });
                
                function highlight(e) {
                    label.style.background = 'linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%)';
                    label.style.borderColor = '#8b6b4a';
                    label.style.transform = 'scale(1.02)';
                }
                
                function unhighlight(e) {
                    label.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';
                    label.style.borderColor = '#6f4e37';
                    label.style.transform = 'scale(1)';
                }
                
                label.addEventListener('drop', handleDrop, false);
                
                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    input.files = files;
                    updateFileName(input);
                }
            });
        });
        
        // Add form validation
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.style.borderColor = '#dc3545';
                            field.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
                        } else {
                            field.style.borderColor = '#6f4e37';
                            field.style.boxShadow = '0 0 0 0.2rem rgba(111, 78, 55, 0.15)';
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('Mohon lengkapi semua field yang wajib diisi!');
                    }
                });
            });
        });
    </script>
@endsection 