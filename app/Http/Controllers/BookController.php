<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BookController extends Controller
{
    // List all books
    public function booklist()
    {
        $books = Book::all();
        return view('books', compact('books'));
    }

    // Show add book form (Admin only)
    public function addbookform(Request $request)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login')
                             ->with('error','You must be an admin to add books.');
        }

        return view('book_add');
    }

    // Add new book (Admin only)
    public function addbook(Request $request)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login')
                             ->with('error','You must be an admin to add books.');
        }

        // Validate input
        $request->validate([
            'title'       => 'required',
            'author'      => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $cover = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $cover = 'uploads/'.$filename;
        }

        Book::create([
            'title'       => $request->title,
            'author'      => $request->author,
            'cover_image' => $cover
        ]);

        return redirect()->route('book.list')
                         ->with('success','Book added successfully!');
    }

    // Edit book form (Admin only)
    public function editbook(Request $request, $id)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login')
                             ->with('error','You must be an admin to edit books.');
        }

        $book = Book::findOrFail($id);
        return view('book_edit', compact('book'));
    }

    // Update book (Admin only)
    public function updatebook(Request $request, $id)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login')
                             ->with('error','You must be an admin to update books.');
        }

        // Validate input
        $request->validate([
            'title'       => 'required',
            'author'      => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $book->cover_image = 'uploads/'.$filename;
        }

        $book->title  = $request->title;
        $book->author = $request->author;
        $book->save();

        return redirect()->route('book.list')
                         ->with('success','Book updated successfully!');
    }

    // Delete book (Admin only)
    public function deletebook(Request $request, $id)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login')
                             ->with('error','You must be an admin to delete books.');
        }

        $book = Book::findOrFail($id);
        $book->delete(); // cascade deletes borrow records if FK with onDelete('cascade') is set

        return redirect()->route('book.list')
                         ->with('success','Book deleted successfully!');
    }
}
