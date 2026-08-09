<div class="it-header">
    <div class="it-header-inner">
        <div>
            <h4 class="it-header-title">{{ $cardTitle }}</h4>
            <p class="it-header-sub">Fill in the item details below</p>
        </div>
        <a href="{{ route('admin.item.index') }}" class="it-back-btn">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="it-card-wrap">
    <div class="it-card">
        <form id="itemForm" method="POST" enctype="multipart/form-data" action="{{ $action }}">
            @csrf
            @if($method)
                @method($method)
            @endif

            @if ($errors->any())
                <div class="it-alert">
                    <div class="it-alert-title"><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="it-form-body">

                <div class="it-form-group">
                    <label for="itName" class="it-label">Item Name <span class="req">*</span></label>
                    <input type="text" id="itName" name="name" class="it-input {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter item name" value="{{ old('name', $item->name ?? '') }}" required>
                </div>

                <div class="it-form-group">
                    <label for="itCategory" class="it-label"><i class="bi bi-tag"></i> Category <span class="req">*</span></label>
                    <select id="itCategory" name="category_id" class="it-input {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="it-form-row">
                    <div class="it-form-group">
                        <label for="itPrice" class="it-label"><i class="bi bi-cash-stack"></i> Price <span class="req">*</span></label>
                        <input type="number" step="0.01" min="0" id="itPrice" name="price" class="it-input {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="0.00" value="{{ old('price', $item->price ?? '') }}" required>
                    </div>
                    <div class="it-form-group">
                        <label for="itCost" class="it-label"><i class="bi bi-cash-coin"></i> Cost <span class="req">*</span></label>
                        <input type="number" step="0.01" min="0" id="itCost" name="cost" class="it-input {{ $errors->has('cost') ? 'is-invalid' : '' }}" placeholder="0.00" value="{{ old('cost', $item->cost ?? '') }}" required>
                    </div>
                </div>

                <div class="it-form-group">
                    <label for="itDetails" class="it-label"><i class="bi bi-card-text"></i> Details</label>
                    <textarea id="itDetails" name="details" rows="4" class="it-input {{ $errors->has('details') ? 'is-invalid' : '' }}" placeholder="Item description / details (optional)">{{ old('details', $item->details ?? '') }}</textarea>
                </div>

                {{-- Existing Pictures (edit mode) --}}
                @if($item && $item->images->isNotEmpty())
                    <div class="it-form-group">
                        <label class="it-label"><i class="bi bi-images"></i> Current Pictures</label>
                        <div class="it-photo-previews" id="itExistingPhotos">
                            @foreach ($item->images as $img)
                                <div class="it-photo-thumb" data-remove-id="{{ $img->id }}" id="itExistingThumb{{ $img->id }}">
                                    <img src="{{ route('admin.item.image', $img) }}" alt="{{ $item->name }}">
                                    <label class="it-photo-remove" title="Remove this picture">
                                        <input type="checkbox" name="remove_images[]" value="{{ $img->id }}" onchange="this.closest('.it-photo-thumb').classList.toggle('removed')">
                                        <i class="bi bi-x-lg"></i>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <span class="it-photo-hint">Tick the <i class="bi bi-x-lg"></i> on a picture to remove it before saving.</span>
                    </div>
                @endif

                {{-- New Pictures --}}
                <div class="it-form-group">
                    <label class="it-label"><i class="bi bi-plus-square"></i> Add Pictures</label>
                    <label for="itPhotoInput" class="it-photo-upload">
                        <i class="bi bi-camera"></i> Choose Pictures (multiple allowed)
                    </label>
                    <input type="file" id="itPhotoInput" name="images[]" accept="image/*" multiple class="it-photo-input">
                    <span class="it-photo-hint">You can add 1 or many pictures — add as many as you like. JPG, PNG, WEBP up to 2MB each.</span>
                    <div class="it-photo-previews" id="itPhotoPreviews"></div>
                </div>
            </div>

            <div class="it-form-footer">
                <a href="{{ route('admin.item.index') }}" class="it-btn-secondary">Cancel</a>
                <button type="submit" class="it-btn-primary">
                    <i class="bi bi-check-lg"></i> {{ $item ? 'Update Item' : 'Save Item' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
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
.it-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.it-card { width: 100%; }

.it-back-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #475569;
    padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600;
    text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.it-back-btn:hover { background: #e2e8f0; color: #1e293b; }

.it-alert {
    margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px;
    background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c;
}
.it-alert-title { font-weight: 600; font-size: 13px; margin-bottom: 6px; }
.it-alert ul { margin: 0; padding-left: 18px; font-size: 13px; }

.it-form-body { padding: 24px; }
.it-form-row {
    display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
}

.it-form-group { margin-bottom: 18px; }
.it-label {
    display: block; font-size: 13px; font-weight: 600; color: #475569;
    margin-bottom: 6px;
}
.it-label .req { color: #dc2626; }
.it-label i { color: #2563eb; margin-right: 4px; }
.it-input {
    width: 100%; padding: 11px 14px; font-size: 14px; color: #1e293b;
    border: 1px solid #cbd5e1; border-radius: 10px; background: #ffffff;
    transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit;
    resize: vertical;
}
.it-input:focus {
    outline: none; border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}
.it-input::placeholder { color: #94a3b8; }
.it-input.is-invalid { border-color: #dc2626; }

.it-photo-upload {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px; border: 1px solid #bfdbfe; border-radius: 8px;
    background: #eff6ff; color: #2563eb; font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s ease;
}
.it-photo-upload:hover { background: #dbeafe; }
.it-photo-input {
    position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden;
}
.it-photo-hint { display: block; font-size: 11.5px; color: #94a3b8; margin-top: 8px; }
.it-photo-previews {
    display: flex; flex-wrap: wrap; gap: 12px; margin-top: 14px;
}
.it-photo-thumb {
    position: relative; width: 92px; height: 92px; border-radius: 12px;
    border: 2px solid #dbeafe; overflow: hidden; background: #f8fafc;
}
.it-photo-thumb img {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
.it-photo-thumb.removed {
    border-color: #fca5a5;
    opacity: 0.45;
    filter: grayscale(1);
}
.it-photo-remove {
    position: absolute; top: 4px; right: 4px;
    width: 24px; height: 24px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(220,38,38,0.9); color: #fff; cursor: pointer;
    font-size: 0.75rem;
}
.it-photo-remove input { display: none; }
.it-photo-remove i { pointer-events: none; }
.it-photo-thumb.removed .it-photo-remove { background: rgba(15,23,42,0.6); }

.it-preview-thumb .it-preview-del {
    position: absolute; top: 4px; right: 4px;
    width: 24px; height: 24px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(220,38,38,0.9); color: #fff; cursor: pointer;
    border: none; font-size: 0.75rem;
}

.it-form-footer {
    padding: 16px 24px; border-top: 1px solid #e2e8f0;
    display: flex; justify-content: flex-end; gap: 10px;
    background: #f8fafc;
}
.it-btn-secondary {
    display: inline-flex; align-items: center; justify-content: center;
    background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b;
    padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
    cursor: pointer; text-decoration: none; transition: all 0.2s ease; font-family: inherit;
}
.it-btn-secondary:hover { background: #e2e8f0; color: #1e293b; }
.it-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 10px 22px; border: none; border-radius: 8px; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit; box-shadow: 0 4px 12px rgba(37,99,235,0.25);
}
.it-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

@media (max-width: 600px) {
    .it-form-row { grid-template-columns: 1fr; gap: 0; }
    .it-form-body { padding: 18px; }
    .it-form-footer { flex-direction: column-reverse; }
    .it-form-footer a,
    .it-form-footer button { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var photoInput = document.getElementById('itPhotoInput');
    var previews = document.getElementById('itPhotoPreviews');
    var selectedFiles = [];

    if (!photoInput || !previews) return;

    function syncInputFiles() {
        var dt = new DataTransfer();
        selectedFiles.forEach(function (f) { dt.items.add(f); });
        photoInput.files = dt.files;
    }

    function renderPreviews() {
        previews.innerHTML = '';
        selectedFiles.forEach(function (file, index) {
            var wrap = document.createElement('div');
            wrap.className = 'it-photo-thumb it-preview-thumb';

            var img = document.createElement('img');
            img.alt = 'Picture';
            var reader = new FileReader();
            reader.onload = function (e) { img.src = e.target.result; };
            reader.readAsDataURL(file);

            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'it-preview-del';
            btn.innerHTML = '<i class="bi bi-x-lg"></i>';
            btn.addEventListener('click', function () {
                selectedFiles.splice(index, 1);
                syncInputFiles();
                renderPreviews();
            });

            wrap.appendChild(img);
            wrap.appendChild(btn);
            previews.appendChild(wrap);
        });
        syncInputFiles();
    }

    photoInput.addEventListener('change', function () {
        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            selectedFiles.push(files[i]);
        }
        this.value = '';
        renderPreviews();
    });
});
</script>