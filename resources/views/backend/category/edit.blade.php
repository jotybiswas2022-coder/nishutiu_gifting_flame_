@extends('backend.app')

@section('content')

<div class="cat-page">
    @include('backend.category._form', [
        'category' => $category,
        'cardTitle' => 'Edit Category',
        'action' => route('admin.category.update', $category),
        'method' => 'PUT',
    ])
</div>

@endsection