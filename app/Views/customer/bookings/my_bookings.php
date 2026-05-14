<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { display: flex; align-items: center; font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .navbar-brand img { margin-right: 12px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 8px 25px; }
        .btn-danger { background: #dc3545; border: none; border-radius: 25px; padding: 8px 25px; }
        .footer { background: #2c3e50; color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
        .badge-pending { background: #ffc107; color: #000; padding: 5px 12px; border-radius: 20px; }
        .badge-confirmed { background: #28a745; color: #fff; padding: 5px 12px; border-radius: 20px; }
        .badge-completed { background: #17a2b8; color: #fff; padding: 5px 12px; border-radius: 20px; }
        .badge-cancelled { background: #dc3545; color: #fff; padding: 5px 12px; border-radius: 20px; }
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
                <li class="nav-item"><a class="nav-link active" href="/my-bookings">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-account">My Account</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-calendar-alt"></i> My Bookings</h1>
        <p>View and manage your reservations</p>
    </div>
</div>

<div class="container">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if(empty($bookings)): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-calendar-times fa-3x mb-3"></i>
            <h4>No Bookings Yet</h4>
            <p>You haven't made any bookings.</p>
            <a href="/" class="btn btn-primary">Browse Cottages</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach($bookings as $booking): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5><?= $booking['booking_reference'] ?></h5>
                            <span class="badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span>
                        </div>
                        <hr>
                        <p><strong>Cottage:</strong> <?= $booking['cottage_name'] ?></p>
                        <p><strong>Check-in:</strong> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                        <p><strong>Check-out:</strong> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                        <p><strong>Total:</strong> ₱<?= number_format($booking['total_amount'], 2) ?></p>
                        <?php if($booking['status'] == 'pending'): ?>
                            <a href="/cancel-booking/<?= $booking['booking_id'] ?>" class="btn btn-danger w-100" onclick="return confirm('Cancel this booking?')">Cancel Booking</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
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