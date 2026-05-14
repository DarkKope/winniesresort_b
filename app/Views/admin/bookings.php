<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings - Admin</title>
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
        .badge-pending { background: #ffc107; color: #000; padding: 5px 10px; border-radius: 20px; }
        .badge-confirmed { background: #28a745; color: #fff; padding: 5px 10px; border-radius: 20px; }
        .badge-paid { background: #00a884; color: #fff; padding: 5px 10px; border-radius: 20px; }
        .payment-badge { font-size: 11px; padding: 3px 8px; border-radius: 15px; }
        .payment-cash { background: #6c757d; color: white; }
        .payment-gcash { background: #00a884; color: white; }
        @media (max-width: 768px) { .sidebar { width: 100%; position: relative; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x" style="color: #00b4d8;"></i><h3>Winnie's Resort</h3><p>Admin Panel</p></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="nav-link" href="/admin/cottages"><i class="fas fa-hotel"></i> Manage Cottages</a>
        <a class="nav-link active" href="/admin/bookings"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
        <hr><a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="top-bar">
        <h4><i class="fas fa-calendar-check"></i> Manage Bookings</h4>
        <div><span class="text-muted"><?= session()->get('username') ?></span> <span class="badge bg-info">Admin</span></div>
    </div>
    
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ref</th>
                        <th>Customer</th>
                        <th>Cottage</th>
                        <th>Check-in</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $booking): ?>
                    <tr>
                        <td><strong><?= $booking['booking_reference'] ?></strong></td>
                        <td><?= $booking['full_name'] ?></td>
                        <td><?= $booking['cottage_name'] ?></td>
                        <td><?= date('M d', strtotime($booking['booking_date'])) ?></td>
                        <td>₱<?= number_format($booking['total_amount'], 2) ?></td>
                        <td>
                            <span class="payment-badge payment-<?= $booking['payment_method'] ?? 'cash' ?>">
                                <i class="fas fa-<?= $booking['payment_method'] == 'gcash' ? 'mobile-alt' : 'money-bill' ?>"></i>
                                <?= ucfirst($booking['payment_method'] ?? 'Cash') ?>
                            </span>
                            <?php if(($booking['payment_method'] ?? '') == 'gcash' && !empty($booking['payment_reference'])): ?>
                                <br><small class="text-muted">Ref: <?= $booking['payment_reference'] ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span>
                            <?php if(($booking['payment_status'] ?? 'pending') == 'paid'): ?>
                                <br><span class="badge-paid">Paid</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="/admin/update-booking-status" method="post" style="display:inline">
                                <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                    <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </form>
                            <?php if(($booking['payment_method'] ?? '') == 'gcash' && ($booking['payment_status'] ?? 'pending') != 'paid'): ?>
                                <a href="/admin/verify-payment/<?= $booking['booking_id'] ?>" class="btn btn-sm btn-success mt-1">Verify Payment</a>
                            <?php endif; ?>
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