<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $experience->title }} - GlobeStitch experiences</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.js" defer></script>
    <style>
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: #1F2937;
            line-height: 1.6;
        }

        .experience-header {
            position: relative;
            text-align: center;
            padding: 8rem 1rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('{{ asset("storage/" . $experience->image) }}') center/cover no-repeat;
            color: white;
        }

        .experience-content {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 2rem;
            background: white;
            border-radius: 15px;
            padding: 2rem;
        }

        .experience-title {
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1rem;
        }

        .experience-meta {
            text-align: center;
            color: #6B7280;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .experience-meta span {
            margin-right: 10px;
        }

        .experience-body {
            font-size: 1.2rem;
            color: #374151;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 2rem;
            font-weight: 600;
            color: #3B82F6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: green;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <header class="experience-header">
        <h1 class="experience-title">{{ $experience->title }}</h1>
    </header>

    <section class="experience-content">
        <p class="experience-meta">
            <span>{{ \Carbon\Carbon::parse($experience->created_at)->format('F d, Y') }}</span>
        </p>

        <div class="experience-body">
            {!! nl2br(e($experience->description)) !!}
        </div>

        <a href="/experience" class="back-link">← Back to experiences</a>
    </section>

    @include('layouts.footer')
</body>
</html>
