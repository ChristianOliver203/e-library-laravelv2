<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BorrowController extends Controller
{
    // List all borrowed books
    public function borrowlist(Request $request)
    {
        $borrows = Borrow::all(); // fetch all borrow records
        return view('borrow_list', compact('borrows'));
    }

    // Show borrow form
    public function addborrowform(Request $request)
    {
        $books = Book::all();
        $book_id = $request->query('book_id'); // pre-selected book ID
        return view('borrow_add', compact('books', 'book_id'));
    }

    // Borrow a book
    public function addborrow(Request $request)
    {
        $request->validate([
            'borrower' => 'required',
            'book_id' => 'required|exists:books,id'
        ]);

        $borrowerName = $request->borrower;
        $bookId = $request->book_id;

        // Check if already borrowed by this user
        $exists = Borrow::where('book_id', $bookId)
                        ->where('borrower', $borrowerName)
                        ->where('status', 'Borrowed')
                        ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You have already borrowed this book.');
        }

        Borrow::create([
            'book_id' => $bookId,
            'borrower' => $borrowerName,
            'borrow_date' => now(),
            'status' => 'Borrowed'
        ]);

        // Save borrower name in session for tracking
        $request->session()->put('borrower_name', $borrowerName);

        return redirect()->route('borrow.list')->with('success', 'Book borrowed successfully!');
    }

    // Return a book
    public function returnbook(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->status = 'Returned';
        $borrow->save();

        return redirect()->route('borrow.list')->with('success', 'Book returned successfully!');
    }
}
