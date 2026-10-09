<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
          $authors = Author::all();

        return view('admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required|string']);
         $author = Author::create($data);
       
        $request->session()->flash('status', __('site.Author Added Succefuly!'));
          return Redirect(route('author.show', $author));
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
         return view('admin.author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
         return view('admin.author.edit', compact( 'author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
       $data = $request->validate(['name'=>'required|string','description'=>'nullable|string']);
         $author->update($data);
       
        $request->session()->flash('status', __('site.Author Updated Succefuly!'));
        return Redirect(route('author.index', $author));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
         $author->delete();
    return redirect(route('author.index'))->withwith('status', __('site.Deleted Sucessfuly'));}
     public function authorBooks(Author $author){
            $books=$author->books()->paginate(12);
            return view('gallary',['books'=>$books, 'name'=>__('site.Author Books')]);
    }

    public function list(){
        $authors=Author::all();
        $title=__('site.Authors');
        return view('authors',['authors'=>$authors , 'name'=>__('site.Authors'),'title'=>$title]);
    }

   public function search(Request $request){
        $keyWord=$request['keyword'];
        $authors=Author::where('name','like','%'.$keyWord.'%')->get();
        return view('authors',['authors'=>$authors , 'title'=>__('site.Authors Search Result ')]);
    }
}
