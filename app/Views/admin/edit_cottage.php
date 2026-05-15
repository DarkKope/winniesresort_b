<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cottage - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); min-height: 100vh; position: fixed; width: 280px; }
        .sidebar .brand { padding: 25px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .brand h3 { color: white; }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; }
        .sidebar .nav-link.active { background: #0f3460; color: white; }
        .main-content { margin-left: 280px; padding: 20px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .btn-primary { background: #1e88e5; border: none; }
        .current-img { max-width: 200px; border-radius: 10px; margin-top: 5px; }
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
    <h2><i class="fas fa-edit"></i> Edit Cottage</h2>
    
    <div class="card mt-3">
        <div class="card-body">
            <form action="/admin/update-cottage/<?= $cottage['cottage_id'] ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cottage Name *</label>
                        <input type="text" name="cottage_name" class="form-control" value="<?= $cottage['cottage_name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price per Day (₱) *</label>
                        <input type="number" step="0.01" name="price_per_day" class="form-control" value="<?= $cottage['price_per_day'] ?>" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Capacity (persons) *</label>
                        <input type="number" name="capacity" class="form-control" value="<?= $cottage['capacity'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="available" <?= $cottage['status'] == 'available' ? 'selected' : '' ?>>Available</option>
                            <option value="maintenance" <?= $cottage['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="4" required><?= $cottage['description'] ?></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current Image</label><br>
                        <?php if(!empty($cottage['image_url'])): ?>
                            <img src="<?= $cottage['image_url'] ?>" class="current-img" alt="Current Image">
                            <br><small class="text-muted">Current image</small>
                        <?php else: ?>
                            <div class="alert alert-info">No image uploaded</div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Upload New Image</label>
                        <input type="file" name="cottage_image" id="cottage_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                        <img id="imagePreview" class="preview-img">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">OR Image URL</label>
                    <input type="url" name="image_url" id="image_url" class="form-control" value="<?= $cottage['image_url'] ?>" placeholder="https://example.com/image.jpg">
                    <small class="text-muted">Enter new URL to replace current image</small>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Cottage</button>
                    <a href="/admin/cottages" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Preview new uploaded image
document.getElementById('cottage_image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(this.files[0]);
    }
});

// Preview URL image
document.getElementById('image_url').addEventListener('change', function() {
    const preview = document.getElementById('imagePreview');
    if (this.value) {
        preview.src = this.value;
        preview.style.display = 'block';
    }
});
</script>
</body>
</html>