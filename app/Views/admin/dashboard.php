<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .stat-card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 4px solid #1e88e5; }
        .stat-card i { font-size: 35px; color: #1e88e5; }
        .stat-card h3 { font-size: 28px; font-weight: bold; margin: 10px 0; }
        .btn-primary { background: #1e88e5; border: none; border-radius: 5px; }
        .btn-primary:hover { background: #0d47a1; }
        .table { background: white; border-radius: 10px; overflow: hidden; }
        .badge-pending { background: #ffc107; color: #000; }
        .badge-confirmed { background: #28a745; color: #fff; }
        .badge-completed { background: #17a2b8; color: #fff; }
        .badge-cancelled { background: #dc3545; color: #fff; }
        @media (max-width: 768px) { .sidebar { position: relative; width: 100%; min-height: auto; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x"></i><h3>Winnie's Resort</h3><small>Admin Panel</small></div>
    <nav class="nav flex-column">
        <a class="nav-link active" href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="nav-link" href="/admin/cottages"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a class="nav-link" href="/admin/bookings"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 15px;">
        <a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
        <div><span class="text-muted">Admin: <?= session()->get('full_name') ?></span></div>
    </div>

    <div class="row">
        <div class="col-md-3"><div class="stat-card"><i class="fas fa-calendar-check"></i><h3><?= $total_bookings ?></h3><p>Total Bookings</p></div></div>
        <div class="col-md-3"><div class="stat-card"><i class="fas fa-clock"></i><h3><?= $pending_bookings ?></h3><p>Pending</p></div></div>
        <div class="col-md-3"><div class="stat-card"><i class="fas fa-check-circle"></i><h3><?= $confirmed_bookings + $completed_bookings ?></h3><p>Confirmed</p></div></div>
        <div class="col-md-3"><div class="stat-card"><i class="fas fa-users"></i><h3><?= $total_customers ?></h3><p>Customers</p></div></div>
    </div>

    <div class="row">
        <div class="col-md-6"><div class="stat-card"><i class="fas fa-hotel"></i><h3><?= $total_cottages ?></h3><p>Total Cottages</p></div></div>
        <div class="col-md-6"><div class="stat-card"><i class="fas fa-money-bill"></i><h3>₱<?= number_format($total_revenue, 2) ?></h3><p>Total Revenue</p></div></div>
    </div>

    <div class="card mt-3"><div class="card-header">Recent Bookings</div><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Reference</th><th>Customer</th><th>Cottage</th><th>Date</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead><tbody>
    <?php foreach($recent_bookings as $booking): ?>
    <tr><td><?= $booking['booking_reference'] ?></td><td><?= $booking['full_name'] ?></td><td><?= $booking['cottage_name'] ?></td><td><?= date('M d, Y', strtotime($booking['booking_date'])) ?></td><td>₱<?= number_format($booking['total_amount'], 2) ?></td><td><span class="badge badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span></td><td><a href="/admin/view-booking/<?= $booking['booking_id'] ?>" class="btn btn-sm btn-primary">View</a></td></tr>
    <?php endforeach; ?>
    </tbody></table></div></div></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>