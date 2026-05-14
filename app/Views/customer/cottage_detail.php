<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $cottage['cottage_name'] ?> - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --blue: #1e88e5; --blue-dark: #0d47a1; --blue-steel: #2c3e50; --brown: #8b5a2b; }
        body { font-family: 'Montserrat', sans-serif; background: #f5f5f5; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--blue-dark) !important; }
        .navbar-brand span { color: var(--brown); }
        .nav-link { font-weight: 500; color: #555 !important; margin: 0 10px; }
        .main-image { width: 100%; height: 400px; object-fit: cover; border-radius: 15px; margin-bottom: 15px; cursor: pointer; }
        .thumbnail-container { display: flex; gap: 10px; overflow-x: auto; padding-bottom: 10px; }
        .thumbnail { width: 100px; height: 80px; object-fit: cover; border-radius: 10px; cursor: pointer; transition: all 0.3s; border: 2px solid transparent; }
        .thumbnail:hover, .thumbnail.active { border-color: var(--blue); transform: scale(1.05); }
        .lightbox { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 2000; cursor: pointer; }
        .lightbox-img { max-width: 90%; max-height: 90%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 10px; }
        .close-lightbox { position: absolute; top: 20px; right: 40px; color: white; font-size: 40px; cursor: pointer; }
        .booking-card { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); position: sticky; top: 20px; }
        .price { font-size: 2rem; font-weight: bold; color: var(--brown); }
        .btn-book { background: linear-gradient(135deg, var(--blue), var(--blue-dark)); color: white; border: none; border-radius: 25px; padding: 12px 30px; font-weight: 600; width: 100%; transition: all 0.3s; }
        .btn-book:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(30,136,229,0.3); }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #ddd; padding: 10px 15px; }
        .form-control:focus, .form-select:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(30,136,229,0.1); }
        .feature-icon { width: 40px; height: 40px; background: #f0f0f0; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--blue); }
        .footer { background: var(--blue-steel); color: white; padding: 30px 0; margin-top: 50px; text-align: center; }
        @media (max-width: 768px) { .main-image { height: 250px; } .booking-card { position: relative; top: 0; margin-top: 20px; } }
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
                <li class="nav-item"><a class="nav-link" href="/#cottages">Cottages</a></li>
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

<div class="container mt-4">
    <a href="/#cottages" class="btn btn-outline-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
    
    <div class="row">
        <div class="col-lg-7 mb-4">
            <h2 class="mb-3"><?= $cottage['cottage_name'] ?></h2>
            <?php 
            $galleryImages = [
                1 => ['https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1519167758483-2c6f0d964f15?w=150&h=100&fit=crop'],
                2 => ['https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1519167758483-2c6f0d964f15?w=150&h=100&fit=crop'],
                3 => ['https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1519167758483-2c6f0d964f15?w=150&h=100&fit=crop'],
                4 => ['https://images.unsplash.com/photo-1519167758483-2c6f0d964f15?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop'],
                5 => ['https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop'],
                6 => ['https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&h=100&fit=crop', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=150&h=100&fit=crop'],
            ];
            $images = $galleryImages[$cottage['cottage_id']] ?? $galleryImages[1];
            ?>
            <img id="mainImage" src="<?= $images[0] ?>" class="main-image" onclick="openLightbox()">
            <div class="thumbnail-container">
                <?php foreach($images as $index => $img): ?>
                    <img src="<?= $img ?>" class="thumbnail" onclick="changeImage(this.src, this)">
                <?php endforeach; ?>
            </div>
            <div class="mt-4"><h4>Description</h4><p><?= $cottage['description'] ?></p></div>
            <div class="row mt-4">
                <div class="col-6 col-md-3 mb-3"><div class="feature-icon"><i class="fas fa-users fa-lg"></i></div><small>Capacity</small><p class="fw-bold"><?= $cottage['capacity'] ?> persons</p></div>
                <div class="col-6 col-md-3 mb-3"><div class="feature-icon"><i class="fas fa-wifi fa-lg"></i></div><small>Free WiFi</small><p class="fw-bold">Included</p></div>
                <div class="col-6 col-md-3 mb-3"><div class="feature-icon"><i class="fas fa-swimming-pool fa-lg"></i></div><small>Pool Access</small><p class="fw-bold">Free</p></div>
                <div class="col-6 col-md-3 mb-3"><div class="feature-icon"><i class="fas fa-parking fa-lg"></i></div><small>Free Parking</small><p class="fw-bold">Available</p></div>
            </div>
        </div>
        
        <div class="col-lg-5 mb-4">
            <div class="booking-card">
                <div class="text-center mb-3"><span class="price">₱<?= number_format($cottage['price_per_day'], 2) ?></span><small>/per night</small></div>
                <hr>
                <form id="bookingForm">
                    <input type="hidden" name="cottage_id" value="<?= $cottage['cottage_id'] ?>">
                    <div class="mb-3"><label>Check-in Date</label><input type="date" name="check_in" id="check_in" class="form-control" min="<?= date('Y-m-d') ?>" required></div>
                    <div class="mb-3"><label>Check-out Date</label><input type="date" name="check_out" id="check_out" class="form-control" required></div>
                    <div class="mb-3"><label>Special Requests</label><textarea name="special_requests" class="form-control" rows="3" placeholder="Any special requests?"></textarea></div>
                    <div id="pricePreview" class="alert alert-info mb-3" style="display:none"><div class="text-center"><strong>Total:</strong> <span id="daysCount">0</span> night(s) = <strong>₱<span id="totalPrice">0</span></strong></div></div>
                    <button type="submit" class="btn-book"><i class="fas fa-check-circle me-2"></i> Confirm Booking</button>
                </form>
                <hr><div class="text-center"><small><i class="fas fa-shield-alt"></i> Secure booking<br><i class="fas fa-credit-card"></i> No prepayment<br><i class="fas fa-calendar-times"></i> Free cancellation</small></div>
            </div>
        </div>
    </div>
</div>

<footer class="footer"><div class="container"><p>&copy; 2024 Winnie's Resort. All rights reserved.</p><p><i class="fas fa-phone"></i> +63 912 345 6789 | <i class="fas fa-envelope"></i> info@winniesresort.com</p></div></footer>

<div id="lightbox" class="lightbox" onclick="closeLightbox()"><span class="close-lightbox">&times;</span><img id="lightboxImg" class="lightbox-img" src=""></div>

<!-- Login/Register Modals -->
<div class="modal fade" id="loginModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Login</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div id="loginAlert"></div><form id="loginForm"><div class="mb-3"><input type="email" id="loginEmail" class="form-control" placeholder="Email" required></div><div class="mb-3"><input type="password" id="loginPassword" class="form-control" placeholder="Password" required></div><button type="submit" class="btn btn-primary w-100">Login</button></form></div><div class="modal-footer"><p class="mb-0">No account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></p></div></div></div></div>

<div class="modal fade" id="registerModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Register</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div id="registerAlert"></div><form id="registerForm"><div class="row"><div class="col-md-6 mb-3"><input type="text" id="regUsername" class="form-control" placeholder="Username" required></div><div class="col-md-6 mb-3"><input type="email" id="regEmail" class="form-control" placeholder="Email" required></div></div><div class="mb-3"><input type="text" id="regFullname" class="form-control" placeholder="Full Name" required></div><div class="mb-3"><input type="text" id="regPhone" class="form-control" placeholder="Phone" required></div><div class="mb-3"><input type="password" id="regPassword" class="form-control" placeholder="Password (min 6)" required></div><button type="submit" class="btn btn-primary w-100">Register</button></form></div><div class="modal-footer"><p class="mb-0">Have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p></div></div></div></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function changeImage(src, el) { document.getElementById('mainImage').src = src; document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active')); el.classList.add('active'); }
function openLightbox() { document.getElementById('lightboxImg').src = document.getElementById('mainImage').src; document.getElementById('lightbox').style.display = 'block'; }
function closeLightbox() { document.getElementById('lightbox').style.display = 'none'; }
function calculateTotal() {
    let checkIn = $('#check_in').val(), checkOut = $('#check_out').val(), price = <?= $cottage['price_per_day'] ?>;
    if(checkIn && checkOut) { let days = Math.ceil((new Date(checkOut) - new Date(checkIn)) / (1000*60*60*24)); if(days > 0) { $('#daysCount').text(days); $('#totalPrice').text((days * price).toFixed(2)); $('#pricePreview').show(); } else $('#pricePreview').hide(); }
}
$('#check_in').on('change', function() { $('#check_out').attr('min', this.value); calculateTotal(); });
$('#check_out').on('change', calculateTotal);
$('#bookingForm').on('submit', function(e) {
    e.preventDefault();
    <?php if(!$isLoggedIn): ?> new bootstrap.Modal(document.getElementById('loginModal')).show();
    <?php else: ?> $.ajax({url: '/save-booking', method: 'POST', data: $(this).serialize(), success: function(r) { if(r.success) { alert(r.message); window.location.href = '/my-bookings'; } else alert(r.message); } }); <?php endif; ?>
});
function showAlert(el, msg, type) { $(`#${el}`).html(`<div class="alert alert-${type}">${msg}</div>`); setTimeout(() => $(`#${el}`).html(''), 5000); }
$('#loginForm').on('submit', function(e) { e.preventDefault(); $.ajax({url: '/ajax/login', method: 'POST', data: {email: $('#loginEmail').val(), password: $('#loginPassword').val()}, success: function(r) { r.success ? location.reload() : showAlert('loginAlert', r.message, 'danger'); } }); });
$('#registerForm').on('submit', function(e) { e.preventDefault(); $.ajax({url: '/ajax/register', method: 'POST', data: {username: $('#regUsername').val(), email: $('#regEmail').val(), full_name: $('#regFullname').val(), phone: $('#regPhone').val(), password: $('#regPassword').val()}, success: function(r) { if(r.success) { showAlert('registerAlert', r.message, 'success'); setTimeout(() => { $('#registerModal').modal('hide'); $('#loginModal').modal('show'); }, 2000); } else showAlert('registerAlert', r.message, 'danger'); } }); });
</script>
</body>
</html>