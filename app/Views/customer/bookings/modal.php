<div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book: <?= $cottage['cottage_name'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="bookingAlert"></div>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Price per day:</strong> ₱<?= number_format($cottage['price_per_day'], 2) ?></p>
                        <p><strong>Capacity:</strong> <?= $cottage['capacity'] ?> persons</p>
                        <p><strong>Description:</strong> <?= $cottage['description'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <form id="bookingForm">
                            <input type="hidden" name="cottage_id" value="<?= $cottage['cottage_id'] ?>">
                            <div class="mb-3">
                                <label>Check-in Date</label>
                                <input type="date" name="check_in" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Check-out Date</label>
                                <input type="date" name="check_out" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Special Requests</label>
                                <textarea name="special_requests" class="form-control" rows="2"></textarea>
                            </div>
                            <div id="pricePreview" class="alert alert-info" style="display:none"></div>
                            <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/save-booking',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#bookingAlert').html(`<div class="alert alert-success">${response.message}</div>`);
                    setTimeout(() => {
                        $('#bookingModal').modal('hide');
                        window.location.href = '/my-bookings';
                    }, 2000);
                } else {
                    $('#bookingAlert').html(`<div class="alert alert-danger">${response.message}</div>`);
                }
            }
        });
    });
    
    function calculateTotal() {
        let checkIn = $('input[name="check_in"]').val();
        let checkOut = $('input[name="check_out"]').val();
        let price = <?= $cottage['price_per_day'] ?>;
        
        if(checkIn && checkOut) {
            let days = Math.ceil((new Date(checkOut) - new Date(checkIn)) / (1000 * 60 * 60 * 24));
            if(days > 0) {
                let total = days * price;
                $('#pricePreview').html(`<strong>Duration:</strong> ${days} day(s)<br><strong>Total:</strong> ₱${total.toFixed(2)}`).show();
            }
        }
    }
    
    $('input[name="check_in"], input[name="check_out"]').on('change', calculateTotal);
    $('input[name="check_in"]').on('change', function() {
        $('input[name="check_out"]').attr('min', this.value);
    });
</script>