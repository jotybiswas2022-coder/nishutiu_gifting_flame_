@extends('backend.app')

@section('content')

<div class="it-page">
    @include('backend.item._form', [
        'item' => $item,
        'cardTitle' => 'Edit Item',
        'action' => route('admin.item.update', $item),
        'method' => 'PUT',
    ])
</div>

@endsection