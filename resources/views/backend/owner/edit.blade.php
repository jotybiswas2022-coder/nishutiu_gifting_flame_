@extends('backend.app')

@section('content')

<div class="owner-page">
    @include('backend.owner._form', [
        'owner' => $owner,
        'cardTitle' => 'Edit Owner',
        'action' => route('admin.owner.update', $owner),
        'method' => 'PUT',
    ])
</div>

@endsection