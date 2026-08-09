@extends('frontend.app')

@section('title', ($q !== '' ? 'Search: ' . $q . ' — ' : '') . 'All Items | NishuTiu Gifting Flame')

@section('content')
@include('frontend.partials.shop-styles')

<section class="nf-shop-page py-5">
    <div class="container py-3">
        <div class="text-center">
            <span class="nf-shop-tag"><i class="bi bi-gift-fill"></i> Our Items</span>
            <h1 class="nf-shop-title">
                @if($q !== '')
                    Results for <span style="color:#FF4D6D;">"{{ $q }}"</span>
                @else
                    Every gift <span style="color:#FF4D6D;">we craft</span>
                @endif
            </h1>
            <p class="nf-shop-sub mx-auto">Hand-picked gifts, grouped by category. Tap a category box to explore everything inside it.</p>
            <div class="text-center">
                <span class="nf-cat-box-count" style="margin-top:1rem;">
                    {{ $totalItems }} item{{ $totalItems == 1 ? '' : 's' }}
                </span>
            </div>
        </div>

        @include('frontend.partials.shop-search')

        @forelse($categories as $category)
            <div class="mb-4">
                <a href="{{ route('items.category', $category) }}" class="nf-cat-box">
                    <img class="nf-cat-box-thumb" src="{{ route('category.photo', $category) }}" alt="{{ $category->name }}" loading="lazy">
                    <div class="nf-cat-box-info">
                        <div class="nf-cat-box-name">{{ $category->name }}</div>
                        @if($category->description)
                            <p class="nf-cat-box-desc">{{ $category->description }}</p>
                        @else
                            <p class="nf-cat-box-desc">Explore this collection</p>
                        @endif
                    </div>
                    <span class="nf-cat-box-count"><i class="bi bi-box-seam"></i> {{ $category->items->count() }}</span>
                </a>

                <div class="row g-4">
                    @foreach($category->items as $item)
                        @include('frontend.partials.item-card', ['item' => $item])
                    @endforeach
                </div>

                <div class="text-center mt-3 mb-4">
                    <a href="{{ route('items.category', $category) }}" class="nf-cat-more">
                        Browse all {{ $category->name }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="nf-shop-empty">
                <div class="nf-empty-icon">🎁</div>
                <h4>No gifts found{{ $q !== '' ? ' for "' . e($q) . '"' : '' }}</h4>
                <p>Try a different keyword, or browse all our items instead.</p>
                <a href="{{ route('items.index') }}" class="nf-item-btn"><i class="bi bi-gift"></i> View all items</a>
            </div>
        @endforelse
    </div>
</section>

@endsection