<div class="rev-header">
    <div class="rev-header-inner">
        <div>
            <h4 class="rev-header-title">{{ $cardTitle }}</h4>
            <p class="rev-header-sub">Store a customer's review screenshot</p>
        </div>
        <a href="{{ route('admin.review.index') }}" class="rev-back-btn">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="rev-card-wrap">
    <div class="rev-card">
        <form id="reviewForm" method="POST" enctype="multipart/form-data" action="{{ $action }}">
            @csrf
            @if($method)
                @method($method)
            @endif

            @if ($errors->any())
                <div class="rev-alert">
                    <div class="rev-alert-title"><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rev-form-body">
                <div class="rev-photo-field {{ $review && $review->image ? '' : 'rev-required' }}">
                    <img src="{{ $review && $review->image ? route('admin.review.image', $review) : '' }}" alt="Screenshot preview" class="rev-photo-preview" id="reviewPhotoPreview">
                    <label for="reviewPhotoInput" class="rev-photo-upload">
                        <i class="bi bi-camera"></i> Choose Screenshot
                    </label>
                    <input type="file" id="reviewPhotoInput" name="image" accept="image/*" class="rev-photo-input" {{ $review ? '' : 'required' }}>
                    <span class="rev-photo-hint">JPG, PNG, WEBP up to 5MB</span>
                </div>

                <div class="rev-form-group">
                    <label for="reviewName" class="rev-label">Customer Name</label>
                    <input type="text" id="reviewName" name="customer_name" class="rev-input {{ $errors->has('customer_name') ? 'is-invalid' : '' }}" placeholder="e.g. Rafsan Ahmed" value="{{ old('customer_name', $review->customer_name ?? '') }}">
                </div>

                <div class="rev-form-group">
                    <label for="reviewCaption" class="rev-label">Caption / Note <span class="rev-hint">(visible somewhere nice)</span></label>
                    <textarea id="reviewCaption" name="caption" rows="3" class="rev-input rev-textarea {{ $errors->has('caption') ? 'is-invalid' : '' }}" placeholder="e.g. Anniversary gift — she loved it!">{{ old('caption', $review->caption ?? '') }}</textarea>
                </div>
            </div>

            <div class="rev-form-footer">
                <a href="{{ route('admin.review.index') }}" class="rev-btn-secondary">Cancel</a>
                <button type="submit" class="rev-btn-primary">
                    <i class="bi bi-check-lg"></i> {{ $review ? 'Update Review' : 'Save Review' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.rev-header {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px;
    padding: 18px 22px; margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.04);
}
.rev-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
}
.rev-header-title { font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 2px 0; }
.rev-header-sub { font-size: 13px; color: #64748b; margin: 0; }
.rev-back-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #475569;
    padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600;
    text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.rev-back-btn:hover { background: #e2e8f0; color: #1e293b; }
.rev-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.rev-alert {
    margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px;
    background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c;
}
.rev-alert-title { font-weight: 600; font-size: 13px; margin-bottom: 6px; }
.rev-alert ul { margin: 0; padding-left: 18px; font-size: 13px; }

.rev-form-body { padding: 24px; }
.rev-photo-field {
    display: flex; flex-direction: column; align-items: center; gap: 10px;
    margin-bottom: 22px;
}
.rev-photo-preview {
    width: 220px; height: 150px; object-fit: cover;
    border: 3px dashed #cbd5e1; background: #f8fafc; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8; font-size: 2rem;
}
.rev-photo-upload {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; border: 1px solid #bfdbfe; border-radius: 8px;
    background: #eff6ff; color: #2563eb; font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s ease;
}
.rev-photo-upload:hover { background: #dbeafe; }
.rev-photo-input {
    position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden;
}
.rev-photo-hint { font-size: 11px; color: #94a3b8; }
.rev-required .rev-photo-preview { border-color: #2563eb; border-style: solid; }

.rev-form-group { margin-bottom: 18px; }
.rev-label {
    display: block; font-size: 13px; font-weight: 600; color: #475569;
    margin-bottom: 6px;
}
.rev-hint { font-weight: 400; color: #94a3b8; }
.rev-input {
    width: 100%; padding: 11px 14px; font-size: 14px; color: #1e293b;
    border: 1px solid #cbd5e1; border-radius: 10px; background: #ffffff;
    transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit;
}
.rev-input:focus {
    outline: none; border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}
.rev-input::placeholder { color: #94a3b8; }
.rev-input.is-invalid { border-color: #dc2626; }
.rev-textarea { resize: vertical; min-height: 90px; }

.rev-form-footer {
    padding: 16px 24px; border-top: 1px solid #e2e8f0;
    display: flex; justify-content: flex-end; gap: 10px;
    background: #f8fafc;
}
.rev-btn-secondary {
    display: inline-flex; align-items: center; justify-content: center;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b;
    padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
    cursor: pointer; text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.rev-btn-secondary:hover { background: #e2e8f0; color: #1e293b; }
.rev-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 10px 22px; border: none; border-radius: 8px; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit; box-shadow: 0 4px 12px rgba(37,99,235,0.25);
}
.rev-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

@media (max-width: 480px) {
    .rev-form-body { padding: 18px; }
    .rev-form-footer { flex-direction: column-reverse; }
    .rev-form-footer a,
    .rev-form-footer button { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('reviewPhotoInput').addEventListener('change', function () {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('reviewPhotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
});
</script>