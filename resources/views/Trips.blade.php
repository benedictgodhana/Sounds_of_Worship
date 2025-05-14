<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GlobeStitch - Craft Your Perfect Travel Story</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.js" defer></script>
    <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- jQuery (Required for Toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Futura LT', sans-serif;
            background-color: #f9fafb;
            color: #333;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 50vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(5, 150, 105, 0.6), rgba(37, 99, 235, 0.6));
            z-index: 1;
        }
        .hero-content {
            max-width: 800px;
            padding: 2rem;
            z-index: 1;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .cta-button {
            background-color: green;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.2s;
            display: inline-block;
            font-weight: 600;
        }
        .cta-button:hover {
            background-color: #DC2626;
            transform: translateY(-2px);
        }

        /* Trip Container */
        .trip-container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 1rem;
        }
        .trip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        /* Trip Card Styles */
        .trip-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .trip-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        .trip-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .trip-card:hover img {
            transform: scale(1.1);
        }
        .trip-content {
            padding: 1.5rem;
        }
        .trip-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .trip-description {
            color: #6B7280;
            margin-bottom: 1rem;
        }
        .trip-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .trip-date {
            font-size: 1.1rem;
            font-weight: bold;
            color: green;
        }
        .trip-actions {
            display: flex;
            gap: 0.5rem;
        }
        .trip-action {
            background-color: green;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
            cursor: pointer;
            border: none;
        }
        .trip-action:hover {
            background-color: #DC2626;
        }
        .trip-inquiry {
            background-color: #4B5563;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
            cursor: pointer;
            border: none;
        }
        .trip-inquiry:hover {
            background-color: #374151;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
        }
        .modal {
            background-color: white;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #D1D5DB;
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-input:focus {
            outline: none;
            border-color: green;
            box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.2);
        }
        .form-submit {
            width: 100%;
            background-color: green;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .form-submit:hover {
            background-color: #DC2626;
        }
        .close-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6B7280;
        }
        .close-button:hover {
            color: #1F2937;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .trip-card img {
                height: 150px;
            }
            .trip-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body x-data="{
    bookingModal: false,
    inquiryModal: false,
    currentTripTitle: '',
    currentTripDate: '',
    currentTripId: '',
}">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Plan Your Next Adventure</h1>
            <p>Explore our curated list of upcoming trips and embark on unforgettable journeys around the world.</p>
            <a href="#trips" class="cta-button">View Upcoming Trips</a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="trip-container" id="trips">
        <h2 style="text-align: center; margin-bottom: 2rem;">Upcoming Trips</h2>
        <div class="trip-grid">
            @foreach ($trips as $trip)
                <div class="trip-card">
                    <img src="{{ asset('storage/' . $trip->image) }}" alt="{{ $trip->title }}">
                    <div class="trip-content">
                        <h3 class="trip-title">{{ $trip->title }}</h3>
                        <p class="trip-description">{{ $trip->description }}</p>
                        <div class="trip-footer">
                            <span class="trip-date">{{ \Carbon\Carbon::parse($trip->start_date)->format('F d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('d, Y') }}</span>
                            <div class="trip-actions">
                            <button
                class="trip-action"
                @click="
                    bookingModal = true;
                    currentTripTitle = '{{ $trip->title }}';
                    currentTripDate = '{{ \Carbon\Carbon::parse($trip->start_date)->format('F d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('d, Y') }}';
                    currentTripId = '{{ $trip->id }}';  <!-- Add this line -->
                "
            >
                Book Now
            </button>
            <button
                class="trip-inquiry"
                @click="
                    inquiryModal = true;
                    currentTripTitle = '{{ $trip->title }}';
                    currentTripDate = '{{ \Carbon\Carbon::parse($trip->start_date)->format('F d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('d, Y') }}';
                    currentTripId = '{{ $trip->id }}';  <!-- Add this line -->
                "
            >
                Inquire
            </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

 <!-- Booking Modal -->
<div class="modal-overlay" x-show="bookingModal" x-transition @click.self="bookingModal = false" style="display: none;">
    <div class="modal">
        <button class="close-button" @click="bookingModal = false">&times;</button>
        <h3 class="modal-title">Book Trip: <span x-text="currentTripTitle"></span></h3>
        <p class="text-center" style="margin-top: -1rem; margin-bottom: 1.5rem; color: #6B7280;" x-text="currentTripDate"></p>
        <form action="{{ route('trip.book') }}" method="POST">
    @csrf
    <input type="hidden" name="trip_id" x-model="currentTripId">
    <div class="form-group">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" id="full_name" name="full_name" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" id="email" name="email" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" id="phone" name="phone" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="number_of_travelers" class="form-label">Number of Travelers</label>
        <input type="number" id="number_of_travelers" name="number_of_travelers" min="1" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="special_requests" class="form-label">Special Requests (Optional)</label>
        <textarea id="special_requests" name="special_requests" class="form-input" rows="3"></textarea>
    </div>

    <button type="submit" class="form-submit">Complete Booking</button>
</form>

    </div>
</div>

<!-- Inquiry Modal -->
<div class="modal-overlay" x-show="inquiryModal" x-transition @click.self="inquiryModal = false" style="display: none;">
    <div class="modal">
        <button class="close-button" @click="inquiryModal = false">&times;</button>
        <h3 class="modal-title">Inquiry for: <span x-text="currentTripTitle"></span></h3>
        <p class="text-center" style="margin-top: -1rem; margin-bottom: 1.5rem; color: #6B7280;" x-text="currentTripDate"></p>
        <form action="{{ route('trip.inquire') }}" method="POST">
            @csrf

            <input type="hidden" name="trip_id" x-model="currentTripId">

            <div class="form-group">
                <label for="inquiry_name" class="form-label">Full Name</label>
                <input type="text" id="inquiry_name" name="name" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="inquiry_email" class="form-label">Email Address</label>
                <input type="email" id="inquiry_email" name="email" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="inquiry_email" class="form-label">Phone</label>
                <input type="number" id="inquiry_phone" name="phone" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="inquiry_message" class="form-label">Your Questions</label>
                <textarea id="inquiry_message" name="message" class="form-input" rows="4" required></textarea>
            </div>

            <button type="submit" class="form-submit">Send Inquiry</button>
        </form>
    </div>
</div>

    <!-- Footer -->
    @include('layouts.footer')
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    });
</script>

</html>
