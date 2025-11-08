<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> - <?php echo e(config('app.name')); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <style>
        :root {
            --primary: 199 83% 37%;
            --primary-light: 199 83% 50%;
            --primary-dark: 199 83% 25%;
            --primary-gradient: linear-gradient(135deg, hsl(199, 83%, 37%) 0%, hsl(199, 83%, 50%) 100%);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --navbar-height: 56px;
            --border-radius: 12px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-elegant: 0 10px 30px -10px hsl(199, 83%, 37%, 0.3);
            --shadow-glow: 0 0 40px hsl(199, 83%, 50%, 0.4);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f8fafc;
            font-size: 14px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Enhanced Navbar */
        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: var(--box-shadow);
            z-index: 1050;
            height: var(--navbar-height);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
            white-space: nowrap;
        }

        /* Fixed & Minimizable Sidebar */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--navbar-height));
            background: var(--primary-gradient);
            color: white;
            transition: var(--transition-smooth);
            z-index: 1040;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .nav-link-text,
        .sidebar.collapsed .sidebar-header-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px 0;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar-header {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header-text {
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition-smooth);
            white-space: nowrap;
        }

        .sidebar-toggle-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .sidebar-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            border-radius: 8px;
            margin: 4px 12px;
            padding: 12px 16px;
            transition: var(--transition-smooth);
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }

        .sidebar.collapsed .nav-link:hover {
            transform: none;
        }

        .sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 12px;
            transition: var(--transition-smooth);
            flex-shrink: 0;
        }

        .nav-link-text {
            transition: var(--transition-smooth);
        }

        /* Main Content Container */
        .main-wrapper {
            padding-top: var(--navbar-height);
            min-height: 100vh;
            display: flex;
        }

        .main-content {
            background: white;
            min-height: calc(100vh - var(--navbar-height));
            margin-left: var(--sidebar-width);
            padding: 32px;
            flex: 1;
            transition: var(--transition-smooth);
            border-radius: 20px 0 0 0;
        }

        .sidebar.collapsed~.main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            width: 100%;
            height: calc(100vh - var(--navbar-height));
            background: rgba(0, 0, 0, 0.5);
            z-index: 1035;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
            display: none;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Enhanced Cards */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 24px;
        }

        .card-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 16px 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        /* Improved Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition-smooth);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px hsl(199, 83%, 37%, 0.3);
        }

        /* Enhanced Table */
        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8fafc;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            border-top: none;
            padding: 12px 8px;
            white-space: nowrap;
        }

        .table td {
            padding: 12px 8px;
            vertical-align: middle;
            border-color: #e2e8f0;
        }

        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }

        /* DataTables Customization */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-gradient) !important;
            border-color: hsl(var(--primary)) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: hsl(var(--primary-light)) !important;
            border-color: hsl(var(--primary)) !important;
            color: white !important;
        }

        .dataTables_processing {
            background: rgba(255, 255, 255, 0.95) !important;
            border-radius: 10px;
            padding: 2rem;
        }

        /* Avatar */
        .avatar-circle {
            width: 36px;
            height: 36px;
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
        }

        /* Badges */
        .badge {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.4em 0.8em;
            border-radius: 6px;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            padding: 8px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: hsl(var(--primary));
            box-shadow: 0 0 0 3px hsl(var(--primary) / 0.1);
        }

        /* Alerts */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            font-weight: 500;
        }

        /* Desktop Styles */
        @media (min-width: 1200px) {
            .sidebar {
                position: fixed;
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: none !important;
            }

            .mobile-sidebar-close {
                display: none !important;
            }
        }

        @media (min-width: 992px) and (max-width: 1199.98px) {
            .main-content {
                padding: 24px;
            }
        }

        /* Tablet & Mobile Styles */
        @media (max-width: 1199.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar.collapsed {
                width: var(--sidebar-width);
            }

            .main-content {
                margin-left: 0 !important;
                border-radius: 0;
            }

            .sidebar-overlay {
                display: block;
            }

            .desktop-sidebar-toggle {
                display: none !important;
            }
        }

        /* Tablet Styles */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .sidebar {
                width: 260px;
            }

            .main-content {
                padding: 24px;
            }

            .card-body {
                padding: 16px;
            }

            .table th,
            .table td {
                padding: 10px 6px;
                font-size: 13px;
            }

            .filter-row .col-md-2,
            .filter-row .col-md-3 {
                margin-bottom: 12px;
            }
        }

        /* Mobile Styles */
        @media (max-width: 767.98px) {
            .sidebar {
                width: 100%;
            }

            .main-content {
                padding: 12px;
                margin-left: 0 !important;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .card {
                margin-bottom: 16px;
                border-radius: 10px;
            }

            .card-header {
                padding: 12px 16px;
                font-size: 14px;
            }

            .card-body {
                padding: 16px 12px;
            }

            .table-responsive {
                border-radius: 8px;
                box-shadow: none;
            }

            .table th,
            .table td {
                padding: 8px 4px;
                font-size: 12px;
            }

            .table th {
                font-size: 11px;
                padding: 6px 4px;
            }

            .mobile-hide {
                display: none !important;
            }

            .filter-row>div {
                margin-bottom: 10px;
            }

            .filter-row .col-md-1 {
                margin-top: 0;
            }

            .btn-group-mobile {
                display: flex;
                flex-direction: column;
                gap: 2px;
            }

            .btn-group-mobile .btn {
                border-radius: 4px !important;
                font-size: 11px;
                padding: 4px 8px;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.3em 0.6em;
            }

            .avatar-circle {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .modal-dialog {
                margin: 8px;
            }

            .modal-body {
                padding: 16px 12px;
            }

            .pagination {
                font-size: 12px;
            }

            .pagination .page-link {
                padding: 4px 8px;
            }

            .toast-container {
                bottom: 16px !important;
                right: 8px !important;
                left: 8px !important;
            }

            .form-control,
            .form-select {
                font-size: 14px;
                padding: 8px 10px;
            }

            .form-label {
                font-size: 13px;
                margin-bottom: 4px;
            }

            .status-mobile {
                display: block;
                margin-top: 4px;
            }
        }

        /* Extra Small Mobile */
        @media (max-width: 575.98px) {
            .main-content {
                padding: 8px;
            }

            .card-header h1,
            .card-header h3 {
                font-size: 1rem;
            }

            .card-header h5 {
                font-size: 0.95rem;
            }

            .table th,
            .table td {
                font-size: 11px;
                padding: 6px 2px;
            }

            .btn-sm {
                font-size: 0.7rem;
                padding: 2px 6px;
            }
        }

        /* Loading States */
        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner-border-sm {
            width: 0.875rem;
            height: 0.875rem;
        }

        /* Utility Classes */
        .text-truncate-mobile {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100px;
        }

        @media (min-width: 768px) {
            .text-truncate-mobile {
                max-width: none;
                overflow: visible;
                text-overflow: initial;
                white-space: normal;
            }
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Print Styles */
        @media print {

            .sidebar,
            .navbar,
            .btn,
            .sidebar-overlay {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid px-3">
            <!-- Mobile sidebar toggle -->
            <button class="btn btn-link text-white sidebar-toggle p-1 me-2" type="button"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('job-applications.index')); ?>">
                <i class="fas fa-briefcase me-2"></i>
                <span class="d-none d-sm-inline">Job Management System</span>
                <span class="d-inline d-sm-none">JMS</span>
            </a>

            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>
                        <span class="d-none d-md-inline"><?php echo e(Auth::user()->name ?? Auth::user()->email); ?></span>
                        <span class="d-inline d-md-none">Menu</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <span class="sidebar-header-text">Menu</span>
                <div class="d-flex gap-2">
                    <!-- Desktop: Toggle collapse -->
                    <button class="sidebar-toggle-btn desktop-sidebar-toggle" id="sidebarCollapseBtn" type="button"
                        title="Toggle sidebar">
                        <i class="fas fa-angles-left"></i>
                    </button>
                    <!-- Mobile: Close button -->
                    <button class="sidebar-toggle-btn mobile-sidebar-close d-xl-none" id="sidebarClose" type="button"
                        aria-label="Close navigation">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <div class="p-2">
                <nav class="nav flex-column">
                    <a class="nav-link <?php echo e(request()->routeIs('job-applications.index') ? 'active' : ''); ?>"
                        href="<?php echo e(route('job-applications.index')); ?>">
                        <i class="fas fa-list"></i>
                        <span class="nav-link-text">Job Applications</span>
                    </a>
                    <!-- Add more navigation items here -->
                </nav>
            </div>
        </div>

        <!-- Sidebar overlay for mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Scripts -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        // Enhanced sidebar functionality with collapse
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('mainContent');

            let isDesktop = window.innerWidth >= 1200;
            let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            // Initialize sidebar state on desktop
            function initSidebar() {
                if (isDesktop && isCollapsed) {
                    sidebar.classList.add('collapsed');
                    updateCollapseIcon();
                }
            }

            function updateLayout() {
                const wasDesktop = isDesktop;
                isDesktop = window.innerWidth >= 1200;

                if (isDesktop !== wasDesktop) {
                    if (isDesktop) {
                        hideMobileSidebar();
                        if (isCollapsed) {
                            sidebar.classList.add('collapsed');
                        }
                    } else {
                        sidebar.classList.remove('collapsed');
                    }
                }
            }

            // Desktop: Toggle collapse
            function toggleCollapse() {
                sidebar.classList.toggle('collapsed');
                isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
                updateCollapseIcon();
            }

            function updateCollapseIcon() {
                const icon = sidebarCollapseBtn?.querySelector('i');
                if (icon) {
                    if (isCollapsed) {
                        icon.className = 'fas fa-angles-right';
                        sidebarCollapseBtn.title = 'Expand sidebar';
                    } else {
                        icon.className = 'fas fa-angles-left';
                        sidebarCollapseBtn.title = 'Collapse sidebar';
                    }
                }
            }

            // Mobile: Show sidebar
            function showMobileSidebar() {
                sidebar.classList.add('show');
                sidebarOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            // Mobile: Hide sidebar
            function hideMobileSidebar() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    if (isDesktop) {
                        toggleCollapse();
                    } else {
                        showMobileSidebar();
                    }
                });
            }

            if (sidebarCollapseBtn) {
                sidebarCollapseBtn.addEventListener('click', toggleCollapse);
            }

            if (sidebarClose) {
                sidebarClose.addEventListener('click', hideMobileSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', hideMobileSidebar);
            }

            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(updateLayout, 150);
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !isDesktop) {
                    hideMobileSidebar();
                }
            });

            // Close mobile sidebar when clicking nav links
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (!isDesktop) {
                        hideMobileSidebar();
                    }
                });
            });

            // Focus management for accessibility
            sidebarToggle?.addEventListener('click', function() {
                if (!isDesktop) {
                    setTimeout(() => {
                        if (sidebar.classList.contains('show')) {
                            const firstLink = sidebar.querySelector('.nav-link');
                            firstLink?.focus();
                        }
                    }, 300);
                }
            });

            // Auto-hide alerts
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Initialize
            initSidebar();
            updateLayout();
        });

        // Touch device detection
        if ('ontouchstart' in window) {
            document.body.classList.add('touch-device');

            document.querySelectorAll('.btn, .nav-link, .table tr').forEach(element => {
                element.addEventListener('touchstart', function() {
                    this.classList.add('touch-active');
                });

                element.addEventListener('touchend', function() {
                    setTimeout(() => {
                        this.classList.remove('touch-active');
                    }, 150);
                });
            });
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH F:\LARAVEL\COMPANYPROFILE\COMPANYPROFILE3\MyAdmin\resources\views/layouts/admin.blade.php ENDPATH**/ ?>