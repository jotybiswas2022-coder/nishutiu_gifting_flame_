@php $activeId = $currentCategoryId ?? null; @endphp
<div class="nf-cat-chips">
    @if($activeId === null)
        <span class="nf-cat-chip nf-cat-chip-active"><i class="bi bi-check-circle-fill"></i> All <small>({{ $totalItems }})</small></span>
    @else
        <a href="{{ route('items.index') }}" class="nf-cat-chip"><i class="bi bi-layout-three-columns"></i> All <small>({{ $totalItems }})</small></a>
    @endif

    @foreach($categories as $cat)
        @if($cat->id == $activeId)
            <span class="nf-cat-chip nf-cat-chip-active"><i class="bi bi-check-circle-fill"></i> {{ $cat->name }} <small>({{ $cat->items_count }})</small></span>
        @else
            <a href="{{ route('items.category', $cat) }}" class="nf-cat-chip"><i class="bi bi-box-seam"></i> {{ $cat->name }} <small>({{ $cat->items_count }})</small></a>
        @endif
    @endforeach
</div>