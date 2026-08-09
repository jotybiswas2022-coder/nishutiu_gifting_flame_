@extends('backend.app')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="cat-page">

    {{-- Header --}}
    <div class="cat-header">
        <div class="cat-header-inner">
            <div>
                <h4 class="cat-header-title">Categories</h4>
                <p class="cat-header-sub">Manage product categories</p>
            </div>
            <a href="{{ route('admin.category.create') }}" class="cat-add-btn">
                <i class="bi bi-plus-lg"></i> Add Category
            </a>
        </div>
    </div>

    {{-- Card --}}
    <div class="cat-card-wrap">
        <div class="cat-card">
            <div class="cat-scroll-wrap">
                <table class="cat-table">
                    <thead>
                        <tr>
                            <th style="width:70px;"><i class="bi bi-image me-1"></i> Photo</th>
                            <th class="text-start"><i class="bi bi-tag me-1"></i> Name</th>
                            <th class="text-start"><i class="bi bi-card-text me-1"></i> Description</th>
                            <th style="width:130px;"><i class="bi bi-gear me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>
                                    <img src="{{ route('admin.category.photo', $category) }}" alt="{{ $category->name }}" class="cat-avatar" loading="lazy">
                                </td>
                                <td class="text-start fw-semibold">{{ $category->name }}</td>
                                <td class="text-start">
                                    <span class="cat-desc">{{ $category->description ?: '—' }}</span>
                                </td>
                                <td>
                                    <div class="cat-actions">
                                        <a href="{{ route('admin.category.edit', $category) }}" class="cat-action-btn cat-edit" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="cat-action-btn cat-del" title="Delete" onclick="deleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="cat-empty-row">
                                    <div class="cat-empty-state">
                                        <i class="bi bi-collection cat-empty-icon"></i>
                                        <div class="cat-empty-title">No Categories Found</div>
                                        <div class="cat-empty-sub">Click "Add Category" to add the first category.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* ===== CATEGORY PAGE (Light Theme) ===== */
.cat-page { padding: 24px 28px; height: 100%; }
.cat-header {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px;
    padding: 18px 22px; margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.04);
}
.cat-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
}
.cat-header-title { font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 2px 0; }
.cat-header-sub { font-size: 13px; color: #64748b; margin: 0; }
.cat-add-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 9px 18px; border: none; border-radius: 10px; font-size: 13px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(37,99,235,0.25); text-decoration: none;
}
.cat-add-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

.cat-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.cat-scroll-wrap { overflow-x: auto; }
.cat-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.cat-table thead { background: #f8fafc; position: sticky; top: 0; z-index: 5; }
.cat-table th {
    padding: 14px 16px; text-align: center; font-weight: 600;
    font-size: 13px; color: #64748b; text-transform: uppercase;
    letter-spacing: 0.4px; border-bottom: 1px solid #e2e8f0;
}
.cat-table th i { color: #2563eb; }
.cat-table td {
    padding: 12px 16px; text-align: center; color: #1e293b;
    border-bottom: 1px solid #e2e8f0; vertical-align: middle;
}
.cat-table tbody tr { transition: background 0.18s ease; }
.cat-table tbody tr:hover { background: #f8fafc; }
.cat-table tbody tr:last-child td { border-bottom: none; }
.cat-avatar {
    width: 46px; height: 46px; border-radius: 50%; object-fit: cover;
    border: 2px solid #dbeafe; box-shadow: 0 2px 8px rgba(37,99,235,0.15);
}
.cat-desc {
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; font-size: 13px; color: #64748b; max-width: 280px;
}

.cat-actions { display: flex; justify-content: center; gap: 8px; }
.cat-action-btn {
    width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;
    transition: all 0.2s ease; font-size: 0.95rem; text-decoration: none;
}
.cat-action-btn:hover { transform: translateY(-1px); }
.cat-edit { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
.cat-edit:hover { background: #dbeafe; }
.cat-del { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.cat-del:hover { background: #fee2e2; }

.cat-empty-row { text-align: center; padding: 60px 20px !important; }
.cat-empty-state { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.cat-empty-icon { font-size: 40px; color: #94a3b8; margin-bottom: 8px; display: block; }
.cat-empty-title { font-weight: 600; font-size: 16px; color: #64748b; }
.cat-empty-sub { font-size: 13px; color: #94a3b8; }

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .cat-page { padding: 20px 22px; }
    .cat-table td, .cat-table th { padding: 12px 14px; font-size: 13px; }
}
@media (max-width: 768px) {
    .cat-page { padding: 16px; }
    .cat-table td, .cat-table th { padding: 10px 12px; font-size: 13px; }
    .cat-header { padding: 14px 16px; }
    .cat-table th:nth-child(3), .cat-table td:nth-child(3) { display: none; }
}
@media (max-width: 480px) {
    .cat-page { padding: 12px; }
    .cat-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .cat-add-btn { width: 100%; justify-content: center; }
    .cat-avatar { width: 40px; height: 40px; }
    .cat-desc { max-width: 160px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var sessionSuccess = document.getElementById('sessionSuccess');
    if (sessionSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: sessionSuccess.value,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#1e293b',
            iconColor: '#2563eb',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }
});

function deleteCategory(id, name) {
    Swal.fire({
        title: 'Delete this category?',
        text: name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then(function (result) {
        if (result.isConfirmed) {
            axios.delete('{{ url('/admin/categories') }}/' + id)
                .then(function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: res.data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        background: '#ffffff',
                        color: '#1e293b',
                        iconColor: '#2563eb'
                    }).then(function () {
                        window.location.reload();
                    });
                })
                .catch(function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Could not delete the category.',
                        background: '#ffffff',
                        color: '#1e293b',
                        confirmButtonColor: '#2563eb'
                    });
                });
        }
    });
}
</script>

@endsection