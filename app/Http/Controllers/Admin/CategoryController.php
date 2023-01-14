<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Request\Admin\CategoryRequest;

class CategoryController extends AdminController
{
    public function index()
    {
        $categories = Category::all();
        // echo '<pre>';
        // dd(new Category);

        // dd($categories[0]->parent());
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.create', compact('categories'));
    }
    public function store()
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        if (empty($request->parent_id))
            unset($inputs['parent_id']);
        Category::create($inputs);
        return redirect('admin/category');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.edit', compact('categories', 'category'));
    }
    public function update($id)
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        Category::update(array_merge($inputs, ['id' => $id]));
        return redirect('admin/category');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('admin/category');
    }
}
