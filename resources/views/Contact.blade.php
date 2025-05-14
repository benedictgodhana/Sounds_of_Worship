<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Sounds of Worship</title>
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
        .contact-hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1477233534935-f5e6fe7c1159');
            background-size: cover;
            background-position: center;
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

        .contact-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .custom-input:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
            outline: none;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased font-sans">
    <!-- Navigation -->
   @include ('layouts.navigation')

    <!-- Hero Section -->
    <section class="contact-hero text-white min-h-[40vh] flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl max-w-2xl mx-auto opacity-90">We'd love to hear from you. Reach out with questions, prayer requests, or to connect with our worship community.</p>
            <div class="flex justify-center gap-4 mt-8">
                <a href="#contact-form" class="bg-primary px-6 py-3 rounded-full font-semibold hover:bg-opacity-90 transition-all shadow-lg">
                    <i class="fas fa-envelope mr-2"></i>Send Message
                </a>
                <a href="#locations" class="border-2 border-white px-6 py-3 rounded-full hover:bg-white hover:text-gray-900 transition-all duration-300">
                    <i class="fas fa-map-marker-alt mr-2"></i>Our Locations
                </a>
            </div>
        </div>
    </section>

  
    <!-- Contact Methods Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-medium">Get In Touch</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">We're Here For You</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">Have questions about our ministry, events, or how to get involved? Choose the most convenient way to connect with us.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Card 1 -->
                <div class="contact-card bg-white rounded-xl shadow-md p-8 text-center border-t-4 border-primary">
                    <div class="bg-primary bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">Call Us</h3>
                    <p class="text-gray-600 mb-4">Our team is available to help during business hours</p>
                    <a href="tel:+15551234567" class="text-primary font-semibold text-lg hover:underline">(555) 123-4567</a>
                    <p class="text-gray-500 text-sm mt-2">Monday-Friday: 9am-5pm</p>
                </div>

                <!-- Contact Card 2 -->
                <div class="contact-card bg-white rounded-xl shadow-md p-8 text-center border-t-4 border-secondary">
                    <div class="bg-secondary bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-secondary text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">Email Us</h3>
                    <p class="text-gray-600 mb-4">Send us an email and we'll respond within 24 hours</p>
                    <a href="mailto:info@soundsofworship.com" class="text-secondary font-semibold text-lg hover:underline">info@soundsofworship.com</a>
                    <p class="text-gray-500 text-sm mt-2">For general inquiries</p>
                </div>

                <!-- Contact Card 3 -->
                <div class="contact-card bg-white rounded-xl shadow-md p-8 text-center border-t-4 border-accent">
                    <div class="bg-accent bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-comments text-accent text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">Live Chat</h3>
                    <p class="text-gray-600 mb-4">Chat with our support team in real-time</p>
                    <button class="bg-accent text-white px-6 py-3 rounded-full font-semibold hover:bg-opacity-90 transition-colors">
                        <i class="fas fa-comment-dots mr-2"></i>Start Chat
                    </button>
                    <p class="text-gray-500 text-sm mt-2">Available 24/7</p>
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="bg-gray-50 rounded-xl p-8 border border-gray-200">
                    <h3 class="font-bold text-xl mb-4 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-2"></i>
                        Frequently Asked Questions
                    </h3>
                    <div x-data="{selected:null}">
                        <div class="mb-4">
                            <button
                                @click="selected !== 1 ? selected = 1 : selected = null"
                                class="flex justify-between items-center w-full py-3 px-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow"
                            >
                                <span class="font-medium">What are your service times?</span>
                                <i class="fas" :class="selected == 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div
                                x-show="selected == 1"
                                x-collapse
                                class="py-3 px-4 text-gray-600 border-l-2 border-primary"
                            >
                                Our Sunday services are at 9:00 AM and 11:00 AM. We also have a Wednesday evening service at 7:00 PM.
                            </div>
                        </div>
                        <div class="mb-4">
                            <button
                                @click="selected !== 2 ? selected = 2 : selected = null"
                                class="flex justify-between items-center w-full py-3 px-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow"
                            >
                                <span class="font-medium">How can I join the worship team?</span>
                                <i class="fas" :class="selected == 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div
                                x-show="selected == 2"
                                x-collapse
                                class="py-3 px-4 text-gray-600 border-l-2 border-primary"
                            >
                                We're always looking for talented musicians and singers. Complete our worship team application form and we'll schedule an audition.
                            </div>
                        </div>
                        <div class="mb-4">
                            <button
                                @click="selected !== 3 ? selected = 3 : selected = null"
                                class="flex justify-between items-center w-full py-3 px-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow"
                            >
                                <span class="font-medium">Do you offer counseling services?</span>
                                <i class="fas" :class="selected == 3 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div
                                x-show="selected == 3"
                                x-collapse
                                class="py-3 px-4 text-gray-600 border-l-2 border-primary"
                            >
                                Yes, we offer pastoral counseling by appointment. Please contact our office to schedule a session with one of our pastoral staff members.
                            </div>
                        </div>
                    </div>
                    <a href="/faq" class="text-primary hover:underline flex items-center mt-4 font-medium">
                        View all FAQs <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="text-center md:text-left">
                    <h3 class="font-bold text-xl mb-4">Connect With Us</h3>
                    <p class="text-gray-600 mb-6">Follow us on social media for updates, live streams, and more</p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <a href="#" class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="bg-red-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors" aria-label="YouTube">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                        <a href="#" class="bg-pink-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="bg-sky-500 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-sky-600 transition-colors" aria-label="Twitter">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="bg-green-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors" aria-label="Spotify">
                            <i class="fab fa-spotify text-xl"></i>
                        </a>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="font-medium mb-2">Subscribe to our newsletter</p>
                        <div class="flex mt-2">
                            <input type="email" placeholder="Your email address" class="flex-1 p-3 border rounded-l-lg custom-input">
                            <button class="bg-primary text-white px-4 py-3 rounded-r-lg hover:bg-purple-700 transition-colors">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact-form" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="bg-gradient-to-br from-primary to-purple-900 p-12 text-white">
                        <h2 class="text-3xl font-bold mb-6">Send Us a Message</h2>
                        <p class="mb-8 opacity-90">We'd love to hear from you. Fill out the form and we'll get back to you as soon as possible.</p>

                        <div class="mb-6">
                            <h3 class="font-semibold text-xl mb-4">Office Hours</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <i class="far fa-clock mr-3 text-purple-300"></i>
                                    <span>Monday - Friday: 9:00 AM - 5:00 PM</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="far fa-clock mr-3 text-purple-300"></i>
                                    <span>Saturday: 10:00 AM - 2:00 PM</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="far fa-clock mr-3 text-purple-300"></i>
                                    <span>Sunday: Closed (Services Only)</span>
                                </li>
                            </ul>
                        </div>

                        <div id="locations">
                            <h3 class="font-semibold text-xl mb-4">Our Location</h3>
                            <address class="not-italic">
                                <div class="flex items-start mb-2">
                                    <i class="fas fa-map-marker-alt mr-3 mt-1 text-purple-300"></i>
                                    <span>123 Worship Avenue<br>Nashville, TN 37203</span>
                                </div>
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-phone-alt mr-3 text-purple-300"></i>
                                    <span>(555) 123-4567</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope mr-3 text-purple-300"></i>
                                    <span>info@soundsofworship.com</span>
                                </div>
                            </address>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white border-opacity-20">
                            <h3 class="font-semibold text-xl mb-4">Need Prayer?</h3>
                            <p class="mb-4">Our prayer team is available 24/7 for urgent prayer requests.</p>
                            <a href="/prayer" class="inline-flex items-center bg-white text-primary px-5 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors shadow-md">
                                <i class="fas fa-pray mr-2"></i>
                                Submit Prayer Request
                            </a>
                        </div>
                    </div>

                    <div class="p-12">
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="firstName" class="block text-gray-700 font-medium mb-2">First Name</label>
                                    <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" class="w-full p-3 border rounded-lg custom-input">
                                </div>
                                <div>
                                    <label for="lastName" class="block text-gray-700 font-medium mb-2">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" class="w-full p-3 border rounded-lg custom-input">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email address" class="w-full p-3 border rounded-lg custom-input">
                            </div>

                            <div class="mb-6">
                                <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" class="w-full p-3 border rounded-lg custom-input">
                            </div>

                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                                <select id="subject" name="subject" class="w-full p-3 border rounded-lg custom-input">
                                    <option value="" selected disabled>Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="music">Music & Worship</option>
                                    <option value="events">Events & Services</option>
                                    <option value="volunteer">Volunteering</option>
                                    <option value="prayer">Prayer Request</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                                <textarea id="message" name="message" rows="5" placeholder="Type your message here..." class="w-full p-3 border rounded-lg custom-input"></textarea>
                            </div>

                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                    <span class="ml-2 text-gray-700">I agree to the Privacy Policy and Terms of Service</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-primary text-white py-4 rounded-lg font-semibold hover:bg-purple-700 transition-colors shadow-md">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary font-medium">Visit Us</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Find Our Locations</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">Join us for worship at one of our convenient locations</p>
            </div>

            <div class="bg-gray-200 rounded-xl overflow-hidden h-96 relative shadow-lg">
                <!-- This would be replaced with an actual map integration -->
                <div class="absolute inset-0 flex items-center justify-center bg-gray-300">
                    <div class="text-center">
                        <i class="fas fa-map-marker-alt text-primary text-5xl mb-4"></i>
                        <p class="text-gray-700">Map location: 123 Worship Avenue, Nashville, TN 37203</p>
                        <button class="mt-4 bg-primary text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-directions mr-2"></i>Get Directions
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Location 1 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="font-bold text-xl mb-3">Main Campus</h3>
                    <address class="not-italic text-gray-600 mb-4">
                        123 Worship Avenue<br>
                        Nashville, TN 37203
                    </address>
                    <div class="space-y-2 text-gray-700">
                        <div class="flex items-center">
                            <i class="far fa-clock w-6 text-primary"></i>
                            <span>Sunday: 9AM, 11AM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock w-6 text-primary"></i>
                            <span>Wednesday: 7PM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt w-6 text-primary"></i>
                            <span>(555) 123-4567</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t">
                        <a href="#" class="text-primary hover:underline font-medium flex items-center">
                            <i class="fas fa-directions mr-2"></i>Get Directions
                        </a>
                    </div>
                </div>

                <!-- Location 2 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="font-bold text-xl mb-3">Downtown Location</h3>
                    <address class="not-italic text-gray-600 mb-4">
                        456 Central Avenue<br>
                        Nashville, TN 37201
                    </address>
                    <div class="space-y-2 text-gray-700">
                        <div class="flex items-center">
                            <i class="far fa-clock w-6 text-primary"></i>
                            <span>Sunday: 10AM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock w-6 text-primary"></i>
                            <span>Thursday: 6:30PM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt w-6 text-primary"></i>
                            <span>(555) 987-6543</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t">
                        <a href="#" class="text-primary hover:underline font-medium flex items-center">
                            <i class="fas fa-directions mr-2"></i>Get Directions
                        </a>
                    </div>
                </div>

                <!-- Location 3 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="font-bold text-xl mb-3">East Nashville</h3>
                    <address class="not-italic text-gray-600 mb-4">
                        789 Eastside Blvd<br>
                        Nashville, TN 37206
                    </address>
                    <div class="space-y-2 text-gray-700">
                        <div class="flex items-center">
                            <i class="far fa-clock w-6 text-primary"></i>
                            <span>Sunday: 9:30AM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock w-6 text-primary"></i>
                            <span>Tuesday: 7PM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt w-6 text-primary"></i>
                            <span>(555) 456-7890</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t">
                        <a href="#" class="text-primary hover:underline font-medium flex items-center">
                            <i class="fas fa-directions mr-2"></i>Get Directions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-gradient-to-r from-primary to-purple-600 rounded-2xl p-10 shadow-lg text-white">
                <h2 class="text-3xl font-bold mb-4">Ready to Join Our Worship Community?</h2>
                <p class="opacity-90 mb-8 max-w-2xl mx-auto">Whether you're seeking spiritual growth, looking to contribute your musical talents, or simply want to connect with fellow worshippers, we're here to welcome you.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/events" class="bg-white text-primary px-8 py-4 rounded-full font-semibold hover:bg-opacity-90 transition-colors shadow-lg">
                        <i class="fas fa-calendar-alt mr-2"></i>Upcoming Events
                    </a>
                    <a href="/connect" class="border-2 border-white px-8 py-4 rounded-full hover:bg-white hover:text-primary transition-colors">
                        <i class="fas fa-hands-helping mr-2"></i>Get Involved
                    </a>
                </div>
            </div>
        </div>
    </section>

   @include ('layouts.footer')
</body>
</html>
