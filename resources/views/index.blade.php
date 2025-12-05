<!DOCTYPE html>
<html>
<head>
    <title>E-Library Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5 text-center">
    <h1 class="mb-4">📖 Welcome to the E-Library System</h1>
    <p class="lead mb-5">Manage books and borrowing records — all in one place.</p>

    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">📚 Book Management</h3>
                    <a href="{{ route('book.list') }}" class="btn btn-primary w-100">Go to Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">📘 Borrowed Books</h3>
                    <a href="{{ route('borrow.list') }}" class="btn btn-warning w-100">Go to Borrow Records</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
