<h1 class="mb-4"><i class="fas fa-list"></i> Manage Bookings</h1>

<!-- Filter Tabs -->
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link <?= $current_filter == 'all' ? 'active' : '' ?>" href="/admin/bookings?filter=all">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $current_filter == 'pending' ? 'active' : '' ?>" href="/admin/bookings?filter=pending">
            <i class="fas fa-clock text-warning"></i> Pending
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $current_filter == 'confirmed' ? 'active' : '' ?>" href="/admin/bookings?filter=confirmed">
            <i class="fas fa-check-circle text-success"></i> Confirmed
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $current_filter == 'completed' ? 'active' : '' ?>" href="/admin/bookings?filter=completed">
            <i class="fas fa-check-double text-info"></i> Completed
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $current_filter == 'cancelled' ? 'active' : '' ?>" href="/admin/bookings?filter=cancelled">
            <i class="fas fa-times-circle text-danger"></i> Cancelled
        </a>
    </li>
</ul>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Reference</th>
                <th>Customer</th>
                <th>Cottage</th>
                <th>Check-in</th>
                <th>Days</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Approved By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookings as $booking): ?>
            <tr>
                <td><strong><?= $booking['booking_reference'] ?></strong></td>
                <td><?= $booking['full_name'] ?><br><small><?= $booking['customer_phone'] ?></small></td>
                <td><?= $booking['cottage_name'] ?></td>
                <td><?= date('M d, Y', strtotime($booking['booking_date'])) ?></td>
                <td><?= $booking['total_days'] ?> day(s)</td>
                <td>₱<?= number_format($booking['total_amount'], 2) ?></td>
                <td>
                    <span class="badge bg-<?= $booking['status'] == 'confirmed' ? 'success' : ($booking['status'] == 'pending' ? 'warning' : ($booking['status'] == 'completed' ? 'info' : 'danger')) ?>">
                        <?= ucfirst($booking['status']) ?>
                    </span>
                </td>
                <td><?= $booking['approved_by_name'] ?? '-' ?></td>
                <td>
                    <a href="/admin/view-booking/<?= $booking['booking_id'] ?>" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>