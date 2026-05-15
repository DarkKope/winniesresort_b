<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winnies Resort - Paradise Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a5f7a;
            --primary-light: #2c8eb3;
            --secondary: #e8b86b;
            --secondary-dark: #d4a043;
            --dark: #1e2a3e;
            --light: #f8f9fa;
            --text: #2c3e50;
            --text-light: #6c757d;
            --white: #ffffff;
            --shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
            --shadow-hover: 0 30px 45px -15px rgba(0,0,0,0.15);
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light);
            color: var(--text);
            overflow-x: hidden;
        }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #e0e0e0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 10px; }
        
        .navbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-brand img {
            transition: transform 0.3s ease;
            margin-right: 12px;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text) !important;
            margin: 0 8px;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: width 0.3s;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        .hero {
            background: linear-gradient(135deg, rgba(26,95,122,0.95), rgba(44,142,179,0.9)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&h=600&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 120px 0;
            text-align: center;
            color: white;
            position: relative;
        }
        
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 20px;
            animation: fadeInUp 0.8s ease;
        }
        
        .hero p {
            font-size: 1.2rem;
            opacity: 0.95;
            animation: fadeInUp 0.8s ease 0.2s both;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
        }
        
        .section-title .divider {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), var(--primary));
            margin: 0 auto;
            border-radius: 3px;
        }
        
        .cottage-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
        }
        
        .cottage-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }
        
        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 250px;
        }
        
        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .cottage-card:hover .card-img-wrapper img {
            transform: scale(1.1);
        }
        
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.6));
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .cottage-card:hover .card-overlay {
            opacity: 1;
        }
        
        .card-content {
            padding: 25px;
        }
        
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--dark);
        }
        
        .card-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .price small {
            font-size: 0.9rem;
            font-weight: normal;
            color: var(--text-light);
        }
        
        .btn-book {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(26,95,122,0.3);
        }
        
        .features {
            padding: 60px 0;
            background: linear-gradient(135deg, #f8f9fa, #fff);
        }
        
        .feature-item {
            text-align: center;
            padding: 30px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        
        .feature-item:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .feature-icon i {
            font-size: 2rem;
            color: white;
        }
        
        .feature-item h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .footer {
            background: linear-gradient(135deg, var(--dark), #1a2a3a);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--secondary);
        }
        
        .footer a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer a:hover {
            color: var(--secondary);
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }
        
        .fade-up {
            animation: fadeUp 0.6s ease forwards;
        }
        
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .section-title h2 { font-size: 1.8rem; }
            .card-img-wrapper { height: 200px; }
            .navbar-brand { font-size: 1.3rem; }
            .navbar-brand img { height: 35px; }
        }
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

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Discover Your Perfect Paradise</h1>
        <p>"Giving you the luxurious feeling for a very afordable accommodation."</p>
    </div>
</section>

<!-- Cottages Section -->
<div class="container py-5">
    <div class="section-title">
        <h2>Our Exclusive Cottages</h2>
        <div class="divider"></div>
        <p class="mt-3 text-muted">Choose your perfect getaway</p>
    </div>
    
    <div class="row">
        <?php foreach($cottages as $index => $cottage): ?>
        <div class="col-md-4 mb-4 fade-up" style="animation-delay: <?= $index * 0.1 ?>s">
            <div class="cottage-card">
                <div class="card-img-wrapper">
                    <img src="<?= !empty($cottage['image_url']) ? $cottage['image_url'] : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&h=350&fit=crop' ?>" 
                         alt="<?= $cottage['cottage_name'] ?>">
                    <div class="card-overlay"></div>
                </div>
                <div class="card-content">
                    <h3 class="card-title"><?= $cottage['cottage_name'] ?></h3>
                    <div class="card-meta">
                        <span><i class="fas fa-users"></i> <?= $cottage['capacity'] ?> guests</span>
                        <span><i class="fas fa-bed"></i> <?= $cottage['capacity'] == 2 ? '1' : round($cottage['capacity']/2) ?> bedroom</span>
                    </div>
                    <p class="text-muted small"><?= substr($cottage['description'], 0, 80) ?>...</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <span class="price">₱<?= number_format($cottage['price_per_day'], 2) ?></span>
                            <small>/night</small>
                        </div>
                        <a href="/book/<?= $cottage['cottage_id'] ?>" class="btn-book">Book Now <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <div class="divider"></div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-umbrella-beach"></i></div>
                    <h4>Front Pool access</h4>
                    <p class="text-muted">Direct access to pristine pool view</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-swimming-pool"></i></div>
                    <h4> Pool access</h4>
                    <p class="text-muted">Stunning pool view</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-utensils"></i></div>
                    <h4>Canteen Area</h4>
                    <p class="text-muted">Affordable prices and accessible</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-spa"></i></div>
                    <h4>Fun & Peace</h4>
                    <p class="text-muted">Relaxing yet enjoyable stay</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>Winnies Resort</h5>
                <p class="text-muted">Experience the perfect blend of affordable, comfortable, and natural beauty at Winnies Resort.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li><a href="#cottages">Cottages</a></li>
                    <li><a href="/my-bookings">My Bookings</a></li>
                    <li><a href="/my-account">My Account</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Contact Info</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i>Sto. Cagay, Su-ay, Himamaylan City, 6108</li>
                    <li><i class="fas fa-phone me-2"></i> 09512261616/ 09108746744</li>
                    <li><i class="fas fa-envelope me-2"></i> winniesresort100517@gmail.com</li>
                </ul>
            </div>
        </div>
        <hr class="mt-3">
        <div class="text-center">
            <p class="mb-0">&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Welcome Back</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="loginError" class="alert alert-danger" style="display:none"></div>
                <form id="loginForm">
                    <div class="mb-3">
                        <input type="email" id="loginEmail" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" id="loginPassword" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="modal-footer border-0">
                <p class="mb-0">Don't have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Register here</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="registerError" class="alert alert-danger" style="display:none"></div>
                <div id="registerSuccess" class="alert alert-success" style="display:none"></div>
                <form id="registerForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" id="regUsername" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" id="regEmail" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" id="regFullname" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" id="regPhone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" id="regPassword" class="form-control" placeholder="Password (min 6 characters)" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
            <div class="modal-footer border-0">
                <p class="mb-0">Already have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/ajax/login',
            type: 'POST',
            data: { email: $('#loginEmail').val(), password: $('#loginPassword').val() },
            success: function(res) {
                if (res.success) window.location.href = res.redirect;
                else $('#loginError').text(res.message).show();
            }
        });
    });
    
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/ajax/register',
            type: 'POST',
            data: {
                username: $('#regUsername').val(),
                email: $('#regEmail').val(),
                full_name: $('#regFullname').val(),
                phone: $('#regPhone').val(),
                password: $('#regPassword').val()
            },
            success: function(res) {
                if (res.success) {
                    $('#registerSuccess').text(res.message).show();
                    setTimeout(function() {
                        $('#registerModal').modal('hide');
                        $('#loginModal').modal('show');
                        $('#registerSuccess').hide();
                        $('#registerForm')[0].reset();
                    }, 2000);
                } else {
                    $('#registerError').text(res.message).show();
                }
            }
        });
    });
});
</script>
</body>
</html>