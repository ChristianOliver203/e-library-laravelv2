<!DOCTYPE html>
<html>
<head>
    <title>Borrow a Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">📘 Borrow a Book</h2>

    <!-- Back button now goes to book list -->
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

    <form method="POST" action="{{ route('borrow.add') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Your Name</label>
            <input type="text" name="borrower" class="form-control" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Book</label>
            <select name="book_id" class="form-select" required>
                <option value="">-- Choose a Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}"
                        @if(isset($book_id) && $book_id == $book->id) selected @endif>
                        {{ $book->title }} by {{ $book->author }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">Borrow Book</button>
    </form>
</div>
</body>
</html>
