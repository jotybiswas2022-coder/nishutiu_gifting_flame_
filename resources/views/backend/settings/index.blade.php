@extends('backend.app')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="set-page">

    <div class="set-header">
        <div class="set-header-inner">
            <div>
                <h4 class="set-header-title">Settings</h4>
                <p class="set-header-sub">Delivery charge, payment numbers and social links — shown in serial order</p>
            </div>
        </div>
    </div>

    <div class="set-card-wrap">
        <div class="set-card">
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="set-alert">
                        <div class="set-alert-title"><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="set-form-body">
                    <ol class="set-list">
                        @foreach($fields as $key => $field)
                            <li class="set-item">
                                <span class="set-serial">{{ $loop->iteration }}</span>
                                <div class="set-field">
                                    <label for="set_{{ $key }}" class="set-label">
                                        <i class="bi {{ $field['icon'] }}"></i> {{ $field['label'] }}
                                    </label>
                                    <input
                                        type="{{ $field['type'] }}"
                                        id="set_{{ $key }}"
                                        name="{{ $key }}"
                                        class="set-input {{ $errors->has($key) ? 'is-invalid' : '' }}"
                                        placeholder="{{ $field['placeholder'] }}"
                                        value="{{ old($key, $values[$key] ?? '') }}"
                                    >
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="set-form-footer">
                    <button type="submit" class="set-btn-primary">
                        <i class="bi bi-check-lg"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.set-page { padding: 24px 28px; height: 100%; }
.set-header {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px;
    padding: 18px 22px; margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.04);
}
.set-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
}
.set-header-title { font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 2px 0; }
.set-header-sub { font-size: 13px; color: #64748b; margin: 0; }

.set-card-wrap {
    border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff;
    overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.06);
}
.set-alert {
    margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px;
    background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c;
}
.set-alert-title { font-weight: 600; font-size: 13px; margin-bottom: 6px; }
.set-alert ul { margin: 0; padding-left: 18px; font-size: 13px; }

.set-form-body { padding: 18px 24px 8px; }
.set-list {
    list-style: none; margin: 0; padding: 0;
    display: flex; flex-direction: column; gap: 14px;
}
.set-item {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 14px 16px; background: #f8fafc;
    border: 1px solid #e2e8f0; border-radius: 12px;
    transition: all 0.2s ease;
}
.set-item:hover { border-color: #bfdbfe; background: #fbfdff; }
.set-serial {
    flex-shrink: 0; width: 30px; height: 30px; margin-top: 2px;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    border-radius: 50%; font-weight: 700; font-size: 13px;
    box-shadow: 0 3px 8px rgba(37,99,235,0.3);
}
.set-field { flex: 1; min-width: 0; }
.set-label {
    display: block; font-size: 13px; font-weight: 600; color: #475569;
    margin-bottom: 6px;
}
.set-label i { color: #2563eb; margin-right: 5px; }
.set-input {
    width: 100%; padding: 10px 14px; font-size: 14px; color: #1e293b;
    border: 1px solid #cbd5e1; border-radius: 10px; background: #ffffff;
    transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit;
}
.set-input:focus {
    outline: none; border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}
.set-input::placeholder { color: #94a3b8; }
.set-input.is-invalid { border-color: #dc2626; }

.set-form-footer {
    padding: 16px 24px; border-top: 1px solid #e2e8f0;
    display: flex; justify-content: flex-end; gap: 10px;
    background: #f8fafc;
}
.set-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 10px 26px; border: none; border-radius: 8px; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit; box-shadow: 0 4px 12px rgba(37,99,235,0.25);
}
.set-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

@media (max-width: 768px) {
    .set-page { padding: 16px; }
    .set-header { padding: 14px 16px; }
    .set-form-body { padding: 14px 14px 6px; }
    .set-item { padding: 12px 12px; }
}
@media (max-width: 480px) {
    .set-page { padding: 12px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
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
            iconColor: '#2563eb'
        });
    }
});
</script>

@endsection