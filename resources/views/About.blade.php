<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        :root {
            --primary-color: #FF6B01; /* Vibrant Orange */
            --primary-light: #FFA726;
            --secondary-color: #FFFFFF;
            --text-color: #333333;
            --background-color: #FFFAF0; /* Soft Cream */
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.7;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Animated Header */
        .about-header {
            position: relative;
            background: url('/images/large-group-fans-with-arms-raised-having-fun-music-concert-night(1).jpg') bottom/cover no-repeat;
            color: var(--secondary-color);
            text-align: center;
            padding: 8rem 2rem;
            overflow: hidden;
        }

        .header-waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            animation: wave 10s linear infinite;
        }

        @keyframes wave {
            0% { transform: translateX(0); }
            50% { transform: translateX(-50px); }
            100% { transform: translateX(0); }
        }

        .about-header h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            font-weight: 700;
            position: relative;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .about-header p {
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.2rem;
            opacity: 0;
            animation: fadeIn 1s forwards 0.5s;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* Mission Section */
        .mission-section {
            padding: 6rem 0;
            background-color: var(--secondary-color);
        }

        .mission-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .mission-card {
            background-color: var(--secondary-color);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: var(--transition);
            border-top: 5px solid var(--primary-color);
            transform: perspective(1000px);
        }

        .mission-card:hover {
            transform:
                perspective(1000px)
                rotateX(10deg)
                translateY(-15px)
                scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .mission-card-icon {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .mission-card h3 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: var(--primary-color);
            transition: color 0.3s ease;
        }

        .mission-card:hover h3 {
            color: #FF4500;
        }

        /* Values Section */
        .values-section {
            background-color: var(--background-color);
            padding: 6rem 0;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .value-item {
            background-color: var(--secondary-color);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            transition: var(--transition);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .value-item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(
                circle at center,
                rgba(255,107,1,0.1) 0%,
                transparent 70%
            );
            transform: rotate(-45deg);
            transition: transform 0.6s ease;
        }

        .value-item:hover::before {
            transform: rotate(0deg);
        }

        .value-item:hover {
            transform: translateY(-15px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .value-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .value-item:hover .value-icon {
            transform: rotate(360deg);
        }

        @media (max-width: 768px) {
            .about-header h1 {
                font-size: 2.5rem;
            }
        }

         /* Story Section Styles */
    .story-section {
        padding: 8rem 0;
        background-color: var(--secondary-color);
    }

    .story-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .story-header h2 {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .accent-line {
        height: 5px;
        width: 80px;
        background-color: var(--primary-color);
        margin: 0 auto;
        border-radius: 5px;
    }

    .story-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
    }

    .story-image {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .story-image img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .story-image:hover img {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: var(--primary-color);
        color: var(--secondary-color);
        padding: 15px;
        border-top-left-radius: 15px;
    }

    .image-overlay span {
        font-size: 2rem;
    }

    .story-text h3 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
    }

    .story-text p {
        margin-bottom: 1.5rem;
    }

    .btn-primary {
        display: inline-block;
        padding: 12px 28px;
        background-color: var(--primary-color);
        color: var(--secondary-color);
        text-decoration: none;
        border-radius: 30px;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: 0 5px 15px rgba(255,107,1,0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-light);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255,107,1,0.4);
    }

    /* Vision Banner */
    .vision-banner {
        position: relative;
        padding: 6rem 0;
        background: url('/api/placeholder/1920/600') center/cover fixed;
        color: var(--secondary-color);
        text-align: center;
    }

    .vision-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,107,1,0.9) 0%, rgba(255,69,0,0.8) 100%);
    }

    .vision-content {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .vision-content h2 {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
    }

    .vision-content p {
        font-size: 1.5rem;
        line-height: 1.6;
    }

    /* Impact Section */
    .impact-section {
        padding: 6rem 0;
        background-color: var(--background-color);
    }

    .impact-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .impact-header h2 {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .impact-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
    }

    .stat-card {
        background-color: var(--secondary-color);
        padding: 2.5rem 1.5rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: var(--transition);
        transform-style: preserve-3d;
    }

    .stat-card:hover {
        transform: translateY(-15px) rotateY(10deg);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-color);
        font-weight: 600;
    }

    /* Gallery Section */
    .gallery-section {
        padding: 6rem 0;
        background-color: var(--secondary-color);
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .gallery-header h2 {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .gallery-header p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 1rem auto 0;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .gallery-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: var(--transition);
    }

    .gallery-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 15px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: var(--secondary-color);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-caption {
        font-size: 1rem;
        font-weight: 600;
    }

    .gallery-cta {
        text-align: center;
    }

    /* Banner */
    .team-banner {
        padding: 5rem 0;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--secondary-color);
        text-align: center;
        margin-top: 6rem;
    }

    .banner-content h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .banner-content p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-cta {
        display: inline-block;
        padding: 15px 35px;
        background-color: var(--secondary-color);
        color: var(--primary-color);
        text-decoration: none;
        border-radius: 30px;
        font-weight: 700;
        transition: var(--transition);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        background-color: #f8f8f8;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .story-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .story-image {
            max-width: 600px;
            margin: 0 auto;
        }

        .vision-content h2 {
            font-size: 3rem;
        }

        .vision-content p {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 768px) {
        .story-section,
        .impact-section,
        .gallery-section {
            padding: 4rem 0;
        }

        .story-header h2,
        .impact-header h2,
        .gallery-header h2 {
            font-size: 2.5rem;
        }

        .story-text h3 {
            font-size: 1.5rem;
        }

        .vision-content h2 {
            font-size: 2.5rem;
        }

        .vision-content p {
            font-size: 1.1rem;
        }

        .stat-card {
            padding: 2rem 1rem;
        }

        .stat-number {
            font-size: 2rem;
        }
    }
    </style>
</head>
<body x-data x-init="AOS.init({ duration: 1000, once: true })">
    @include ('layouts.navigation')
    <header class="about-header">
        <div class="header-waves"></div>
        <div class="container">
            <h1 data-aos="zoom-in">Sounds of Worship</h1>
            <p data-aos="fade-up" data-aos-delay="300">Unleashing passionate worship through vibrant music, creating electrifying moments of spiritual connection that ignite hearts and transform lives!</p>
        </div>
    </header>


    <div class="story-section">
    <div class="container">
        <div class="story-header" data-aos="fade-up">
            <h2>Our Story</h2>
            <div class="accent-line"></div>
        </div>

        <div class="story-content">
            <div class="story-image" data-aos="fade-right">
                <img src="/images/DKN00648.jpg" alt="Worship team leading a service" />
                <div class="image-overlay">
                    <span class="mdi mdi-heart-pulse"></span>
                </div>
            </div>

            <div class="story-text" data-aos="fade-left">
                <h3>From Humble Beginnings to Spiritual Revolution</h3>
                <p>Sounds of Worship began in 2015 when a small group of passionate musicians gathered in a living room with one shared vision: to revolutionize worship through music that ignites the soul. What started as intimate jam sessions soon evolved into a movement that has touched thousands of lives across the country.</p>
                <p>Our journey hasn't been without challenges, but each obstacle has only strengthened our resolve to create worship experiences that break through religious formality and connect hearts directly to the divine presence. From our first public gathering of just 30 people to now leading thousands in explosive praise, we've remained true to our calling: unleashing worship that transforms.</p>
                <a href="#" class="btn-primary">Learn More</a>
            </div>
        </div>
    </div>
</div>

<div class="vision-banner">
    <div class="vision-overlay"></div>
    <div class="container">
        <div class="vision-content" data-aos="zoom-in">
            <h2>Our Vision</h2>
            <p>To ignite a global worship revolution that breaks traditional barriers, releases spiritual freedom, and transforms communities through the raw power of authentic praise.</p>
        </div>
    </div>
</div>

<div class="impact-section">
    <div class="container">
        <div class="impact-header" data-aos="fade-up">
            <h2>Our Impact</h2>
            <div class="accent-line"></div>
        </div>

        <div class="impact-stats">
            <div class="stat-card" data-aos="flip-up">
                <div class="stat-number">150+</div>
                <div class="stat-label">Worship Events</div>
            </div>

            <div class="stat-card" data-aos="flip-up" data-aos-delay="100">
                <div class="stat-number">20,000+</div>
                <div class="stat-label">Lives Touched</div>
            </div>

            <div class="stat-card" data-aos="flip-up" data-aos-delay="200">
                <div class="stat-number">12</div>
                <div class="stat-label">Original Albums</div>
            </div>

            <div class="stat-card" data-aos="flip-up" data-aos-delay="300">
                <div class="stat-number">30+</div>
                <div class="stat-label">Partner Churches</div>
            </div>
        </div>
    </div>
</div>

<div class="gallery-section">
    <div class="container">
        <div class="gallery-header" data-aos="fade-up">
            <h2>Gallery</h2>
            <div class="accent-line"></div>
            <p>Glimpses of transformation through worship</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item" data-aos="fade-up">
                <img src="/images/large-group-fans-with-arms-raised-having-fun-music-concert-night(1).jpg" alt="Worship moment" />
                <div class="gallery-overlay">
                    <div class="gallery-caption">Summer Revival 2023</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                <img src="/images/large-group-fans-with-arms-raised-having-fun-music-concert-night(1).jpg" alt="Concert crowd" />
                <div class="gallery-overlay">
                    <div class="gallery-caption">Praise Explosion Conference</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="200">
                <img src="/images/large-group-fans-with-arms-raised-having-fun-music-concert-night(1).jpg" alt="Worship band performing" />
                <div class="gallery-overlay">
                    <div class="gallery-caption">Backstage Worship Session</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                <img src="/images/large-group-fans-with-arms-raised-having-fun-music-concert-night(1).jpg" alt="Hands raised in worship" />
                <div class="gallery-overlay">
                    <div class="gallery-caption">Breakthrough Moment</div>
                </div>
            </div>
        </div>

        <div class="gallery-cta" data-aos="fade-up">
            <a href="#" class="btn-primary">View Full Gallery</a>
        </div>
    </div>
</div>

<div class="team-banner">
    <div class="container">
        <div class="banner-content" data-aos="fade-up">
            <h2>Join the Movement</h2>
            <p>Experience worship that breaks barriers and transforms lives</p>
            <a href="#" class="btn-cta">Connect With Us</a>
        </div>
    </div>
</div>

    @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>
</html>
