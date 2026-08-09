@extends('frontend.app')

@section('title', ($q !== '' ? 'Search: ' . $q . ' — ' : '') . 'All Items | NishuTiu Gifting Flame')

@section('content')
@include('frontend.partials.shop-styles')

<section class="nf-shop-page py-5">
    <div class="container py-3">
        <div class="nf-shop-crumbs">
            <a href="/">Home</a>
            <i class="bi bi-chevron-right"></i>
            <span style="color:#1F1F1F;">Items</span>
        </div>

        <div class="text-center">
            <span class="nf-shop-tag"><i class="bi bi-gift-fill"></i> All Items</span>
            <h1 class="nf-shop-title">
                @if($q !== '')
                    Results for <span style="color:#FF4D6D;">"{{ $q }}"</span>
                @else
                    Every gift <span style="color:#FF4D6D;">we craft</span>
                @endif
            </h1>
            <p class="nf-shop-sub mx-auto">Hand-picked gifts, all in one place. Filter by category below to narrow things down.</p>
        </div>

        @include('frontend.partials.shop-search')

        @include('frontend.partials.category-chips', ['currentCategoryId' => null, 'categories' => $categories, 'totalItems' => $totalItems])

        @if($items->isNotEmpty())
            <div class="row g-4">
                @foreach($items as $item)
                    @include('frontend.partials.item-card', ['item' => $item])
                @endforeach
            </div>
        @else
            <div class="nf-shop-empty">
                <div class="nf-empty-icon">🎁</div>
                <h4>No gifts found{{ $q !== '' ? ' for "' . e($q) . '"' : '' }}</h4>
                <p>Try a different keyword, or check back soon.</p>
                <a href="{{ route('items.index') }}" class="nf-item-btn"><i class="bi bi-gift"></i> View all items</a>
            </div>
        @endif
    </div>
</section>

@endsection