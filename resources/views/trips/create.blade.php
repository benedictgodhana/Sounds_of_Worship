<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Trip</title>
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
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }

        input, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.25rem;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid">
            <h1>Create Trip</h1>
            <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>

                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" required></textarea>

                <label for="image">Image</label>
                <input type="file" name="image" id="image">

                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" required>

                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" required>

                <button type="submit">Create Trip</button>
            </form>
        </div>
    </x-app-layout>
</body>
</html>
