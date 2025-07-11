<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
        .sidebar .nav-link {
            color: #f5e9da;
            font-weight: 600;
            padding: 16px 28px;
            border-left: 5px solid transparent;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
            display: flex;
            align-items: center;
            font-size: 1.13rem;
            letter-spacing: 0.5px;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: rgba(245, 233, 218, 0.13);
            color: #ffc107;
            border-left: 5px solid #ffc107;
            box-shadow: 0 2px 8px rgba(111, 78, 55, 0.08);
            transform: translateX(4px) scale(1.03);
        }
        .sidebar .navbar-brand {
            color: #fff;
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 2.5rem;
            display: block;
            text-align: center;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #6f4e37;
        }
        .fa {
            font-size: 1.35rem;
            margin-right: 14px;
        }
        main {
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
            main { border-radius: 0; }
        }
    </style>
    @yield('header')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="navbar-brand mb-4">Admin Panel</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}" href="/admin/orders"><i class="fa fa-list-alt"></i> Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/messages') ? 'active' : '' }}" href="/admin/messages"><i class="fa fa-envelope"></i> Pesan Kontak</a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link text-danger" href="/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </nav>
        <main role="main" class="col-md-10 ml-sm-auto px-4 py-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html> 