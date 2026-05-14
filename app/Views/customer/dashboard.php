<div class="row">
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3><?= isset($stats['total_bookings']) ? $stats['total_bookings'] : 0 ?></h3>
            <p>Total Bookings</p>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3><?= isset($stats['pending']) ? $stats['pending'] : 0 ?></h3>
            <p>Pending</p>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-check-circle"></i>
            <h3><?= isset($stats['confirmed']) ? $stats['confirmed'] : 0 ?></h3>
            <p>Confirmed</p>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card">
            <i class="fas fa-check-double"></i>
            <h3><?= isset($stats['completed']) ? $stats['completed'] : 0 ?></h3>
            <p>Completed</p>
        </div>
    </div>
</div>

<!-- Image Gallery Section -->
<div class="card mb-5">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-images me-2"></i> Resort Gallery</h5>
    </div>
    <div class="card-body">
        <div class="row gallery">
            <div class="col-md-4 mb-3">
                <a href="/book/1" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=400&h=300&fit=crop" alt="Beach Front" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <span>🏖️ Beach Front Kubo</span>
                            <small>₱3,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/2" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=300&fit=crop" alt="Family Villa" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <span>👨‍👩‍👧‍👦 Family Villa</span>
                            <small>₱8,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/3" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=300&fit=crop" alt="Couple's Paradise" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <span>💑 Couple's Paradise</span>
                            <small>₱5,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/4" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1519167758483-2c6f0d964f15?w=400&h=300&fit=crop" alt="Function Hall" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <span>🎉 Function Hall</span>
                            <small>₱15,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/5" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&h=300&fit=crop" alt="Deluxe Suite" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <span>⭐ Deluxe Suite</span>
                            <small>₱7,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/book/6" class="gallery-link">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=400&h=300&fit=crop" alt="Beach House" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <span>🏆 Premium Beach House</span>
                            <small>₱12,000/night</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card text-center">
            <div class="card-body py-5">
                <i class="fas fa-search fa-3x mb-3" style="color: #1e88e5;"></i>
                <h4>Browse All Cottages</h4>
                <p class="text-muted">Explore our luxurious cottages and find your perfect getaway</p>
                <a href="/cottages" class="btn btn-primary mt-2">
                    Browse Now <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card text-center">
            <div class="card-body py-5">
                <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #8b5a2b;"></i>
                <h4>My Bookings</h4>
                <p class="text-muted">View and manage all your existing reservations</p>
                <a href="/my-bookings" class="btn btn-outline-brown mt-2">
                    View Bookings <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    cursor: pointer;
}

.gallery-link {
    text-decoration: none;
    display: block;
}

.gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    color: white;
    padding: 20px 15px 15px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    transform: translateY(0);
}

.gallery-overlay span {
    font-size: 16px;
    font-weight: 600;
    display: block;
}

.gallery-overlay small {
    font-size: 12px;
    opacity: 0.9;
}

.btn-outline-brown {
    border: 2px solid #8b5a2b;
    color: #8b5a2b;
    background: transparent;
}

.btn-outline-brown:hover {
    background: #8b5a2b;
    color: white;
}
</style>