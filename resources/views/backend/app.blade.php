<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Laravel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://junait.com/tiny_pro.js"></script>

    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
</head>
<body>

    @include('backend.partials.sidebar')

    <main class="content-area">
        @yield('content')
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>

@yield('scripts')
</body>

<style>
/* ─── Base Reset ─── */
* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
    overflow-x: hidden;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

body {
    display: grid;
    grid-template-columns: 250px 1fr;
    grid-template-rows: auto 1fr;
    grid-template-areas:
        "navbar navbar"
        "sidebar content";
    min-height: 100vh;
    background: #f1f5f9;
    color: #1e293b;
    -webkit-font-smoothing: antialiased;
}

/* Grid area assignments */
nav.top-navbar {
    grid-area: navbar;
}

aside.sidebar {
    grid-area: sidebar;
}

main.content-area {
    grid-area: content;
    overflow-y: auto;
    max-height: calc(100vh - 57px);
    background: #f1f5f9;
}

/* ─── Responsive ─── */
@media (max-width: 992px) {
    body {
        grid-template-columns: 200px 1fr;
    }
    main.content-area {
        max-height: calc(100vh - 57px);
    }
}
@media (max-width: 768px) {
    body {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto 1fr;
        grid-template-areas:
            "navbar"
            "sidebar"
            "content";
    }
    main.content-area {
        max-height: none;
        overflow: visible;
    }
}
@media (max-width: 480px) {
    body {
        grid-template-rows: auto auto 1fr;
    }
    main.content-area {
        overflow: visible;
    }
}

/* ─── Scrollbar ─── */
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: rgba(100,116,139,0.25); border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: rgba(100,116,139,0.45); }

/* ─── Pagination (global style for all backend pages) ─── */
.pagination {
    display: flex;
    gap: 4px;
    list-style: none;
    margin: 0;
    padding: 0;
    flex-wrap: wrap;
}
.pagination .page-item .page-link {
    display: grid;
    place-items: center;
    min-width: 34px;
    height: 34px;
    padding: 0 10px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 500;
    color: #64748b;
    text-decoration: none;
    background: #ffffff;
    transition: all 0.2s;
    font-family: inherit;
}
.pagination .page-item .page-link:hover {
    background: #eff6ff;
    border-color: #bfdbfe;
    color: #2563eb;
}
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    border-color: #2563EB;
    color: #fff;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.pagination .page-item.disabled .page-link {
    opacity: 0.3;
    pointer-events: none;
}

/* ─── Swal2 Light Override ─── */
.swal2-popup {
    background: #ffffff !important;
    color: #1e293b !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 16px !important;
}
.swal2-title { color: #1e293b !important; }
.swal2-html-container { color: #64748b !important; }
.swal2-confirm.swal2-styled {
    background: linear-gradient(135deg, #2563EB, #1E40AF) !important;
    box-shadow: none !important;
}
.swal2-cancel.swal2-styled {
    background: #f1f5f9 !important;
    color: #64748b !important;
    border: 1px solid #e2e8f0 !important;
}
.swal2-toast {
    background: #ffffff !important;
    box-shadow: 0 8px 32px rgba(15,23,42,0.12) !important;
    border: 1px solid #e2e8f0 !important;
}
</style>

</html>