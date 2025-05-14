<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | Sounds of Worship</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .event-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .event-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 2;
        }

        .calendar-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 107, 53, 0.1);
        }

        .event-modal {
            backdrop-filter: blur(5px);
            background: rgba(0, 0, 0, 0.5);
        }

        .event-image {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-card:hover .event-image {
            transform: scale(1.05);
        }

        .ticket-modal {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .ticket-modal.show {
            opacity: 1;
            pointer-events: auto;
        }

        .ticket-type {
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .ticket-type.selected {
            border-color: #FF6B35;
            background-color: rgba(255, 107, 53, 0.1);
        }

        .ticket-counter {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 120px;
        }

        .counter-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .counter-btn:hover {
            background: #FF6B35;
            color: white;
        }

        .text-primary {
            color: #FF6B35;
        }

        .bg-primary {
            background: linear-gradient(135deg, #FF6B35, #FF4500);
        }

        .event-card {
    position: relative;
    overflow: hidden;
}

/* Add subtle gradient to the stamp */
.absolute.bg-green-600 {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

/* Add notch effect to the stamp */
.absolute.bg-green-600::after {
    content: '';
    position: absolute;
    bottom: -4px;
    right: 30px;
    width: 8px;
    height: 8px;
    background: #047857;
    transform: rotate(45deg);
}

/* Improve text contrast */
.absolute.bg-green-600 span {
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}
    </style>
</head>
<body class="bg-gray-50 Futura LT antialiased">
    @include ('layouts.navigation')

    <!-- Events Hero -->
    <section class="relative bg-gradient-to-r from-blue-900 to-purple-900 text-white py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                 class="absolute inset-0 w-full h-full object-cover">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl text-center mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Upcoming Events</h1>
                <p class="text-xl opacity-90 mb-8">Join us in worship and fellowship</p>
                <div class="flex justify-center gap-4">
                    <a href="#events" class="bg-primary px-6 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors">
                        <i class="fas fa-calendar-alt mr-2"></i>View Calendar
                    </a>
                    <a href="#submit" class="bg-white text-gray-900 px-6 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Submit Event
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16" id="events">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($events as $event)

            @php
                $remainingSeats = $event->capacity - $event->tickets_sold;
            @endphp
            <div class="event-card relative"
                 data-event-id="{{ $event->id }}"
                 data-event-name="{{ $event->name }}"
                 data-event-date="{{ $event->event_date->format('M j, Y') }}"
                 data-event-location="{{ $event->location }}"
                 data-ticket-price="{{ $event->is_paid ? 0 : $event->ticket_price }}"
                 data-is-free="{{ $event->is_paid ? 'true' : 'false' }}"

     data-ticket-categories="{{ json_encode($event->ticket_categories) }}"
                 >

                <div class="relative overflow-hidden">
                    <img src="{{ asset('storage/' . $event->event_image) }}"
                         alt="{{ $event->title }}"
                         class="event-image w-full">

                         @if($event->status === 'fully_booked')
                <!-- Diagonal Fully Booked Stamp -->
                <div class="absolute top-4 -right-8 w-48 h-8 bg-green-600 transform rotate-45 z-20
                            flex items-center justify-center shadow-md">
                    <span class="text-white text-xs font-bold uppercase tracking-wider">
                        <i class="fas fa-ban mr-1"></i> Fully Booked
                    </span>
                </div>
                @endif

                    @if($event->is_paid)
                        <span class="event-badge bg-primary text-white">Free Entry</span>
                    @else
                        <span class="event-badge bg-purple-600 text-white">KES {{ number_format($event->ticket_price) }}</span>
                    @endif
                </div>

                <div class="p-6">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="calendar-icon rounded-lg flex items-center justify-center text-primary">
                            <div class="text-center">
                                <div class="font-bold text-2xl">{{ $event->event_date->format('d') }}</div>
                                <div class="text-sm">{{ $event->event_date->format('M') }}</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $event->location }}
                            </p>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>

                    <p class="text-sm font-semibold {{ $remainingSeats > 0 ? 'text-green-600' : 'text-red-600' }}">
                        <i class="fas fa-chair"></i>
                        {{ $remainingSeats > 0 ? $remainingSeats . ' Seats Remaining' : 'No Seats Available' }}
                    </p>
                    <br>

                    <div class="flex gap-2">
                        @if($event->status !== 'fully_booked')
                            <button class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-opacity-90 transition-colors get-tickets-btn">
                                Get Tickets
                            </button>
                        @else
                            <button class="flex-1 bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed" disabled>
                                Fully Booked
                            </button>
                        @endif

                        <a href="{{ route('all_events.show', $event->id) }}" class="flex-1 bg-gray-100 text-gray-800 py-2 rounded-lg hover:bg-gray-200 transition-colors text-center">
                            Learn More
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Featured Event -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b"
                         alt="Annual Worship Conference" class="w-full h-96 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black p-6 text-white">
                        <h3 class="text-2xl font-bold">Featured Event</h3>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-bold mb-4">Annual Worship Conference</h2>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="bg-primary text-white px-4 py-2 rounded-full">
                            <i class="fas fa-calendar-day mr-2"></i>May 20-22, 2024
                        </div>
                        <div class="bg-gray-100 px-4 py-2 rounded-full">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>KICC Nairobi
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">Join worship leaders from across the region for 3 days of:</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Powerful worship sessions
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Leadership workshops
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Networking opportunities
                        </li>
                    </ul>
                    <button class="bg-primary text-white px-8 py-3 rounded-full hover:bg-opacity-90 transition-colors get-tickets-btn"
                            data-event-id="3"
                            data-event-name="Annual Worship Conference"
                            data-event-date="May 20-22, 2024"
                            data-event-location="KICC Nairobi"
                            data-ticket-price="3500">
                        Get Tickets Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Subscribe to our newsletter to get updates about upcoming events and worship nights</p>

            <div class="max-w-md mx-auto flex gap-4">
                <input type="email" placeholder="Enter your email"
                       class="flex-1 px-4 py-3 rounded-full border focus:outline-none focus:ring-2 focus:ring-primary">
                <button class="bg-primary text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                    Subscribe
                </button>
            </div>
        </div>
    </section>
<!-- Ticket Modal -->
<div id="ticketModal" class="ticket-modal fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" id="modalBackdrop"></div>
    <div class="bg-white rounded-2xl w-full max-w-2xl mx-4 relative z-10">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold" id="modalEventTitle">Event Title</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="mb-6">
                <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                    <div><i class="fas fa-calendar-alt mr-2 text-primary"></i><span id="modalEventDate">Date</span></div>
                    <div><i class="fas fa-map-marker-alt mr-2 text-primary"></i><span id="modalEventLocation">Location</span></div>
                </div>

                <!-- Free Event Form -->
                <div id="freeEventForm" class="hidden">
                    <div class="border-t border-b py-4 mb-4">
                        <h4 class="font-semibold mb-3">Register for Free Event</h4>
                        <div class="space-y-4">
                            <div class="form-group">
                                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="fullName" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Enter your full name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" id="phone" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Enter your phone number">
                            </div>
                            <div class="form-group">
                                <label for="attendees" class="block text-sm font-medium text-gray-700 mb-1">Number of Attendees</label>
                                <select id="attendees" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <!-- Hidden input to store event name -->
                            <input type="hidden" id="eventNameInput" value="">
                        </div>
                    </div>
                </div>

                <!-- Paid Event Form -->
                <div id="paidEventForm" class="hidden">
    <div class="border-t border-b py-4 mb-4">
        <h4 class="font-semibold mb-3">Select Ticket Type</h4>
        <div class="space-y-3 ticket-types-container">
            @foreach($ticketCategories as $ticket)
            <div class="ticket-type p-3 rounded-lg cursor-pointer"
                 data-ticket-type="{{ Str::slug($ticket['category']) }}"
                 data-ticket-price="{{ $ticket['price'] }}">
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="font-medium">{{ $ticket['category'] }}</h5>
                        @if(!empty($ticket['description']))
                            <p class="text-sm text-gray-500">{{ $ticket['description'] }}</p>
                        @endif
                    </div>
                    <div class="text-primary font-bold">
                        KES {{ number_format($ticket['price']) }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mb-6">
        <h4 class="font-semibold mb-3">Number of Tickets</h4>
        <div class="ticket-counter">
            <div class="counter-btn" id="decreaseTickets">
                <i class="fas fa-minus"></i>
            </div>
            <span id="ticketCount" class="font-medium text-lg">1</span>
            <div class="counter-btn" id="increaseTickets">
                <i class="fas fa-plus"></i>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <div class="flex justify-between mb-2">
            <span>Ticket Price</span>
            <span id="subtotalPrice">KES 0</span>
        </div>
        <div class="flex justify-between mb-2">
            <span>Processing Fee</span>
            <span id="processingFee">KES 0</span>
        </div>
        <div class="flex justify-between font-bold pt-2 border-t">
            <span>Total</span>
            <span id="totalPrice" class="text-primary">KES 0</span>
        </div>
    </div>
</div>

            <div class="flex gap-4">
                <button id="continueToPayment" class="flex-1 bg-primary text-white py-3 rounded-lg hover:bg-opacity-90 transition-colors">
                    Continue to Payment
                </button>
                <button id="registerFreeEvent" class="hidden flex-1 bg-primary text-white py-3 rounded-lg hover:bg-opacity-90 transition-colors">
                    Register Now
                </button>
            </div>
        </div>
    </div>
</div>
</div>

@include ('layouts.footer')



    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables
    let selectedTicket = null;
    let ticketCount = 1;
    let isEventFree = false;
    let currentEventName = '';
    let currentEventId = '';
    let currentTicketCategories = [];

    // Selectors
    const ticketModal = document.getElementById('ticketModal');
    const ticketTypesContainer = document.querySelector('.ticket-types-container');
    const ticketCountEl = document.getElementById('ticketCount');
    const subtotalPrice = document.getElementById('subtotalPrice');
    const processingFee = document.getElementById('processingFee');
    const totalPrice = document.getElementById('totalPrice');

    // Ticket button click handler
    document.querySelectorAll('.get-tickets-btn').forEach(button => {
        button.addEventListener('click', function() {
            const eventCard = this.closest('.event-card') || this;
            currentEventId = eventCard.dataset.eventId;
            currentEventName = eventCard.dataset.eventName;

            try {
            currentTicketCategories = JSON.parse(eventCard.dataset.ticketCategories || '[]');
            console.log("Parsed currentTicketCategories:", currentTicketCategories); // Debugging line
        } catch (error) {
            console.error("Error parsing ticket categories:", error);
            currentTicketCategories = []; // Default to empty array to prevent errors
        }            isEventFree = eventCard.dataset.isFree === 'true';

            // Update modal details
            document.getElementById('modalEventTitle').textContent = currentEventName;
            document.getElementById('modalEventDate').textContent = eventCard.dataset.eventDate;
            document.getElementById('modalEventLocation').textContent = eventCard.dataset.eventLocation;

            // Handle form visibility
            if (isEventFree) {
                document.getElementById('freeEventForm').classList.remove('hidden');
                document.getElementById('paidEventForm').classList.add('hidden');
                document.getElementById('continueToPayment').classList.add('hidden');
                document.getElementById('registerFreeEvent').classList.remove('hidden');
            } else {
                document.getElementById('freeEventForm').classList.add('hidden');
                document.getElementById('paidEventForm').classList.remove('hidden');
                document.getElementById('continueToPayment').classList.remove('hidden');
                document.getElementById('registerFreeEvent').classList.add('hidden');

                // Clear existing tickets
                ticketTypesContainer.innerHTML = '';

                // Create new ticket elements
                currentTicketCategories.forEach((ticket, index) => {
                    const ticketElement = document.createElement('div');
                    ticketElement.className = 'ticket-type p-3 rounded-lg cursor-pointer';
                    ticketElement.innerHTML = `
                        <div class="flex justify-between items-center">
                            <div>
                                <h5 class="font-medium">${ticket.category}</h5>
                                ${ticket.description ? `<p class="text-sm text-gray-500">${ticket.description}</p>` : ''}
                            </div>
                            <div class="text-primary font-bold">
                                KES ${Number(ticket.price).toLocaleString()}
                            </div>
                        </div>
                    `;
                    ticketElement.dataset.ticketPrice = ticket.price;
                    ticketElement.dataset.ticketType = ticket.category.toLowerCase().replace(/\s+/g, '-');

                    if (index === 0) {
                        ticketElement.classList.add('selected');
                        selectedTicket = ticketElement;
                    }

                    ticketTypesContainer.appendChild(ticketElement);
                });

                // Reset counters
                ticketCount = 1;
                ticketCountEl.textContent = ticketCount;
                updatePricing();
            }

            // Show modal
            ticketModal.classList.add('show');
        });
    });

    // Ticket type selection
    ticketTypesContainer.addEventListener('click', (e) => {
        const ticket = e.target.closest('.ticket-type');
        if (ticket) {
            document.querySelectorAll('.ticket-type').forEach(t => t.classList.remove('selected'));
            ticket.classList.add('selected');
            selectedTicket = ticket;
            updatePricing();
        }
    });

    // Ticket counter
    document.getElementById('decreaseTickets').addEventListener('click', () => {
        if (ticketCount > 1) {
            ticketCount--;
            ticketCountEl.textContent = ticketCount;
            updatePricing();
        }
    });

    document.getElementById('increaseTickets').addEventListener('click', () => {
        if (ticketCount < 10) {
            ticketCount++;
            ticketCountEl.textContent = ticketCount;
            updatePricing();
        }
    });

    // Pricing calculation
    function updatePricing() {
        if (!selectedTicket) return;

        const price = parseFloat(selectedTicket.dataset.ticketPrice);
        const subtotal = price * ticketCount;
        const fee = Math.round(subtotal * 0.05);
        const total = subtotal + fee;

        subtotalPrice.textContent = `KES ${subtotal.toLocaleString()}`;
        processingFee.textContent = `KES ${fee.toLocaleString()}`;
        totalPrice.textContent = `KES ${total.toLocaleString()}`;
    }

    // Continue to payment
    document.getElementById('continueToPayment').addEventListener('click', () => {
        if (!selectedTicket) {
            alert('Please select a ticket type');
            return;
        }

        const ticketData = {
            eventId: currentEventId,
            eventName: currentEventName,
            category: selectedTicket.querySelector('h5').textContent,
            price: selectedTicket.dataset.ticketPrice,
            quantity: ticketCount,
            total: totalPrice.textContent
        };

        console.log('Processing payment:', ticketData);
        ticketModal.classList.remove('show');
    });

    // Close modal handlers
    document.getElementById('closeModal').addEventListener('click', () => ticketModal.classList.remove('show'));
    document.getElementById('modalBackdrop').addEventListener('click', () => ticketModal.classList.remove('show'));
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') ticketModal.classList.remove('show');
    });

    // Free registration handler
    document.getElementById('registerFreeEvent').addEventListener('click', async () => {
        const formData = {
            event_id: currentEventId,
            full_name: document.getElementById('fullName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            quantity: document.getElementById('attendees').value
        };

        try {
            const response = await fetch('/tickets/free', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (data.success) {
                alert('Registration successful! Check your email for confirmation.');
                ticketModal.classList.remove('show');
            } else {
                throw new Error(data.message || 'Registration failed');
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'An error occurred. Please try again.');
        }
    });
});
</script>
</body>
</html>
