<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: #1a1a2e; min-height: 100vh; color: white; position: fixed; width: 260px; }
        .sidebar .brand { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 10px; }
        .sidebar .nav-link.active { background: #0f3460; color: white; }
        .sidebar .nav-link i { width: 25px; margin-right: 10px; }
        .main-content { margin-left: 260px; padding: 20px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        @media (max-width: 768px) { .sidebar { position: relative; width: 100%; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x"></i><h3>Winnie's Resort</h3><small>Admin Panel</small></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="nav-link" href="/admin/cottages"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a class="nav-link" href="/admin/bookings"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a class="nav-link active" href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
        <hr style="border-color: rgba(255,255,255,0.1);"><a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <h2>Manage Users</h2>
    <div class="card mt-3"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>ID</th><th>Username</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Joined</th></tr></thead><tbody>
    <?php foreach($users as $user): ?>
    <tr><td><?= $user['user_id'] ?></td><td><strong><?= $user['username'] ?></strong></td><td><?= $user['full_name'] ?></td><td><?= $user['email'] ?></td><td><?= $user['phone'] ?></td><td><span class="badge bg-<?= $user['role'] == 'admin' ? 'danger' : 'primary' ?>"><?= ucfirst($user['role']) ?></span></td><td><?= date('M d, Y', strtotime($user['created_at'])) ?></td></tr>
    <?php endforeach; ?>
    </tbody></table></div></div></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>