@extends('frontend.app')

@section('title', $category->name . ' | NishuTiu Gifting Flame')

@section('content')
@include('frontend.partials.shop-styles')

<section class="nf-shop-page py-5">
    <div class="container py-3">
        <div class="nf-shop-crumbs">
            <a href="/">Home</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('items.index') }}">Items</a>
            <i class="bi bi-chevron-right"></i>
            <span style="color:#1F1F1F;">{{ $category->name }}</span>
        </div>

        <div class="text-center">
            <span class="nf-shop-tag"><i class="bi bi-bookmark-heart"></i> {{ $category->name }}</span>
            <h1 class="nf-shop-title">
                {{ $category->name }} <span style="color:#FF4D6D;">collection</span>
            </h1>
            @if($category->description)
                <p class="nf-shop-sub mx-auto">{{ $category->description }}</p>
            @else
                <p class="nf-shop-sub mx-auto">Beautiful, hand-picked gifts from the {{ $category->name }} collection.</p>
            @endif
            <div class="text-center">
                <span class="nf-cat-box-count" style="margin-top:1rem;">
                    <i class="bi bi-box-seam"></i> {{ $items->count() }} item{{ $items->count() == 1 ? '' : 's' }}
                </span>
            </div>
        </div>

        @include('frontend.partials.shop-search', ['searchAction' => route('items.category', $category)])

        @include('frontend.partials.category-chips', ['currentCategoryId' => $category->id, 'categories' => $categories, 'totalItems' => $totalItems])

        @if($items->isNotEmpty())
            <div class="row g-4">
                @foreach($items as $item)
                    @include('frontend.partials.item-card', ['item' => $item])
                @endforeach
            </div>
        @else
            <div class="nf-shop-empty">
                <div class="nf-empty-icon">🔍</div>
                <h4>No gifts found{{ $q !== '' ? ' for "' . e($q) . '"' : ' in this collection yet' }}</h4>
                <p>{{ $q !== '' ? 'Try a different keyword.' : 'New treasures are being added here soon.' }}</p>
                <a href="{{ route('items.index') }}" class="nf-item-btn"><i class="bi bi-gift"></i> View all items</a>
            </div>
        @endif
    </div>
</section>

@endsection