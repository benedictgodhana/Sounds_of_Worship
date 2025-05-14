<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6b7280;
            --background-color: #f9fafb;
            --card-background: #ffffff;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            padding: 2rem;
            max-width: 600px;
            margin: auto;
            background-color: var(--card-background);
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .info {
            margin-bottom: 1rem;
            font-size: 1rem;
            color: var(--secondary-color);
        }

        .image-container {
            text-align: center;
            margin-bottom: 1rem;
        }

        .image-container img {
            width: 100%;
            max-height: 300px; /* Set max height */
            height: auto;
            border-radius: 0.5rem;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            object-fit: cover; /* Ensure image scales properly */
        }

        .status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .status-active {
            color: green;
        }

        .status-pending {
            color: orange;
        }

        .status-inactive {
            color: red;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            text-align: center;
        }

        .cta-button {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 0.25rem;
            text-decoration: none;
            margin-top: 1rem;
            transition: background 0.3s ease;
        }

        .cta-button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid">
            <h1>{{ $experience->title }}</h1>

            <div class="image-container">
                @if ($experience->image)
                    <img src="{{ asset('storage/' . $experience->image) }}" alt="Experience Image">
                @else
                    <p>No Image Available</p>
                @endif
            </div>

            <p class="info"><strong>Category:</strong> {{ $experience->category }}</p>
            <p class="info"><strong>Description:</strong> {{ $experience->description }}</p>
            <p class="info"><strong>Created By:</strong> {{ $experience->creator->name ?? 'Unknown' }}</p>
            <p class="info"><strong>Date:</strong> {{ $experience->created_at->format('Y-m-d') }}</p>
            <p class="info"><strong>Status:</strong>
                <span class="status {{ 'status-' . strtolower($experience->status) }}">{{ ucfirst($experience->status) }}</span>
            </p>

            @if ($experience->cta_link)
                <a href="{{ $experience->cta_link }}" class="cta-button" target="_blank">
                    {{ $experience->cta_text ?? 'Learn More' }}
                </a>
            @endif

            <a href="{{ route('experiences.index') }}" class="back-link">← Back to Experiences</a>
        </div>
    </x-app-layout>
</body>
</html>
