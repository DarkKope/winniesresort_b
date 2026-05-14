<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: #1a1a2e; min-height: 100vh; color: white; position: fixed; width: 260px; }
        .sidebar .brand { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 10px; }
        .sidebar .nav-link i { width: 25px; margin-right: 10px; }
        .main-content { margin-left: 260px; padding: 20px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .badge-pending { background: #ffc107; color: #000; }
        .badge-confirmed { background: #28a745; color: #fff; }
        .badge-completed { background: #17a2b8; color: #fff; }
        .badge-cancelled { background: #dc3545; color: #fff; }
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
    <h2>Booking Details</h2>
    <div class="row">
        <div class="col-md-8"><div class="card"><div class="card-header">Booking Information</div><div class="card-body">
            <div class="row"><div class="col-md-6"><p><strong>Reference:</strong> <?= $booking['booking_reference'] ?></p><p><strong>Status:</strong> <span class="badge badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span></p><p><strong>Booking Date:</strong> <?= date('F d, Y', strtotime($booking['created_at'])) ?></p></div>
            <div class="col-md-6"><p><strong>Check-in:</strong> <?= date('F d, Y', strtotime($booking['booking_date'])) ?></p><p><strong>Check-out:</strong> <?= date('F d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p><p><strong>Duration:</strong> <?= $booking['total_days'] ?> night(s)</p></div></div>
            <hr><div class="row"><div class="col-md-6"><h6>Cottage</h6><p><?= $booking['cottage_name'] ?><br>₱<?= number_format($booking['price_per_day'], 2) ?>/night</p></div>
            <div class="col-md-6"><h6>Payment</h6><p>Total: ₱<?= number_format($booking['total_amount'], 2) ?></p></div></div>
            <?php if($booking['special_requests']): ?><div class="alert alert-info"><strong>Special Requests:</strong><br><?= nl2br(htmlspecialchars($booking['special_requests'])) ?></div><?php endif; ?>
        </div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-header">Customer</div><div class="card-body"><p><strong>Name:</strong> <?= $booking['full_name'] ?></p><p><strong>Email:</strong> <?= $booking['email'] ?></p><p><strong>Phone:</strong> <?= $booking['phone'] ?></p></div></div>
        <div class="card mt-3"><div class="card-body"><form action="/admin/update-booking-status" method="post"><input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>"><select name="status" class="form-select mb-2"><option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option><option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option><option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Completed</option><option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option></select><button type="submit" class="btn btn-primary w-100">Update Status</button></form></div></div>
        <div class="card mt-3"><div class="card-body"><a href="/admin/bookings" class="btn btn-secondary w-100">Back to Bookings</a></div></div></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>