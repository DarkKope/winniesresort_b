<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Winnie's Resort - Customer</a>
            <div>
                <span class="text-white me-3">Welcome, <?= session()->get('username') ?></span>
                <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>My Dashboard</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings</h5>
                        <h2><?= $total_bookings ?? 0 ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <h2><?= $pending ?? 0 ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Approved</h5>
                        <h2><?= $approved ?? 0 ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="/cottages" class="btn btn-primary">Book a Cottage</a>
            <a href="/my-bookings" class="btn btn-info">My Bookings</a>
        </div>
    </div>
</body>
</html>