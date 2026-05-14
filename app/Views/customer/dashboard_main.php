<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .hero { background: linear-gradient(135deg, #2c3e50, #1a3a5c); padding: 60px 0; color: white; text-align: center; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s; margin-bottom: 20px; overflow: hidden; }
        .card:hover { transform: translateY(-5px); }
        .card-img-top { height: 220px; object-fit: cover; transition: transform 0.3s; }
        .card:hover .card-img-top { transform: scale(1.05); }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 8px 25px; }
        .price-tag { background: #8b5a2b; color: white; padding: 5px 12px; border-radius: 20px; font-size: 13px; }
        .footer { background: #2c3e50; color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">Winnie's Resort</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <?php if(isset($isLoggedIn) && $isLoggedIn): ?>
                    <li class="nav-item"><a class="nav-link" href="/my-bookings">My Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="/my-account">My Account</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <h1>Welcome to Winnie's Resort</h1>
        <p>Experience luxury and tranquility in paradise</p>
    </div>
</section>

<div class="container">
    <h2 class="text-center mb-4">Our Cottages & Rooms</h2>
    <div class="row">
        <?php foreach($cottages as $cottage): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="<?= !empty($cottage['image_url']) ? $cottage['image_url'] : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&h=350&fit=crop' ?>" 
                     class="card-img-top" alt="<?= $cottage['cottage_name'] ?>">
                <div class="card-body">
                    <h4><?= $cottage['cottage_name'] ?></h4>
                    <p class="text-muted small"><?= substr($cottage['description'], 0, 80) ?>...</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <i class="fas fa-users"></i> <?= $cottage['capacity'] ?> persons<br>
                            <span class="price-tag">₱<?= number_format($cottage['price_per_day'], 2) ?>/night</span>
                        </div>
                        <a href="/book/<?= $cottage['cottage_id'] ?>" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Winnie's Resort. All rights reserved.</p>
        <p><i class="fas fa-phone"></i> +63 912 345 6789 | <i class="fas fa-envelope"></i> info@winniesresort.com</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>