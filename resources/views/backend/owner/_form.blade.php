<div class="owner-header">
    <div class="owner-header-inner">
        <div>
            <h4 class="owner-header-title">{{ $cardTitle }}</h4>
            <p class="owner-header-sub">Fill in the owner details below</p>
        </div>
        <a href="{{ route('admin.owner.index') }}" class="owner-back-btn">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="owner-card-wrap">
    <div class="owner-card">
        <form id="ownerForm" method="POST" enctype="multipart/form-data" action="{{ $action }}">
            @csrf
            @if($method)
                @method($method)
            @endif

            @if ($errors->any())
                <div class="owner-alert">
                    <div class="owner-alert-title"><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="owner-form-body">
                {{-- Photo Preview --}}
                <div class="owner-photo-field">
                    <img src="{{ $owner && $owner->photo ? route('admin.owner.photo', $owner) : '' }}" alt="Photo preview" class="owner-photo-preview" id="ownerPhotoPreview">
                    <label for="ownerPhotoInput" class="owner-photo-upload">
                        <i class="bi bi-camera"></i> Choose Photo
                    </label>
                    <input type="file" id="ownerPhotoInput" name="photo" accept="image/*" class="owner-photo-input">
                    <span class="owner-photo-hint">JPG, PNG, WEBP up to 2MB</span>
                </div>

                <div class="owner-form-group">
                    <label for="ownerName" class="owner-label">Name <span class="req">*</span></label>
                    <input type="text" id="ownerName" name="name" class="owner-input {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter owner name" value="{{ old('name', $owner->name ?? '') }}" required>
                </div>

                <div class="owner-form-group">
                    <label for="ownerFb" class="owner-label"><i class="bi bi-facebook"></i> Facebook</label>
                    <input type="url" id="ownerFb" name="facebook" class="owner-input {{ $errors->has('facebook') ? 'is-invalid' : '' }}" placeholder="https://facebook.com/..." value="{{ old('facebook', $owner->facebook ?? '') }}">
                </div>

                <div class="owner-form-group">
                    <label for="ownerIg" class="owner-label"><i class="bi bi-instagram"></i> Instagram</label>
                    <input type="url" id="ownerIg" name="instagram" class="owner-input {{ $errors->has('instagram') ? 'is-invalid' : '' }}" placeholder="https://instagram.com/..." value="{{ old('instagram', $owner->instagram ?? '') }}">
                </div>
            </div>

            <div class="owner-form-footer">
                <a href="{{ route('admin.owner.index') }}" class="owner-btn-secondary">Cancel</a>
                <button type="submit" class="owner-btn-primary">
                    <i class="bi bi-check-lg"></i> {{ $owner ? 'Update Owner' : 'Save Owner' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
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
.owner-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.owner-card { width: 100%; }

.owner-back-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #475569;
    padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600;
    text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.owner-back-btn:hover { background: #e2e8f0; color: #1e293b; }

.owner-alert {
    margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px;
    background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c;
}
.owner-alert-title { font-weight: 600; font-size: 13px; margin-bottom: 6px; }
.owner-alert ul { margin: 0; padding-left: 18px; font-size: 13px; }

.owner-form-body { padding: 24px; }

.owner-photo-field {
    display: flex; flex-direction: column; align-items: center; gap: 10px;
    margin-bottom: 22px;
}
.owner-photo-preview {
    width: 110px; height: 110px; border-radius: 50%; object-fit: cover;
    border: 3px dashed #cbd5e1; background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8; font-size: 2.5rem;
}
.owner-photo-upload {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; border: 1px solid #bfdbfe; border-radius: 8px;
    background: #eff6ff; color: #2563eb; font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s ease;
}
.owner-photo-upload:hover { background: #dbeafe; }
.owner-photo-input {
    position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden;
}
.owner-photo-hint { font-size: 11px; color: #94a3b8; }

.owner-form-group { margin-bottom: 18px; }
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
.owner-input.is-invalid { border-color: #dc2626; }

.owner-form-footer {
    padding: 16px 24px; border-top: 1px solid #e2e8f0;
    display: flex; justify-content: flex-end; gap: 10px;
    background: #f8fafc;
}
.owner-btn-secondary {
    display: inline-flex; align-items: center; justify-content: center;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b;
    padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
    cursor: pointer; text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.owner-btn-secondary:hover { background: #e2e8f0; color: #1e293b; }
.owner-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 10px 22px; border: none; border-radius: 8px; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit; box-shadow: 0 4px 12px rgba(37,99,235,0.25);
}
.owner-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

@media (max-width: 480px) {
    .owner-form-body { padding: 18px; }
    .owner-form-footer { flex-direction: column-reverse; }
    .owner-form-footer a,
    .owner-form-footer button { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
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
</script>