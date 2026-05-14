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