<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Winnies Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e88e5;
        }
        
        .navbar-brand span {
            color: #8b5a2b;
        }
        
        .nav-link {
            font-weight: 500;
            color: #555 !important;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: #1e88e5 !important;
        }
        
        /* Hero Section */
        .page-header {
            background: linear-gradient(135deg, #2c3e50, #1a3a5c);
            padding: 60px 0;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
        }
        
        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .profile-card {
            background: white;
            text-align: center;
            padding: 30px 20px;
        }
        
        .profile-card i {
            font-size: 80px;
            color: #1e88e5;
            margin-bottom: 15px;
        }
        
        .profile-card h4 {
            margin-bottom: 5px;
            color: #2c3e50;
        }
        
        .profile-card .badge {
            background: #8b5a2b;
            padding: 5px 15px;
            border-radius: 25px;
            font-size: 12px;
        }
        
        /* List Group */
        .list-group-item {
            border: none;
            padding: 12px 20px;
            margin-bottom: 8px;
            border-radius: 12px;
            transition: all 0.3s;
        }
        
        .list-group-item i {
            width: 25px;
            margin-right: 10px;
        }
        
        .list-group-item.active {
            background: linear-gradient(135deg, #1e88e5, #9cb0ce);
            color: white;
        }
        
        .list-group-item:not(.active):hover {
            background: #f0f0f0;
            transform: translateX(5px);
        }
        
        /* Form */
        .form-control {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
            outline: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30,136,229,0.3);
        }
        
        .btn-outline-warning {
            border: 2px solid #ffc107;
            color: #ffc107;
            background: transparent;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s;
        }
        
        .btn-outline-warning:hover {
            background: #ffc107;
            color: white;
        }
        
        /* Stats Card */
        .stats-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 15px;
            text-align: center;
        }
        
        .stats-card i {
            font-size: 30px;
            color: #1e88e5;
            margin-bottom: 10px;
        }
        
        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        .footer a {
            color: #d4a373;
            text-decoration: none;
        }
        
        .divider {
            width: 60px;
            height: 3px;
            background: #d4a373;
            margin: 15px auto;
        }
        
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">Winnies<span>Resort</span></a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/my-bookings">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link active" href="/my-account">My Account</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-user-circle"></i> My Account</h1>
        <p>Manage your profile information and account settings</p>
        <div class="divider"></div>
    </div>
</div>

<div class="container">
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
    
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4 mb-4">
            <div class="card profile-card">
                <i class="fas fa-user-circle"></i>
                <h4><?= $user['full_name'] ?></h4>
                <p class="text-muted">@<?= $user['username'] ?></p>
                <span class="badge"><?= ucfirst($user['role']) ?></span>
                
                <hr>
                
                <div class="list-group text-start">
                    <a href="/my-account" class="list-group-item active">
                        <i class="fas fa-user"></i> Profile Information
                    </a>
                    <a href="/change-password" class="list-group-item">
                        <i class="fas fa-lock"></i> Change Password
                    </a>
                    <a href="/my-bookings" class="list-group-item">
                        <i class="fas fa-calendar-alt"></i> My Bookings
                    </a>
                </div>
            </div>
            
            <div class="card mt-3 stats-card">
                <i class="fas fa-calendar-check"></i>
                <h5>Account Stats</h5>
                <?php 
                $db = \Config\Database::connect();
                $total = $db->query("SELECT COUNT(*) as count FROM bookings WHERE user_id = ?", [$user['user_id']])->getRowArray();
                ?>
                <p class="mb-0">Total Bookings: <strong><?= $total['count'] ?? 0 ?></strong></p>
                <p>Member since: <strong><?= date('M d, Y', strtotime($user['created_at'])) ?></strong></p>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-4">
                    <h4 class="mb-4"><i class="fas fa-edit"></i> Edit Profile Information</h4>
                    
                    <form action="/update-account" method="post">
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Username</label>
                            <input type="text" class="form-control" value="<?= $user['username'] ?>" disabled>
                            <small class="text-muted">Username cannot be changed</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user-circle"></i> Full Name *</label>
                            <input type="text" name="full_name" class="form-control" value="<?= $user['full_name'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email Address *</label>
                            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-phone"></i> Phone Number *</label>
                            <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-tag"></i> Role</label>
                            <input type="text" class="form-control" value="<?= ucfirst($user['role']) ?>" disabled>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Account
                            </button>
                            <a href="/change-password" class="btn btn-outline-warning">
                                <i class="fas fa-key"></i> Change Password
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
        <p>
            <i class="fas fa-phone"></i> 09512261616/ 09108746744| &nbsp;|&nbsp;
            <i class="fas fa-envelope"></i> winniesresort100517@gmail.com&nbsp;|&nbsp;
            <i class="fas fa-map-marker-alt"></i> Sto. Cagay, Su-ay, Himamaylan City, 6108
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>