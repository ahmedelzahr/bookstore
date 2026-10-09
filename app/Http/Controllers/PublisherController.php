<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
     public function index()
    {
          $publishers = Publisher::all();

        return view('admin.publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required|string']);
         $publisher = Publisher::create($data);
       
        $request->session()->flash('status', __('site.Publisher Added Succefuly!'));
          return Redirect(route('publisher.show', $publisher));
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
         return view('admin.publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
         return view('admin.publisher.edit', compact( 'publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
       $data = $request->validate(['name'=>'required|string','description'=>'nullable|string']);
         $publisher->update($data);
       
        $request->session()->flash('status', __('site.Publisher Updated Succefuly!'));
        return Redirect(route('publisher.index', $publisher));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
         $publisher->delete();
    return redirect(route('publisher.index'))->withwith('status', __('site.Deleted Sucessfuly'));}

    

   

    public function publisherBooks(Publisher $publisher){
            $books=$publisher->books()->paginate(12);
            return view('gallary',['books'=>$books, 'title'=>__('site.publisher Books')]);
    }

    public function list(){
        $publishers=Publisher::all();
        return view('publishers',['publishers'=>$publishers , 'title'=>__('site.publishers')]);
    }

   public function search(Request $request){
        $keyWord=$request['keyword'];
        $publishers=Publisher::where('name','like','%'.$keyWord.'%')->get();
        return view('publishers',['publishers'=>$publishers , 'title'=>__('site.publishers Search Result ')]);
    }
}
