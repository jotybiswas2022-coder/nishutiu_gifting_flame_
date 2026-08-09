@php $cardImg = $item->images->first(); @endphp
<div class="col-sm-6 col-lg-4 col-xl-4">
    <a href="{{ route('items.show', $item) }}" class="nf-item-card" title="View {{ $item->name }}">
        <div class="nf-item-img">
            @if($cardImg)
                <img src="{{ route('item.image', $cardImg) }}" alt="{{ $item->name }}" loading="lazy">
            @else
                <div class="nf-item-noimg"><span>🎁</span></div>
            @endif
            @if($item->category)
                <span class="nf-item-cat">{{ $item->category->name }}</span>
            @endif
        </div>
        <div class="nf-item-body">
            <h5 class="nf-item-name">{{ $item->name }}</h5>
            <p class="nf-item-desc">{{ \Illuminate\Support\Str::limit($item->details, 80) }}</p>
            <div class="nf-item-foot">
                <span class="nf-item-price">৳ {{ number_format($item->price, 2) }}</span>
                <span class="nf-item-btn"><i class="bi bi-box-arrow-up-right"></i> Details</span>
            </div>
        </div>
    </a>
</div>