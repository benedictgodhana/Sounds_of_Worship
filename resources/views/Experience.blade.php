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
    <style>
        :root {
            --primary-color: green; /* Coral accent */
            --secondary-color: #3B82F6; /* Blue accent */
            --text-color: #1F2937; /* Dark gray */
            --light-gray: #F3F4F6; /* Light gray */
            --transition: all 0.3s ease;
        }

        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: var(--text-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Header Section */
        .experience-header {
            position: relative;
            text-align: center;
            padding: 8rem 1rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/3d-tropical-palm-tree-island.jpg') center/cover no-repeat;
            color: white;
            overflow: hidden;
        }

        .experience-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(5, 150, 105, 0.6), rgba(37, 99, 235, 0.6));
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-title {
            font-size: 3.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header-subtitle {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* Experience Grid */
        .experience-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        /* Experience Card */
        .experience-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            position: relative;
        }

        .experience-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .experience-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: var(--transition);
        }

        .experience-card:hover img {
            transform: scale(1.05);
        }

        .experience-content {
            padding: 2rem;
        }

        .experience-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 2;
        }

        .experience-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-color);
            line-height: 1.3;
        }

        .experience-description {
            color: #6B7280;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .experience-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--light-gray);
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .explore-more {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            gap: 0.5rem;
        }

        .explore-more:hover {
            color: var(--secondary-color);
            gap: 0.75rem;
        }

        .experience-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #6B7280;
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Upcoming Trips Section */
        .upcoming-trips {
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .upcoming-trips h2 {
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .upcoming-trips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

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
            color:green;
        }
        .trip-action {
            background-color:green;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
        }
        .trip-action:hover {
            background-color: #DC2626;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-title {
                font-size: 2.5rem;
            }

            .experience-grid,
            .upcoming-trips-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }

            .experience-title,
            .trip-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <header class="experience-header">
        <div class="header-content">
            <h1 class="header-title">GlobeStitch Experiences</h1>
            <p class="header-subtitle">Discover unforgettable travel experiences curated just for you. Explore the world with GlobeStitch.</p>
        </div>
    </header>

    <section>
        <div class="experience-grid">
            <!-- Retreats -->
            @foreach($experiences as $experience)
    <article class="experience-card">
        <span class="experience-category">{{ $experience->category }}</span>
        <img src="{{ asset('storage/' . $experience->image) }}" alt="{{ $experience->category }}">
        <div class="experience-content">
            <h3 class="experience-title">{{ $experience->title }}</h3>
            <p class="experience-description">{{ Str::limit($experience->description, 50) }}</p>
            <div class="experience-footer">
                <a href="{{ route('experience.show', $experience->id) }}" class="explore-more">
                    Discover More
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <div class="experience-meta">
                    <span class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        {{ \Carbon\Carbon::parse($experience->date)->format('F Y') }}
                    </span>
                </div>
            </div>
        </div>
    </article>
@endforeach




            <!-- Nightlife Experiences -->

        </div>
    </section>

    <!-- Upcoming Trips Section -->
    <section class="upcoming-trips">
        <h2>Upcoming Trips</h2>
        <div class="upcoming-trips-grid">
            <!-- Trip 1 -->

            <!-- Trip 2 -->
            @foreach ($trips as $trip)
            <div class="trip-card">
                <img src="{{ asset('storage/' . $trip->image) }}" alt="{{ $trip->title }}">
                <div class="trip-content">
                    <h3 class="trip-title">{{ $trip->title }}</h3>
                    <p class="trip-description">{{ $trip->description }}</p>
                    <div class="trip-footer">
                        <span class="trip-date">{{ \Carbon\Carbon::parse($trip->start_date)->format('F d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('d, Y') }}</span>
                        <a href="#" class="trip-action">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach

            <!-- Trip 3 -->


            <!-- Trip 4 -->

            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="#" class="explore-more">
                View All Upcoming Experiences
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>

    @include('layouts.footer')
</body>
</html>
