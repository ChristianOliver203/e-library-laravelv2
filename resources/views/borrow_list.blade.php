<!DOCTYPE html>
<html>
<head>
    <title>Borrow Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">📖 Borrow Records</h2>

    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">🏠 Back to Home</a>
    <a href="{{ route('borrow.addform') }}" class="btn btn-success mb-3">➕ Borrow a Book</a>

    {{-- Success/Error messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($borrows->isEmpty())
        <p>No borrow records found.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Borrower</th>
                    <th>Borrow Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrows as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->book->title }}</td>
                        <td>{{ $borrow->book->author }}</td>
                        <td>{{ $borrow->borrower }}</td>
                        <td>{{ $borrow->borrow_date }}</td>
                        <td>
                            @if($borrow->status == 'Borrowed')
                                <span class="badge bg-warning text-dark">Borrowed</span>
                            @else
                                <span class="badge bg-success">Returned</span>
                            @endif
                        </td>
                        <td>
                            @if($borrow->status == 'Borrowed')
                                <a href="{{ route('borrow.return', $borrow->id) }}" class="btn btn-sm btn-primary"
                                   onclick="return confirm('Mark this book as returned?');">Return</a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
