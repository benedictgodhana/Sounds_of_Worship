<!DOCTYPE html>
<html>
<head>
    <title>Globestitch Booking Update</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Afacad', system-ui, sans-serif;
        margin: 0;
        padding: 0;
        background: #f3f4f6;
        color: #1f2937;
        line-height: 1.6;
    }

    .container {
        max-width: 640px;
        margin: 2rem auto;
        background: white;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .header {
        padding: 2.5rem 1.5rem;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        text-align: center;
        position: relative;
    }

    .header::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 24px;
        background: linear-gradient(to bottom right, transparent 49%, white 50%);
    }

    .logo {
        width: 160px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    .header h2 {
        color: white;
        font-size: 2rem;
        margin: 1rem 0 0.5rem;
        letter-spacing: -0.025em;
        font-weight: 700;
    }

    .header p {
        color: #d1fae5;
        font-size: 1.125rem;
        margin: 0;
    }

    .content {
        padding: 2rem;
    }

    h2 {
        color: #065f46;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        position: relative;
        padding-left: 1.5rem;
    }

    h2::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
    }

    .booking-card {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .booking-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .booking-details {
        padding: 1.5rem;
        background: #f9fafb;
    }

    .booking-title {
        color: #065f46;
        margin: 0 0 0.5rem;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .booking-date {
        color: #4b5563;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        text-decoration: none;
        border-radius: 2rem;
        font-weight: 600;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px -1px rgba(16, 185, 129, 0.3);
    }

    .section-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 2rem 0;
        border: 0;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        padding: 1.5rem;
        background: #f9fafb;
    }

    .social-icons a {
        color: #4b5563;
        font-size: 1.5rem;
        transition: all 0.2s ease;
    }

    .social-icons a:hover {
        color: #059669;
        transform: translateY(-2px);
    }

    .footer {
        padding: 1.5rem;
        text-align: center;
        background: #f9fafb;
        color: #4b5563;
        font-size: 0.875rem;
    }

    .footer a {
        color: #059669;
        text-decoration: none;
        font-weight: 500;
    }

    @media (max-width: 640px) {
        .container {
            margin: 1rem;
            border-radius: 1rem;
        }

        .header {
            padding: 1.5rem;
        }

        .header h2 {
            font-size: 1.75rem;
        }
    }
</style></head>
<body class="FuturaLT">
    <div class="container">
        <!-- Header with Logo -->
        <div class="header">
            <img src="{{ $message->embed(public_path('/images/logo.png')) }}" alt="Globestitch Logo" class="logo">
            <h2>GLOBESTITCH</h2>
            <p>Your booking status update.</p>
        </div>

        <!-- Content Section -->
        <div class="content">
            <h2>Booking Update</h2>

            <p>Dear {{ $name }},</p>
            <p>We wanted to inform you that your booking status has been updated. Here are the details:</p>

            <div class="booking-card">
                <div class="booking-details">
                    <h3 class="booking-title">Booking for: {{ $booking->trip->title }}</h3>
                    <p><strong>Booking Phone:</strong> {{ $booking->phone }}</p>
                    <p><strong>Number of Travelers:</strong> {{ $booking->number_of_travelers }}</p>
                    <p><strong>Special Requests:</strong> {{ $booking->special_requests }}</p>
                    <p class="booking-date"><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y') }}</p>
                    <p><strong>Status:</strong> {{ $booking->status }}</p>
                    <p><strong>Reply:</strong>
                    @if($reply)
        {{ $reply }}
    @endif</p>
                </div>
            </div>

           
            <hr class="section-divider">

            <h2>Important Travel Tips</h2>
            <p>To help you prepare for your upcoming trip, here are some essential tips:</p>
            <ul style="padding-left: 20px; color: #444;">
                <li>Check your travel documents for validity</li>
                <li>Make sure your bags comply with airline regulations</li>
                <li>Stay hydrated during your travels</li>
                <li>Research your destination for any special requirements</li>
            </ul>
        </div>

        <!-- Social Media Icons with FontAwesome -->
        <div class="social-icons">
            <p style="margin-bottom: 15px; color: #555;">Connect with Us</p>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing Globestitch for your travel arrangements!</p>
            <p>© 2025 Globestitch. All rights reserved.</p>
            <p><a href="#">Unsubscribe</a> | <a href="#">Privacy Policy</a></p>
        </div>
    </div>
</body>
</html>
