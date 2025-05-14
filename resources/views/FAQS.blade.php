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
            --primary-color: #34D399;
            --secondary-color: #3B82F6;
            --text-color: #1F2937;
            --light-gray: #F3F4F6;
            --transition: all 0.5s ease-in-out;
        }

        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: var(--text-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .faq-header {
            text-align: center;
            padding: 8rem 1rem;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/3d-tropical-palm-tree-island.jpg') center/cover no-repeat;
            color: white;
            overflow: hidden;
            position: relative;
        }

        .faq-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(5, 150, 105, 0.6), rgba(37, 99, 235, 0.6));
            z-index: 1;
        }

        .header-title {
            font-size: 3.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .header-subtitle {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .header-content {
            position: relative;
            z-index: 2;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .faq-content {
            max-width: 1000px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .faq-categories {
    display: flex;
    flex-wrap: wrap; /* Ensures buttons wrap if the screen is small */
    gap: 10px; /* Adds spacing between buttons */
    justify-content: center; /* Centers buttons horizontally */
    padding: 10px;
    border-radius: 8px;
}

.category-btn {
    flex: 1; /* Ensures equal spacing between buttons */
    min-width: 120px; /* Prevents buttons from getting too small */
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    background: #ddd;
    border-radius: 5px;
    transition: 0.3s;
    text-align: center;
}

        .category-btn:hover, .category-btn.active {
            background-color: var(--primary-color);
            color: white;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .faq-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
        }

        .faq-question {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
        }

        .faq-question:hover {
            background-color: var(--light-gray);
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: var(--transition);
            color: black;
        }

        .faq-answer.open {
            padding: 1.5rem;
            max-height: 500px;
            border-top: 1px solid var(--light-gray);
        }

        .faq-toggle {
            transition: var(--transition);
        }

        .faq-toggle.open {
            transform: rotate(45deg);
        }

        .contact-section {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--light-gray);
        }

        .contact-section h2 {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .contact-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .contact-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-5px);
        }

        /* Category Content */
        .category-content {
            display: none;
        }

        .category-content.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 2.5rem;
            }
            .faq-categories {
                gap: 0.5rem;
            }
            .category-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation will be included here -->
    @include('layouts.navigation')

    <header class="faq-header">
        <div class="header-content">
            <h1 class="header-title">Frequently Asked Questions</h1>
            <p class="header-subtitle">Find answers to common questions about our tours, retreats, and travel experiences.</p>
        </div>
    </header>

    <section class="faq-content">
    <div x-data="{ activeCategory: 'general', openQuestion: null }">
    <div class="faq-categories">
                <button class="category-btn" :class="{ 'active': activeCategory === 'general' }" @click="activeCategory = 'general'">General</button>
                <button class="category-btn" :class="{ 'active': activeCategory === 'retreats' }" @click="activeCategory = 'retreats'">Retreats & Wellness</button>
                <button class="category-btn" :class="{ 'active': activeCategory === 'sports' }" @click="activeCategory = 'sports'">Sports Travel</button>
                <button class="category-btn" :class="{ 'active': activeCategory === 'safaris' }" @click="activeCategory = 'safaris'">Safaris & Adventure</button>
                <button class="category-btn" :class="{ 'active': activeCategory === 'nightlife' }" @click="activeCategory = 'nightlife'">Nightlife & Fun</button>
                <button class="category-btn" :class="{ 'active': activeCategory === 'payments' }" @click="activeCategory = 'payments'">Payments & Policies</button>
            </div>
        <!-- General Questions -->
        <div class="category-content" :class="{ 'active': activeCategory === 'general' }">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 1 ? null : 1">
                        <span>What is Globestitch?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 1 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 1 }">
                        <p>Globestitch is a tour company that curates wellness retreats, sports travel packages, safaris, and nightlife experiences, helping you explore, heal, and enjoy life's adventures.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 2 ? null : 2">
                        <span>How do I book a trip or retreat with Globestitch?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 2 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 2 }">
                        <p>You can book directly through our website, contact us via email or social media, or fill out our inquiry form for customized experiences.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Retreats & Wellness Travel -->
        <div class="category-content" :class="{ 'active': activeCategory === 'retreats' }">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 3 ? null : 3">
                        <span>What can I expect from a Globestitch retreat?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 3 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 3 }">
                        <p>Our retreats focus on mental wellness, yoga, meditation, and holistic healing, set in peaceful nature destinations. They include guided sessions, nutritious meals, and relaxation activities.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 4 ? null : 4">
                        <span>Do I need yoga experience to join a retreat?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 4 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 4 }">
                        <p>Not at all! Our retreats cater to all levels, from beginners to experienced yogis.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 5 ? null : 5">
                        <span>Are the retreats open to solo travelers?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 5 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 5 }">
                        <p>Yes! Many of our guests come alone and leave with new connections.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sports Travel -->
        <div class="category-content" :class="{ 'active': activeCategory === 'sports' }">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 6 ? null : 6">
                        <span>What sports experiences does Globestitch offer?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 6 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 6 }">
                        <p>We provide tailor-made sports travel packages, including football, Formula 1, tennis, and rugby tours in partnership with Sportsbreaks.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 7 ? null : 7">
                        <span>Do sports packages include match tickets?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 7 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 7 }">
                        <p>Yes! Our packages typically include tickets, accommodation, and exclusive fan experiences.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 8 ? null : 8">
                        <span>Can I customize my sports travel package?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 8 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 8 }">
                        <p>Absolutely! Let us know your preferences, and we'll tailor an experience for you.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Safaris & Adventure Travel -->
        <div class="category-content" :class="{ 'active': activeCategory === 'safaris' }">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 9 ? null : 9">
                        <span>What safari destinations do you offer?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 9 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 9 }">
                        <p>We organize safaris to Kenya's top wildlife destinations, including the Maasai Mara, Amboseli, Tsavo, and more.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 10 ? null : 10">
                        <span>Do you offer private or group safaris?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 10 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 10 }">
                        <p>Both! Whether you prefer a private luxury safari or a budget-friendly group tour, we've got options for you.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nightlife & Fun Travel -->
        <div class="category-content" :class="{ 'active': activeCategory === 'nightlife' }">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 11 ? null : 11">
                        <span>Which destinations do you offer for nightlife trips?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 11 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 11 }">
                        <p>We arrange nightlife and party experiences in destinations like Ibiza, Santorini, Dubai, and Bangkok.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 12 ? null : 12">
                        <span>Do you offer VIP access to clubs and events?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 12 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 12 }">
                        <p>Yes! Our packages can include VIP entry, table reservations, and private party experiences.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payments & Policies -->
        <div class="category-content" :class="{ 'active': activeCategory === 'payments' }">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 13 ? null : 13">
                        <span>What payment methods do you accept?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 13 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 13 }">
                        <p>We accept mobile money (M-Pesa), bank transfers, and credit/debit cards.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 14 ? null : 14">
                        <span>Do you offer payment plans?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 14 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 14 }">
                        <p>Yes! We provide flexible installment payment options for certain trips.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" @click="openQuestion = openQuestion === 15 ? null : 15">
                        <span>What is your cancellation policy?</span>
                        <span class="faq-toggle" :class="{ 'open': openQuestion === 15 }">+</span>
                    </div>
                    <div class="faq-answer" :class="{ 'open': openQuestion === 15 }">
                        <p>Our policy depends on the trip. Please check the specific package details or contact us for more info.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="contact-section">
        <h2>Still Have Questions?</h2>
        <p>Our friendly team is here to help with any additional questions you might have about our tours or services.</p>
        <a href="/contact" class="contact-btn">Contact Us</a>
    </section>

    <!-- Footer will be included here -->
    @include('layouts.footer')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Alpine.js handles most of our interactions
        });
    </script>
</body>
</html>
