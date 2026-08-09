@extends('backend.app')

@section('content')

<div class="it-page">
    @include('backend.item._form', [
        'item' => null,
        'cardTitle' => 'Add Item',
        'action' => route('admin.item.store'),
        'method' => null,
    ])
</div>

@endsection