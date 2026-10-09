<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $categories = Category::all();
        $title=__('site.Categories');

        return view('categories', compact('categories','title'));
    }

      public function search(Request $request){
        $keyWord=$request['keyword'];
        $categories=Category::where('name','like','%'.$keyWord.'%')->get();
        return view('categories',['categories'=>$categories , 'title'=>__('site.Categories Search Result ')]);
    }

    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        $category = Category::create($data);

        $request->session()->flash('status', __('site.Category Added Succefuly!'));

        return Redirect(route('category.show', $category));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate(['name' => 'required|string', 'description' => 'nullable|string']);
        $category->update($data);

        $request->session()->flash('status', __('site.Category Updated Succefuly!'));

        return Redirect(route('category.index', $category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('category.index'))->withwith('status', __('site.Deleted Sucessfuly'));
    }
}
