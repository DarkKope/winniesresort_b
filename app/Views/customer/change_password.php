<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #1e88e5;
            text-decoration: none;
        }
        
        .navbar-brand img {
            margin-right: 12px;
            height: 40px;
        }
        
        .page-header {
            background: linear-gradient(135deg, #2c3e50, #1a3a5c);
            padding: 50px 0;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: white;
        }
        
        .card-body {
            padding: 35px;
        }
        
        .form-control {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
            outline: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30,136,229,0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .alert {
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 20px;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        .footer a {
            color: #d4a373;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .page-header h1 { font-size: 1.8rem; }
            .card-body { padding: 25px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://cdn-icons-png.flaticon.com/512/1047/1047711.png" alt="Logo">
            Winnie's Resort
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-bookings">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-account">My Account</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-key"></i> Change Password</h1>
        <p>Update your security credentials</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center mb-4">Change Your Password</h4>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="/update-password" method="post">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                            <small class="text-muted">Minimum 6 characters</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Change Password
                            </button>
                            <a href="/my-account" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
        <p>
            <i class="fas fa-phone"></i> +63 912 345 6789 &nbsp;|&nbsp;
            <i class="fas fa-envelope"></i> info@winniesresort.com &nbsp;|&nbsp;
            <i class="fas fa-map-marker-alt"></i> Boracay Island, Philippines
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>