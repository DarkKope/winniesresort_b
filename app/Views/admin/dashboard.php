<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #1a1a2e;
            --admin-secondary: #16213e;
            --admin-accent: #0f3460;
            --admin-success: #00b4d8;
            --admin-warning: #fca311;
            --admin-danger: #e63946;
            --admin-sidebar: #0f0f1f;
            --admin-card: #ffffff;
            --admin-text: #2c3e50;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: #f4f6f9;
            color: var(--admin-text);
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            z-index: 100;
            transition: all 0.3s;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        }
        
        .sidebar .brand {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        
        .sidebar .brand h3 {
            color: white;
            margin: 10px 0 0;
            font-size: 1.5rem;
            font-weight: 600;
            font-family: 'Playfair Display', serif;
        }
        
        .sidebar .brand p {
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
            margin: 5px 0 0;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: #0f3460;
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-bar h4 {
            margin: 0;
            font-weight: 600;
            color: var(--admin-primary);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info .badge {
            background: #00b4d8;
            padding: 5px 12px;
            border-radius: 20px;
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid var(--admin-accent);
            text-align: center;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .stat-card i {
            font-size: 35px;
            color: var(--admin-accent);
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            font-size: 28px;
            font-weight: 700;
            margin: 10px 0 5px;
        }
        
        .stat-card p {
            color: #666;
            margin: 0;
            font-size: 14px;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--admin-accent);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #1a4a7a;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: var(--admin-danger);
            border: none;
        }
        
        .btn-warning {
            background: var(--admin-warning);
            border: none;
            color: white;
        }
        
        .btn-info {
            background: var(--admin-success);
            border: none;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="fas fa-umbrella-beach fa-2x" style="color: #00b4d8;"></i>
        <h3>Winnie's Resort</h3>
        <p>Administrator Panel</p>
    </div>
    
    <nav class="nav flex-column">
        <a class="nav-link active" href="/admin/dashboard">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link" href="/admin/cottages">
            <i class="fas fa-hotel"></i> Manage Cottages
        </a>
        <a class="nav-link" href="/admin/bookings">
            <i class="fas fa-calendar-check"></i> Manage Bookings
        </a>
        <a class="nav-link" href="/admin/users">
            <i class="fas fa-users"></i> Manage Users
        </a>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 15px;">
        <a class="nav-link text-danger" href="/logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>
    
    <div class="position-absolute bottom-0 p-3" style="width: 100%;">
        <small style="color: rgba(255,255,255,0.5);">
            Logged in as:<br>
            <strong style="color: white;"><?= session()->get('full_name') ?></strong>
        </small>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h4><i class="fas fa-chart-line"></i> Admin Dashboard</h4>
        <div class="user-info">
            <span class="text-muted"><?= session()->get('username') ?></span>
            <span class="badge">Admin</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-calendar-check"></i>
                <h3><?= $total_bookings ?></h3>
                <p>Total Bookings</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <h3><?= $pending_bookings ?></h3>
                <p>Pending</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-hotel"></i>
                <h3><?= $total_cottages ?></h3>
                <p>Cottages</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3><?= $total_customers ?></h3>
                <p>Customers</p>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="/admin/cottages" class="btn btn-primary"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a href="/admin/bookings" class="btn btn-info"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a href="/admin/users" class="btn btn-warning"><i class="fas fa-users"></i> Manage Users</a>
        <a href="/logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>