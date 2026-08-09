@extends('frontend.app')

@section('title', 'My Cart | NishuTiu Gifting Flame')

@section('content')
@include('frontend.partials.shop-styles')

<style>
    .nf-cart-line {
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 20px;
        padding: 1rem;
        box-shadow: 0 10px 26px rgba(255, 77, 109, 0.08);
        transition: all 0.3s ease;
    }

    .nf-cart-line:hover {
        box-shadow: 0 18px 36px rgba(255, 77, 109, 0.14);
        border-color: rgba(255, 77, 109, 0.3);
    }

    .nf-cart-thumb {
        width: 86px;
        height: 86px;
        border-radius: 16px;
        overflow: hidden;
        flex-shrink: 0;
        background: linear-gradient(135deg, #FFE3E9, #FFF0C2);
    }

    .nf-cart-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .nf-cart-line-name {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.05rem;
        color: #1F1F1F;
        text-decoration: none;
    }

    .nf-cart-line-name:hover {
        color: #C9184A;
    }

    .nf-cart-line-price {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 700;
        font-size: 1rem;
        color: #8A6E78;
    }

    .nf-cart-qty {
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(255, 77, 109, 0.3);
        border-radius: 50rem;
        background: #FFFFFF;
        overflow: hidden;
    }

    .nf-cart-qty button {
        border: none;
        background: transparent;
        width: 32px;
        height: 34px;
        font-size: 1rem;
        font-weight: 700;
        color: #C9184A;
        transition: all 0.2s ease;
    }

    .nf-cart-qty button:hover {
        background: #FFE3E9;
    }

    .nf-cart-qty input {
        border: none;
        width: 42px;
        text-align: center;
        font-weight: 700;
        color: #1F1F1F;
        background: transparent;
        font-size: 0.9rem;
        border-left: 1px solid rgba(255, 77, 109, 0.12);
        border-right: 1px solid rgba(255, 77, 109, 0.12);
    }

    .nf-cart-qty input:focus {
        outline: none;
    }

    .nf-cart-line-total {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 1.2rem;
        color: #C9184A;
        white-space: nowrap;
    }

    .nf-cart-remove {
        background: transparent;
        border: none;
        color: #DC2626;
        font-size: 0.82rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
        padding: 4px 8px;
        border-radius: 50rem;
    }

    .nf-cart-remove:hover {
        background: rgba(220, 38, 38, 0.08);
    }

    .nf-cart-summary {
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 24px;
        padding: 1.8rem;
        position: sticky;
        top: 90px;
        box-shadow: 0 16px 38px rgba(255, 77, 109, 0.1);
    }

    .nf-cart-summary h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        margin-bottom: 1.2rem;
    }

    .nf-cart-summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.95rem;
        color: #6B5860;
        margin-bottom: 0.7rem;
    }

    .nf-cart-summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px dashed rgba(255, 77, 109, 0.3);
        padding-top: 1rem;
        margin-top: 0.4rem;
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 1.4rem;
        color: #C9184A;
    }

    .nf-checkout-btn {
        border: none;
        width: 100%;
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        font-weight: 800;
        font-size: 0.98rem;
        padding: 0.85rem;
        border-radius: 50rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .nf-checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px rgba(255, 77, 109, 0.4);
        color: #FFFFFF;
    }

    .nf-cart-note {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.98rem;
        color: #8A6E78;
        text-align: center;
        margin-top: 1rem;
    }
</style>

<section class="nf-shop-page py-5">
    <div class="container py-3">
        <div class="nf-shop-crumbs">
            <a href="/">Home</a>
            <i class="bi bi-chevron-right"></i>
            <span style="color:#1F1F1F;">My Cart</span>
        </div>

        <div class="text-center mb-4">
            <span class="nf-shop-tag"><i class="bi bi-bag-heart-fill"></i> My Cart</span>
            <h1 class="nf-shop-title">The gifts you've <span style="color:#FF4D6D;">put aside</span></h1>
            <p class="nf-shop-sub mx-auto">Review your picks below — when you're ready, we'll finalize everything over a warm chat.</p>
        </div>

        @if(session('success'))
            <div class="text-center mb-4">
                <span class="nf-cat-box-count" style="color:#2FA96B;background:rgba(47,169,107,0.12);">{{ session('success') }}</span>
            </div>
        @endif

        @if(count($lines) > 0)
            <div class="row g-4">
                <div class="col-lg-8">
                    @foreach($lines as $line)
                        <div class="nf-cart-line mb-3">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <a href="{{ route('items.show', $line['item']) }}" class="nf-cart-thumb">
                                    @if($line['item']->images->isNotEmpty())
                                        <img src="{{ route('item.image', $line['item']->images->first()) }}" alt="{{ $line['item']->name }}">
                                    @else
                                        <div class="nf-item-noimg d-flex align-items-center justify-content-center h-100 w-100"><span>🎁</span></div>
                                    @endif
                                </a>
                                <div class="flex-grow-1 min-w-0">
                                    <a href="{{ route('items.show', $line['item']) }}" class="nf-cart-line-name">{{ $line['item']->name }}</a>
                                    <div class="nf-cart-line-price">
                                        ৳ {{ number_format($line['item']->price, 2) }} each
                                        @if($line['item']->category)
                                            <span style="opacity:0.7;"> · {{ $line['item']->category->name }}</span>
                                        @endif
                                    </div>
                                </div>

                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline-flex align-items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $line['item']->id }}">
                                    <div class="nf-cart-qty">
                                        <button type="submit" name="qty" value="{{ $line['qty'] - 1 }}">−</button>
                                        <input type="number" value="{{ $line['qty'] }}" readonly>
                                        <button type="submit" name="qty" value="{{ $line['qty'] + 1 }}">+</button>
                                    </div>
                                </form>

                                <span class="nf-cart-line-total">৳ {{ number_format($line['lineTotal'], 2) }}</span>

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $line['item']->id }}">
                                    <button type="submit" class="nf-cart-remove"><i class="bi bi-trash"></i> Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-end mt-3">
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nf-cart-remove" style="font-size:0.9rem;"><i class="bi bi-x-circle"></i> Clear cart</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="nf-cart-summary">
                        <h5>Order Summary</h5>
                        <div class="nf-cart-summary-row">
                            <span>Items ({{ count($lines) }})</span>
                            <span>৳ {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="nf-cart-summary-row">
                            <span>Wrapping &amp; ribbon</span>
                            <span style="color:#2FA96B;">Included</span>
                        </div>
                        <div class="nf-cart-summary-total">
                            <span>Total</span>
                            <span>৳ {{ number_format($total, 2) }}</span>
                        </div>
                        <a href="{{ route('contact.page') }}" class="nf-checkout-btn mt-3" style="width:auto;">
                            <i class="bi bi-whatsapp"></i> Place order via chat
                        </a>
                        <p class="nf-cart-note">We'll confirm your order personally and arrange the wrapping &amp; delivery.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="nf-shop-empty">
                <div class="nf-empty-icon">🛍️</div>
                <h4>Your cart is empty</h4>
                <p>Looks like you haven't picked any gifts yet. Let's fix that!</p>
                <a href="{{ route('items.index') }}" class="nf-item-btn"><i class="bi bi-gift"></i> Browse all items</a>
            </div>
        @endif
    </div>
</section>

@endsection