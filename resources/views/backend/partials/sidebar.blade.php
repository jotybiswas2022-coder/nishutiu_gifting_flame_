@php
use Illuminate\Support\Str;
@endphp

<!-- Top Navbar -->
<nav class="top-navbar">
    <div class="top-nav-inner">
        <div class="top-nav-left">
            <a class="top-nav-brand" href="/admin">
                <i class="bi bi-speedometer2"></i>
                <span>Admin Dashboard</span>
            </a>
        </div>

        <div class="top-nav-right">
            <button class="sb-toggler" type="button" id="sbToggle" aria-label="Toggle menu">
                <i class="bi bi-three-dots-vertical" id="sbToggleIcon"></i>
            </button>
        </div>

        <div class="top-nav-links" id="navbarTopNav">
            @include('backend.partials.auth-links')
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sb-backdrop" id="sbBackdrop"></div>
<aside class="sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <i class="bi bi-layout-sidebar"></i>
        <span>Navigation</span>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ url('/admin/owners') }}"
               class="{{ request()->is('admin/owners') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Owner's Info</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/categories') }}"
               class="{{ request()->is('admin/categories') ? 'active' : '' }}">
                <i class="bi bi-collection-fill"></i>
                <span>Category</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/items') }}"
               class="{{ request()->is('admin/items') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Item</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/contact') }}"
               class="{{ request()->is('admin/contact') ? 'active' : '' }}">
                <i class="bi bi-envelope-fill"></i>
                <span>Contact</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/reviews') }}"
               class="{{ request()->is('admin/reviews') ? 'active' : '' }}">
                <i class="bi bi-chat-square-heart-fill"></i>
                <span>Customer Review</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/settings') }}"
               class="{{ request()->is('admin/settings') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                <span>Settings</span>
            </a>
        </li>
        <li class="sidebar-mobile-item">
            <a href="{{ url('/') }}">
                <i class="bi bi-house-door"></i>
                <span>Home</span>
            </a>
        </li>
        <li class="sidebar-mobile-item">
            <form action="{{ route('logout') }}" method="POST" class="sidebar-logout-form">
                @csrf
                <button type="submit" class="sidebar-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>

    <div class="sidebar-footer">
        <span class="sidebar-version">Connectly v1.0</span>
    </div>
</aside>

<style>
/* ─── Top Navbar (Light Theme) ─── */
.top-navbar {
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    padding: 10px 24px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 1px 3px rgba(15,23,42,0.06);
}
.top-nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 100%;
    gap: 16px;
}
.top-nav-left {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}
.sb-toggler {
    display: none;
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    color: #475569;
    font-size: 1.15rem;
    cursor: pointer;
    transition: all 0.2s ease;
    padding: 0;
}
.sb-toggler:hover { background: #eff6ff; color: #2563eb; }
.sb-toggler:focus { outline: none; }
.sb-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,0.5);
    z-index: 1049;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
}
.sb-backdrop.show {
    opacity: 1;
    visibility: visible;
}
.sidebar-mobile-item {
    display: none;
}
.sidebar-logout-form {
    margin: 0;
}
.sidebar-logout-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 10px 14px;
    color: #dc2626;
    font-weight: 500;
    font-size: 0.88rem;
    background: transparent;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
    text-align: left;
}
.sidebar-logout-btn i {
    font-size: 1.05rem;
    width: 20px;
    text-align: center;
    flex-shrink: 0;
}
.sidebar-logout-btn:hover {
    background: #fee2e2;
    color: #b91c1c;
}
.top-nav-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #1e293b;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    letter-spacing: -0.3px;
}
.top-nav-brand i {
    font-size: 1.3rem;
    color: #2563eb;
}

.top-nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
}
.nav-link-custom {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    color: #64748b;
    font-weight: 500;
    font-size: 0.85rem;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.nav-link-custom:hover {
    color: #2563eb;
    background: #eff6ff;
}
.nav-link-custom.active {
    color: #2563eb;
    background: #dbeafe;
}
.nav-link-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    color: #dc2626;
    font-weight: 600;
    font-size: 0.85rem;
    background: transparent;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}
.nav-link-btn:hover {
    background: #fee2e2;
    color: #dc2626;
}
.signup-link {
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff !important;
    padding: 7px 18px;
}
.signup-link:hover {
    background: linear-gradient(135deg, #1E40AF, #1e3a8a);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* ─── Sidebar (Light Theme) ─── */
.sidebar {
    width: 250px;
    min-width: 250px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    max-height: calc(100vh - 57px);
}
.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 20px 20px 16px;
    color: #94a3b8;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    border-bottom: 1px solid #f1f5f9;
}
.sidebar-brand i {
    font-size: 0.9rem;
    color: #cbd5e1;
}
.sidebar-menu {
    list-style: none;
    padding: 12px 10px;
    margin: 0;
    flex: 1;
}
.sidebar-menu li { margin-bottom: 2px; }
.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #64748b;
    padding: 10px 14px;
    font-weight: 500;
    font-size: 0.88rem;
    border-radius: 10px;
    transition: all 0.2s ease;
    text-decoration: none;
}
.sidebar-menu a i {
    font-size: 1.05rem;
    width: 20px;
    text-align: center;
    flex-shrink: 0;
}
.sidebar-menu a:hover {
    background: #eff6ff;
    color: #2563eb;
}
.sidebar-menu a.active {
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    color: #2563eb;
    border: 1px solid #bfdbfe;
    box-shadow: 0 2px 8px rgba(37,99,235,0.1);
}
.sidebar-footer {
    padding: 14px 20px;
    border-top: 1px solid #f1f5f9;
}
.sidebar-version {
    font-size: 0.65rem;
    color: #cbd5e1;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* ─── Scrollbar ─── */
.sidebar::-webkit-scrollbar { width: 4px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(100,116,139,0.18); border-radius: 10px; }

/* ─── Responsive ─── */
@media (max-width: 768px) {
    .sb-toggler { display: flex; }
    .top-nav-inner { gap: 8px; }
    .top-nav-brand { font-size: 0.92rem; }
    .top-nav-brand span { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .top-nav-links { display: none; }
    .sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        width: 260px;
        min-width: 260px;
        max-width: 85vw;
        height: 100vh;
        max-height: 100vh;
        flex-direction: column;
        align-items: stretch;
        background: #ffffff;
        border-right: 1px solid #e2e8f0;
        z-index: 1050;
        overflow-y: auto;
        transition: left 0.3s ease;
        box-shadow: none;
    }
    .sidebar.open {
        left: 0;
        box-shadow: 0 0 60px rgba(15,23,42,0.25);
    }
    .sidebar-brand { display: flex; padding-top: 22px; }
    .sidebar-menu {
        flex-direction: column;
        flex-wrap: nowrap;
        padding: 12px 10px;
        gap: 2px;
    }
    .sidebar-menu li { margin-bottom: 2px; flex-shrink: 1; }
    .sidebar-menu a { font-size: 0.88rem; padding: 10px 14px; white-space: normal; }
    .sidebar-mobile-item { display: list-item; }
    .sidebar-footer { display: block; }
}

/* JS: body scroll lock when drawer is open */
body.sidebar-open { overflow: hidden; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var sbToggle = document.getElementById('sbToggle');
    var sbToggleIcon = document.getElementById('sbToggleIcon');
    var sidebar = document.getElementById('appSidebar');
    var backdrop = document.getElementById('sbBackdrop');

    if (!sbToggle || !sidebar) return;

    function openSidebar() {
        sidebar.classList.add('open');
        backdrop.classList.add('show');
        document.body.classList.add('sidebar-open');
        sbToggleIcon.className = 'bi bi-x-lg';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        backdrop.classList.remove('show');
        document.body.classList.remove('sidebar-open');
        sbToggleIcon.className = 'bi bi-three-dots-vertical';
    }

    sbToggle.addEventListener('click', function () {
        if (sidebar.classList.contains('open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    backdrop.addEventListener('click', closeSidebar);

    sidebar.querySelectorAll('a, button').forEach(function (el) {
        el.addEventListener('click', closeSidebar);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSidebar();
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeSidebar();
        }
    });
});
</script>
