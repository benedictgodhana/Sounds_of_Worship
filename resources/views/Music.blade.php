<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music | Sounds of Worship</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        @font-face {
          font-family: 'Futura LT';
          src: url('/fonts/futura-lt/FuturaLT-Book.ttf') format('woff2'),
               url('/fonts/futura-lt/FuturaLT.ttf') format('woff'),
               url('/fonts/futura-lt/FuturaLT-Condensed.ttf') format('truetype');
          font-weight: normal;
          font-style: normal;
        }

        .nav-bg {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .text-primary { color: #FF6B35; }
        .bg-primary { background: linear-gradient(135deg, #FF6B35, #FF4500); }

        .album-card {
            transition: all 0.4s ease;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .album-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .video-thumbnail {
            transition: transform 0.3s ease;
        }

        .video-thumbnail:hover {
            transform: scale(1.05);
        }

        .audio-player {
            background: #f8f9fa;
            border-radius: 10px;
        }

        .audio-progress {
            height: 4px;
            border-radius: 2px;
        }

        .player-button {
            transition: all 0.2s ease;
        }

        .player-button:hover {
            transform: scale(1.1);
        }

        .spotify-gradient {
            background: linear-gradient(135deg, #1DB954, #1AA34A);
        }

        .active-tab {
            color: #FF6B35;
            border-bottom: 2px solid #FF6B35;
        }

        /* Add to your existing styles */
.spotify-embed {
    border-radius: 12px;
    overflow: hidden;
}

/* Responsive tweaks */
@media (max-width: 768px) {
    #audio-player .flex.items-center {
        flex-direction: column;
        align-items: flex-start;
    }

    #audio-player .flex-1 {
        width: 100%;
    }
}
    </style>
</head>
<body class="bg-gray-50 Futura LT antialiased">
   @include ('layouts.navigation')
    <!-- Spacer for fixed navigation -->

    <!-- Hero Section with Embedded Video -->
    <section class="relative bg-gradient-to-r from-blue-900 to-purple-900 text-white py-24">
    <div class="absolute inset-0 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('/images/Tuko Huru-122.jpg');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
</div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Music</h1>
                    <p class="text-xl opacity-90 mb-8">Experience worship through our curated collection of uplifting songs, videos, and albums.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#latest-releases" class="bg-primary px-6 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors flex items-center">
                            <i class="fas fa-play mr-2"></i> Latest Releases
                        </a>
                        <a href="#spotify-section" class="spotify-gradient px-6 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors flex items-center">
                            <i class="fab fa-spotify mr-2"></i> Connect with Spotify
                        </a>
                    </div>
                </div>
                <div x-data="{ currentVideo: 0, videos: [
        { id: 'ASLYSSJikwo', title: 'Niko Huru - Sounds of Worship' },
        { id: 'Co-ramkl2vg', title: 'Another Worship Song' },
        { id: 'kUD2ftkfkXw', title: 'Glory Revealed' },
        { id: 'sF_hdF0CN_c', title: ' DHABIHU' },
        { id: '0INobltYS_0', title: 'UKO NAMI' },
        { id: 'B1Hf-F8vrmk', title: 'CHANZO' },
        { id: 'JwMc2FONO5E', title: 'LOVE YOUR NAME' },
        { id: 'nreTaCIqrOM', title: 'JEHOVAH' },


    ] }" class="relative w-full max-w-2xl mx-auto">

    <!-- Video Display -->
    <div class="rounded-2xl overflow-hidden shadow-2xl relative bg-gray-900">
        <div class="relative rounded-2xl overflow-hidden" style="padding-bottom: 56.25%; height: 0;">
            <iframe class="absolute top-0 left-0 w-full h-full rounded-2xl"
                :src="'https://www.youtube.com/embed/' + videos[currentVideo].id + '?autoplay=1&loop=1&playlist=' + videos[currentVideo].id + '&mute=0'"
                :title="videos[currentVideo].title"
                frameborder="0"
                allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black via-black/70 to-transparent p-4 rounded-b-2xl">
            <p class="text-white font-semibold text-lg" x-text="'🎵 Featured: ' + videos[currentVideo].title"></p>
        </div>
    </div>

    <!-- Carousel Controls -->
    <div class="flex justify-between mt-4">
        <button @click="currentVideo = (currentVideo === 0) ? videos.length - 1 : currentVideo - 1"
            class="px-4 py-2 bg-gray-800 text-white rounded-lg">
            ⬅️ Previous
        </button>

        <button @click="currentVideo = (currentVideo + 1) % videos.length"
            class="px-4 py-2 bg-gray-800 text-white rounded-lg">
            Next ➡️
        </button>
    </div>
</div>



        </div>
    </section>

    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50" id="audio-player">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center">
            <div class="w-12 h-12 mr-4">
                <img id="current-track-cover" src="/path/to/default-album-cover.jpg" alt="Now Playing" class="w-full h-full object-cover rounded">
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center mb-1">
                    <div>
                        <h4 class="font-medium" id="current-track-title">Select a track</h4>
                        <p class="text-sm text-gray-500" id="current-track-artist">-</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button id="prev-track" class="player-button">
                            <i class="fas fa-step-backward text-gray-600"></i>
                        </button>
                        <button id="play-pause" class="player-button w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-play text-white" id="play-icon"></i>
                        </button>
                        <button id="next-track" class="player-button">
                            <i class="fas fa-step-forward text-gray-600"></i>
                        </button>
                        <div class="text-sm text-gray-500 ml-4">
                            <span id="current-time">0:00</span> /
                            <span id="total-duration">0:00</span>
                        </div>
                    </div>
                </div>
                <div class="audio-progress bg-gray-200 w-full">
                    <div class="bg-primary h-full" id="progress-bar" style="width: 0%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Music Categories Tabs -->
    <section class="py-10 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex overflow-x-auto whitespace-nowrap py-2 gap-8">
                <button class="tab-button active-tab px-4 py-2 font-medium text-lg" data-tab="all">
                    All Music
                </button>
                <button class="tab-button px-4 py-2 font-medium text-lg" data-tab="videos">
                    Music Videos
                </button>
                <button class="tab-button px-4 py-2 font-medium text-lg" data-tab="albums">
                    Albums
                </button>
                <button class="tab-button px-4 py-2 font-medium text-lg" data-tab="singles">
                    Singles
                </button>
                <button class="tab-button px-4 py-2 font-medium text-lg" data-tab="playlists">
                    Playlists
                </button>
            </div>
        </div>
    </section>

    <!-- Music Videos Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Music Videos</h2>
                <a href="#" class="text-primary flex items-center font-medium hover:underline">
                    View All <i class="fas fa-chevron-right ml-2 text-sm"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Video 1 -->
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <div class="video-thumbnail relative">
                        <img src="/api/placeholder/600/340" alt="Worship Video" class="w-full">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-30 transition-opacity">
                            <button class="bg-primary w-14 h-14 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-xl"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 px-2 py-1 rounded text-white text-sm">
                            4:35
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Amazing Grace (My Chains Are Gone)</h3>
                        <p class="text-gray-500 text-sm">Official Music Video • 12K views</p>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <div class="video-thumbnail relative">
                        <img src="/api/placeholder/600/340" alt="Worship Video" class="w-full">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-30 transition-opacity">
                            <button class="bg-primary w-14 h-14 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-xl"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 px-2 py-1 rounded text-white text-sm">
                            3:58
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Holy Ground</h3>
                        <p class="text-gray-500 text-sm">Live Worship Session • 8.5K views</p>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <div class="video-thumbnail relative">
                        <img src="/api/placeholder/600/340" alt="Worship Video" class="w-full">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-30 transition-opacity">
                            <button class="bg-primary w-14 h-14 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-xl"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 px-2 py-1 rounded text-white text-sm">
                            5:12
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Faithful One</h3>
                        <p class="text-gray-500 text-sm">Acoustic Performance • 6.2K views</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="latest-releases" class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Latest YouTube Releases</h2>
            <a href="https://www.youtube.com/channel/UCFErN1GpPGNAsK0jKxrLhQw" target="_blank"
                class="text-primary flex items-center font-medium hover:underline">
                View All <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </a>
        </div>

        <!-- Videos Grid -->
        <div id="youtube-videos" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Sample YouTube Video Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="relative">
                    <iframe class="w-full h-56 rounded-t-2xl"
                        src="https://www.youtube.com/embed/VIDEO_ID_1"
                        title="Song Title 1"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900">Song Title 1</h3>
                    <p class="text-sm text-gray-500">Artist Name</p>
                    <!-- Share Buttons -->
                    <div class="mt-3 flex space-x-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.youtube.com/watch?v=VIDEO_ID_1"
                           target="_blank" class="text-blue-600 hover:text-blue-800">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=https://www.youtube.com/watch?v=VIDEO_ID_1"
                           target="_blank" class="text-blue-400 hover:text-blue-600">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=Check%20out%20this%20song:%20https://www.youtube.com/watch?v=VIDEO_ID_1"
                           target="_blank" class="text-green-500 hover:text-green-700">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Repeat for Additional Videos -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="relative">
                    <iframe class="w-full h-56 rounded-t-2xl"
                        src="https://www.youtube.com/embed/VIDEO_ID_2"
                        title="Song Title 2"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900">Song Title 2</h3>
                    <p class="text-sm text-gray-500">Artist Name</p>
                    <!-- Share Buttons -->
                    <div class="mt-3 flex space-x-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.youtube.com/watch?v=VIDEO_ID_2"
                           target="_blank" class="text-blue-600 hover:text-blue-800">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=https://www.youtube.com/watch?v=VIDEO_ID_2"
                           target="_blank" class="text-blue-400 hover:text-blue-600">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=Check%20out%20this%20song:%20https://www.youtube.com/watch?v=VIDEO_ID_2"
                           target="_blank" class="text-green-500 hover:text-green-700">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Add more videos in similar fashion -->
        </div>
    </div>
</section>

<!-- FontAwesome for social media icons -->

<!-- Update the Spotify section with this -->
<section id="spotify-section" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl overflow-hidden shadow-lg p-6">
            <h2 class="text-3xl font-bold mb-6">Listen on Spotify</h2>
            <div class="spotify-embed">
                <iframe style="border-radius:12px"
                        src="https://open.spotify.com/embed/artist/57oO4AfCn29k5W92MchRDp?utm_source=generator"
                        width="100%"
                        height="352"
                        frameborder="0"
                        allowfullscreen=""
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

    <!-- Popular Tracks Section with Interactive Player -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-10">Popular Tracks</h2>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="space-y-0 divide-y divide-gray-100">
                    <!-- Track 1 -->
                    <div class="track-item p-4 flex items-center hover:bg-gray-50 group cursor-pointer">
                        <div class="w-10 text-center text-gray-500 group-hover:hidden">1</div>
                        <div class="w-10 text-center text-primary hidden group-hover:block">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="w-12 h-12 mx-4">
                            <img src="/api/placeholder/100/100" alt="Track" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium">Amazing Grace (My Chains Are Gone)</h3>
                            <p class="text-sm text-gray-500">Glory Revealed • 2024</p>
                        </div>
                        <div class="text-sm text-gray-500 mr-4">4:35</div>
                        <div class="flex items-center gap-3">
                            <button class="p-2 text-gray-600 hover:text-primary">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="#" class="p-2 text-gray-600 hover:text-green-500">
                                <i class="fab fa-spotify"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Track 2 -->
                    <div class="track-item p-4 flex items-center hover:bg-gray-50 group cursor-pointer">
                        <div class="w-10 text-center text-gray-500 group-hover:hidden">2</div>
                        <div class="w-10 text-center text-primary hidden group-hover:block">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="w-12 h-12 mx-4">
                            <img src="/api/placeholder/100/100" alt="Track" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium">Holy Ground</h3>
                            <p class="text-sm text-gray-500">Single • 2024</p>
                        </div>
                        <div class="text-sm text-gray-500 mr-4">4:32</div>
                        <div class="flex items-center gap-3">
                            <button class="p-2 text-gray-600 hover:text-primary">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="#" class="p-2 text-gray-600 hover:text-green-500">
                                <i class="fab fa-spotify"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Track 3 -->
                    <div class="track-item p-4 flex items-center hover:bg-gray-50 group cursor-pointer">
                        <div class="w-10 text-center text-gray-500 group-hover:hidden">3</div>
                        <div class="w-10 text-center text-primary hidden group-hover:block">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="w-12 h-12 mx-4">
                            <img src="/api/placeholder/100/100" alt="Track" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium">Faithful One</h3>
                            <p class="text-sm text-gray-500">Sacred Harmony • 2023</p>
                        </div>
                        <div class="text-sm text-gray-500 mr-4">3:58</div>
                        <div class="flex items-center gap-3">
                            <button class="p-2 text-gray-600 hover:text-primary">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="#" class="p-2 text-gray-600 hover:text-green-500">
                                <i class="fab fa-spotify"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Track 4 -->
                    <div class="track-item p-4 flex items-center hover:bg-gray-50 group cursor-pointer">
                        <div class="w-10 text-center text-gray-500 group-hover:hidden">4</div>
                        <div class="w-10 text-center text-primary hidden group-hover:block">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="w-12 h-12 mx-4">
                            <img src="/api/placeholder/100/100" alt="Track" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium">Spirit & Truth</h3>
                            <p class="text-sm text-gray-500">Spirit & Truth • 2023</p>
                        </div>
                        <div class="text-sm text-gray-500 mr-4">4:17</div>
                        <div class="flex items-center gap-3">
                            <button class="p-2 text-gray-600 hover:text-primary">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="#" class="p-2 text-gray-600 hover:text-green-500">
                                <i class="fab fa-spotify"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Track 5 -->
                    <div class="track-item p-4 flex items-center hover:bg-gray-50 group cursor-pointer">
                        <div class="w-10 text-center text-gray-500 group-hover:hidden">5</div>
                        <div class="w-10 text-center text-primary hidden group-hover:block">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="w-12 h-12 mx-4">
                            <img src="/api/placeholder/100/100" alt="Track" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium">Holy Surrender</h3>
                            <p class="text-sm text-gray-500">Holy Surrender • 2022</p>
                        </div>
                        <div class="text-sm text-gray-500 mr-4">5:24
                        </div>
                        <div class="flex items
                        -center gap-3">
                            <button class="p-2 text-gray-600 hover:text-primary">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="#" class="p-2 text-gray-600 hover:text-green-500">
                                <i class="fab fa-spotify"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-primary text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold mb-4">Experience Worship Like Never Before</h2>
                <p class="text-lg opacity-90 mb-8">Join our community and get access to exclusive content, events, and more.</p>
                <a href="#" class="bg-white text-primary px-6 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors">
                    Join Now
                </a>
            </div>
        </div>

    </section>
    @include ('layouts.footer')



<script>
document.addEventListener('DOMContentLoaded', function() {
    const audio = new Audio();
    let currentTrackIndex = 0;

    // Sample track list - replace with your actual tracks
    const tracks = [
        {
            title: "Amazing Grace",
            artist: "Glory Revealed",
            cover: "/path/to/cover1.jpg",
            file: "/path/to/song1.mp3",
            duration: "4:35"
        },
        {
            title: "Holy Ground",
            artist: "Live Worship Session",
            cover: "/path/to/cover2.jpg",
            file: "/path/to/song2.mp3",
            duration: "3:58"
        }
    ];

    // Player controls
    const playPauseBtn = document.getElementById('play-pause');
    const progressBar = document.getElementById('progress-bar');
    const currentTimeElem = document.getElementById('current-time');
    const totalDurationElem = document.getElementById('total-duration');
    const currentTrackTitle = document.getElementById('current-track-title');
    const currentTrackArtist = document.getElementById('current-track-artist');
    const currentTrackCover = document.getElementById('current-track-cover');

    function updateTrackInfo(track) {
        currentTrackTitle.textContent = track.title;
        currentTrackArtist.textContent = track.artist;
        currentTrackCover.src = track.cover;
        totalDurationElem.textContent = track.duration;
    }

    function updateProgress() {
        const progress = (audio.currentTime / audio.duration) * 100;
        progressBar.style.width = `${progress}%`;
        currentTimeElem.textContent = formatTime(audio.currentTime);
    }

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        seconds = Math.floor(seconds % 60);
        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }

    audio.addEventListener('timeupdate', updateProgress);

    playPauseBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            document.getElementById('play-icon').classList.replace('fa-play', 'fa-pause');
        } else {
            audio.pause();
            document.getElementById('play-icon').classList.replace('fa-pause', 'fa-play');
        }
    });

    // Track click handlers for popular tracks
    document.querySelectorAll('.track-item').forEach((track, index) => {
        track.addEventListener('click', () => {
            currentTrackIndex = index;
            audio.src = tracks[index].file;
            updateTrackInfo(tracks[index]);
            audio.play();
            document.getElementById('play-icon').classList.replace('fa-play', 'fa-pause');
        });
    });

    // Next/previous track controls
    document.getElementById('next-track').addEventListener('click', () => {
        currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
        audio.src = tracks[currentTrackIndex].file;
        updateTrackInfo(tracks[currentTrackIndex]);
        audio.play();
    });

    document.getElementById('prev-track').addEventListener('click', () => {
        currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
        audio.src = tracks[currentTrackIndex].file;
        updateTrackInfo(tracks[currentTrackIndex]);
        audio.play();
    });

    // Initialize first track
    updateTrackInfo(tracks[0]);

    audio.src = tracks[0].file;
});
</script>
<script>
    const API_KEY = "{{$apiKey}}";  // Replace with your YouTube API Key
const CHANNEL_ID = "{{$channelId}}";  // Your YouTube Channel ID
const YOUTUBE_API_URL = `https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet,id&order=date&maxResults=4`;

async function fetchYouTubeVideos() {
    try {
        const response = await fetch(YOUTUBE_API_URL);
        const data = await response.json();
        const videos = data.items;

        let videoHtml = "";

        videos.forEach(video => {
            const videoId = video.id.videoId;
const title = video.snippet.title;
const thumbnail = video.snippet.thumbnails.high.url;
const description = video.snippet.description;
const publishedAt = video.snippet.publishedAt;
const videoUrl = `https://www.youtube.com/watch?v=${videoId}`;
videoHtml += `
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
    <div class="relative overflow-hidden rounded-t-2xl" style="padding-bottom: 56.25%;">
      <iframe class="absolute top-0 left-0 w-full h-full"
        src="https://www.youtube.com/embed/${videoId}"
        frameborder="0" allowfullscreen>
      </iframe>
      <div class="absolute top-3 right-3 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
        NEW
      </div>
    </div>
    <div class="p-6">
      <h3 class="font-bold text-xl text-gray-900 line-clamp-2 hover:text-primary transition duration-200">${title}</h3>

      <!-- Published Date -->
      <div class="mt-2 text-sm text-gray-500 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Published: ${new Date(publishedAt).toLocaleDateString()}
      </div>

      <!-- Description -->
      <p class="mt-3 text-sm text-gray-600 line-clamp-3">${description}</p>

      <div class="mt-2 text-sm text-gray-600 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Watch the latest release now!
      </div>

      <!-- Divider -->
      <div class="my-4 border-t border-gray-100"></div>

      <!-- Share Buttons -->
      <div class="flex justify-between items-center">
        <div class="flex space-x-4">
          <a href="https://www.facebook.com/sharer/sharer.php?u=${videoUrl}"
            target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-200 transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
            </svg>
          </a>
          <a href="https://twitter.com/intent/tweet?url=${videoUrl}"
            target="_blank" class="text-blue-400 hover:text-blue-600 transition duration-200 transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
          </a>
          <a href="https://api.whatsapp.com/send?text=Check%20out%20this%20video:%20${videoUrl}"
            target="_blank" class="text-green-500 hover:text-green-700 transition duration-200 transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
          </a>
        </div>

        <!-- Watch on YouTube Link -->
        <a href="${videoUrl}" target="_blank"
          class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-full hover:bg-red-700 transition duration-200 shadow-md hover:shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
          </svg>
          YouTube
        </a>
      </div>
    </div>
  </div>
`;

        });

        document.getElementById("youtube-videos").innerHTML = videoHtml;
    } catch (error) {
        console.error("Error fetching YouTube videos:", error);
    }
}

// Load YouTube videos on page load
fetchYouTubeVideos();

</script>

</body>
</html>
