<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: #1a1a2e; min-height: 100vh; color: white; position: fixed; width: 260px; }
        .sidebar .brand { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #0f3460; color: white; }
        .sidebar .nav-link i { width: 25px; margin-right: 10px; }
        .main-content { margin-left: 260px; padding: 20px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        @media (max-width: 768px) { .sidebar { position: relative; width: 100%; min-height: auto; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x"></i><h3>Winnie's Resort</h3><small>Admin Panel</small></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="nav-link" href="/admin/cottages"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a class="nav-link" href="/admin/bookings"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
        <a class="nav-link active" href="/admin/staff"><i class="fas fa-user-tie"></i> Manage Staff</a>
        <hr><a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <h2>Manage Staff</h2>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <!-- Add Staff Form -->
    <div class="card mb-4"><div class="card-header">Add New Staff</div><div class="card-body">
        <form action="/admin/add-staff" method="post" class="row g-3">
            <div class="col-md-3"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
            <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
            <div class="col-md-3"><input type="text" name="full_name" class="form-control" placeholder="Full Name" required></div>
            <div class="col-md-2"><input type="text" name="phone" class="form-control" placeholder="Phone" required></div>
            <div class="col-md-2"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Add Staff</button></div>
        </form>
    </div></div>
    
    <!-- Staff List -->
    <div class="card"><div class="card-header">Staff List</div><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>ID</th><th>Username</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Joined</th><th>Action</th></tr></thead><tbody>
    <?php foreach($staff as $member): ?>
    <tr>
        <td><?= $member['user_id'] ?></td>
        <td><strong><?= $member['username'] ?></strong></td>
        <td><?= $member['full_name'] ?></td>
        <td><?= $member['email'] ?></td>
        <td><?= $member['phone'] ?></td>
        <td><?= date('M d, Y', strtotime($member['created_at'])) ?></td>
        <td><a href="/admin/delete-staff/<?= $member['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this staff member?')">Delete</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody></table></div></div></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>