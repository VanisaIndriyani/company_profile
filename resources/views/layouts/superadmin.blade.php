<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { background: #fffbe6; font-family: 'Montserrat', 'Segoe UI', sans-serif; }
        .sidebar {
            position: sticky;
            top: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #6f4e37 0%, #b4845c 100%);
            color: #fff;
            padding-top: 36px;
            border-top-right-radius: 32px;
            border-bottom-right-radius: 32px;
            box-shadow: 2px 0 18px rgba(111, 78, 55, 0.10);
            z-index: 1000;
        }
        .sidebar .nav-link, .sidebar a {
            color: #f5e9da;
            font-weight: 600;
            padding: 16px 28px;
            border-left: 5px solid transparent;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
            display: flex;
            align-items: center;
            font-size: 1.13rem;
            letter-spacing: 0.5px;
            text-decoration: none;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover, .sidebar a.active, .sidebar a:hover {
            background: rgba(245, 233, 218, 0.13);
            color: #ffc107;
            border-left: 5px solid #ffc107;
            box-shadow: 0 2px 8px rgba(111, 78, 55, 0.08);
            transform: translateX(4px) scale(1.03);
        }
        .sidebar .logo, .sidebar .navbar-brand {
            color: #fff;
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 2.5rem;
            display: block;
            text-align: center;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #6f4e37;
        }
        .fa, .fas, .fa-solid {
            font-size: 1.35rem;
            margin-right: 14px;
        }
        main, .content {
            background-color: #fffbe6;
            border-radius: 24px;
            box-shadow: 0 0 18px rgba(111, 78, 55, 0.08);
            min-height: 100vh;
            padding-bottom: 40px;
            transition: box-shadow 0.3s;
            margin-left: 0;
        }
        .card {
            border-radius: 18px !important;
            box-shadow: 0 2px 12px rgba(111, 78, 55, 0.10) !important;
            border: none !important;
        }
        @media (max-width: 768px) {
            .sidebar { min-height: auto; border-radius: 0; }
            main, .content { border-radius: 0; }
        }
    </style>
    @yield('head')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="logo mb-4">
                <img src="{{ asset('img/LOGO.jpg') }}" alt="Fourjo Logo" style="width:60px;border-radius:50%;box-shadow:0 2px 12px #b4845c;background:#fffbe6;padding:6px;display:block;margin:0 auto 10px auto;">
                Super Admin
            </div>
            <a href="/superadmin/dashboard" class="{{ request()->is('superadmin/dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
            <a href="/superadmin/users" class="{{ request()->is('superadmin/users*') ? 'active' : '' }}"><i class="fa fa-users"></i> Manajemen User</a>
            <a href="/logout" class="text-danger" onclick="return confirm('Logout?')"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
        <main role="main" class="col-md-10 ml-sm-auto px-4 py-4 content">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html> 