<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">📚 Book List</h2>

    {{-- Admin buttons --}}
    @if(session('is_admin'))
        <a href="{{ route('book.addform') }}" class="btn btn-success mb-3">➕ Add Book</a>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger mb-3">🚪 Logout</a>
    @else
        <a href="{{ route('admin.login') }}" class="btn btn-primary mb-3">🔑 Admin Login</a>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">🏠 Back to Home</a>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($books->isEmpty())
        <p>No books found.</p>
    @else
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        @if($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" class="card-img-top" style="height:250px; object-fit:cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ $book->author }}</p>

                            {{-- Non-admin: Borrow form --}}
                            @if(!session('is_admin'))
                                <a href="{{ route('borrow.addform', ['book_id' => $book->id]) }}" class="btn btn-success btn-sm w-100 mb-2">
                                    📖 Borrow
                                </a>
                            @endif

                            {{-- Admin actions --}}
                            @if(session('is_admin'))
                                <a href="{{ route('book.editform', $book->id) }}" class="btn btn-primary btn-sm mb-1 w-100">✏️ Edit</a>
                                <a href="{{ route('book.delete', $book->id) }}" class="btn btn-danger btn-sm w-100"
                                   onclick="return confirm('Are you sure you want to delete this book?');">🗑 Delete</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
