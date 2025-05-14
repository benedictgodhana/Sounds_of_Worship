<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sounds of Worship</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.js" defer></script>
    <style>
        :root {
            --primary-color:orangered   ; /* Warm gold */
            --secondary-color: #483D8B; /* Deep purple */
            --text-color: #2D3748;
            --light-gray: #F3F4F6;
            --transition: all 0.3s ease;
        }

        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: var(--text-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .blog-header {
            position: relative;
            text-align: center;
            padding: 8rem 1rem;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/worship_header.jpg') center/cover no-repeat;
            color: white;
            overflow: hidden;
        }

        .blog-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(140, 109, 63, 0.6), rgba(72, 61, 139, 0.7));
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-title {
            font-size: 3.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header-subtitle {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .blog-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            position: relative;
            border: 1px solid #f0f0f0;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .blog-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: var(--transition);
        }

        .blog-card:hover img {
            transform: scale(1.05);
        }

        .blog-content {
            padding: 2rem;
        }

        .blog-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 2;
        }

        .blog-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-color);
            line-height: 1.3;
        }

        .blog-description {
            color: #6B7280;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .blog-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--light-gray);
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            gap: 0.5rem;
        }

        .read-more:hover {
            color: var(--secondary-color);
            gap: 0.75rem;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #6B7280;
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 2.5rem;
            }

            .blog-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }

            .blog-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <header class="blog-header">
        <div class="header-content">
            <h1 class="header-title">Sounds of Worship</h1>
            <p class="header-subtitle">Discover inspirational music, worship resources, and spiritual insights from around the world.</p>
        </div>
    </header>
    <section>
    <div class="blog-grid">
        @foreach ($blogs as $blog)
            <article class="blog-card">
                <span class="blog-category">{{ $blog->category }}</span>
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                <div class="blog-content">
                    <h3 class="blog-title">{{ $blog->title }}</h3>
                    <p class="blog-description">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                    <div class="blog-footer">
                        <a href="{{ route('blogs.showBlog', $blog->id) }}" class="read-more">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <div class="blog-meta">
                            <span class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $blog->reading_time }} min read
                            </span>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
    @include('layouts.footer')
</body>
</html>
