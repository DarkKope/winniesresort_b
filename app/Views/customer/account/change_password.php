<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.8rem; font-weight: 700; color: #0d47a1; }
        .navbar-brand span { color: #8b5a2b; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 10px 25px; }
        .footer { background: #2c3e50; color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://cdn-icons-png.flaticon.com/512/1047/1047711.png" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
            Winnie's<span>Resort</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center p-3"><i class="fas fa-user-circle fa-4x text-primary mb-3"></i><h5><?= session()->get('full_name') ?></h5><p><?= session()->get('username') ?></p>
            <div class="list-group"><a href="/my-account" class="list-group-item list-group-item-action">Profile</a><a href="/change-password" class="list-group-item list-group-item-action active">Change Password</a><a href="/my-bookings" class="list-group-item list-group-item-action">My Bookings</a></div></div>
        </div>
        <div class="col-md-8">
            <div class="card"><div class="card-body">
                <h4>Change Password</h4>
                <?php if(session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>
                <?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
                <form action="/update-password" method="post">
                    <div class="mb-3"><label>Current Password</label><input type="password" name="current_password" class="form-control" required></div>
                    <div class="mb-3"><label>New Password</label><input type="password" name="new_password" class="form-control" required></div>
                    <div class="mb-3"><label>Confirm Password</label><input type="password" name="confirm_password" class="form-control" required></div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div></div>
        </div>
    </div>
</div>

<footer class="footer"><div class="container"><p>&copy; 2024 Winnie's Resort</p></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>