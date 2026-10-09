<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    public function index(){
        $books=Book::paginate(12);
        return view('gallary' ,['books'=>$books , 'title'=>__('site.Book Galary')]);
    }

    public function search(Request $request){
        $keyWord=$request['keyword'];
        $books=Book::where('title','like','%'.$keyWord.'%')->paginate();
        return view('gallary' ,['books'=>$books , 'title'=>__('site.Search Result')]);
    }
}
