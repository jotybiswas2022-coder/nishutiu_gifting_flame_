@extends('backend.app')

@section('content')

<div class="owner-page">
    @include('backend.owner._form', [
        'owner' => null,
        'cardTitle' => 'Add Owner',
        'action' => route('admin.owner.store'),
        'method' => null,
    ])
</div>

@endsection