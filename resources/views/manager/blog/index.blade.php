@extends('layouts.manager')

@section('content')
<style>
    .blog-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        background: #fffbe6;
    }
    .blog-table th {
        background: #6f4e37;
        color: #fffbe6;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
    }
    .blog-table td {
        vertical-align: middle;
        border: none;
        background: #fff;
    }
    .blog-table tr {
        transition: background 0.2s;
    }
    .blog-table tr:hover {
        background: #f5e9da;
    }
    .blog-img {
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
        <h2 style="color:#6f4e37;font-weight:800;letter-spacing:1px;">Daftar Artikel Blog</h2>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">+ Tambah Artikel</button>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body p-0">
            <table class="table blog-table mb-0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td style="font-weight:600;color:#6f4e37;">{{ $article->title }}</td>
                            <td>{{ $article->slug }}</td>
                            <td>
                                @if($article->image)
                                    <img src="{{ asset('article_image/'.$article->image) }}" class="blog-img">
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-id="{{ $article->id }}"
                                    data-title="{{ htmlspecialchars($article->title, ENT_QUOTES) }}"
                                    data-content="{{ htmlspecialchars($article->content, ENT_QUOTES) }}"
                                    onclick="editBlog(this)" data-toggle="modal" data-target="#editModal">Edit</button>
                                <form action="{{ route('manager.blog.destroy', $article) }}" method="POST" style="display:inline;">
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
                    <h5 class="modal-title">Tambah Artikel Blog</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('manager.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="font-weight-bold">Judul</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Konten</label>
                            <textarea name="content" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Gambar</label>
                            <input type="file" name="image" class="form-control">
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
                    <h5 class="modal-title">Edit Artikel Blog</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="font-weight-bold">Judul</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Konten</label>
                            <textarea name="content" id="edit_content" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Gambar (biarkan kosong jika tidak diubah)</label>
                            <input type="file" name="image" class="form-control">
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
        function editBlog(btn) {
            var id = btn.getAttribute('data-id');
            var title = btn.getAttribute('data-title');
            var content = btn.getAttribute('data-content');
            var form = document.getElementById('editForm');
            form.action = `/manager/blog/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_content').value = content;
        }
        // Prevent submit if action is not set properly
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('editForm').addEventListener('submit', function(e) {
                if (!this.action.match(/\/manager\/blog\/[0-9]+$/)) {
                    alert('Gagal: ID artikel tidak ditemukan.');
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection 