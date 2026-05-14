<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Cottages - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); min-height: 100vh; position: fixed; width: 280px; }
        .sidebar .brand { padding: 25px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .brand h3 { color: white; font-size: 1.5rem; }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #0f3460; color: white; }
        .sidebar .nav-link i { width: 25px; margin-right: 10px; }
        .main-content { margin-left: 280px; padding: 20px; }
        .top-bar { background: white; padding: 15px 25px; border-radius: 15px; margin-bottom: 25px; display: flex; justify-content: space-between; }
        .card { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .cottage-img { width: 60px; height: 50px; object-fit: cover; border-radius: 8px; }
        @media (max-width: 768px) { .sidebar { width: 100%; position: relative; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x" style="color: #00b4d8;"></i><h3>Winnie's Resort</h3><p>Admin Panel</p></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="nav-link active" href="/admin/cottages"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a class="nav-link" href="/admin/bookings"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
        <hr><a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="top-bar">
        <h4><i class="fas fa-hotel"></i> Manage Cottages</h4>
        <div><span class="text-muted"><?= session()->get('username') ?></span> <span class="badge bg-info">Admin</span></div>
    </div>
    
    <div class="mb-3">
        <a href="/admin/add-cottage" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Cottage</a>
    </div>
    
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Cottage Name</th>
                        <th>Price/Day</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cottages as $cottage): ?>
                    <tr>
                        <td>
                            <img src="<?= !empty($cottage['image_url']) ? $cottage['image_url'] : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=100&h=80&fit=crop' ?>" 
                                 class="cottage-img" alt="<?= $cottage['cottage_name'] ?>">
                        </td>
                        <td><?= $cottage['cottage_id'] ?></td>
                        <td><strong><?= $cottage['cottage_name'] ?></strong></td>
                        <td>₱<?= number_format($cottage['price_per_day'], 2) ?></td>
                        <td><?= $cottage['capacity'] ?></td>
                        <td><span class="badge bg-<?= $cottage['status'] == 'available' ? 'success' : 'danger' ?>"><?= ucfirst($cottage['status']) ?></span></td>
                        <td>
                            <a href="/admin/edit-cottage/<?= $cottage['cottage_id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="/admin/delete-cottage/<?= $cottage['cottage_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this cottage?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>