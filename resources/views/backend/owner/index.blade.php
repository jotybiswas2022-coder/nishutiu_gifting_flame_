@extends('backend.app')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="owner-page">

    {{-- Header --}}
    <div class="owner-header">
        <div class="owner-header-inner">
            <div>
                <h4 class="owner-header-title">Owner's Info</h4>
                <p class="owner-header-sub">Manage company owners and their social profiles</p>
            </div>
            <a href="{{ route('admin.owner.create') }}" class="owner-add-btn">
                <i class="bi bi-plus-lg"></i> Add Owner
            </a>
        </div>
    </div>

    {{-- Card --}}
    <div class="owner-card-wrap">
        <div class="owner-card">
            <div class="owner-scroll-wrap">
                <table class="owner-table">
                    <thead>
                        <tr>
                            <th style="width:70px;"><i class="bi bi-image me-1"></i> Photo</th>
                            <th class="text-start"><i class="bi bi-person me-1"></i> Name</th>
                            <th><i class="bi bi-facebook me-1"></i> Facebook</th>
                            <th><i class="bi bi-instagram me-1"></i> Instagram</th>
                            <th style="width:130px;"><i class="bi bi-gear me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($owners as $owner)
                            <tr>
                                <td>
                                    <img src="{{ route('admin.owner.photo', $owner) }}" alt="{{ $owner->name }}" class="owner-avatar" loading="lazy">
                                </td>
                                <td class="text-start fw-semibold">{{ $owner->name }}</td>
                                <td>
                                    @if($owner->facebook)
                                        <a href="{{ $owner->facebook }}" target="_blank" rel="noopener" class="owner-social-link">
                                            <i class="bi bi-facebook"></i> Facebook
                                        </a>
                                    @else
                                        <span class="owner-na">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($owner->instagram)
                                        <a href="{{ $owner->instagram }}" target="_blank" rel="noopener" class="owner-social-link">
                                            <i class="bi bi-instagram"></i> Instagram
                                        </a>
                                    @else
                                        <span class="owner-na">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="owner-actions">
                                        <a href="{{ route('admin.owner.edit', $owner) }}" class="owner-action-btn owner-edit" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="owner-action-btn owner-del" title="Delete" onclick="deleteOwner({{ $owner->id }}, '{{ addslashes($owner->name) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="owner-empty-row">
                                    <div class="owner-empty-state">
                                        <i class="bi bi-people owner-empty-icon"></i>
                                        <div class="owner-empty-title">No Owners Found</div>
                                        <div class="owner-empty-sub">Click "Add Owner" to add the first owner.</div>
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
/* ===== OWNER PAGE (Light Theme) ===== */
.owner-page { padding: 24px 28px; height: 100%; }
.owner-header {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px;
    padding: 18px 22px; margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.04);
}
.owner-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
}
.owner-header-title { font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 2px 0; }
.owner-header-sub { font-size: 13px; color: #64748b; margin: 0; }
.owner-add-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 9px 18px; border: none; border-radius: 10px; font-size: 13px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(37,99,235,0.25);
    text-decoration: none;
}
.owner-add-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

.owner-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.owner-scroll-wrap { overflow-x: auto; }
.owner-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.owner-table thead { background: #f8fafc; position: sticky; top: 0; z-index: 5; }
.owner-table th {
    padding: 14px 16px; text-align: center; font-weight: 600;
    font-size: 13px; color: #64748b; text-transform: uppercase;
    letter-spacing: 0.4px; border-bottom: 1px solid #e2e8f0;
}
.owner-table th i { color: #2563eb; }
.owner-table td {
    padding: 12px 16px; text-align: center; color: #1e293b;
    border-bottom: 1px solid #e2e8f0; vertical-align: middle;
}
.owner-table tbody tr { transition: background 0.18s ease; }
.owner-table tbody tr:hover { background: #f8fafc; }
.owner-table tbody tr:last-child td { border-bottom: none; }
.owner-avatar {
    width: 46px; height: 46px; border-radius: 50%; object-fit: cover;
    border: 2px solid #dbeafe; box-shadow: 0 2px 8px rgba(37,99,235,0.15);
}
.owner-social-link {
    display: inline-flex; align-items: center; gap: 6px;
    color: #2563eb; text-decoration: none; font-weight: 500; font-size: 13px;
    transition: color 0.2s ease;
}
.owner-social-link:hover { color: #1e40af; text-decoration: underline; }
.owner-na { color: #cbd5e1; }

.owner-actions { display: flex; justify-content: center; gap: 8px; }
.owner-action-btn {
    width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;
    transition: all 0.2s ease; font-size: 0.95rem;
    text-decoration: none;
}
.owner-action-btn:hover { transform: translateY(-1px); }
.owner-edit { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
.owner-edit:hover { background: #dbeafe; }
.owner-del { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.owner-del:hover { background: #fee2e2; }

.owner-empty-row { text-align: center; padding: 60px 20px !important; }
.owner-empty-state { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.owner-empty-icon { font-size: 40px; color: #94a3b8; margin-bottom: 8px; display: block; }
.owner-empty-title { font-weight: 600; font-size: 16px; color: #64748b; }
.owner-empty-sub { font-size: 13px; color: #94a3b8; }

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .owner-page { padding: 20px 22px; }
    .owner-table td, .owner-table th { padding: 12px 14px; font-size: 13px; }
}
@media (max-width: 768px) {
    .owner-page { padding: 16px; }
    .owner-table td, .owner-table th { padding: 10px 12px; font-size: 13px; }
    .owner-header { padding: 14px 16px; }
    .owner-table th:nth-child(3), .owner-table td:nth-child(3),
    .owner-table th:nth-child(4), .owner-table td:nth-child(4) { display: none; }
}
@media (max-width: 480px) {
    .owner-page { padding: 12px; }
    .owner-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .owner-add-btn { width: 100%; justify-content: center; }
    .owner-avatar { width: 40px; height: 40px; }
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

function deleteOwner(id, name) {
    Swal.fire({
        title: 'Delete this owner?',
        text: name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then(function (result) {
        if (result.isConfirmed) {
            axios.delete('{{ url('/admin/owners') }}/' + id)
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
                        text: 'Could not delete the owner.',
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