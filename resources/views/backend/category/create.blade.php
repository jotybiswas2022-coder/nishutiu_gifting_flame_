@extends('backend.app')

@section('content')

<div class="cat-page">
    @include('backend.category._form', [
        'category' => null,
        'cardTitle' => 'Add Category',
        'action' => route('admin.category.store'),
        'method' => null,
    ])
</div>

@endsection