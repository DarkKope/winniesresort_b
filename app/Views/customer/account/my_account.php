<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
        .card { background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border: none; margin-bottom: 20px; }
        .card-body { padding: 25px; }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 10px 25px; }
        .btn-primary:hover { background: #0d47a1; }
        .btn-warning { background: #ffc107; border: none; border-radius: 25px; padding: 10px 25px; color: #000; }
        .form-control { border-radius: 10px; padding: 10px 15px; border: 1px solid #ddd; }
        .form-control:focus { border-color: #1e88e5; outline: none; }
        .footer { background: #2c3e50; color: white; text-align: center; padding: 20px; margin-top: 30px; }
        .list-group-item { border: none; padding: 12px 20px; border-radius: 10px; margin-bottom: 5px; }
        .list-group-item.active { background: #1e88e5; color: white; }
        .list-group-item:not(.active):hover { background: #f0f0f0; cursor: pointer; }
        .alert { padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
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
                <li class="nav-item"><a class="nav-link active" href="/my-account">My Account</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="mb-4">👤 My Account</h2>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">❌ <?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                    <h4><?= $user['full_name'] ?></h4>
                    <p class="text-muted">@<?= $user['username'] ?></p>
                    <hr>
                    <div class="list-group">
                        <a href="/my-account" class="list-group-item active">
                            <i class="fas fa-user"></i> Profile Information
                        </a>
                        <a href="/change-password" class="list-group-item">
                            <i class="fas fa-lock"></i> Change Password
                        </a>
                        <a href="/my-bookings" class="list-group-item">
                            <i class="fas fa-calendar-alt"></i> My Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Edit Profile Information</h4>
                    <form action="/update-account" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?= $user['username'] ?>" disabled>
                            <small class="text-muted">Username cannot be changed</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control" value="<?= $user['full_name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="<?= ucfirst($user['role']) ?>" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Account
                        </button>
                        <a href="/change-password" class="btn btn-warning">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                    </form>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="mb-3">📊 Account Information</h5>
                    <p><strong>Member since:</strong> <?= date('F d, Y', strtotime($user['created_at'])) ?></p>
                    <?php 
                    $db = \Config\Database::connect();
                    $total = $db->query("SELECT COUNT(*) as count FROM bookings WHERE user_id = ?", [$user['user_id']])->getRowArray();
                    ?>
                    <p><strong>Total Bookings:</strong> <?= $total['count'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
        <p><i class="fas fa-phone"></i> +63 912 345 6789 | <i class="fas fa-envelope"></i> info@winniesresort.com</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
