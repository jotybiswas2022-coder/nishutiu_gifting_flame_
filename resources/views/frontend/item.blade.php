@extends('frontend.app')

@section('title', $item->name . ' | NishuTiu Gifting Flame')

@section('content')
@include('frontend.partials.shop-styles')

<style>
    .nf-detail {
        font-family: 'Inter', sans-serif;
        color: #1F1F1F;
        background: #FFF5F7;
    }

    .nf-detail-gallery {
        position: relative;
        border-radius: 26px;
        overflow: hidden;
        border: 1px solid rgba(255, 77, 109, 0.14);
        box-shadow: 0 22px 50px rgba(255, 77, 109, 0.14);
        aspect-ratio: 4 / 3;
        background: linear-gradient(135deg, #FFE3E9, #FFF0C2);
    }

    .nf-detail-gallery img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .nf-detail-gallery .nf-item-noimg {
        font-size: 5rem;
    }

    .nf-detail-thumbs {
        display: flex;
        gap: 0.7rem;
        margin-top: 0.9rem;
        flex-wrap: wrap;
    }

    .nf-detail-thumb {
        width: 76px;
        height: 76px;
        border-radius: 14px;
        overflow: hidden;
        border: 3px solid transparent;
        background: linear-gradient(135deg, #FFE3E9, #FFF0C2);
        cursor: pointer;
        transition: all 0.25s ease;
        padding: 0;
    }

    .nf-detail-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .nf-detail-thumb.nf-active {
        border-color: #FF4D6D;
        box-shadow: 0 8px 18px rgba(255, 77, 109, 0.35);
    }

    .nf-detail-cat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #C9184A;
        background: #FFE3E9;
        padding: 0.45rem 1.05rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 77, 109, 0.2);
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .nf-detail-cat:hover {
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        border-color: transparent;
        text-decoration: none;
    }

    .nf-detail-name {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: clamp(1.7rem, 3vw, 2.4rem);
        line-height: 1.15;
        color: #1F1F1F;
        margin: 0.9rem 0 0.4rem;
    }

    .nf-detail-price {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: clamp(1.7rem, 3vw, 2.2rem);
        color: #C9184A;
        margin-bottom: 1.2rem;
    }

    .nf-detail-price small {
        font-size: 0.8rem;
        font-weight: 700;
        color: #A08A92;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .nf-detail-desc-title {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #1F1F1F;
    }

    .nf-detail-desc {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.12rem;
        line-height: 1.7;
        color: #6B5860;
        white-space: pre-line;
        word-break: break-word;
    }

    .nf-detail-divider {
        border: 0;
        border-top: 1px solid rgba(255, 77, 109, 0.16);
        margin: 1.5rem 0;
    }

    .nf-qty-selector {
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(255, 77, 109, 0.3);
        border-radius: 50rem;
        background: #FFFFFF;
        overflow: hidden;
    }

    .nf-qty-selector button {
        border: none;
        background: transparent;
        width: 42px;
        height: 44px;
        font-size: 1.2rem;
        font-weight: 700;
        color: #C9184A;
        transition: all 0.2s ease;
    }

    .nf-qty-selector button:hover {
        background: #FFE3E9;
    }

    .nf-qty-selector input {
        border: none;
        width: 54px;
        text-align: center;
        font-weight: 700;
        color: #1F1F1F;
        background: transparent;
        border-left: 1px solid rgba(255, 77, 109, 0.12);
        border-right: 1px solid rgba(255, 77, 109, 0.12);
    }

    .nf-qty-selector input:focus {
        outline: none;
    }

    .nf-add-cart-btn {
        border: none;
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        font-weight: 800;
        font-size: 1rem;
        padding: 0.8rem 2rem;
        border-radius: 50rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        box-shadow: 0 14px 30px rgba(255, 77, 109, 0.35);
        transition: all 0.3s ease;
    }

    .nf-add-cart-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(255, 77, 109, 0.45);
        color: #FFFFFF;
    }

    .nf-ask-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 77, 109, 0.35);
        color: #C9184A;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        background: #FFFFFF;
    }

    .nf-ask-btn:hover {
        background: #FFE3E9;
        color: #8A0F35;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .nf-stock-note {
        font-size: 0.85rem;
        color: #A08A92;
    }

    .nf-stock-note i {
        color: #2FA96B;
    }
</style>

<section class="nf-detail py-5">
    <div class="container py-3">
        <div class="nf-shop-crumbs">
            <a href="/">Home</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('items.index') }}">Items</a>
            @if($item->category)
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('items.category', $item->category) }}">{{ $item->category->name }}</a>
            @endif
            <i class="bi bi-chevron-right"></i>
            <span style="color:#1F1F1F;">{{ $item->name }}</span>
        </div>

        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                @php $gallery = $item->images; @endphp
                <div class="nf-detail-gallery">
                    @if($gallery->isNotEmpty())
                        <img id="nfMainImg" src="{{ route('item.image', $gallery->first()) }}" alt="{{ $item->name }}">
                    @else
                        <div class="nf-item-noimg d-flex align-items-center justify-content-center h-100"><span>🎁</span></div>
                    @endif
                </div>
                @if($gallery->count() > 1)
                    <div class="nf-detail-thumbs">
                        @foreach($gallery as $gImg)
                            <button type="button" class="nf-detail-thumb {{ $loop->first ? 'nf-active' : '' }}" data-src="{{ route('item.image', $gImg) }}">
                                <img src="{{ route('item.image', $gImg) }}" alt="{{ $item->name }}" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-lg-6">
                @if($item->category)
                    <a href="{{ route('items.category', $item->category) }}" class="nf-detail-cat"><i class="bi bi-bookmark-heart"></i> {{ $item->category->name }}</a>
                @endif
                <h1 class="nf-detail-name">{{ $item->name }}</h1>
                <div class="nf-detail-price">
                    ৳ {{ number_format($item->price, 2) }}
                    <small style="display:block; margin-top:2px;">per piece</small>
                </div>

                <hr class="nf-detail-divider">

                @if($item->details)
                    <h4 class="nf-detail-desc-title">About this gift</h4>
                    <p class="nf-detail-desc">{{ $item->details }}</p>
                    <hr class="nf-detail-divider">
                @endif

                <div class="d-flex flex-wrap align-items-center gap-3 my-3">
                    <form action="{{ route('cart.add') }}" method="POST" id="nfAddCartForm">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <div class="nf-qty-selector">
                                <button type="button" class="nf-qty-minus">−</button>
                                <input type="number" name="qty" id="nfQty" value="1" min="1" max="99" readonly>
                                <button type="button" class="nf-qty-plus">+</button>
                            </div>
                            <button type="submit" class="nf-add-cart-btn"><i class="bi bi-bag-heart-fill"></i> Add to Cart</button>
                        </div>
                    </form>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-3">
                    <a href="{{ route('contact.page') }}" class="nf-ask-btn"><i class="bi bi-whatsapp"></i> Ask about this gift</a>
                    <span class="nf-stock-note"><i class="bi bi-patch-check-fill"></i> Hand-wrapped &amp; delivered with love</span>
                </div>
            </div>
        </div>

        @if($related->isNotEmpty())
            <div class="mt-5 pt-4">
                <div class="d-flex align-items-end justify-content-between flex-wrap gap-3 mb-4">
                    <div>
                        <span class="nf-shop-tag">You may also like</span>
                        <h2 class="nf-shop-title" style="font-size:clamp(1.4rem,2.5vw,1.9rem);">More from this collection</h2>
                    </div>
                    <a href="{{ route('items.category', $item->category) }}" class="nf-cat-more">View all <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="row g-4">
                    @foreach($related as $relItem)
                        @include('frontend.partials.item-card', ['item' => $relItem])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@endsection

@section('script')
<script>
    document.querySelectorAll('.nf-detail-thumb').forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            const main = document.getElementById('nfMainImg');
            if (!main) return;
            main.src = thumb.getAttribute('data-src');
            document.querySelectorAll('.nf-detail-thumb').forEach(function (t) { t.classList.remove('nf-active'); });
            thumb.classList.add('nf-active');
        });
    });

    const qtyInput = document.getElementById('nfQty');
    const minusBtn = document.querySelector('.nf-qty-minus');
    const plusBtn = document.querySelector('.nf-qty-plus');

    if (minusBtn) minusBtn.addEventListener('click', function () {
        const v = parseInt(qtyInput.value, 10) || 1;
        qtyInput.value = Math.max(1, v - 1);
    });

    if (plusBtn) plusBtn.addEventListener('click', function () {
        const v = parseInt(qtyInput.value, 10) || 1;
        qtyInput.value = Math.min(99, v + 1);
    });

    const addForm = document.getElementById('nfAddCartForm');
    if (addForm) {
        addForm.addEventListener('submit', function (e) {
            e.preventDefault();
            fetch(addForm.action, {
                method: 'POST',
                body: new FormData(addForm),
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            }).then(function (res) { return res.json(); }).then(function (data) {
                if (data.success) {
                    const badge = document.getElementById('cartBadge');
                    if (badge) {
                        badge.textContent = data.cartCount;
                        badge.style.display = data.cartCount > 0 ? 'inline-block' : 'none';
                    }
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success', title: 'Added to cart!',
                            text: 'The gift is waiting in your cart.', timer: 1800,
                            showConfirmButton: false, position: 'top-end', toast: true
                        });
                    }
                }
            });
        });
    }
</script>
@endsection