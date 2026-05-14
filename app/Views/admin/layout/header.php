<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - Winnie's Resort Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #1e3c72;
            --admin-secondary: #2a5298;
            --admin-success: #28a745;
            --admin-warning: #ffc107;
            --admin-danger: #dc3545;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(180deg, var(--admin-primary) 0%, var(--admin-secondary) 100%);
            min-height: 100vh;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            z-index: 100;
        }
        
        .sidebar .brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .brand h3 {
            margin: 10px 0 0;
            font-size: 1.3rem;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        
        .top-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .stat-card i {
            font-size: 35px;
            margin-bottom: 10px;
        }
        
        .btn-admin {
            background: var(--admin-primary);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }
        
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
        <i class="fas fa-umbrella-beach fa-2x"></i>
        <h3>Winnie's Resort</h3>
        <small>Administrator Panel</small>
    </div>
    
    <nav class="nav flex-column mt-3">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link" href="/admin/cottages">
            <i class="fas fa-hotel"></i> Manage Cottages
        </a>
        <a class="nav-link" href="/admin/bookings">
            <i class="fas fa-calendar-check"></i> Manage Bookings
        </a>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 15px;">
        <a class="nav-link text-danger" href="/logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>
    
    <div class="position-absolute bottom-0 p-3" style="width: 100%;">
        <small class="text-white-50">
            Logged in as:<br>
            <strong><?= session()->get('full_name') ?></strong>
        </small>
    </div>
</div>

<div class="main-content">
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-chart-line"></i> <?= $title ?? 'Dashboard' ?></h4>
        <div>
            <span class="text-muted">Welcome back, <strong><?= session()->get('full_name') ?></strong></span>
        </div>
    </div>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>