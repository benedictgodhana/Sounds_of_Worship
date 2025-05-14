<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise | Sounds of Worship</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .merch-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .merch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .merch-badge {
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

        .cart-preview {
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            max-width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .cart-preview.open {
            transform: translateX(0);
        }

        .product-image {
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .checkout-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        .category-filter.active {
            background: #FF6B35;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    @include('layouts.navigation')

    <!-- Merchandise Hero -->
    <section class="relative bg-gradient-to-r from-blue-900 to-purple-900 text-white py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1501386761578-eacb1c1e84f3')">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl text-center mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Wear Your Worship</h1>
                <p class="text-xl opacity-90 mb-8">Express your faith with our premium quality merchandise</p>
                <a href="#featured" class="inline-block bg-primary px-6 py-3 rounded-full font-medium hover:bg-opacity-90 transition-colors">
                    Shop Now
                </a>
            </div>
        </div>
    </section>
<!-- Featured Products -->
<section id="featured" class="py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-center justify-between mb-10 gap-4">
      <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
      <div class="flex gap-2">
        <button class="category-filter px-4 py-2 rounded-full bg-gray-100 hover:bg-primary hover:text-white active" data-category="all">
          All
        </button>
        <button class="category-filter px-4 py-2 rounded-full bg-gray-100 hover:bg-primary hover:text-white" data-category="clothing">
          Clothing
        </button>
        <button class="category-filter px-4 py-2 rounded-full bg-gray-100 hover:bg-primary hover:text-white" data-category="accessories">
          Accessories
        </button>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      @foreach ($products as $product)
      <div class="merch-card relative group rounded-lg shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200" data-category="{{ $product->category }}">
        @if($product->is_new) <!-- Optional: condition for "New" badge -->
        <span class="merch-badge absolute top-3 left-3 bg-primary text-white text-xs font-bold px-2 py-1 rounded-md z-10">New</span>
        @elseif($product->is_best_seller) <!-- Optional: condition for "Best Seller" badge -->
        <span class="merch-badge absolute top-3 left-3 bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded-md z-10">Best Seller</span>
        @endif
        <div class="h-64 overflow-hidden rounded-t-lg relative">
          <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover product-image transition-transform duration-500 group-hover:scale-110">
          <div class="absolute top-3 right-3 z-10">
            <button class="share-button bg-white text-gray-700 w-8 h-8 rounded-full flex items-center justify-center shadow-md hover:bg-gray-100 transition-colors"
                    onclick="shareProduct('{{ $product->name }}', '{{ url('/product/' . $product->id) }}')">
              <i class="fas fa-share-alt"></i>
            </button>
          </div>
        </div>
        <div class="p-5">
          <h3 class="font-bold text-lg mb-2">{{ $product->name }}</h3>
          <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>

          <!-- Size Selection (Hardcoded options as tabs) -->
          <div class="mb-4">
            <label class="text-sm font-semibold text-gray-700">Size</label>
            <div class="flex space-x-2 mt-2">
              <button class="size-tab px-4 py-2 rounded-full border text-sm font-medium text-gray-700 hover:bg-primary hover:text-white" data-size="S">S</button>
              <button class="size-tab px-4 py-2 rounded-full border text-sm font-medium text-gray-700 hover:bg-primary hover:text-white" data-size="M">M</button>
              <button class="size-tab px-4 py-2 rounded-full border text-sm font-medium text-gray-700 hover:bg-primary hover:text-white" data-size="L">L</button>
              <button class="size-tab px-4 py-2 rounded-full border text-sm font-medium text-gray-700 hover:bg-primary hover:text-white" data-size="XL">XL</button>
              <button class="size-tab px-4 py-2 rounded-full border text-sm font-medium text-gray-700 hover:bg-primary hover:text-white" data-size="XXL">XXL</button>
            </div>
          </div>

          <div class="flex justify-between items-center">
            <span class="text-primary text-xl font-bold">Ksh {{ number_format($product->price, 2) }}</span>
            <button class="add-to-cart bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-90 transition-colors transform hover:scale-105">
              <i class="fas fa-shopping-cart"></i>
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

    <!-- Cart Preview -->
    <div class="cart-preview">
        <div class="h-full flex flex-col">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold">Your Cart</h3>
                    <button class="close-cart text-gray-500 hover:text-primary text-2xl">
                        &times;
                    </button>
                </div>
                <div class="text-sm text-gray-500 mt-1"><span id="cart-count">0</span> items</div>
            </div>

            <div class="flex-1 overflow-y-auto p-6">
                <div class="cart-items space-y-4">
                    <div class="empty-cart text-center text-gray-500 py-12">
                        Your cart is empty
                    </div>
                </div>
            </div>

            <div class="border-t p-6 bg-white">
                <div class="flex justify-between mb-4 font-bold">
                    <span>Total:</span>
                    <span class="text-primary">Ksh<span id="cart-total">0.00</span></span>
                </div>
                <a href="/checkout" class="checkout-btn w-full bg-primary text-white py-3 rounded-lg hover:bg-opacity-90 transition-colors flex items-center justify-center">
                    Proceed to Checkout
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartPreview = document.querySelector('.cart-preview');
            const cartItemsContainer = document.querySelector('.cart-items');
            const emptyCartMessage = document.querySelector('.empty-cart');

            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productCard = this.closest('.merch-card');
                    const product = {
                        name: productCard.querySelector('h3').textContent,
                        price: parseFloat(productCard.querySelector('span.text-primary').textContent.replace('Ksh', '')),
                        image: productCard.querySelector('img').src,
                        quantity: 1
                    };

                    const existingItem = cart.find(item => item.name === product.name);
                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        cart.push(product);
                    }

                    updateCartDisplay();
                    cartPreview.classList.add('open');
                    localStorage.setItem('cart', JSON.stringify(cart));
                });
            });

            // Cart management functions
            function updateCartDisplay() {
                cartItemsContainer.innerHTML = '';
                let total = 0;

                if (cart.length === 0) {
                    emptyCartMessage.classList.remove('hidden');
                } else {
                    emptyCartMessage.classList.add('hidden');
                    cart.forEach((item, index) => {
                        total += item.price * item.quantity;
                        const cartItem = document.createElement('div');
                        cartItem.className = 'cart-item flex gap-4 items-center';
                        cartItem.innerHTML = `
                            <img src="${item.image}" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <div class="font-medium">${item.name}</div>
                                <div class="text-sm text-gray-500">Quantity: ${item.quantity}</div>
                                <div class="text-primary font-bold">Ksh${(item.price * item.quantity).toFixed(2)}</div>
                            </div>
                            <button class="remove-item text-gray-400 hover:text-primary" data-index="${index}">
                                &times;
                            </button>
                        `;
                        cartItemsContainer.appendChild(cartItem);
                    });
                }

                document.getElementById('cart-count').textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
                document.getElementById('cart-total').textContent = total.toFixed(2);
            }

            // Remove item from cart
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    const index = parseInt(e.target.dataset.index);
                    cart.splice(index, 1);
                    updateCartDisplay();
                    localStorage.setItem('cart', JSON.stringify(cart));
                }
            });

            // Category filtering
            document.querySelectorAll('.category-filter').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    document.querySelectorAll('.merch-card').forEach(card => {
                        card.style.display = category === 'all' || card.dataset.category === category ? 'block' : 'none';
                    });

                    document.querySelectorAll('.category-filter').forEach(btn =>
                        btn.classList.remove('active', 'bg-primary', 'text-white')
                    );
                    this.classList.add('active', 'bg-primary', 'text-white');
                });
            });

            // Close cart
            document.querySelector('.close-cart').addEventListener('click', () => {
                cartPreview.classList.remove('open');
            });

            // Initialize cart display
            updateCartDisplay();
        });
    </script>


<script>
  function shareProduct(productName, productUrl) {
    if (navigator.share) {
      navigator.share({
        title: productName,
        text: 'Check out this amazing product: ' + productName,
        url: productUrl,
      })
        .then(() => console.log('Successful share'))
        .catch((error) => console.log('Error sharing:', error));
    } else {
      // Fallback for browsers that don't support the Web Share API
      const tempInput = document.createElement('input');
      document.body.appendChild(tempInput);
      tempInput.value = productUrl;
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);

      // Show a temporary message that URL was copied
      const message = document.createElement('div');
      message.textContent = 'Link copied to clipboard!';
      message.style.position = 'fixed';
      message.style.bottom = '20px';
      message.style.left = '50%';
      message.style.transform = 'translateX(-50%)';
      message.style.padding = '10px 20px';
      message.style.backgroundColor = 'rgba(0,0,0,0.8)';
      message.style.color = 'white';
      message.style.borderRadius = '5px';
      message.style.zIndex = '9999';

      document.body.appendChild(message);

      setTimeout(() => {
        document.body.removeChild(message);
      }, 3000);
    }
  }
</script>


    @include('layouts.footer')
</body>
</html>
