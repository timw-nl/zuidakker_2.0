jQuery(document).ready(function($) {
    'use strict';

    const bookingForm = $('#booking-form');
    const resourceSelect = $('#booking_resource');
    const startDateInput = $('#booking_start_date');
    const endDateInput = $('#booking_end_date');
    const checkAvailabilityBtn = $('#check-availability');
    const submitBookingBtn = $('#submit-booking');
    const resourceDetails = $('#resource-details');
    const bookingSummary = $('#booking-summary');
    const availabilityMessage = $('#availability-message');

    resourceSelect.on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const resourceId = selectedOption.val();

        if (!resourceId) {
            resourceDetails.hide();
            bookingSummary.hide();
            submitBookingBtn.hide();
            return;
        }

        const tier = selectedOption.data('tier');
        const price = selectedOption.data('price');
        const minDuration = selectedOption.data('min-duration');
        const maxDuration = selectedOption.data('max-duration');

        let detailsHtml = '<h4>' + selectedOption.text() + '</h4>';
        
        if (tier === 'professional') {
            detailsHtml += '<p><strong>Tier:</strong> Professional</p>';
            detailsHtml += '<p><strong>Price:</strong> €' + parseFloat(price).toFixed(2) + ' per day</p>';
        } else {
            detailsHtml += '<p><strong>Tier:</strong> Free</p>';
        }
        
        detailsHtml += '<p><strong>Minimum duration:</strong> ' + minDuration + ' day(s)</p>';
        detailsHtml += '<p><strong>Maximum duration:</strong> ' + maxDuration + ' day(s)</p>';

        resourceDetails.find('.resource-info').html(detailsHtml);
        resourceDetails.show();
        
        bookingSummary.hide();
        submitBookingBtn.hide();
        availabilityMessage.hide().removeClass('available unavailable');
    });

    startDateInput.on('change', function() {
        const startDate = $(this).val();
        endDateInput.attr('min', startDate);
        
        if (endDateInput.val() && endDateInput.val() < startDate) {
            endDateInput.val(startDate);
        }
        
        bookingSummary.hide();
        submitBookingBtn.hide();
        availabilityMessage.hide().removeClass('available unavailable');
    });

    endDateInput.on('change', function() {
        bookingSummary.hide();
        submitBookingBtn.hide();
        availabilityMessage.hide().removeClass('available unavailable');
    });

    checkAvailabilityBtn.on('click', function(e) {
        e.preventDefault();

        const resourceId = resourceSelect.val();
        const startDate = startDateInput.val();
        const endDate = endDateInput.val();

        if (!resourceId || !startDate || !endDate) {
            alert('Please fill in all fields before checking availability.');
            return;
        }

        const selectedOption = resourceSelect.find('option:selected');
        const minDuration = parseInt(selectedOption.data('min-duration'));
        const maxDuration = parseInt(selectedOption.data('max-duration'));

        const start = new Date(startDate);
        const end = new Date(endDate);
        const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

        if (days < minDuration) {
            alert('Minimum booking duration is ' + minDuration + ' day(s).');
            return;
        }

        if (days > maxDuration) {
            alert('Maximum booking duration is ' + maxDuration + ' day(s).');
            return;
        }

        checkAvailabilityBtn.prop('disabled', true).text('Checking...');

        $.ajax({
            url: zuidakkerBooking.ajaxurl,
            type: 'POST',
            data: {
                action: 'zuidakker_check_availability',
                nonce: zuidakkerBooking.nonce,
                resource_id: resourceId,
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    
                    availabilityMessage
                        .addClass('available')
                        .html('<strong>✓ Available!</strong> This resource is available for your selected dates.')
                        .show();

                    let summaryHtml = '<p><strong>Resource:</strong> ' + selectedOption.text() + '</p>';
                    summaryHtml += '<p><strong>Duration:</strong> ' + data.days + ' day(s)</p>';
                    summaryHtml += '<p><strong>Start:</strong> ' + formatDate(startDate) + '</p>';
                    summaryHtml += '<p><strong>End:</strong> ' + formatDate(endDate) + '</p>';
                    
                    if (data.tier === 'professional') {
                        summaryHtml += '<p><strong>Price per day:</strong> €' + parseFloat(data.price_per_day).toFixed(2) + '</p>';
                        summaryHtml += '<p class="total-price">Total: €' + parseFloat(data.total).toFixed(2) + '</p>';
                    } else {
                        summaryHtml += '<p class="total-price" style="color: #46b450;">Free Booking</p>';
                    }

                    bookingSummary.find('.summary-content').html(summaryHtml);
                    bookingSummary.show();
                    submitBookingBtn.show();
                } else {
                    availabilityMessage
                        .addClass('unavailable')
                        .html('<strong>✗ Not Available</strong><br>' + response.data.message)
                        .show();
                    
                    bookingSummary.hide();
                    submitBookingBtn.hide();
                }
            },
            error: function() {
                alert('An error occurred while checking availability. Please try again.');
            },
            complete: function() {
                checkAvailabilityBtn.prop('disabled', false).text('Check Availability');
            }
        });
    });

    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString(undefined, options);
    }

    bookingForm.on('submit', function(e) {
        if (!confirm('Are you sure you want to confirm this booking?')) {
            e.preventDefault();
            return false;
        }
    });
});
