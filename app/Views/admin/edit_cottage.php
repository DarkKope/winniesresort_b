<!DOCTYPE html>
<html>
<head><title>Edit Cottage</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<div class="container mt-4">
    <h2>Edit Cottage</h2>
    <form action="/admin/update-cottage/<?= $cottage['cottage_id'] ?>" method="post">
        <div class="mb-3"><label>Cottage Name</label><input type="text" name="cottage_name" class="form-control" value="<?= $cottage['cottage_name'] ?>" required></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="3" required><?= $cottage['description'] ?></textarea></div>
        <div class="mb-3"><label>Price per Day</label><input type="number" step="0.01" name="price_per_day" class="form-control" value="<?= $cottage['price_per_day'] ?>" required></div>
        <div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" value="<?= $cottage['capacity'] ?>" required></div>
        <div class="mb-3"><label>Status</label><select name="status" class="form-control"><option value="available" <?= $cottage['status']=='available'?'selected':'' ?>>Available</option><option value="maintenance" <?= $cottage['status']=='maintenance'?'selected':'' ?>>Maintenance</option></select></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/cottages" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>