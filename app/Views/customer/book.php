<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - <?= $cottage['cottage_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.8rem; font-weight: bold; color: #1e88e5; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 20px; overflow: hidden; }
        .btn-primary { background: #1e88e5; border: none; border-radius: 25px; padding: 10px 25px; }
        .btn-success { background: #00a884; border: none; border-radius: 25px; padding: 10px 25px; }
        .price { font-size: 2rem; font-weight: bold; color: #8b5a2b; }
        .footer { background: #2c3e50; color: white; padding: 20px; text-align: center; margin-top: 30px; }
        .form-control, .form-select { border-radius: 10px; padding: 10px; }
        .cottage-image { width: 100%; height: 300px; object-fit: cover; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
        .payment-option { border: 2px solid #e0e0e0; border-radius: 10px; padding: 15px; margin-bottom: 10px; cursor: pointer; transition: all 0.3s; }
        .payment-option:hover { border-color: #1e88e5; background: #f0f8ff; }
        .payment-option.selected { border-color: #00a884; background: #e8f5e9; }
        .gcash-badge { background: #00a884; color: white; padding: 3px 8px; border-radius: 5px; font-size: 12px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">Winnie's Resort</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="<?= !empty($cottage['image_url']) ? $cottage['image_url'] : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&h=400&fit=crop' ?>" 
                     class="cottage-image" alt="<?= $cottage['cottage_name'] ?>">
                <div class="card-body">
                    <h3><?= $cottage['cottage_name'] ?></h3>
                    <p><?= $cottage['description'] ?></p>
                    <hr>
                    <h4 class="price">₱<?= number_format($cottage['price_per_day'], 2) ?>/night</h4>
                    <p><i class="fas fa-users"></i> <?= $cottage['capacity'] ?> persons</p>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i> Check-in: 9:00 AM | Check-out: 6:00 PM
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Complete Your Booking</h4>
                    <hr>
                    <form id="bookingForm">
                        <input type="hidden" name="cottage_id" value="<?= $cottage['cottage_id'] ?>">
                        
                        <div class="mb-3">
                            <label>Check-in Date</label>
                            <input type="date" name="check_in" id="check_in" class="form-control" min="<?= date('Y-m-d') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label>Check-out Date</label>
                            <input type="date" name="check_out" id="check_out" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label>Special Requests</label>
                            <textarea name="special_requests" class="form-control" rows="2"></textarea>
                        </div>
                        
                        <div id="pricePreview" class="alert alert-info" style="display: none;"></div>
                        
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div class="payment-option" onclick="selectPayment('cash')" id="cashOption">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="cash" id="cashRadio">
                                    <label class="form-check-label" for="cashRadio">
                                        <i class="fas fa-money-bill-wave"></i> Cash on Arrival
                                    </label>
                                </div>
                            </div>
                            <div class="payment-option" onclick="selectPayment('gcash')" id="gcashOption">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="gcash" id="gcashRadio">
                                    <label class="form-check-label" for="gcashRadio">
                                        <i class="fas fa-mobile-alt"></i> GCash <span class="gcash-badge">Secure Payment</span>
                                    </label>
                                </div>
                                <div id="gcashDetails" style="display: none; margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                                    <p><strong>GCash Payment Instructions:</strong></p>
                                    <ol>
                                        <li>Open GCash App</li>
                                        <li>Click "Pay QR" or "Send Money"</li>
                                        <li>Send payment to: <strong>09123456789</strong> (Winnie's Resort)</li>
                                        <li>Enter the exact amount shown above</li>
                                        <li>Enter your Reference Number below after payment</li>
                                    </ol>
                                    <div class="mb-2">
                                        <label>GCash Reference Number</label>
                                        <input type="text" id="gcash_reference" name="gcash_reference" class="form-control" placeholder="Enter GCash Reference Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Winnie's Resort</p>
    </div>
</footer>

<script>
$(document).ready(function() {
    $('#check_in').on('change', function() {
        $('#check_out').attr('min', this.value);
        calculateTotal();
    });
    $('#check_out').on('change', calculateTotal);
    
    function calculateTotal() {
        var checkIn = $('#check_in').val();
        var checkOut = $('#check_out').val();
        var price = <?= $cottage['price_per_day'] ?>;
        if(checkIn && checkOut) {
            var days = Math.ceil((new Date(checkOut) - new Date(checkIn)) / (1000 * 60 * 60 * 24));
            if(days > 0) {
                var total = days * price;
                $('#pricePreview').html('<strong>' + days + ' night(s) = ₱' + total.toFixed(2) + '</strong>').show();
            }
        }
    }
});

function selectPayment(method) {
    document.getElementById('cashOption').classList.remove('selected');
    document.getElementById('gcashOption').classList.remove('selected');
    
    if (method === 'cash') {
        document.getElementById('cashOption').classList.add('selected');
        document.getElementById('cashRadio').checked = true;
        document.getElementById('gcashDetails').style.display = 'none';
        document.getElementById('gcashRadio').checked = false;
    } else if (method === 'gcash') {
        document.getElementById('gcashOption').classList.add('selected');
        document.getElementById('gcashRadio').checked = true;
        document.getElementById('gcashDetails').style.display = 'block';
        document.getElementById('cashRadio').checked = false;
    }
}

$('#bookingForm').on('submit', function(e) {
    e.preventDefault();
    
    var paymentMethod = $('input[name="payment_method"]:checked').val();
    var gcashRef = $('#gcash_reference').val();
    
    if (!paymentMethod) {
        alert('Please select a payment method');
        return;
    }
    
    if (paymentMethod === 'gcash' && !gcashRef) {
        alert('Please enter GCash Reference Number');
        return;
    }
    
    var formData = $(this).serialize();
    if (paymentMethod === 'gcash') {
        formData += '&gcash_reference=' + gcashRef;
    }
    
    $.ajax({
        url: '/save-booking',
        type: 'POST',
        data: formData,
        success: function(res) {
            alert(res.message);
            if(res.success) window.location.href = '/my-bookings';
        }
    });
});
</script>
</body>
</html>