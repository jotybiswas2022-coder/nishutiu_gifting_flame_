@php $cardImg = $item->images->first(); @endphp
<div class="col-sm-6 col-lg-4 col-xl-4">
    <div class="nf-item-card">
        <a href="{{ route('contact.page') }}" class="nf-item-img d-block" title="Ask about this gift">
            @if($cardImg)
                <img src="{{ route('item.image', $cardImg) }}" alt="{{ $item->name }}" loading="lazy">
            @else
                <div class="nf-item-noimg"><span>🎁</span></div>
            @endif
            @if($item->category)
                <span class="nf-item-cat">{{ $item->category->name }}</span>
            @endif
        </a>
        <div class="nf-item-body">
            <h5 class="nf-item-name">{{ $item->name }}</h5>
            <p class="nf-item-desc">{{ \Illuminate\Support\Str::limit($item->details, 80) }}</p>
            <div class="nf-item-foot">
                <span class="nf-item-price">৳ {{ number_format($item->price, 2) }}</span>
                <a href="{{ route('contact.page') }}" class="nf-item-btn"><i class="bi bi-whatsapp"></i> Ask for it</a>
            </div>
        </div>
    </div>
</div>