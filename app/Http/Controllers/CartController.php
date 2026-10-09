<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {

        $books = auth()->user()->booksOnCart;
        $total = auth()->user()->booksOnCartPrice();

        return view('cart', compact('books', 'total'));
    }

    public function addToCart(Request $request)
    {
    
        $user = auth()->user();
        $book = Book::find($request->id);
        if ($user->booksOnCart->contains($book->id)) {

            $inCartBooks = $user->booksOnCart()->where('book_id', $book->id)->first()->pivot->number_of_copies;
            $requestedQuantity = $request->quantity;
            $newQuantity = $requestedQuantity + $inCartBooks;

            if ($newQuantity > $book->number_of_copies) {

                session()->flash('status', __('site.The Available Quantity is ').($book->number_of_copies - $inCartBooks));

            } else {
         
                $user->booksOnCart()->updateExistingPivot($book->id, ['number_of_copies' => $newQuantity]);

            }
        } else {
            $user->booksOnCart()->attach([$book->id => ['number_of_copies' => $request->quantity, 'price' => $book->price]]);

        }
        $number_of_book = $user->booksOnCart()->count();

        return response()->json([
            'number_of_book' => $number_of_book,
        ]);
    }

    public function removeOneItem(Request $request)
    {
        $user = auth()->user();
        $book = Book::find($request->id);
        $inCartBooks = $user->booksOnCart()->where('book_id', $book->id)->first()->pivot->number_of_copies;
        if ($inCartBooks > 1) {
            $inCartBooks--;
            $user->booksOnCart()->updateExistingPivot($book->id, ['number_of_copies' => $inCartBooks]);

            return response()->json(['quantity' => $inCartBooks, 'total_price' => $inCartBooks * $book->price, 'books_on_cart_price' => $user->booksOnCartPrice(),"books"=>$user->booksOnCart()->count()]);
        } else {
            $user->booksOnCart()->detach($book->id);
            return response()->json(['quantity' => 0, 'books_on_cart_price' => $user->booksOnCartPrice(),"books"=>$user->booksOnCart()->count()]);
            
        }
    }

    public function delete(Request $request)
    {
        $user = auth()->user();
        $book = Book::find($request->id);
        $user->booksOnCart()->detach($book->id);
        return response()->json(['books_on_cart_price' => $user->booksOnCartPrice(),"books"=>$user->booksOnCart()->count()]);

    }
}
