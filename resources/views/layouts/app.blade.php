<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Product Management Dashboard') - Inventory Pro</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 270px;
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --card-border-radius: 16px;
            --bg-body: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: #334155;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            color: #94a3b8;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 1.5rem 1.75rem;
            color: #ffffff;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }

        .sidebar-menu {
            padding: 1.25rem 0.85rem;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu .menu-header {
            font-size: 0.725rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            font-weight: 700;
            padding: 0.75rem 1rem 0.35rem;
        }

        .sidebar-menu .nav-link {
            color: #94a3b8;
            padding: 0.85rem 1.15rem;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            transition: all 0.2s ease;
            margin-bottom: 0.3rem;
            text-decoration: none;
        }

        .sidebar-menu .nav-link:hover {
            color: #ffffff;
            background-color: var(--sidebar-hover);
            transform: translateX(3px);
        }

        .sidebar-menu .nav-link.active {
            color: #ffffff;
            background: var(--primary-gradient);
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
        }

        .sidebar-menu .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Wrapper */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Navbar Styling */
        .top-navbar {
            height: 74px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .content-body {
            padding: 2rem;
            flex: 1;
        }

        /* Modern Custom Cards */
        .stat-card {
            background: #ffffff;
            border-radius: var(--card-border-radius);
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.06), 0 4px 12px -4px rgba(0, 0, 0, 0.04);
            border-color: #cbd5e1;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .bg-indigo-light { background-color: #e0e7ff; color: #4338ca; }
        .bg-emerald-light { background-color: #d1fae5; color: #047857; }
        .bg-amber-light { background-color: #fef3c7; color: #b45309; }
        .bg-sky-light { background-color: #e0f2fe; color: #0369a1; }

        /* Tables & UI Components */
        .card-custom {
            background: #ffffff;
            border-radius: var(--card-border-radius);
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-custom td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .product-thumb {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

        .btn-gradient-primary {
            background: var(--primary-gradient);
            color: #ffffff;
            border: none;
            font-weight: 600;
            padding: 0.65rem 1.35rem;
            border-radius: 10px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .btn-gradient-primary:hover {
            color: #ffffff;
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 1rem;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        /* Custom Modern Pagination Styling */
        .pagination {
            margin-bottom: 0;
            gap: 0.35rem;
            display: flex;
            align-items: center;
        }

        .pagination .page-item .page-link {
            border-radius: 10px !important;
            border: 1px solid #e2e8f0;
            color: #475569;
            font-weight: 600;
            padding: 0.45rem 0.85rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            text-decoration: none;
        }

        .pagination .page-item .page-link:hover {
            color: #4f46e5;
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-gradient);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8fafc;
            color: #cbd5e1;
            border-color: #f1f5f9;
            cursor: not-allowed;
            transform: none;
        }

        /* Mobile responsiveness */
        @media (max-width: 991.98px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            #sidebar.show {
                margin-left: 0;
            }
            #main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div>
                <div>Inventory Pro</div>
                <div style="font-size: 0.7rem; color: #64748b; font-weight: 500;">Product Management</div>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Overview</li>
            <li>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard & Products</span>
                </a>
            </li>
            
            <li class="menu-header">Product Management</li>
            <li>
                <a href="{{ route('products.create') }}" class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>Add New Product</span>
                </a>
            </li>
        </ul>

        <div style="position: absolute; bottom: 20px; left: 20px; right: 20px;">
            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);">
                <div class="d-flex align-items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" class="rounded-circle" width="36" height="36" alt="User Avatar">
                    <div>
                        <div class="text-white fw-semibold" style="font-size: 0.85rem;">Store Admin</div>
                        <div style="font-size: 0.75rem; color: #64748b;">admin@inventory.com</div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div id="main-content">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="sidebarToggle" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h5 class="fw-bold m-0 text-dark">@yield('page-header', 'Product Management Dashboard')</h5>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('products.create') }}" class="btn btn-gradient-primary btn-sm d-flex align-items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Product</span>
                </a>
            </div>
        </header>

        <!-- Main Body View -->
        <main class="content-body">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert" style="background-color: #ecfdf5; color: #065f46; border-left: 4px solid #10b981 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-check fs-5"></i>
                        <div><strong>Success!</strong> {{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert" style="background-color: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation fs-5"></i>
                        <div><strong>Error!</strong> {{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 text-center text-muted" style="font-size: 0.85rem;">
            <div class="container-fluid">
                &copy; {{ date('Y') }} Inventory Pro Product Management. Built with Laravel 11 & Bootstrap 5.
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
