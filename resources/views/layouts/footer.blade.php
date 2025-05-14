<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer - Sounds of Worship</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <style>
        /* Base styles */
        * {
            font-family: 'Futura LT', sans-serif;            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        footer {
            background: #fff;
            color: #2d2d2d;
            padding: 6rem 2rem 2rem;
            position: relative;
            overflow: hidden;
            border-top: 3px solid #FF6B35;
            background-image: linear-gradient(45deg, #fff3e610 25%, transparent 25%, transparent 75%, #fff3e610 75%),
                            linear-gradient(-45deg, #fff3e610 25%, transparent 25%, transparent 75%, #fff3e610 75%);
            background-size: 40px 40px;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .footer-section {
            padding: 1.5rem;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .footer-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .footer-section h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #FF6B35;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #FF6B35, #FF4500);
        }

        .footer-section p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: #666;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .footer-section a:hover {
            color: #FF6B35;
            background: rgba(255, 107, 53, 0.05);
            transform: translateX(10px);
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-icons a {
            width: 45px;
            height: 45px;
            background: #FF6B35;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .social-icons a::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #FF6B35, #FF4500);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .social-icons a:hover {
            transform: rotate(5deg) scale(1.1);
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .social-icons a:hover::before {
            opacity: 1;
        }

        .social-icons i {
            color: white;
            font-size: 1.4rem;
            position: relative;
            z-index: 1;
        }

        .copyright {
            margin-top: 4rem;
            text-align: center;
            padding: 2rem 0 0;
            border-top: 1px solid rgba(255, 107, 53, 0.1);
            position: relative;
            color: #888;
        }

        .copyright::before {
            content: '🎵';
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.5rem;
            opacity: 0.3;
        }

        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-section h3 {
                justify-content: center;
            }

            .footer-section h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .footer-section a {
                justify-content: center;
            }

            .social-icons {
                justify-content: center;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-container">
            <!-- About Us -->
            <div class="footer-section">
                <h3><i class="mdi mdi-music-clef-treble"></i>Our Worship</h3>
                <p>
                    Creating transformative worship experiences through spirit-led music.
                    Join us in raising a new sound of praise that touches heaven and changes earth.
                </p>
                <div class="social-icons">
                    <a href="#"><i class="mdi mdi-facebook"></i></a>
                    <a href="#"><i class="mdi mdi-youtube"></i></a>
                    <a href="#"><i class="mdi mdi-spotify"></i></a>
                    <a href="#"><i class="mdi mdi-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h3><i class="mdi mdi-heart-multiple"></i>Quick Links</h3>
                <ul>
                    <li><a href="/live"><i class="mdi mdi-broadcast"></i>Live Stream</a></li>
                    <li><a href="/music"><i class="mdi mdi-music-box-multiple"></i>Music Library</a></li>
                    <li><a href="/events"><i class="mdi mdi-calendar-star"></i>Events</a></li>
                    <li><a href="/media"><i class="mdi mdi-video-4k-box"></i>Media</a></li>
                    <li><a href="/contact"><i class="mdi mdi-hand-heart"></i>Prayer Requests</a></li>
                </ul>
            </div>

            <!-- Contact Us -->
            <div class="footer-section">
                <h3><i class="mdi mdi-account-group"></i>Connect</h3>
                <p><a href="mailto:praise@soundsofworship.com"><i class="mdi mdi-email"></i>praise@soundsofworship.com</a></p>
                <p><a href="tel:+15551234567"><i class="mdi mdi-phone"></i>(555) 123-4567</a></p>
                <p><i class="mdi mdi-map-marker"></i>123 Worship Way, Heaven City</p>
                <p><i class="mdi mdi-clock-time-three"></i>Office Hours: Mon-Fri 9AM-5PM</p>
            </div>
        </div>

        <div class="copyright">
            &copy; 2024 Sounds of Worship. All rights reserved.<br>
            <small>Making a joyful noise unto the Lord</small>
        </div>
    </footer>

    <script>
        // Scroll Animation Trigger
        const sections = document.querySelectorAll('.footer-section');

        const checkVisibility = () => {
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (sectionTop < windowHeight * 0.85) {
                    section.classList.add('visible');
                }
            });
        };

        window.addEventListener('scroll', checkVisibility);
        window.addEventListener('load', checkVisibility);
    </script>
</body>
</html>
