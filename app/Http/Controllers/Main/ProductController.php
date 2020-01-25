<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $productName = $request->input('productName');
        $productCategory = $request->input('productCategory');
        $products = Product::query()
            ->where('active', true);
        if ($productName != null) {
            $products = $products->where('name', 'like', '%' . $productName . '%');
        }
        if ($productCategory != null) {
            $products = $products->where('categoryId', $productCategory);
        }
        $products = $products->paginate(12);
        session()->flashInput($request->input());
        return view('pages.product.list', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function getProduct($id)
    {
        $product = Product::query()
            ->with('company')
            ->findOrFail($id);
        $relatedProducts = Product::query()
            ->where('categoryId', $product->categoryId)
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();
        return view('pages.product.single', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required|image',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'categoryId' => 'required|numeric',
            'validity' => 'required|string',
            'productionDate' => 'required|date',
            'usage' => 'required|string',
            'weightType' => 'required|numeric',
            'weight' => 'required|numeric|min:0',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->image = $request->file('photo');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->categoryId = $request->input('categoryId');
        $product->validity = $request->input('validity');
        $product->productionDate = $request->input('productionDate');
        $product->usage = $request->input('usage');
        $product->weightType = $request->input('weightType');
        $product->weight = $request->input('weight');
        $product->companyId = Auth::user()->id;
        $product->save();

        return redirect()->route('company.account', ['tab' => 'products'])
            ->with('success', __('messages.product_created'));
    }

    public function updateProduct($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'image',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'categoryId' => 'required|numeric',
            'validity' => 'required|string',
            'productionDate' => 'required|date',
            'usage' => 'required|string',
            'weightType' => 'required|numeric',
            'weight' => 'required|numeric|min:0',
        ]);

        $product = Product::query()->findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->categoryId = $request->input('categoryId');
        $product->validity = $request->input('validity');
        $product->productionDate = $request->input('productionDate');
        $product->usage = $request->input('usage');
        $product->weightType = $request->input('weightType');
        $product->weight = $request->input('weight');
        if ($request->hasFile('photo')) {
            $product->image = $request->file('photo');
        }
        $product->save();

        return redirect()->route('company.account', ['tab' => 'products'])
            ->with('success', __('messages.product_updated'));
    }

    public function activate($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->active = !$product->active;
        $product->save();
        return redirect()->back();
    }
}
