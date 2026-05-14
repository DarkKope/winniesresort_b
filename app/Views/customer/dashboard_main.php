<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winnie's Resort - Book Your Perfect Getaway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue: #1e88e5;
            --blue-dark: #0d47a1;
            --blue-steel: #2c3e50;
            --brown: #8b5a2b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', sans-serif; background: #f5f5f5; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--blue-dark) !important; }
        .navbar-brand span { color: var(--brown); }
        .nav-link { font-weight: 500; color: #555 !important; margin: 0 10px; transition: all 0.3s; }
        .nav-link:hover { color: var(--blue) !important; }
        .hero { background: linear-gradient(135deg, var(--blue-steel), var(--blue-dark)); padding: 80px 0; text-align: center; color: white; }
        .hero h1 { font-size: 3rem; font-weight: 700; font-family: 'Playfair Display', serif; }
        .hero p { font-size: 1.2rem; opacity: 0.9; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s; overflow: hidden; background: white; }
        .card:hover { transform: translateY(-5px); }
        .card-img-top { transition: transform 0.3s; height: 220px; object-fit: cover; }
        .card:hover .card-img-top { transform: scale(1.05); }
        .stat-card { background: white; border-radius: 15px; padding: 20px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-top: 4px solid var(--brown); }
        .stat-card i { font-size: 40px; color: var(--blue); }
        .stat-card h3 { font-size: 28px; font-weight: bold; margin: 10px 0; }
        .btn-primary { background: var(--blue); border: none; border-radius: 25px; padding: 8px 20px; font-weight: 500; transition: all 0.3s; }
        .btn-primary:hover { background: var(--blue-dark); transform: translateY(-2px); }
        .price-tag { background: var(--brown); color: white; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; }
        .footer { background: var(--blue-steel); color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
        .modal-content { border-radius: 20px; }
        @media (max-width: 768px) { .hero h1 { font-size: 2rem; } .navbar-brand { font-size: 1.3rem; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://cdn-icons-png.flaticon.com/512/1047/1047711.png" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
            Winnie's<span>Resort</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#cottages">Cottages</a></li>
                <?php if($isLoggedIn): ?>
                    <li class="nav-item"><a class="nav-link" href="/my-bookings">My Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="/my-account">My Account</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li>
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

<div class="container mt-5">
    <?php if($isLoggedIn && $stats): ?>
    <div class="row mb-5">
        <div class="col-md-3 mb-3"><div class="stat-card"><i class="fas fa-calendar-check"></i><h3><?= $stats['total_bookings'] ?? 0 ?></h3><p>Total Bookings</p></div></div>
        <div class="col-md-3 mb-3"><div class="stat-card"><i class="fas fa-clock"></i><h3><?= $stats['pending'] ?? 0 ?></h3><p>Pending</p></div></div>
        <div class="col-md-3 mb-3"><div class="stat-card"><i class="fas fa-check-circle"></i><h3><?= $stats['confirmed'] ?? 0 ?></h3><p>Confirmed</p></div></div>
        <div class="col-md-3 mb-3"><div class="stat-card"><i class="fas fa-check-double"></i><h3><?= $stats['completed'] ?? 0 ?></h3><p>Completed</p></div></div>
    </div>
    <?php endif; ?>

    <h2 id="cottages" class="text-center mb-4">Our Cottages</h2>
    <div class="row">
        <?php 
        $cottageImages = [
            1 => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=300&fit=crop',
            2 => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=300&fit=crop',
            3 => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=400&h=300&fit=crop',
            4 => 'https://images.unsplash.com/photo-1519167758483-2c6f0d964f15?w=400&h=300&fit=crop',
            5 => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&h=300&fit=crop',
            6 => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=400&h=300&fit=crop',
        ];
        ?>
        <?php foreach($cottages as $cottage): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="<?= $cottageImages[$cottage['cottage_id']] ?? 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=300&fit=crop' ?>" class="card-img-top" alt="<?= $cottage['cottage_name'] ?>">
                <div class="card-body">
                    <h4 class="card-title"><?= $cottage['cottage_name'] ?></h4>
                    <p class="card-text text-muted small"><?= substr($cottage['description'], 0, 80) ?>...</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <i class="fas fa-users text-muted"></i> <span class="small"><?= $cottage['capacity'] ?> guests</span><br>
                            <span class="price-tag mt-2 d-inline-block">₱<?= number_format($cottage['price_per_day'], 2) ?>/night</span>
                        </div>
                        <a href="/cottage/<?= $cottage['cottage_id'] ?>" class="btn btn-primary btn-sm">View Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Winnie's Resort. All rights reserved.</p>
        <p><i class="fas fa-phone"></i> +63 912 345 6789 | <i class="fas fa-envelope"></i> info@winniesresort.com</p>
    </div>
</footer>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Login</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div id="loginAlert"></div>
                <form id="loginForm">
                    <div class="mb-3"><input type="email" id="loginEmail" class="form-control" placeholder="Email" required></div>
                    <div class="mb-3"><input type="password" id="loginPassword" class="form-control" placeholder="Password" required></div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="modal-footer"><p class="mb-0">No account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></p></div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Register</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div id="registerAlert"></div>
                <form id="registerForm">
                    <div class="row">
                        <div class="col-md-6 mb-3"><input type="text" id="regUsername" class="form-control" placeholder="Username" required></div>
                        <div class="col-md-6 mb-3"><input type="email" id="regEmail" class="form-control" placeholder="Email" required></div>
                    </div>
                    <div class="mb-3"><input type="text" id="regFullname" class="form-control" placeholder="Full Name" required></div>
                    <div class="mb-3"><input type="text" id="regPhone" class="form-control" placeholder="Phone" required></div>
                    <div class="mb-3"><input type="password" id="regPassword" class="form-control" placeholder="Password (min 6)" required></div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
            <div class="modal-footer"><p class="mb-0">Have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showAlert(element, message, type) {
    $(`#${element}`).html(`<div class="alert alert-${type}">${message}</div>`);
    setTimeout(() => $(`#${element}`).html(''), 5000);
}
$('#loginForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({url: '/ajax/login', method: 'POST', data: {email: $('#loginEmail').val(), password: $('#loginPassword').val()}, success: function(r) { r.success ? location.reload() : showAlert('loginAlert', r.message, 'danger'); }});
});
$('#registerForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({url: '/ajax/register', method: 'POST', data: {username: $('#regUsername').val(), email: $('#regEmail').val(), full_name: $('#regFullname').val(), phone: $('#regPhone').val(), password: $('#regPassword').val()}, success: function(r) { if(r.success) { showAlert('registerAlert', r.message, 'success'); setTimeout(() => { $('#registerModal').modal('hide'); $('#loginModal').modal('show'); }, 2000); } else { showAlert('registerAlert', r.message, 'danger'); } }});
});
</script>
</body>
</html>