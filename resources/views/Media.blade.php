    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Media | Sounds of Worship</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <style>
            .media-card {
                transition: all 0.3s ease;
                border-radius: 12px;
                overflow: hidden;
                background: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            }

            .media-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            }

            .media-badge {
                position: absolute;
                top: 15px;
                left: 15px;
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                z-index: 2;
            }

            .play-button {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 50px;
                height: 50px;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .media-card:hover .play-button {
                opacity: 1;
            }

            .media-image {
                height: 200px;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .media-card:hover .media-image {
                transform: scale(1.05);
            }
        </style>
    </head>
    <body class="bg-gray-50 antialiased">
        @include ('layouts.navigation')

        <!-- Media Hero -->
        <section class="relative bg-gradient-to-r from-blue-900 to-purple-900 text-white py-24">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <img src=""
                    class="absolute inset-0 w-full h-full object-cover">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl text-center mx-auto">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Worship Media Library</h1>
                    <p class="text-xl opacity-90 mb-8">Stream sermons, worship sessions, and spiritual resources</p>
                    <div class="flex justify-center gap-4">
                        <a href="#videos" class="bg-primary px-6 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors">
                            <i class="fas fa-play-circle mr-2"></i>Watch Videos
                        </a>
                        <a href="#podcasts" class="bg-white text-gray-900 px-6 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors">
                            <i class="fas fa-podcast mr-2"></i>Listen to Podcasts
                        </a>
                    </div>
                </div>
            </div>
        </section>




        <!-- Media Categories -->
        <section class="py-16" id="media">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Latest Uploads</h2>
                    <div class="flex gap-4">
                        <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-primary hover:text-white">
                            Videos
                        </button>
                        <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-primary hover:text-white">
                            Podcasts
                        </button>
                        <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-primary hover:text-white">
                            Albums
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Video Card -->
                    <div class="media-card">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1557672172-298e090bd0f1"
                                alt="Sunday Worship Live" class="media-image w-full">
                            <span class="media-badge bg-red-500 text-white">Video</span>
                            <div class="play-button">
                                <i class="fas fa-play text-primary text-xl"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Sunday Worship Live</h3>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>March 24, 2024</span>
                                <span>45:30</span>
                            </div>
                        </div>
                    </div>

                    <!-- Podcast Card -->
                    <div class="media-card">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad"
                                alt="Spiritual Growth Podcast" class="media-image w-full">
                            <span class="media-badge bg-purple-600 text-white">Podcast</span>
                            <div class="play-button">
                                <i class="fas fa-headphones text-primary text-xl"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Spiritual Growth Series</h3>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Episode 12</span>
                                <span>32:15</span>
                            </div>
                        </div>
                    </div>

                    <!-- Album Card -->
                    <div class="media-card">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1458560871784-56d23406c091"
                                alt="Worship Hits 2024" class="media-image w-full">
                            <span class="media-badge bg-primary text-white">Album</span>
                            <div class="play-button">
                                <i class="fas fa-music text-primary text-xl"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Worship Hits 2024</h3>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>12 Tracks</span>
                                <span>Download</span>
                            </div>
                        </div>
                    </div>

                    <!-- Add more media cards -->
                </div>
            </div>
        </section>

        <!-- Featured Media -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="https://www.youtube.com/embed/example"
                                    class="w-full h-full rounded-xl"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold mb-4">Featured Worship Session</h2>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="bg-primary text-white px-4 py-2 rounded-full">
                                <i class="fas fa-calendar-day mr-2"></i>March 15, 2024
                            </div>
                            <div class="bg-gray-100 px-4 py-2 rounded-full">
                                <i class="fas fa-clock mr-2 text-primary"></i>45 Minutes
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">Experience our latest worship session featuring:</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                Live band performance
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                Special guest worship leader
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                Multi-camera production
                            </li>
                        </ul>
                        <button class="bg-primary text-white px-8 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                            Watch Full Video
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Get New Content Alerts</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Subscribe to receive notifications about new videos, podcasts, and worship resources</p>

                <div class="max-w-md mx-auto flex gap-4">
                    <input type="email" placeholder="Enter your email"
                        class="flex-1 px-4 py-3 rounded-full border focus:outline-none focus:ring-2 focus:ring-primary">
                    <button class="bg-primary text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                        Subscribe
                    </button>
                </div>
            </div>
        </section>

        @include ('layouts.footer')

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Media play functionality
                document.querySelectorAll('.media-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const mediaTitle = this.querySelector('h3').textContent;
                        // Add media play logic here
                        alert(`Playing: ${mediaTitle}`);
                    });
                });

                // Newsletter validation
                document.querySelector('button').addEventListener('click', function() {
                    const email = document.querySelector('input[type="email"]').value;
                    if (validateEmail(email)) {
                        alert('Thanks for subscribing!');
                    } else {
                        alert('Please enter a valid email address');
                    }
                });

                function validateEmail(email) {
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return re.test(email);
                }
            });
        </script>
    </body>
    </html>
