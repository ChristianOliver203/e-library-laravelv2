<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">✏️ Edit Book</h2>
    <a href="{{ route('book.list') }}" class="btn btn-secondary mb-3">⬅ Back to Book List</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('book.update', $book->id) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Book Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Book</button>
    </form>
</div>
</body>
</html>
