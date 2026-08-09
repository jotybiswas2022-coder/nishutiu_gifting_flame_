<form action="{{ $searchAction ?? route('items.index') }}" method="GET" class="nf-shop-search">
    <i class="bi bi-search"></i>
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search items by name or detail..." autocomplete="off">
    <button type="submit" class="nf-shop-search-btn">Search</button>
</form>