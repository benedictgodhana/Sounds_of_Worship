<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Sounds of Worship</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B5CF6',
                        secondary: '#4F46E5',
                        accent: '#F59E0B',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .carousel-item {
            transition: opacity 0.6s ease-in-out;
        }

        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .sermon-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sermon-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .play-button {
            transition: transform 0.2s ease;
        }

        .play-button:hover {
            transform: scale(1.1);
        }

        .nav-link {
            position: relative;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: currentColor;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .custom-shadow {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 antialiased font-sans">
    <!-- Navigation -->
    @include ('layouts.navigation')

    <!-- Hero Carousel Section -->
    <section x-data="{ activeSlide: 0 }" class="relative text-white min-h-[90vh]">
        <!-- Carousel slides -->
        <div class="relative h-[90vh] overflow-hidden">
            <!-- Slide 1 -->
            <div
                class="carousel-item absolute inset-0 h-full w-full flex items-center justify-center"
                :class="{ 'opacity-100 z-10': activeSlide === 0, 'opacity-0 z-0': activeSlide !== 0 }"
                style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/DKN00648.jpg'); background-size: cover; background-position: center;"
            >
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">Experience Divine Worship</h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Join our global community in uplifting worship and spiritual growth</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="/live" class="bg-primary px-8 py-4 rounded-full font-semibold hover:bg-opacity-90 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            <i class="fas fa-broadcast-tower mr-2"></i>Join Live Stream
                        </a>
                        <a href="/events" class="border-2 border-white px-8 py-4 rounded-full hover:bg-white hover:text-gray-900 transition-all duration-300">
                            <i class="fas fa-calendar-alt mr-2"></i>Upcoming Events
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div
                class="carousel-item absolute inset-0 h-full w-full flex items-center justify-center"
                :class="{ 'opacity-100 z-10': activeSlide === 1, 'opacity-0 z-0': activeSlide !== 1 }"
                style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/Tuko Huru-122.jpg'); background-size: cover; background-position: center;"
            >
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">Worship Through Music</h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Explore our collection of original worship songs and live performances</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="/music" class="bg-accent px-8 py-4 rounded-full font-semibold hover:bg-opacity-90 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            <i class="fas fa-music mr-2"></i>Listen Now
                        </a>
                        <a href="/songs" class="border-2 border-white px-8 py-4 rounded-full hover:bg-white hover:text-gray-900 transition-all duration-300">
                            <i class="fas fa-book-open mr-2"></i>Songbook
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div
                class="carousel-item absolute inset-0 h-full w-full flex items-center justify-center"
                :class="{ 'opacity-100 z-10': activeSlide === 2, 'opacity-0 z-0': activeSlide !== 2 }"
                style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/0B8A7112-Enhanced-NR.jpg'); background-size: cover; background-position: center;"
            >
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">Join Our Community</h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Connect with believers worldwide and grow together in faith and worship</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="/connect" class="bg-secondary px-8 py-4 rounded-full font-semibold hover:bg-opacity-90 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            <i class="fas fa-users mr-2"></i>Connect Groups
                        </a>
                        <a href="/volunteer" class="border-2 border-white px-8 py-4 rounded-full hover:bg-white hover:text-gray-900 transition-all duration-300">
                            <i class="fas fa-hands-helping mr-2"></i>Get Involved
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel controls -->
        <div class="absolute inset-x-0 bottom-5 flex justify-center space-x-3 z-20">
            <button @click="activeSlide = 0" class="h-3 w-3 rounded-full" :class="{ 'bg-white': activeSlide === 0, 'bg-gray-400': activeSlide !== 0 }"></button>
            <button @click="activeSlide = 1" class="h-3 w-3 rounded-full" :class="{ 'bg-white': activeSlide === 1, 'bg-gray-400': activeSlide !== 1 }"></button>
            <button @click="activeSlide = 2" class="h-3 w-3 rounded-full" :class="{ 'bg-white': activeSlide === 2, 'bg-gray-400': activeSlide !== 2 }"></button>
        </div>

        <!-- Carousel arrow controls -->
        <button @click="activeSlide = activeSlide === 0 ? 2 : activeSlide - 1" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 rounded-full p-2 text-white z-20">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button @click="activeSlide = activeSlide === 2 ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 rounded-full p-2 text-white z-20">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
    </section>

    <!-- Quick Links -->
    <section class="py-8 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 -mt-16 relative z-20">
                <!-- Quick Link 1 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center transform hover:-translate-y-1 transition-transform">
                    <div class="bg-primary bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-church text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Services</h3>
                    <p class="text-gray-600 text-sm mb-3">Join us for worship</p>
                    <a href="#" class="text-primary hover:underline text-sm font-medium">View Times →</a>
                </div>

                <!-- Quick Link 2 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center transform hover:-translate-y-1 transition-transform">
                    <div class="bg-secondary bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-pray text-secondary text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Prayer</h3>
                    <p class="text-gray-600 text-sm mb-3">Request prayer support</p>
                    <a href="#" class="text-secondary hover:underline text-sm font-medium">Submit Request →</a>
                </div>

                <!-- Quick Link 3 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center transform hover:-translate-y-1 transition-transform">
                    <div class="bg-accent bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hand-holding-heart text-accent text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Give</h3>
                    <p class="text-gray-600 text-sm mb-3">Support our ministry</p>
                    <a href="#" class="text-accent hover:underline text-sm font-medium">Donate Now →</a>
                </div>

                <!-- Quick Link 4 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center transform hover:-translate-y-1 transition-transform">
                    <div class="bg-purple-800 bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headphones text-purple-800 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Listen</h3>
                    <p class="text-gray-600 text-sm mb-3">Latest sermons & music</p>
                    <a href="#" class="text-purple-800 hover:underline text-sm font-medium">Browse Library →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-primary font-medium">Join Us</span>
                    <h2 class="text-3xl font-bold text-gray-900">Upcoming Events</h2>
                </div>
                <a href="/events" class="text-primary hover:underline flex items-center">
                    View All Events <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                <div class="event-card bg-white">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a"
                             alt="Night of Worship" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-sm">Conference</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-gray-500"></i>
                            <span class="text-gray-600 text-sm">June 15, 2024</span>
                            <i class="far fa-clock text-gray-500 ml-2"></i>
                            <span class="text-gray-600 text-sm">7:00 PM</span>
                        </div>
                        <h3 class="font-bold text-xl mb-2">Global Worship Night</h3>
                        <p class="text-gray-600 mb-4">Join believers worldwide for 24 hours of non-stop worship and prayer</p>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-primary font-semibold hover:underline">Learn More →</a>
                            <span class="text-sm font-medium bg-purple-100 text-purple-800 px-3 py-1 rounded-full">Free</span>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="event-card bg-white">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18"
                             alt="Worship Workshop" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-accent text-white px-3 py-1 rounded-full text-sm">Workshop</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-gray-500"></i>
                            <span class="text-gray-600 text-sm">June 22, 2024</span>
                            <i class="far fa-clock text-gray-500 ml-2"></i>
                            <span class="text-gray-600 text-sm">10:00 AM</span>
                        </div>
                        <h3 class="font-bold text-xl mb-2">Worship Leaders Workshop</h3>
                        <p class="text-gray-600 mb-4">A hands-on workshop for worship leaders to refine skills and techniques</p>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-primary font-semibold hover:underline">Register Now →</a>
                            <span class="text-sm font-medium bg-green-100 text-green-800 px-3 py-1 rounded-full">$25</span>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="event-card bg-white">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745"
                             alt="Praise Concert" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-secondary text-white px-3 py-1 rounded-full text-sm">Concert</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-gray-500"></i>
                            <span class="text-gray-600 text-sm">July 5, 2024</span>
                            <i class="far fa-clock text-gray-500 ml-2"></i>
                            <span class="text-gray-600 text-sm">6:30 PM</span>
                        </div>
                        <h3 class="font-bold text-xl mb-2">Summer Praise Festival</h3>
                        <p class="text-gray-600 mb-4">A night of praise and worship featuring multiple worship teams</p>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-primary font-semibold hover:underline">Get Tickets →</a>
                            <span class="text-sm font-medium bg-blue-100 text-blue-800 px-3 py-1 rounded-full">$15</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Sermon -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="sermon-card p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="bg-white text-primary w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-bible text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm opacity-75">Featured Sermon</p>
                            <h3 class="text-2xl font-bold">The Power of Worship</h3>
                        </div>
                    </div>
                    <p class="mb-6 opacity-90 leading-relaxed">Discover how worship transforms lives and communities in this powerful message from Pastor John. Learn how worship can be a gateway to deeper spiritual experiences and community connection.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <button class="bg-white text-primary px-6 py-3 rounded-full font-semibold hover:bg-opacity-90 flex items-center gap-2 play-button">
                            <i class="fas fa-play"></i>Play Sermon
                        </button>
                        <button class="border border-white px-6 py-3 rounded-full hover:bg-white hover:text-purple-900 transition-colors duration-300">
                            <i class="fas fa-download mr-2"></i>Download Notes
                        </button>
                        <div class="text-sm opacity-75 mt-2 md:mt-0 md:ml-2">45:30 minutes</div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-white border-opacity-20 flex items-center gap-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" alt="Pastor John" class="w-12 h-12 rounded-full object-cover border-2 border-white">
                        <div>
                            <p class="font-medium">Pastor John Davis</p>
                            <p class="text-sm opacity-75">Lead Pastor</p>
                        </div>
                    </div>
                </div>

                <div class="text-center relative">
                    <img src="https://images.unsplash.com/photo-1584985429921-7b6b22e2a4d3"
                         alt="Worship Team" class="rounded-xl shadow-2xl mx-auto relative z-10">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-accent rounded-full opacity-20 blur-2xl"></div>
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary rounded-full opacity-20 blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Sermons -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-primary font-medium">Listen & Learn</span>
                    <h2 class="text-3xl font-bold text-gray-900">Recent Sermons</h2>
                </div>
                <a href="/sermons" class="text-primary hover:underline flex items-center">
                    View All Sermons <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Sermon Card 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform hover:-translate-y-2 transition-all duration-300 hover:shadow-lg">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1552664831-4b7b6d39a1a0"
                             alt="Sermon Thumbnail" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-center">
                            <span class="text-white text-sm bg-black bg-opacity-50 px-2 py-1 rounded">45:30</span>
                            <button class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg play-button">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold mb-2">Walking in Faith</h3>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <i class="far fa-user text-primary mr-2"></i>
                            Pastor Sarah Johnson
                        </p>
                        <p class="text-gray-500 text-sm mb-3 flex items-center">
                            <i class="far fa-calendar-alt text-gray-400 mr-2"></i>
                            March 24, 2024
                        </p>
                        <div class="flex items-center justify-between text-sm pt-3 border-t">
                            <a href="#" class="text-primary hover:underline">Watch Now</a>
                            <div class="flex items-center gap-3">
                                <button class="text-gray-500 hover:text-primary transition-colors">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-gray-500 hover:text-primary transition-colors">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sermon Card 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform hover:-translate-y-2 transition-all duration-300 hover:shadow-lg">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65"
                             alt="Sermon Thumbnail" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-center">
                            <span class="text-white text-sm bg-black bg-opacity-50 px-2 py-1 rounded">38:15</span>
                            <button class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg play-button">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold mb-2">The Heart of Worship</h3>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <i class="far fa-user text-primary mr-2"></i>
                            Pastor Michael Brown
                        </p>
                        <p class="text-gray-500 text-sm mb-3 flex items-center">
                            <i class="far fa-calendar-alt text-gray-400 mr-2"></i>
                            March 17, 2024
                        </p>
                        <div class="flex items-center justify-between text-sm pt-3 border-t">
                            <a href="#" class="text-primary hover:underline">Watch Now</a>
                            <div class="flex items-center gap-3">
                                <button class="text-gray-500 hover:text-primary transition-colors">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-gray-500 hover:text-primary transition-colors">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    @include ('layouts.footer')
</body>
</html>
