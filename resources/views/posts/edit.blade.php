<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Post - Andresta Akbar Adha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #f3f4f6, #e5e7eb);
            font-family: 'Inter', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .btn-primary, .btn-warning {
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #3b82f6;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .btn-warning {
            background-color: #f59e0b;
            border: none;
        }
        .btn-warning:hover {
            background-color: #d97706;
        }
        label {
            font-weight: 600;
            color: #374151;
        }
        .image-preview {
            max-width: 200px;
            height: auto;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            object-fit: cover;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Post</h2>
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block mb-2">Gambar</label>
                            @if($post->image)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600">Gambar Saat Ini:</p>
                                    <img src="{{ Storage::url('public/posts/').$post->image }}" alt="Current Image" class="image-preview">
                                </div>
                            @else
                                <p class="text-sm text-gray-600 mb-3">Tidak ada gambar saat ini.</p>
                            @endif
                            <input type="file" class="form-control" name="image" id="imageInput" accept="image/*">
                            <div class="mt-3">
                                <p class="text-sm text-gray-600">Pratinjau Gambar Baru:</p>
                                <img id="imagePreview" class="image-preview" style="display: none;">
                            </div>
                            @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Masukkan Judul Post">
                            @error('title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2">Konten</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="6" placeholder="Masukkan Konten Post">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            height: 300,
            toolbar: 'Standard'
        });

        // Image preview functionality
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        });
    </script>
</body>
</html>