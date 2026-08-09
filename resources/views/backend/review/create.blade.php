@extends('backend.app')

@section('content')

<div class="rev-page">
    @include('backend.review._form', [
        'review' => null,
        'cardTitle' => 'Add Review Screenshot',
        'action' => route('admin.review.store'),
        'method' => null,
    ])
</div>

@endsection