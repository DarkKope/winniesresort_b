<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Winnies Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { display: flex; align-items: center; font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .navbar-brand img { margin-right: 12px; height: 40px; }
        .page-header { background: linear-gradient(135deg, #2c3e50, #1a3a5c); padding: 40px 0; text-align: center; color: white; margin-bottom: 30px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 20px; overflow: hidden; }
        .card-body { padding: 20px; }
        .nav-tabs { border-bottom: 2px solid #e0e0e0; margin-bottom: 20px; }
        .nav-tabs .nav-link { border: none; color: #666; padding: 10px 20px; font-weight: 500; transition: all 0.3s; }
        .nav-tabs .nav-link:hover { color: #1e88e5; }
        .nav-tabs .nav-link.active { color: #1e88e5; border-bottom: 3px solid #1e88e5; background: transparent; }
        .badge-pending { background: #ffc107; color: #000; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .badge-confirmed { background: #28a745; color: #fff; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .badge-completed { background: #17a2b8; color: #fff; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .badge-cancelled { background: #dc3545; color: #fff; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .btn-danger { background: #dc3545; border: none; border-radius: 25px; padding: 8px 20px; font-size: 14px; }
        .btn-danger:hover { background: #c82333; }
        .footer { background: #2c3e50; color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
        .tab-count { background: #e0e0e0; color: #666; padding: 2px 8px; border-radius: 20px; font-size: 12px; margin-left: 8px; }
        .nav-link.active .tab-count { background: #1e88e5; color: white; }
        .empty-state { text-align: center; padding: 40px; background: white; border-radius: 15px; }
        .empty-state i { font-size: 60px; color: #ccc; margin-bottom: 15px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
        
            Winnies Resort
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-calendar-alt"></i> My Bookings</h1>
        <p>View and manage your reservations</p>
    </div>
</div>

<div class="container">
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                <i class="fas fa-clock"></i> Pending
                <span class="tab-count"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'pending'; })) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="confirmed-tab" data-bs-toggle="tab" data-bs-target="#confirmed" type="button" role="tab">
                <i class="fas fa-check-circle"></i> Confirmed
                <span class="tab-count"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'confirmed'; })) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
                <i class="fas fa-check-double"></i> Completed
                <span class="tab-count"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'completed'; })) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab">
                <i class="fas fa-times-circle"></i> Cancelled
                <span class="tab-count"><?= count(array_filter($bookings, function($b) { return $b['status'] == 'cancelled'; })) ?></span>
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="bookingTabsContent">
        
        <!-- Pending Bookings -->
        <div class="tab-pane fade show active" id="pending" role="tabpanel">
            <?php 
            $pendingBookings = array_filter($bookings, function($b) { return $b['status'] == 'pending'; });
            if(empty($pendingBookings)): ?>
                <div class="empty-state">
                    <i class="fas fa-clock"></i>
                    <h4>No Pending Bookings</h4>
                    <p>You don't have any pending bookings at the moment.</p>
                    <a href="/" class="btn btn-primary">Browse Cottages</a>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($pendingBookings as $booking): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"><i class="fas fa-ticket-alt"></i> <?= $booking['booking_reference'] ?></h5>
                                    <span class="badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Cottage</small>
                                        <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Total Amount</small>
                                        <p class="fw-bold mb-0 text-primary">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Check-in</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Check-out</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <small class="text-muted">Duration</small>
                                    <p><i class="fas fa-hourglass-half"></i> <?= $booking['total_days'] ?> night(s)</p>
                                </div>
                                <div class="mt-3">
                                    <a href="/cancel-booking/<?= $booking['booking_id'] ?>" class="btn btn-danger w-100" onclick="return confirm('Cancel this booking?')">
                                        <i class="fas fa-times"></i> Cancel Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Confirmed Bookings -->
        <div class="tab-pane fade" id="confirmed" role="tabpanel">
            <?php 
            $confirmedBookings = array_filter($bookings, function($b) { return $b['status'] == 'confirmed'; });
            if(empty($confirmedBookings)): ?>
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h4>No Confirmed Bookings</h4>
                    <p>You don't have any confirmed bookings yet.</p>
                    <a href="/" class="btn btn-primary">Browse Cottages</a>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($confirmedBookings as $booking): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"><i class="fas fa-ticket-alt"></i> <?= $booking['booking_reference'] ?></h5>
                                    <span class="badge-confirmed"><i class="fas fa-check-circle"></i> Confirmed</span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Cottage</small>
                                        <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Total Amount</small>
                                        <p class="fw-bold mb-0 text-primary">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Check-in</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Check-out</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <small class="text-muted">Duration</small>
                                    <p><i class="fas fa-hourglass-half"></i> <?= $booking['total_days'] ?> night(s)</p>
                                </div>
                                <div class="mt-3 alert alert-success text-center mb-0 py-2">
                                    <i class="fas fa-check-circle"></i> Your booking is confirmed!
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Completed Bookings -->
        <div class="tab-pane fade" id="completed" role="tabpanel">
            <?php 
            $completedBookings = array_filter($bookings, function($b) { return $b['status'] == 'completed'; });
            if(empty($completedBookings)): ?>
                <div class="empty-state">
                    <i class="fas fa-check-double"></i>
                    <h4>No Completed Bookings</h4>
                    <p>You haven't completed any stays yet.</p>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($completedBookings as $booking): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"><i class="fas fa-ticket-alt"></i> <?= $booking['booking_reference'] ?></h5>
                                    <span class="badge-completed"><i class="fas fa-check-double"></i> Completed</span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Cottage</small>
                                        <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Total Amount</small>
                                        <p class="fw-bold mb-0 text-primary">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Check-in</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Check-out</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                    </div>
                                </div>
                                <div class="mt-3 alert alert-info text-center mb-0 py-2">
                                    <i class="fas fa-star"></i> Thank you for staying with us!
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Cancelled Bookings -->
        <div class="tab-pane fade" id="cancelled" role="tabpanel">
            <?php 
            $cancelledBookings = array_filter($bookings, function($b) { return $b['status'] == 'cancelled'; });
            if(empty($cancelledBookings)): ?>
                <div class="empty-state">
                    <i class="fas fa-times-circle"></i>
                    <h4>No Cancelled Bookings</h4>
                    <p>You don't have any cancelled bookings.</p>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($cancelledBookings as $booking): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"><i class="fas fa-ticket-alt"></i> <?= $booking['booking_reference'] ?></h5>
                                    <span class="badge-cancelled"><i class="fas fa-times-circle"></i> Cancelled</span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Cottage</small>
                                        <p class="fw-bold mb-0"><?= $booking['cottage_name'] ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Total Amount</small>
                                        <p class="fw-bold mb-0 text-muted">₱<?= number_format($booking['total_amount'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Check-in</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'])) ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Check-out</small>
                                        <p class="mb-0"><i class="fas fa-calendar"></i> <?= date('M d, Y', strtotime($booking['booking_date'] . ' + ' . $booking['total_days'] . ' days')) ?></p>
                                    </div>
                                </div>
                                <div class="mt-3 alert alert-secondary text-center mb-0 py-2">
                                    <i class="fas fa-info-circle"></i> This booking has been cancelled.
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
        <p><i class="fas fa-phone"></i> 09512261616/ 09108746744| <i class="fas fa-envelope"></i> winniesresort100517@gmail.com</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>