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
            <button class="owner-add-btn" onclick="openOwnerModal()">
                <i class="bi bi-plus-lg"></i> Add Owner
            </button>
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
                                        <button class="owner-action-btn owner-edit" data-id="{{ $owner->id }}"
                                                data-name="{{ $owner->name }}"
                                                data-photo-url="{{ route('admin.owner.photo', $owner) }}"
                                                data-has-photo="{{ $owner->photo ? '1' : '0' }}"
                                                data-facebook="{{ $owner->facebook }}"
                                                data-instagram="{{ $owner->instagram }}"
                                                title="Edit" onclick="openOwnerModal(this)">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
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

{{-- Add / Edit Modal --}}
<div class="modal fade" id="ownerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="owner-modal-content">
            <div class="owner-modal-header">
                <h5 class="owner-modal-title" id="ownerModalTitle">Add Owner</h5>
                <button type="button" class="owner-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="ownerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="owner-modal-body">

                    {{-- Photo Preview --}}
                    <div class="owner-photo-field">
                        <img src="" alt="Photo preview" class="owner-photo-preview" id="ownerPhotoPreview">
                        <label for="ownerPhotoInput" class="owner-photo-upload">
                            <i class="bi bi-camera"></i> Choose Photo
                        </label>
                        <input type="file" id="ownerPhotoInput" name="photo" accept="image/*" class="owner-photo-input">
                        <span class="owner-photo-hint">JPG, PNG, WEBP up to 2MB</span>
                    </div>

                    <div class="owner-form-group">
                        <label for="ownerName" class="owner-label">Name <span class="req">*</span></label>
                        <input type="text" id="ownerName" name="name" class="owner-input" placeholder="Enter owner name" required>
                    </div>

                    <div class="owner-form-group">
                        <label for="ownerFb" class="owner-label"><i class="bi bi-facebook"></i> Facebook</label>
                        <input type="url" id="ownerFb" name="facebook" class="owner-input" placeholder="https://facebook.com/...">
                    </div>

                    <div class="owner-form-group">
                        <label for="ownerIg" class="owner-label"><i class="bi bi-instagram"></i> Instagram</label>
                        <input type="url" id="ownerIg" name="instagram" class="owner-input" placeholder="https://instagram.com/...">
                    </div>
                </div>
                <div class="owner-modal-footer">
                    <button type="button" class="owner-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="owner-btn-primary"><i class="bi bi-check-lg"></i> Save Owner</button>
                </div>
            </form>
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

/* ===== MODAL ===== */
.owner-modal-content {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px;
    box-shadow: 0 25px 60px rgba(15,23,42,0.18); overflow: hidden;
}
.owner-modal-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px;
    background: linear-gradient(135deg, rgba(37,99,235,0.06), rgba(37,99,235,0.02));
    border-bottom: 1px solid #e2e8f0;
}
.owner-modal-title { font-size: 17px; font-weight: 600; color: #1e293b; margin: 0; }
.owner-modal-close {
    background: none; border: none; color: #64748b; font-size: 14px;
    cursor: pointer; padding: 6px; border-radius: 6px; transition: all 0.2s;
    width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
}
.owner-modal-close:hover { background: #e2e8f0; color: #1e293b; }
.owner-modal-body { padding: 24px; }

.owner-photo-field {
    display: flex; flex-direction: column; align-items: center; gap: 10px;
    margin-bottom: 20px;
}
.owner-photo-preview {
    width: 96px; height: 96px; border-radius: 50%; object-fit: cover;
    border: 3px dashed #cbd5e1; background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8; font-size: 2.5rem;
}
.owner-photo-upload {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 16px; border: 1px solid #bfdbfe; border-radius: 8px;
    background: #eff6ff; color: #2563eb; font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s ease;
}
.owner-photo-upload:hover { background: #dbeafe; }
.owner-photo-input {
    position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden;
}
.owner-photo-hint { font-size: 11px; color: #94a3b8; }

.owner-form-group { margin-bottom: 16px; }
.owner-label {
    display: block; font-size: 13px; font-weight: 600; color: #475569;
    margin-bottom: 6px;
}
.owner-label .req { color: #dc2626; }
.owner-label i { color: #2563eb; margin-right: 4px; }
.owner-input {
    width: 100%; padding: 11px 14px; font-size: 14px; color: #1e293b;
    border: 1px solid #cbd5e1; border-radius: 10px; background: #ffffff;
    transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit;
}
.owner-input:focus {
    outline: none; border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}
.owner-input::placeholder { color: #94a3b8; }

.owner-modal-footer {
    padding: 14px 24px; border-top: 1px solid #e2e8f0;
    display: flex; justify-content: flex-end; gap: 10px;
}
.owner-btn-secondary {
    background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b;
    padding: 9px 20px; border-radius: 8px; font-size: 14px; font-weight: 500;
    cursor: pointer; transition: all 0.2s ease; font-family: inherit;
}
.owner-btn-secondary:hover { background: #e2e8f0; color: #1e293b; }
.owner-btn-primary {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 9px 20px; border: none; border-radius: 8px; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit; box-shadow: 0 4px 12px rgba(37,99,235,0.25);
}
.owner-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

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
    .owner-modal-body { padding: 18px; }
}
@media (max-width: 480px) {
    .owner-page { padding: 12px; }
    .owner-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .owner-add-btn { width: 100%; justify-content: center; }
    .owner-avatar { width: 40px; height: 40px; }
    .owner-modal-footer { flex-direction: column-reverse; }
    .owner-modal-footer button { width: 100%; justify-content: center; }
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

    // Photo preview
    document.getElementById('ownerPhotoInput').addEventListener('change', function () {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('ownerPhotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
});

var ownerModalEl = document.getElementById('ownerModal');

function openOwnerModal(btn) {
    var form = document.getElementById('ownerForm');
    var title = document.getElementById('ownerModalTitle');
    var preview = document.getElementById('ownerPhotoPreview');
    var photoInput = document.getElementById('ownerPhotoInput');
    var methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) methodInput.remove();

    if (!btn) {
        // Add mode
        title.textContent = 'Add Owner';
        form.action = '{{ route('admin.owner.store') }}';
        form.reset();
        preview.removeAttribute('src');
        preview.style.background = '#f8fafc';
        preview.style.border = '3px dashed #cbd5e1';
        preview.innerHTML = '';
    } else {
        // Edit mode
        title.textContent = 'Edit Owner';
        var id = btn.getAttribute('data-id');
        form.action = '{{ url('/admin/owners') }}/' + id;
        var method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        form.appendChild(method);

        document.getElementById('ownerName').value = btn.getAttribute('data-name') || '';
        document.getElementById('ownerFb').value = btn.getAttribute('data-facebook') || '';
        document.getElementById('ownerIg').value = btn.getAttribute('data-instagram') || '';

        if (btn.getAttribute('data-has-photo') === '1') {
            preview.src = btn.getAttribute('data-photo-url');
            preview.style.background = 'transparent';
            preview.style.border = 'none';
        } else {
            preview.removeAttribute('src');
            preview.style.background = '#f8fafc';
            preview.style.border = '3px dashed #cbd5e1';
            preview.innerHTML = '';
        }
    }

    var modal = new bootstrap.Modal(ownerModalEl);
    modal.show();
}

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