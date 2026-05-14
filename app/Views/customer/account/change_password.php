<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
        .card { background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border: none; }
        .card-body { padding: 30px; }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 10px 25px; }
        .btn-primary:hover { background: #0d47a1; }
        .btn-secondary { background: #6c757d; border: none; border-radius: 25px; padding: 10px 25px; }
        .form-control { border-radius: 10px; padding: 10px 15px; border: 1px solid #ddd; }
        .form-control:focus { border-color: #1e88e5; outline: none; }
        .footer { background: #2c3e50; color: white; text-align: center; padding: 20px; margin-top: 30px; }
        .alert { padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">🌊 Winnie's Resort</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-bookings">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-account">My Account</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">🔐 Change Password</h3>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">❌ <?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    
                    <form action="/update-password" method="post">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                            <small class="text-muted">Minimum 6 characters</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        <a href="/my-account" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>