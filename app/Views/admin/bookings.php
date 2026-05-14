<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
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
        .badge-pending { background: #ffc107; color: #000; }
        .badge-confirmed { background: #28a745; color: #fff; }
        .badge-completed { background: #17a2b8; color: #fff; }
        .badge-cancelled { background: #dc3545; color: #fff; }
        .btn-sm { margin: 2px; }
        @media (max-width: 768px) { .sidebar { position: relative; width: 100%; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x"></i><h3>Winnie's Resort</h3><small>Admin Panel</small></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="nav-link" href="/admin/cottages"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a class="nav-link active" href="/admin/bookings"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
        <hr style="border-color: rgba(255,255,255,0.1);"><a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <h2>Manage Bookings</h2>
    <div class="card mt-3"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Reference</th><th>Customer</th><th>Cottage</th><th>Check-in</th><th>Days</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead><tbody>
    <?php foreach($bookings as $booking): ?>
    <tr>
        <td><strong><?= $booking['booking_reference'] ?></strong></td>
        <td><?= $booking['full_name'] ?><br><small><?= $booking['customer_phone'] ?></small></td>
        <td><?= $booking['cottage_name'] ?></td>
        <td><?= date('M d, Y', strtotime($booking['booking_date'])) ?></td>
        <td><?= $booking['total_days'] ?> day(s)</td>
        <td>₱<?= number_format($booking['total_amount'], 2) ?></td>
        <td><span class="badge badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span></td>
        <td>
            <a href="/admin/view-booking/<?= $booking['booking_id'] ?>" class="btn btn-sm btn-primary">View</a>
            <form action="/admin/update-booking-status" method="post" style="display:inline">
                <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto; display: inline-block;">
                    <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                    <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody><td></div></div></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>