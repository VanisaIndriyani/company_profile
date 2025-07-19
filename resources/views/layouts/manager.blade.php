<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manager Panel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5dc;
      font-family: 'Montserrat', 'Segoe UI', sans-serif;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 220px;
      min-height: 100vh;
      background: linear-gradient(135deg, #6f4e37 0%, #b4845c 100%);
      color: #fff;
      padding-top: 20px;
      box-shadow: 2px 0 10px rgba(111, 78, 55, 0.08);
      z-index: 1000;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      overflow-y: auto;
    }
    .sidebar .nav-link {
      color: #f5e9da;
      font-weight: 500;
      padding: 14px 24px;
      border-left: 5px solid transparent;
      transition: all 0.3s cubic-bezier(.4,0,.2,1);
      display: flex;
      align-items: center;
      font-size: 1.08rem;
      letter-spacing: 0.5px;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: rgba(245, 233, 218, 0.13);
      color: #ffc107;
      border-left: 5px solid #ffc107;
      box-shadow: 0 2px 8px rgba(111, 78, 55, 0.08);
      transform: translateX(4px) scale(1.03);
    }
    .sidebar .navbar-brand {
      text-align: center;
      color: #fff;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 32px;
      letter-spacing: 1px;
      text-shadow: 0 2px 8px #6f4e37;
    }
    .sidebar .navbar-brand img {
      width: 70px;
      margin-bottom: 10px;
      border-radius: 50%;
      box-shadow: 0 2px 12px #b4845c;
      background: #fffbe6;
      padding: 6px;
    }
    main {
      background-color: #fffbe6;
      border-radius: 18px;
      box-shadow: 0 0 18px rgba(111, 78, 55, 0.08);
      min-height: 100vh;
      padding-bottom: 40px;
      transition: box-shadow 0.3s;
      margin-left: 220px;
    }
    .card {
      border-radius: 16px !important;
      box-shadow: 0 2px 12px rgba(111, 78, 55, 0.10) !important;
      border: none !important;
    }
    .card-title {
      color: #6f4e37;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .btn-primary, .btn-success, .btn-warning, .btn-danger {
      border-radius: 20px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    .fa {
      font-size: 1.25rem;
      margin-right: 10px;
    }
    @media (max-width: 768px) {
      .sidebar {
        min-height: auto;
      }
      main {
        border-radius: 0;
      }
    }
  </style>
  @yield('header')
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="navbar-brand">
          <img src="{{ asset('img/LOGO.jpg') }}" alt="Fourjo Logo" class="mb-2 d-block mx-auto" style="width:70px;border-radius:50%;box-shadow:0 2px 12px #b4845c;background:#fffbe6;padding:6px;">
          <div>Manager Panel</div>
        </div>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/dashboard') ? 'active' : '' }}" href="/manager/dashboard">
              <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/catalog') ? 'active' : '' }}" href="/manager/catalog">
              <i class="fa fa-box"></i> Katalog
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/blog') ? 'active' : '' }}" href="/manager/blog">
              <i class="fa fa-blog"></i> Blog
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/orders-report') ? 'active' : '' }}" href="/manager/orders-report">
              <i class="fa fa-file-alt"></i> Laporan Pesanan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/finance-report') ? 'active' : '' }}" href="/manager/finance-report">
              <i class="fa fa-money-bill-wave"></i> Laporan Keuangan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/stock') ? 'active' : '' }}" href="/manager/stock">
              <i class="fa fa-warehouse"></i> Stok Barang
            </a>
          </li>
        </ul>
        <div style="flex:1"></div>
        <div class="p-3 w-100" style="margin-top:auto;">
          <a href="/logout" onclick="return confirm('Yakin ingin logout?')"
             class="btn btn-danger btn-block d-flex align-items-center justify-content-center"
             style="font-size:1.15rem;font-weight:700;border-radius:30px;box-shadow:0 2px 8px #b4845c22;">
            <i class="fa fa-sign-out-alt mr-2" style="font-size:1.5rem;"></i> Logout
          </a>
        </div>
      </nav>
      <!-- Main Content -->
      <main role="main" class="col-md-10 ml-sm-auto px-4 py-4">
        @yield('content')
      </main>
    </div>
  </div>
  
  <!-- Bootstrap 4 JS -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
