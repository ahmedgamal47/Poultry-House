<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');

        $categories = Category::query();
        if ($name != null) {
            $categories = $categories->where('name', 'like', '%' . $name . '%');
        }
        if ($status != null) {
            $categories = $categories->where('active', $status);
        }
        $categories = $categories
            ->withCount('products')
            ->withCount('companies')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $request->flash();
        return view('dashboard.pages.category.list', [
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $category = Category::query()
            ->withCount('products')
            ->withCount('companies')
            ->findOrFail($id);
        return view('dashboard.pages.category.show', [
            'category' => $category,
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.category.save', [
            'category' => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category',
            'image' => 'required|image',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->image = $request->file('image');
        $category->save();

        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        $category = Category::query()
            ->findOrFail($id);
        return view('dashboard.pages.category.save', [
            'category' => $category,
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category,name,' . $category->name,
            'image' => 'image',
        ]);

        $category->name = $request->input('name');
        if ($request->hasFile('image')) {
            $category->image = $request->file('image');
        }
        $category->save();

        return redirect()->route('admin.category.show', $category->id);
    }

    public function activate(Category $category)
    {
        $category->active = !$category->active;
        $category->save();
        return redirect()->back();
    }
}
