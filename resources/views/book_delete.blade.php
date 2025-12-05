@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Delete Book (Admin Only)</h2>
    <p>Are you sure you want to delete the book: <strong>{{ $book->title }}</strong> by {{ $book->author }}?</p>

    <form method="POST" action="{{ route('book.delete', $book->id) }}">
        @csrf
        <button type="submit" style="background:red;color:white;">Yes, Delete</button>
        <a href="{{ route('book.list') }}">Cancel</a>
    </form>
</div>
@endsection
