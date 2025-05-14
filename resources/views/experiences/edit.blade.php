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

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: 600;
            color: var(--secondary-color);
        }

        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.25rem;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: background 0.3s ease;
        }

        .button:hover {
            background-color: #4338ca;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            text-align: center;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid">
            <h1>Edit Experience</h1>

            @if ($errors->any())
                <div style="color: red; margin-bottom: 1rem;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $experience->title }}" required>

                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select a category</option>
                    <option value="Adventure" {{ $experience->category == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                    <option value="Education" {{ $experience->category == 'Education' ? 'selected' : '' }}>Education</option>
                    <option value="Work" {{ $experience->category == 'Work' ? 'selected' : '' }}>Work</option>
                    <option value="Travel" {{ $experience->category == 'Travel' ? 'selected' : '' }}>Travel</option>
                </select>

                <label for="description">Description</label>
                <textarea name="description" id="description" required>{{ $experience->description }}</textarea>

                <label for="image">Image</label>
<input type="file" name="image" id="image" accept="image/*">

@if ($experience->image)
    <div class="image-container">
        <img src="{{ asset('storage/' . $experience->image) }}" alt="Experience Image" style="max-width: 300px; max-height: 200px; border-radius: 0.5rem;">
    </div>
@endif

                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active" {{ $experience->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ $experience->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="inactive" {{ $experience->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="button">Update</button>
            </form>

            <a href="{{ route('experiences.index') }}" class="back-link">← Back to Experiences</a>
        </div>
    </x-app-layout>
</body>
</html>
