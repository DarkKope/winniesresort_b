<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.8rem; font-weight: 700; color: #0d47a1; }
        .navbar-brand span { color: #8b5a2b; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .badge-pending { background: #ffc107; color: #000; padding: 5px 12px; border-radius: 20px; }
        .badge-confirmed { background: #28a745; color: #fff; padding: 5px 12px; border-radius: 20px; }
        .badge-completed { background: #17a2b8; color: #fff; padding: 5px 12px; border-radius: 20px; }
        .badge-cancelled { background: #dc3545; color: #fff; padding: 5px 12px; border-radius: 20px; }
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
    <h2 class="mb-4">My Bookings</h2>
    <?php if(empty($bookings)): ?>
        <div class="alert alert-info text-center">No bookings yet. <a href="/#cottages">Browse cottages</a></div>
    <?php else: ?>
        <div class="row">
            <?php foreach($bookings as $booking): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between"><strong><?= $booking['booking_reference'] ?></strong>
                        <span class="badge badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span></div>
                        <hr>
                        <p><strong>Cottage:</strong> <?= $booking['cottage_name'] ?></p>
                        <p><strong>Check-in:</strong> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                        <p><strong>Check-out:</strong> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                        <p><strong>Total:</strong> ₱<?= number_format($booking['total_amount'], 2) ?></p>
                        <?php if($booking['status'] == 'pending'): ?>
                            <a href="/cancel-booking/<?= $booking['booking_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Cancel this booking?')">Cancel</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<footer class="footer"><div class="container"><p>&copy; 2024 Winnie's Resort</p></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>