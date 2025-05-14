<x-app-layout>
 <div class="flex h-screen bg-gray-100">
  <!-- Sidebar content would be here in your existing layout -->

  <!-- Main Content -->
  <main class="flex-1 p-6" x-data="{
    songPlaying: false,
    currentSong: 'Amazing Grace',
    activeTab: 'dashboard'
  }">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold text-orange-600">Sounds of Worship</h1>
      <div class="flex items-center space-x-4">
        <button @click="activeTab = 'dashboard'" class="px-3 py-2 rounded-md transition-colors" :class="activeTab === 'dashboard' ? 'bg-orange-600 text-white' : 'text-gray-600 hover:bg-gray-200'">
          Dashboard
        </button>
        <button @click="activeTab = 'events'" class="px-3 py-2 rounded-md transition-colors" :class="activeTab === 'events' ? 'bg-orange-600 text-white' : 'text-gray-600 hover:bg-gray-200'">
          Events
        </button>
        <button @click="activeTab = 'members'" class="px-3 py-2 rounded-md transition-colors" :class="activeTab === 'members' ? 'bg-orange-600 text-white' : 'text-gray-600 hover:bg-gray-200'">
          Members
        </button>
        <button @click="activeTab = 'merch'" class="px-3 py-2 rounded-md transition-colors" :class="activeTab === 'merch' ? 'bg-orange-600 text-white' : 'text-gray-600 hover:bg-gray-200'">
          Merchandise
        </button>
      </div>
    </div>

    <!-- Stats Cards with Glass Effect -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
      <!-- Total Songs Card -->
      <div class="relative bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg p-4 rounded-lg shadow-lg border border-white border-opacity-20 overflow-hidden group hover:bg-opacity-30 transition duration-300">
        <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-orange-500 bg-opacity-20 flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
          </svg>
        </div>
        <div class="flex flex-col z-10 relative">
          <p class="text-gray-600 text-sm font-medium mb-1">Total Songs</p>
          <p class="text-3xl font-bold text-orange-600">150</p>
          <div class="mt-2 h-1 w-full bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-orange-600 rounded-full w-3/4"></div>
          </div>
          <p class="text-xs text-gray-500 mt-1">+5 new songs this month</p>
        </div>
      </div>

      <!-- Albums Card -->
      <div class="relative bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg p-4 rounded-lg shadow-lg border border-white border-opacity-20 overflow-hidden group hover:bg-opacity-30 transition duration-300">
        <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-orange-500 bg-opacity-20 flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
          </svg>
        </div>
        <div class="flex flex-col z-10 relative">
          <p class="text-gray-600 text-sm font-medium mb-1">Albums</p>
          <p class="text-3xl font-bold text-orange-600">10</p>
          <div class="mt-2 flex h-6 space-x-1">
            <div class="w-1 h-2 bg-orange-600 rounded-full self-end"></div>
            <div class="w-1 h-3 bg-orange-600 rounded-full self-end"></div>
            <div class="w-1 h-6 bg-orange-600 rounded-full self-end"></div>
            <div class="w-1 h-4 bg-orange-600 rounded-full self-end"></div>
            <div class="w-1 h-5 bg-orange-600 rounded-full self-end"></div>
          </div>
          <p class="text-xs text-gray-500 mt-1">New album coming soon</p>
        </div>
      </div>

      <!-- Listeners Card -->
      <div class="relative bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg p-4 rounded-lg shadow-lg border border-white border-opacity-20 overflow-hidden group hover:bg-opacity-30 transition duration-300">
        <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-orange-500 bg-opacity-20 flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
        <div class="flex flex-col z-10 relative">
          <p class="text-gray-600 text-sm font-medium mb-1">Listeners</p>
          <p class="text-3xl font-bold text-orange-600">50K</p>
          <div class="mt-2 relative h-4 w-full bg-gray-200 rounded-full overflow-hidden">
            <div class="absolute h-full bg-orange-600 rounded-full w-4/5 animate-pulse"></div>
          </div>
          <p class="text-xs text-gray-500 mt-1">+15% from last month</p>
        </div>
      </div>

      <!-- Band Members Card -->
      <div class="relative bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg p-4 rounded-lg shadow-lg border border-white border-opacity-20 overflow-hidden group hover:bg-opacity-30 transition duration-300">
        <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-orange-500 bg-opacity-20 flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <div class="flex flex-col z-10 relative">
          <p class="text-gray-600 text-sm font-medium mb-1">Band Members</p>
          <p class="text-3xl font-bold text-orange-600">12</p>
          <div class="mt-2 flex">
            <div class="h-4 w-4 rounded-full bg-orange-600 -ml-1 border border-white"></div>
            <div class="h-4 w-4 rounded-full bg-orange-500 -ml-1 border border-white"></div>
            <div class="h-4 w-4 rounded-full bg-orange-400 -ml-1 border border-white"></div>
            <div class="h-4 w-4 rounded-full bg-orange-300 -ml-1 border border-white"></div>
            <div class="h-4 w-4 rounded-full bg-gray-400 -ml-1 border border-white flex items-center justify-center text-white text-xs">+8</div>
          </div>
          <p class="text-xs text-gray-500 mt-1">Full roster</p>
        </div>
      </div>

      <!-- Upcoming Events Card -->
      <div class="relative bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg p-4 rounded-lg shadow-lg border border-white border-opacity-20 overflow-hidden group hover:bg-opacity-30 transition duration-300">
        <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-orange-500 bg-opacity-20 flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <div class="flex flex-col z-10 relative">
          <p class="text-gray-600 text-sm font-medium mb-1">Upcoming Events</p>
          <p class="text-3xl font-bold text-orange-600">15</p>
          <div class="mt-2 flex justify-between items-center">
            <div class="w-2 h-2 bg-orange-600 rounded-full"></div>
            <div class="w-full h-0.5 bg-gray-300"></div>
            <div class="w-2 h-2 bg-orange-600 rounded-full"></div>
            <div class="w-full h-0.5 bg-gray-300"></div>
            <div class="w-2 h-2 bg-orange-600 rounded-full"></div>
          </div>
          <p class="text-xs text-gray-500 mt-1">Next event in 3 days</p>
        </div>
      </div>

      <!-- Merch Items Card -->
      <div class="relative bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg p-4 rounded-lg shadow-lg border border-white border-opacity-20 overflow-hidden group hover:bg-opacity-30 transition duration-300">
        <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-orange-500 bg-opacity-20 flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        </div>
        <div class="flex flex-col z-10 relative">
          <p class="text-gray-600 text-sm font-medium mb-1">Merch Items</p>
          <p class="text-3xl font-bold text-orange-600">35</p>
          <div class="mt-2 grid grid-cols-7 gap-0.5">
            <div class="h-1 bg-orange-300"></div>
            <div class="h-2 bg-orange-400"></div>
            <div class="h-3 bg-orange-500"></div>
            <div class="h-4 bg-orange-600"></div>
            <div class="h-3 bg-orange-500"></div>
            <div class="h-2 bg-orange-400"></div>
            <div class="h-1 bg-orange-300"></div>
          </div>
          <p class="text-xs text-gray-500 mt-1">5 bestsellers this week</p>
        </div>
      </div>
    </div>

    <!-- Content Sections -->
    <div x-show="activeTab === 'dashboard'">
      <!-- Music Player -->
      <div class="bg-white bg-opacity-90 backdrop-filter backdrop-blur-lg p-4 shadow-md rounded flex flex-col md:flex-row items-center gap-4 mb-6 border border-white border-opacity-40">
        <div class="flex items-center gap-4 w-full md:w-auto">
          <button @click="songPlaying = !songPlaying" class="p-3 bg-orange-600 text-white rounded-full hover:bg-orange-700 transition flex-shrink-0 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="!songPlaying">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="songPlaying">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </button>
          <div>
            <p class="text-lg font-medium">Now Playing:</p>
            <p class="text-gray-600" x-text="currentSong + ' - Sounds of Worship'">"Amazing Grace" - Sounds of Worship</p>
          </div>
        </div>

        <!-- Progress Bar (desktop only) -->
        <div class="hidden md:block flex-1 w-full">
          <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-orange-600 h-2.5 rounded-full w-1/3 relative">
              <div class="absolute -right-1 -top-1 w-4 h-4 bg-white rounded-full border-2 border-orange-600 shadow-md"></div>
            </div>
          </div>
          <div class="flex justify-between text-xs text-gray-500 mt-1">
            <span>1:25</span>
            <span>4:12</span>
          </div>
        </div>

        <!-- Volume Control (desktop only) -->
        <div class="hidden md:flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
          </svg>
          <input type="range" class="w-24" min="0" max="100" value="75">
        </div>
      </div>

      <!-- Featured Content -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Recent Songs -->
        <div class="bg-white bg-opacity-80 backdrop-filter backdrop-blur-lg shadow-md rounded p-4 border border-white border-opacity-30">
          <h2 class="text-lg font-semibold mb-3 text-orange-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
            </svg>
            Popular Songs
          </h2>
          <ul class="divide-y">
            <li class="py-2 flex justify-between items-center">
              <div class="flex items-center">
                <span class="font-medium">Amazing Grace</span>
                <span class="ml-2 text-xs bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full">New</span>
              </div>
              <div class="text-gray-500 text-sm">4:12</div>
            </li>
            <li class="py-2 flex justify-between items-center">
              <div class="flex items-center">
                <span class="font-medium">How Great Thou Art</span>
              </div>
              <div class="text-gray-500 text-sm">5:30</div>
            </li>
            <li class="py-2 flex justify-between items-center">
              <div class="flex items-center">
                <span class="font-medium">Glory To His Name</span>
              </div>
              <div class="text-gray-500 text-sm">3:45</div>
            </li>
            <li class="py-2 flex justify-between items-center">
              <div class="flex items-center">
                <span class="font-medium">Blessed Assurance</span>
              </div>
              <div class="text-gray-500 text-sm">4:55</div>
            </li>
            <li class="py-2 flex justify-between items-center">
              <div class="flex items-center">
                <span class="font-medium">What A Friend We Have</span>
              </div>
              <div class="text-gray-500 text-sm">3:28</div>
            </li>
          </ul>
          <button class="mt-3 text-orange-600 text-sm font-medium hover:underline">View All Songs</button>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white bg-opacity-80 backdrop-filter backdrop-blur-lg shadow-md rounded p-4 border border-white border-opacity-30">
          <h2 class="text-lg font-semibold mb-3 text-orange-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Upcoming Events
          </h2>
          <ul class="divide-y">
            <li class="py-2">
              <div class="flex justify-between items-start">
                <div>
                  <p class="font-medium">Sunday Worship Service</p>
                  <p class="text-gray-500 text-sm">First Baptist Church</p>
                </div>
                <div class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-sm font-medium">
                  March 10
                </div>
              </div>
            </li>
            <li class="py-2">
              <div class="flex justify-between items-start">
                <div>
                  <p class="font-medium">Gospel Night</p>
                  <p class="text-gray-500 text-sm">Community Center</p>
                </div>
                <div class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-sm font-medium">
                  March 17
                </div>
              </div>
            </li>
            <li class="py-2">
              <div class="flex justify-between items-start">
                <div>
                  <p class="font-medium">Charity Concert</p>
                  <p class="text-gray-500 text-sm">Memorial Auditorium</p>
                </div>
                <div class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-sm font-medium">
                  March 25
                </div>
              </div>
            </li>
          </ul>
          <button class="mt-3 text-orange-600 text-sm font-medium hover:underline">View All Events</button>
        </div>
      </div>

      <!-- Latest Albums and Merchandise Preview -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Latest Album -->
        <div class="bg-white bg-opacity-80 backdrop-filter backdrop-blur-lg shadow-md rounded p-4 md:col-span-1 border border-white border-opacity-30">
          <h2 class="text-lg font-semibold mb-3 text-orange-600">Latest Album</h2>
          <div class="relative group">
            <div class="w-full h-48 bg-orange-100 rounded flex items-center justify-center mb-2 overflow-hidden shadow-md">
              <div class="w-full h-full bg-gradient-to-br from-orange-500 to-purple-600 flex items-center justify-center text-white transition-transform group-hover:scale-105">
                <span class="text-2xl font-bold">Heavenly Worship</span>
              </div>
            </div>
            <h3 class="font-medium">Heavenly Worship</h3>
            <p class="text-gray-500 text-sm">Released: February 2025</p>
            <p class="text-sm mt-2">12 tracks of uplifting gospel music</p>
            <button class="mt-3 bg-orange-600 text-white px-4 py-2 rounded text-sm font-medium w-full hover:bg-orange-700 transition shadow-md">
              Listen Now
            </button>
          </div>
        </div>

        <!-- Featured Merchandise -->
        <div class="bg-white bg-opacity-80 backdrop-filter backdrop-blur-lg shadow-md rounded p-4 md:col-span-2 border border-white border-opacity-30">
          <h2 class="text-lg font-semibold mb-3 text-orange-600">Featured Merchandise</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-2 border rounded group hover:border-orange-600 transition bg-white bg-opacity-50 backdrop-filter backdrop-blur-sm shadow-sm">
              <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
              </div>
              <h3 class="font-medium">Worship T-Shirt</h3>
              <p class="text-orange-600 font-bold">$24.99</p>
            </div>
            <div class="p-2 border rounded group hover:border-orange-600 transition bg-white bg-opacity-50 backdrop-filter backdrop-blur-sm shadow-sm">
              <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>
              </div>
              <h3 class="font-medium">Worship CD Collection</h3>
              <p class="text-orange-600 font-bold">$19.99</p>
            </div>
            <div class="p-2 border rounded group hover:border-orange-600 transition bg-white bg-opacity-50 backdrop-filter backdrop-blur-sm shadow-sm">
              <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
              <h3 class="font-medium">Worship Lyric Book</h3>
              <p class="text-orange-600 font-bold">$14.99</p>
            </div>
          </div>
          <button class="mt-3 text-orange-600 text-sm font-medium hover:underline">View All Merchandise</button>
        </div>
      </div>
    </div>

    <!-- Other Tab Content (Events, Members, Merch) would go here -->

  </main>
</div>
</x-app-layout>
