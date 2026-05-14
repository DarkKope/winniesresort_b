<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { display: flex; align-items: center; font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .navbar-brand img { margin-right: 12px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 20px; background: white; }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 8px 25px; }
        .btn-primary:hover { background: #0d47a1; }
        .list-group-item { border: none; padding: 12px 20px; border-radius: 10px; }
        .list-group-item.active { background: #1e88e5; color: white; }
        .list-group-item:not(.active):hover { background: #f0f0f0; cursor: pointer; }
        .form-control { border-radius: 10px; padding: 10px 15px; }
        .footer { background: #2c3e50; color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
        .page-header { background: linear-gradient(135deg, #2c3e50, #1a3a5c); padding: 40px 0; text-align: center; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://cdn-icons-png.flaticon.com/512/1047/1047711.png" alt="Logo" style="height: 40px;">
            Winnie's Resort
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-bookings">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link active" href="/my-account">My Account</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-user-circle"></i> My Account</h1>
        <p>Manage your profile information</p>
    </div>
</div>

<div class="container">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center p-4">
                <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                <h4><?= $user['full_name'] ?></h4>
                <p class="text-muted">@<?= $user['username'] ?></p>
                <hr>
                <div class="list-group">
                    <a href="/my-account" class="list-group-item active">Profile Information</a>
                    <a href="/change-password" class="list-group-item">Change Password</a>
                    <a href="/my-bookings" class="list-group-item">My Bookings</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Edit Profile</h4>
                    <form action="/update-account" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?= $user['username'] ?>" disabled>
                            <small class="text-muted">Username cannot be changed</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?= $user['full_name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="<?= ucfirst($user['role']) ?>" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Account</button>
                    </form>
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