<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Posts - Andresta Akbar Adha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #f3f4f6, #e5e7eb);
            font-family: 'Inter', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            background: white;
        }
        .btn-success {
            background-color: #10b981;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #059669;
        }
        .btn-primary, .btn-danger {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
        }
        img.rounded {
            object-fit: cover;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Posts</h2>
                        <a href="{{ route('posts.create') }}" class="btn btn-success">Tambah Post</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600">Gambar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600">Konten</th>
                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-center">
                                            <img src="{{ Storage::url('public/posts/').$post->image }}" class="rounded" style="width: 120px; height: 80px;">
                                        </td>
                                        <td class="px-6 py-4 text-gray-800">{{ $post->title }}</td>
                                        <td class="px-6 py-4 text-gray-600">{!! Str::limit(strip_tags($post->content), 100) !!}</td>
                                        <td class="px-6 py-4 text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-danger">Data Post belum Tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'Berhasil!', { timeOut: 3000 });
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'Gagal!', { timeOut: 3000 });
        @endif
    </script>
</body>
</html>