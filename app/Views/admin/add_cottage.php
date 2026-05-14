<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Cottage - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); min-height: 100vh; position: fixed; width: 280px; }
        .sidebar .brand { padding: 25px 20px; text-align: center; }
        .sidebar .brand h3 { color: white; }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; }
        .sidebar .nav-link.active { background: #0f3460; color: white; }
        .main-content { margin-left: 280px; padding: 20px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .btn-primary { background: #1e88e5; border: none; }
        .preview-img { max-width: 200px; margin-top: 10px; border-radius: 10px; display: none; }
        @media (max-width: 768px) { .sidebar { width: 100%; position: relative; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i class="fas fa-umbrella-beach fa-2x"></i><h3>Winnie's Resort</h3><p>Admin Panel</p></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="/admin/dashboard">Dashboard</a>
        <a class="nav-link active" href="/admin/cottages">Manage Cottages</a>
        <a class="nav-link" href="/admin/bookings">Manage Bookings</a>
        <a class="nav-link" href="/admin/users">Manage Users</a>
        <hr><a class="nav-link text-danger" href="/logout">Logout</a>
    </nav>
</div>

<div class="main-content">
    <h2>Add New Cottage</h2>
    <div class="card mt-3">
        <div class="card-body">
            <form action="/admin/save-cottage" method="post">
                <div class="mb-3">
                    <label>Cottage Name</label>
                    <input type="text" name="cottage_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Price per Day (₱)</label>
                        <input type="number" step="0.01" name="price_per_day" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Capacity (persons)</label>
                        <input type="number" name="capacity" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="available">Available</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Image URL</label>
                    <input type="url" name="image_url" id="image_url" class="form-control" placeholder="https://example.com/cottage-image.jpg">
                    <small class="text-muted">Enter a valid image URL (optional)</small>
                    <div><img id="preview" class="preview-img"></div>
                </div>
                <button type="submit" class="btn btn-primary">Save Cottage</button>
                <a href="/admin/cottages" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('image_url').addEventListener('change', function() {
    var preview = document.getElementById('preview');
    if(this.value) {
        preview.src = this.value;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
});
</script>
</body>
</html>