@extends('backend.app')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="it-page">

    {{-- Header --}}
    <div class="it-header">
        <div class="it-header-inner">
            <div>
                <h4 class="it-header-title">Items</h4>
                <p class="it-header-sub">Manage your products and their pictures</p>
            </div>
            <a href="{{ route('admin.item.create') }}" class="it-add-btn">
                <i class="bi bi-plus-lg"></i> Add Item
            </a>
        </div>
    </div>

    {{-- Card --}}
    <div class="it-card-wrap">
        <div class="it-card">
            <div class="it-scroll-wrap">
                <table class="it-table">
                    <thead>
                        <tr>
                            <th style="width:80px;"><i class="bi bi-image me-1"></i> Picture</th>
                            <th class="text-start"><i class="bi bi-box-seam me-1"></i> Name</th>
                            <th><i class="bi bi-tag me-1"></i> Category</th>
                            <th><i class="bi bi-cash-stack me-1"></i> Price</th>
                            <th><i class="bi bi-cash-coin me-1"></i> Cost</th>
                            <th style="width:130px;"><i class="bi bi-gear me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="it-pic-cell">
                                        @if($item->images->isNotEmpty())
                                            <img src="{{ route('admin.item.image', $item->images->first()) }}" alt="{{ $item->name }}" class="it-avatar" loading="lazy">
                                        @else
                                            <div class="it-avatar it-avatar-empty"><i class="bi bi-image"></i></div>
                                        @endif
                                        @if($item->images->count() > 1)
                                            <span class="it-pic-badge">{{ $item->images->count() }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-start fw-semibold">{{ $item->name }}</td>
                                <td>
                                    @if($item->category)
                                        <span class="it-cat-badge"><i class="bi bi-tag"></i> {{ $item->category->name }}</span>
                                    @else
                                        <span class="it-na">—</span>
                                    @endif
                                </td>
                                <td><span class="it-price">{{ number_format($item->price, 2) }}</span></td>
                                <td><span class="it-cost">{{ number_format($item->cost, 2) }}</span></td>
                                <td>
                                    <div class="it-actions">
                                        <a href="{{ route('admin.item.edit', $item) }}" class="it-action-btn it-edit" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="it-action-btn it-del" title="Delete" onclick="deleteItem({{ $item->id }}, '{{ addslashes($item->name) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="it-empty-row">
                                    <div class="it-empty-state">
                                        <i class="bi bi-box-seam it-empty-icon"></i>
                                        <div class="it-empty-title">No Items Found</div>
                                        <div class="it-empty-sub">Click "Add Item" to add the first item.</div>
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
/* ===== ITEM PAGE (Light Theme) ===== */
.it-page { padding: 24px 28px; height: 100%; }
.it-header {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px;
    padding: 18px 22px; margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.04);
}
.it-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
}
.it-header-title { font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 2px 0; }
.it-header-sub { font-size: 13px; color: #64748b; margin: 0; }
.it-add-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 9px 18px; border: none; border-radius: 10px; font-size: 13px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(37,99,235,0.25); text-decoration: none;
}
.it-add-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

.it-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.it-scroll-wrap { overflow-x: auto; }
.it-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.it-table thead { background: #f8fafc; position: sticky; top: 0; z-index: 5; }
.it-table th {
    padding: 14px 16px; text-align: center; font-weight: 600;
    font-size: 13px; color: #64748b; text-transform: uppercase;
    letter-spacing: 0.4px; border-bottom: 1px solid #e2e8f0;
}
.it-table th i { color: #2563eb; }
.it-table td {
    padding: 12px 16px; text-align: center; color: #1e293b;
    border-bottom: 1px solid #e2e8f0; vertical-align: middle;
}
.it-table tbody tr { transition: background 0.18s ease; }
.it-table tbody tr:hover { background: #f8fafc; }
.it-table tbody tr:last-child td { border-bottom: none; }

.it-pic-cell { position: relative; display: inline-flex; }
.it-avatar {
    width: 52px; height: 52px; border-radius: 12px; object-fit: cover;
    border: 2px solid #dbeafe; box-shadow: 0 2px 8px rgba(37,99,235,0.15);
}
.it-avatar-empty {
    display: flex; align-items: center; justify-content: center;
    background: #f1f5f9; color: #94a3b8; font-size: 1.2rem;
}
.it-pic-badge {
    position: absolute; top: -6px; right: -6px;
    min-width: 20px; height: 20px; padding: 0 5px;
    display: flex; align-items: center; justify-content: center;
    background: #2563eb; color: #fff; border-radius: 10px;
    font-size: 11px; font-weight: 700; border: 2px solid #fff;
}
.it-cat-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;
    padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
}
.it-price { font-weight: 700; color: #16a34a; }
.it-cost { font-weight: 600; color: #ea580c; }
.it-na { color: #cbd5e1; }

.it-actions { display: flex; justify-content: center; gap: 8px; }
.it-action-btn {
    width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;
    transition: all 0.2s ease; font-size: 0.95rem; text-decoration: none;
}
.it-action-btn:hover { transform: translateY(-1px); }
.it-edit { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
.it-edit:hover { background: #dbeafe; }
.it-del { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.it-del:hover { background: #fee2e2; }

.it-empty-row { text-align: center; padding: 60px 20px !important; }
.it-empty-state { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.it-empty-icon { font-size: 40px; color: #94a3b8; margin-bottom: 8px; display: block; }
.it-empty-title { font-weight: 600; font-size: 16px; color: #64748b; }
.it-empty-sub { font-size: 13px; color: #94a3b8; }

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .it-page { padding: 20px 22px; }
    .it-table td, .it-table th { padding: 12px 14px; font-size: 13px; }
    .it-table th:nth-child(5), .it-table td:nth-child(5) { display: none; }
}
@media (max-width: 768px) {
    .it-page { padding: 16px; }
    .it-table td, .it-table th { padding: 10px 12px; font-size: 13px; }
    .it-header { padding: 14px 16px; }
    .it-table th:nth-child(3), .it-table td:nth-child(3) { display: none; }
}
@media (max-width: 480px) {
    .it-page { padding: 12px; }
    .it-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .it-add-btn { width: 100%; justify-content: center; }
    .it-avatar { width: 44px; height: 44px; }
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

function deleteItem(id, name) {
    Swal.fire({
        title: 'Delete this item?',
        text: name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then(function (result) {
        if (result.isConfirmed) {
            axios.delete('{{ url('/admin/items') }}/' + id)
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
                        text: 'Could not delete the item.',
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