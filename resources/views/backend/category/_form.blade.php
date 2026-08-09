<div class="cat-header">
    <div class="cat-header-inner">
        <div>
            <h4 class="cat-header-title">{{ $cardTitle }}</h4>
            <p class="cat-header-sub">Fill in the category details below</p>
        </div>
        <a href="{{ route('admin.category.index') }}" class="cat-back-btn">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="cat-card-wrap">
    <div class="cat-card">
        <form id="catForm" method="POST" enctype="multipart/form-data" action="{{ $action }}">
            @csrf
            @if($method)
                @method($method)
            @endif

            @if ($errors->any())
                <div class="cat-alert">
                    <div class="cat-alert-title"><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="cat-form-body">
                {{-- Photo Preview --}}
                <div class="cat-photo-field">
                    <img src="{{ $category && $category->photo ? route('admin.category.photo', $category) : '' }}" alt="Photo preview" class="cat-photo-preview" id="catPhotoPreview">
                    <label for="catPhotoInput" class="cat-photo-upload">
                        <i class="bi bi-camera"></i> Choose Photo
                    </label>
                    <input type="file" id="catPhotoInput" name="photo" accept="image/*" class="cat-photo-input">
                    <span class="cat-photo-hint">JPG, PNG, WEBP up to 2MB</span>
                </div>

                <div class="cat-form-group">
                    <label for="catName" class="cat-label">Name <span class="req">*</span></label>
                    <input type="text" id="catName" name="name" class="cat-input {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter category name" value="{{ old('name', $category->name ?? '') }}" required>
                </div>

                <div class="cat-form-group">
                    <label for="catDesc" class="cat-label"><i class="bi bi-card-text"></i> Description</label>
                    <textarea id="catDesc" name="description" rows="4" class="cat-input {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Short description of this category (optional)">{{ old('description', $category->description ?? '') }}</textarea>
                </div>
            </div>

            <div class="cat-form-footer">
                <a href="{{ route('admin.category.index') }}" class="cat-btn-secondary">Cancel</a>
                <button type="submit" class="cat-btn-primary">
                    <i class="bi bi-check-lg"></i> {{ $category ? 'Update Category' : 'Save Category' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
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
.cat-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.cat-card { width: 100%; }

.cat-back-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #475569;
    padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600;
    text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.cat-back-btn:hover { background: #e2e8f0; color: #1e293b; }

.cat-alert {
    margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px;
    background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c;
}
.cat-alert-title { font-weight: 600; font-size: 13px; margin-bottom: 6px; }
.cat-alert ul { margin: 0; padding-left: 18px; font-size: 13px; }

.cat-form-body { padding: 24px; }

.cat-photo-field {
    display: flex; flex-direction: column; align-items: center; gap: 10px;
    margin-bottom: 22px;
}
.cat-photo-preview {
    width: 110px; height: 110px; border-radius: 50%; object-fit: cover;
    border: 3px dashed #cbd5e1; background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8; font-size: 2.5rem;
}
.cat-photo-upload {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; border: 1px solid #bfdbfe; border-radius: 8px;
    background: #eff6ff; color: #2563eb; font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s ease;
}
.cat-photo-upload:hover { background: #dbeafe; }
.cat-photo-input {
    position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden;
}
.cat-photo-hint { font-size: 11px; color: #94a3b8; }

.cat-form-group { margin-bottom: 18px; }
.cat-label {
    display: block; font-size: 13px; font-weight: 600; color: #475569;
    margin-bottom: 6px;
}
.cat-label .req { color: #dc2626; }
.cat-label i { color: #2563eb; margin-right: 4px; }
.cat-input {
    width: 100%; padding: 11px 14px; font-size: 14px; color: #1e293b;
    border: 1px solid #cbd5e1; border-radius: 10px; background: #ffffff;
    transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit;
    resize: vertical;
}
.cat-input:focus {
    outline: none; border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}
.cat-input::placeholder { color: #94a3b8; }
.cat-input.is-invalid { border-color: #dc2626; }

.cat-form-footer {
    padding: 16px 24px; border-top: 1px solid #e2e8f0;
    display: flex; justify-content: flex-end; gap: 10px;
    background: #f8fafc;
}
.cat-btn-secondary {
    display: inline-flex; align-items: center; justify-content: center;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b;
    padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
    cursor: pointer; text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.cat-btn-secondary:hover { background: #e2e8f0; color: #1e293b; }
.cat-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 10px 22px; border: none; border-radius: 8px; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit; box-shadow: 0 4px 12px rgba(37,99,235,0.25);
}
.cat-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

@media (max-width: 480px) {
    .cat-form-body { padding: 18px; }
    .cat-form-footer { flex-direction: column-reverse; }
    .cat-form-footer a,
    .cat-form-footer button { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('catPhotoInput').addEventListener('change', function () {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('catPhotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
});
</script>