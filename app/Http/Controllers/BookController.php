<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Rating;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('admin.book.create', compact('authors', 'categories', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {

        $data = $request->validated();
        $data['cover_image'] = $this->resizeImage($data['cover_image']);
        $book = Book::create(Arr::except($data, 'author'));
        $book->authors()->attach($data['author']);
        $request->session()->flash('status', __('site.Book Added Succefuly!'));

        return Redirect(route('book.show', $book));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('admin.book.edit', compact('authors', 'categories', 'publishers', 'book'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($book->cover_image);
            $data['cover_image'] = $this->resizeImage($data['cover_image']);
        }
        $book->update(Arr::except($data, 'author'));
        $book->authors()->detach($book->authors);
        $book->authors()->attach($data['author']);
        $request->session()->flash('status', __('site.Book Updated Succefuly!'));

        return Redirect(route('book.show', $book));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $image = $book->cover_image;
        $book->delete();
        Storage::disk('public')->delete($image);

        return redirect(route('book.index'))->withwith('status', __('site.Deleted Sucessfuly'));

    }

    public function details(Book $book)
    {
        return view('details', ['book' => $book]);
    }

    public function rate(Book $book, Request $request)
    {

        $rateValue = $request->input('value');

        $user = Auth::user();
        $rating = Rating::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->first();
        if (! $rating) {
            $rating = new Rating;
            $rating->user_id = $user->id;
            $rating->book_id = $book->id;
        }
        $rating->value = $rateValue;
        $rating->save();

        return response()->json(['success' => true]);

    }
}
