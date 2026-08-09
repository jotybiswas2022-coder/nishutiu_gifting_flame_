@php
use Illuminate\Support\Str;
@endphp

<a class="nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="/">
    <i class="bi bi-house-door"></i> Home
</a>

@auth
    @if(auth()->user()->is_admin == 1)
        <a class="nav-link-custom {{ Str::startsWith(request()->path(), 'admin') ? 'active' : '' }}" href="/admin">
            <i class="bi bi-speedometer2"></i> Admin Panel
        </a>
    @endif
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="nav-link-btn logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
@else
    <a class="nav-link-custom {{ request()->is('login') ? 'active' : '' }}" href="/login">
        <i class="bi bi-person-circle"></i> Login
    </a>
    <a class="nav-link-custom signup-link" href="/register">
        <i class="bi bi-person-plus"></i> Signup
    </a>
@endauth