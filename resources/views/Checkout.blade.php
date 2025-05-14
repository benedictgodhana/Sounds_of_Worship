<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Sounds of Worship | Kenya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B35',
                        secondary: '#4CAF50',
                        accent: '#FFC107',
                        kenya: {
                            red: '#be0027',
                            green: '#006b3f',
                            black: '#000000',
                        }
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        .form-control {
            transition: all 0.3s ease;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 12px 16px;
            width: 100%;
            outline: none;
        }

        .form-control:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.1);
        }

        .checkout-summary {
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .checkout-btn {
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .payment-option {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .payment-option:hover {
            border-color: #ddd;
            background-color: #f9f9f9;
        }

        .payment-option.selected {
            border-color: #FF6B35;
            background-color: rgba(255, 107, 53, 0.05);
        }

        .payment-logo {
            width: 60px;
            height: 30px;
            object-fit: contain;
        }

        .payment-form {
            display: none;
            padding-top: 12px;
        }

        .mpesa-logo {
            width: 100px;
            height: 40px;
            object-fit: contain;
        }

        .kenya-flag-accent {
            background: linear-gradient(to right, #be0027 33%, #000000 33%, #000000 66%, #006b3f 66%);
            height: 5px;
            width: 100%;
            border-radius: 2px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation would be included here -->
    @include ('layouts.navigation')

    <!-- Kenya-themed header -->
    <div class="w-full bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Sounds of Worship</h1>
                <div class="flex items-center gap-x-4">
                    <div class="text-sm text-gray-600">Kenya</div>
                    <div class="w-8 h-5 rounded overflow-hidden">
                        <div class="h-1/3 bg-kenya-black"></div>
                        <div class="h-1/3 bg-kenya-red"></div>
                        <div class="h-1/3 bg-kenya-green"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kenya-flag-accent"></div>
    </div>

    <!-- Checkout Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="text-gray-600">Complete your purchase</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="card mb-6">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Contact Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="firstName" class="block mb-2 text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="firstName" class="form-control" required>
                            </div>
                            <div>
                                <label for="lastName" class="block mb-2 text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="lastName" class="form-control" required>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" id="phone" class="form-control" placeholder="e.g. 0712345678" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-6">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Shipping Address</h2>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <div>
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Street Address</label>
                                <input type="text" id="address" class="form-control" required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-700">City/Town</label>
                                    <select id="city" class="form-control" required>
                                        <option value="">Select City/Town</option>
                                        <option value="Nairobi">Nairobi</option>
                                        <option value="Mombasa">Mombasa</option>
                                        <option value="Kisumu">Kisumu</option>
                                        <option value="Nakuru">Nakuru</option>
                                        <option value="Eldoret">Eldoret</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="county" class="block mb-2 text-sm font-medium text-gray-700">County</label>
                                    <select id="county" class="form-control" required>
                                        <option value="">Select County</option>
                                        <option value="Nairobi">Nairobi</option>
                                        <option value="Mombasa">Mombasa</option>
                                        <option value="Kisumu">Kisumu</option>
                                        <option value="Nakuru">Nakuru</option>
                                        <option value="Uasin Gishu">Uasin Gishu</option>
                                        <option value="Kiambu">Kiambu</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="landmark" class="block mb-2 text-sm font-medium text-gray-700">Landmark/Building (Optional)</label>
                                <input type="text" id="landmark" class="form-control" placeholder="e.g. Near Westgate Mall">
                            </div>
                            <div>
                                <label for="delivery_instructions" class="block mb-2 text-sm font-medium text-gray-700">Delivery Instructions (Optional)</label>
                                <textarea id="delivery_instructions" class="form-control" rows="2" placeholder="Any special instructions for delivery"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-6">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Payment Method</h2>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <!-- M-Pesa Option (Primary for Kenya) -->
                            <div class="payment-option" data-payment="mpesa">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" id="mpesa" name="payment-method" class="mr-2" checked>
                                        <label for="mpesa" class="font-medium">M-Pesa</label>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/15/M-PESA_LOGO-01.svg"
                                        alt="M-Pesa" class="mpesa-logo">
                                </div>
                                <div id="mpesa-form" class="payment-form">
                                    <div class="mb-4">
                                        <label for="mpesa-phone" class="block mb-2 text-sm font-medium text-gray-700">M-Pesa Phone Number</label>
                                        <div class="flex">
                                            <div class="bg-gray-100 px-3 flex items-center rounded-l-lg border border-r-0 border-gray-300">
                                                <span>+254</span>
                                            </div>
                                            <input type="tel" id="mpesa-phone" class="form-control rounded-l-none" placeholder="e.g. 712345678">
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Enter your M-Pesa registered phone number</p>
                                    </div>
                                    <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                        <div class="flex items-start">
                                            <div class="text-green-500 mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-700">Once you complete your order, you'll receive an M-Pesa payment request on your phone. Please enter your M-Pesa PIN to complete the transaction.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cash on Delivery Option -->
                            <div class="payment-option" data-payment="cash">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" id="cash" name="payment-method" class="mr-2">
                                        <label for="cash" class="font-medium">Cash on Delivery</label>
                                    </div>
                                    <div class="bg-primary text-white rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div id="cash-form" class="payment-form">
                                    <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                        <div class="flex items-start">
                                            <div class="text-yellow-500 mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-700">Pay with cash when your order is delivered. Please have the exact amount ready.</p>
                                                <p class="text-sm text-gray-700 mt-2">Note: Our delivery partner will call you before arriving.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Credit Card Option -->
                            <div class="payment-option" data-payment="credit-card">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" id="credit-card" name="payment-method" class="mr-2">
                                        <label for="credit-card" class="font-medium">Credit Card</label>
                                    </div>
                                    <div class="flex space-x-2">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png"
                                            alt="Visa" class="payment-logo">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png"
                                            alt="Mastercard" class="payment-logo">
                                    </div>
                                </div>
                                <div id="credit-card-form" class="payment-form">
                                    <div class="mb-4">
                                        <label for="card-number" class="block mb-2 text-sm font-medium text-gray-700">Card Number</label>
                                        <input type="text" id="card-number" class="form-control" placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="expiry" class="block mb-2 text-sm font-medium text-gray-700">Expiry Date</label>
                                            <input type="text" id="expiry" class="form-control" placeholder="MM/YY">
                                        </div>
                                        <div>
                                            <label for="cvv" class="block mb-2 text-sm font-medium text-gray-700">CVV</label>
                                            <input type="text" id="cvv" class="form-control" placeholder="123">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="name-on-card" class="block mb-2 text-sm font-medium text-gray-700">Name on Card</label>
                                        <input type="text" id="name-on-card" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="checkout-summary p-6 h-fit sticky top-6">
                <div class="kenya-flag-accent mb-4"></div>
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

                <div class="space-y-4 mb-6">
                    <!-- Item 1 -->
                    <div id="checkout-items"></div>
                    <div class="flex justify-between border-t mt-4 pt-4 text-lg font-bold">
    <span>Total</span>
    <span id="total-amount" class="text-primary">KSh 0.00</span>
</div>


                <div class="mt-6">
                    <div class="mb-4">
                        <label for="promo" class="block mb-2 text-sm font-medium text-gray-700">Promo Code</label>
                        <div class="flex">
                            <input type="text" id="promo" class="form-control rounded-r-none" placeholder="Enter code">
                            <button class="bg-gray-100 px-4 rounded-r-lg hover:bg-gray-200 transition-colors">Apply</button>
                        </div>
                    </div>

                    <button class="checkout-btn w-full bg-primary text-white py-3 rounded-lg hover:bg-opacity-90 font-medium">
                        Complete Order
                    </button>

                    <div class="flex items-center justify-center mt-4 text-sm text-gray-500">
                        <i class="fas fa-lock mr-2"></i>
                        <span>Secure Checkout</span>
                    </div>

                    <div class="mt-4 text-xs text-gray-500">
                        <p>Free delivery for orders above KSh 10,000 within Nairobi.</p>
                        <p class="mt-1">Delivery within 2-5 business days depending on your location.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer would be included here -->
    @include ('layouts.footer')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const checkoutItems = document.getElementById('checkout-items');
        const totalAmount = document.getElementById('total-amount');

        function updateCartDisplay() {
            checkoutItems.innerHTML = cart.map((item, index) => `
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <img src="${item.image}" class="w-20 h-20 object-cover rounded-lg">
                    <div class="ml-4 flex-1">
                        <h3 class="font-bold">${item.name}</h3>
                        <p>Quantity:
                            <button class="px-2 py-1 bg-gray-200 rounded decrease" data-index="${index}">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button class="px-2 py-1 bg-gray-200 rounded increase" data-index="${index}">+</button>
                        </p>
                        <p class="text-primary font-bold">KSh ${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                    <button class="text-red-500 remove" data-index="${index}">Remove</button>
                </div>
            `).join('');

            updateTotal();
        }

        function updateTotal() {
            const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            totalAmount.textContent = `KSh ${total.toFixed(2)}`;
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        checkoutItems.addEventListener('click', function (e) {
            const index = e.target.dataset.index;
            if (e.target.classList.contains('increase')) {
                cart[index].quantity++;
            } else if (e.target.classList.contains('decrease')) {
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                } else {
                    cart.splice(index, 1); // Remove item if quantity is 1 and decreased
                }
            } else if (e.target.classList.contains('remove')) {
                cart.splice(index, 1);
            }
            updateCartDisplay();
        });

        updateCartDisplay();
    });
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method toggle
            const paymentOptions = document.querySelectorAll('.payment-option');
            const paymentForms = document.querySelectorAll('.payment-form');
            const radioButtons = document.querySelectorAll('input[name="payment-method"]');

            // Initialize payment option selection
            updatePaymentOptions();

            // Add event listeners to radio buttons
            radioButtons.forEach(radio => {
                radio.addEventListener('change', updatePaymentOptions);
            });

            // Add event listeners to payment option containers for better UX
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const radioButton = this.querySelector('input[type="radio"]');
                    if (radioButton) {
                        radioButton.checked = true;
                        updatePaymentOptions();
                    }
                });
            });

            function updatePaymentOptions() {
                // First hide all payment forms
                paymentForms.forEach(form => {
                    form.style.display = 'none';
                });

                // Remove selected class from all options
                paymentOptions.forEach(option => {
                    option.classList.remove('selected');
                });

                // Find the checked radio button and show its form
                const checkedRadio = document.querySelector('input[name="payment-method"]:checked');
                if (checkedRadio) {
                    const paymentMethod = checkedRadio.id;
                    const selectedOption = document.querySelector(`.payment-option[data-payment="${paymentMethod}"]`);
                    const selectedForm = document.getElementById(`${paymentMethod}-form`);

                    if (selectedOption && selectedForm) {
                        selectedOption.classList.add('selected');
                        selectedForm.style.display = 'block';
                    }
                }
            }

            // Form validation would be added here
            document.querySelector('.checkout-btn').addEventListener('click', function(e) {
                e.preventDefault();

                const checkedRadio = document.querySelector('input[name="payment-method"]:checked');
                if (checkedRadio) {
                    if (checkedRadio.id === 'mpesa') {
                        alert('An M-Pesa payment request has been sent to your phone. Please check your phone to complete the transaction.');
                    } else if (checkedRadio.id === 'cash') {
                        alert('Thank you for your order! Our delivery partner will contact you to arrange delivery and payment.');
                    } else {
                        alert('Thank you for your order! Your payment has been processed successfully.');
                    }
                }
            });
        });
    </script>
</body>
</html>
