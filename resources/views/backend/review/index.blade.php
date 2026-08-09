@extends('backend.app')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="rev-page">

    <div class="rev-header">
        <div class="rev-header-inner">
            <div>
                <h4 class="rev-header-title">Customer Reviews</h4>
                <p class="rev-header-sub">Store and manage customer review screenshots</p>
            </div>
            <a href="{{ route('admin.review.create') }}" class="rev-add-btn">
                <i class="bi bi-plus-lg"></i> Add Review
            </a>
        </div>
    </div>

    @if($reviews->isNotEmpty())
        <div class="rev-grid">
            @foreach ($reviews as $review)
                <div class="rev-card-item">
                    <a href="{{ route('admin.review.image', $review) }}" target="_blank" rel="noopener" class="rev-thumb-link" title="Open full screenshot">
                        <img src="{{ route('admin.review.image', $review) }}" alt="{{ $review->customer_name ?? 'Review screenshot' }}" class="rev-thumb" loading="lazy">
                        <span class="rev-zoom"><i class="bi bi-zoom-in"></i></span>
                    </a>
                    <div class="rev-card-body">
                        <div class="rev-card-name">
                            {{ $review->customer_name ?: 'Anonymous' }}
                        </div>
                        @if($review->caption)
                            <p class="rev-card-caption">{{ $review->caption }}</p>
                        @endif
                        <div class="rev-card-foot">
                            <span class="rev-card-date">
                                <i class="bi bi-calendar3"></i> {{ $review->created_at ? $review->created_at->format('d M Y') : '—' }}
                            </span>
                            <div class="rev-actions">
                                <a href="{{ route('admin.review.edit', $review) }}" class="rev-action-btn rev-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="rev-action-btn rev-del" title="Delete" onclick="deleteReview({{ $review->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="rev-empty-state">
            <i class="bi bi-layout-text-window-reverse rev-empty-icon"></i>
            <div class="rev-empty-title">No Review Screenshots Yet</div>
            <div class="rev-empty-sub">Click "Add Review" to store the first customer review image.</div>
        </div>
    @endif
</div>

<style>
.rev-page { padding: 24px 28px; height: 100%; }
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
.rev-add-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #2563EB, #1E40AF); color: #fff;
    padding: 9px 18px; border: none; border-radius: 10px; font-size: 13px;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(37,99,235,0.25); text-decoration: none;
}
.rev-add-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }

.rev-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 18px;
}
.rev-card-item {
    background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px;
    overflow: hidden; box-shadow: 0 4px 16px rgba(15,23,42,0.05);
    transition: all 0.22s ease; display: flex; flex-direction: column;
}
.rev-card-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(15,23,42,0.12);
    border-color: #bfdbfe;
}
.rev-thumb-link {
    position: relative; display: block; width: 100%;
    height: 170px; overflow: hidden; background: #f1f5f9;
}
.rev-thumb {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform 0.35s ease;
}
.rev-thumb-link:hover .rev-thumb { transform: scale(1.06); }
.rev-zoom {
    position: absolute; inset: 0; display: flex; align-items: center;
    justify-content: center; font-size: 1.6rem; color: #ffffff;
    background: rgba(30, 64, 175, 0.35); opacity: 0;
    transition: opacity 0.25s ease;
}
.rev-thumb-link:hover .rev-zoom { opacity: 1; }

.rev-card-body { padding: 14px 15px; display: flex; flex-direction: column; flex: 1; }
.rev-card-name { font-weight: 700; font-size: 14px; color: #1e293b; }
.rev-card-caption {
    font-size: 13px; color: #64748b; margin: 4px 0 0 0;
    flex: 1; overflow: hidden; display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical;
}
.rev-card-foot {
    display: flex; align-items: center; justify-content: space-between;
    gap: 8px; margin-top: 12px; padding-top: 10px;
    border-top: 1px solid #f1f5f9;
}
.rev-card-date { font-size: 11px; color: #94a3b8; display: inline-flex; align-items: center; gap: 4px; }
.rev-actions { display: flex; gap: 6px; }
.rev-action-btn {
    width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;
    border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;
    transition: all 0.2s ease; font-size: 0.85rem; text-decoration: none;
}
.rev-action-btn:hover { transform: translateY(-1px); }
.rev-edit { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
.rev-edit:hover { background: #dbeafe; }
.rev-del { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.rev-del:hover { background: #fee2e2; }

.rev-empty-state {
    display: flex; flex-direction: column; align-items: center; gap: 8px;
    background: #ffffff; border: 2px dashed #e2e8f0; border-radius: 14px;
    padding: 70px 20px; text-align: center;
}
.rev-empty-icon { font-size: 44px; color: #94a3b8; margin-bottom: 8px; display: block; }
.rev-empty-title { font-weight: 600; font-size: 16px; color: #64748b; }
.rev-empty-sub { font-size: 13px; color: #94a3b8; }

@media (max-width: 992px) {
    .rev-page { padding: 20px 22px; }
}
@media (max-width: 768px) {
    .rev-page { padding: 16px; }
    .rev-header { padding: 14px 16px; }
}
@media (max-width: 480px) {
    .rev-page { padding: 12px; }
    .rev-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .rev-add-btn { width: 100%; justify-content: center; }
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
            iconColor: '#2563eb'
        });
    }
});

function deleteReview(id) {
    Swal.fire({
        title: 'Delete this review screenshot?',
        text: 'This cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then(function (result) {
        if (result.isConfirmed) {
            axios.delete('{{ url('/admin/reviews') }}/' + id)
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
                        text: 'Could not delete the review screenshot.',
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