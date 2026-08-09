@extends('backend.app')

@section('content')

<div class="rev-page">
    @include('backend.review._form', [
        'review' => $review,
        'cardTitle' => 'Edit Review Screenshot',
        'action' => route('admin.review.update', $review),
        'method' => 'PUT',
    ])
</div>

@endsection