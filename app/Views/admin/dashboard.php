<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card i {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .stat-card h3 {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending { background: #ffc107; color: #000; }
        .status-confirmed { background: #28a745; color: #fff; }
        .status-completed { background: #17a2b8; color: #fff; }
        .status-cancelled { background: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar" style="background: #2c3e50; min-height: 100vh; color: white;">
                    <div class="brand p-3 text-center">
                        <i class="fas fa-umbrella-beach fa-2x"></i>
                        <h4>Winnie's Resort</h4>
                        <small>Admin Panel</small>
                    </div>
                    <nav class="nav flex-column mt-3">
                        <a class="nav-link text-white" href="/admin/dashboard">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a class="nav-link text-white" href="/admin/cottages">
                            <i class="fas fa-hotel"></i> Cottages
                        </a>
                        <a class="nav-link text-white" href="/admin/bookings">
                            <i class="fas fa-calendar-check"></i> Bookings
                        </a>
                        <a class="nav-link text-danger" href="/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    <h1 class="mb-4"><i class="fas fa-chart-line"></i> Admin Dashboard</h1>
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Stats Cards -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="fas fa-calendar-check text-primary"></i>
                                <h3><?= $total_bookings ?? 0 ?></h3>
                                <p class="text-muted">Total Bookings</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="fas fa-clock text-warning"></i>
                                <h3><?= $pending_bookings ?? 0 ?></h3>
                                <p class="text-muted">Pending Approval</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="fas fa-check-circle text-success"></i>
                                <h3><?= ($confirmed_bookings ?? 0) + ($completed_bookings ?? 0) ?></h3>
                                <p class="text-muted">Confirmed</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="fas fa-money-bill text-info"></i>
                                <h3>₱<?= isset($total_revenue) ? number_format($total_revenue, 2) : '0.00' ?></h3>
                                <p class="text-muted">Total Revenue</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Quick Actions</h5>
                                    <a href="/admin/bookings?filter=pending" class="btn btn-warning">
                                        <i class="fas fa-clock"></i> Review Pending (<?= $pending_bookings ?? 0 ?>)
                                    </a>
                                    <a href="/admin/cottages" class="btn btn-primary">
                                        <i class="fas fa-hotel"></i> Manage Cottages
                                    </a>
                                    <a href="/admin/bookings" class="btn btn-info">
                                        <i class="fas fa-list"></i> All Bookings
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Bookings -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-clock text-warning"></i> Pending Approval</h5>
                        </div>
                        <div class="card-body">
                            <?php if(empty($pending_bookings_list) || !is_array($pending_bookings_list)): ?>
                                <p class="text-muted text-center">No pending bookings</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Reference</th>
                                                <th>Customer</th>
                                                <th>Cottage</th>
                                                <th>Check-in</th>
                                                <th>Days</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($pending_bookings_list as $booking): ?>
                                            <tr>
                                                <td><strong><?= $booking['booking_reference'] ?? 'N/A' ?></strong></td>
                                                <td><?= $booking['full_name'] ?? 'N/A' ?><br><small><?= $booking['customer_phone'] ?? '' ?></small></td>
                                                <td><?= $booking['cottage_name'] ?? 'N/A' ?></td>
                                                <td><?= isset($booking['booking_date']) ? date('M d, Y', strtotime($booking['booking_date'])) : 'N/A' ?></td>
                                                <td><?= $booking['total_days'] ?? 0 ?> day(s)</td>
                                                <td>₱<?= isset($booking['total_amount']) ? number_format($booking['total_amount'], 2) : '0.00' ?></td>
                                                <td>
                                                    <a href="/admin/view-booking/<?= $booking['booking_id'] ?? 0 ?>" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-check"></i> Review
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>