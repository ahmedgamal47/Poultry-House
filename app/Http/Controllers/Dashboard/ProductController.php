<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UserType;
use App\Enums\WeightType;
use App\Models\Category;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $companyId = $request->input('companyId');
        $activeStatus = $request->input('status');

        $products = Product::query();
        if ($name != null) {
            $products = $products->where('name', 'like', '%' . $name . '%');
        }
        if ($minPrice != null) {
            $products = $products->where('price', '>=', floatval($minPrice));
        }
        if ($maxPrice != null) {
            $products = $products->where('price', '<=', floatval($maxPrice));
        }
        if ($companyId != null) {
            $products = $products->where('companyId', $companyId);
        }
        if ($activeStatus != null) {
            $products = $products->where('active', $activeStatus);
        }
        $products = $products->orderBy('active', 'desc')
            ->orderBy('id', 'desc')
            ->with('company')
            ->with('category')
            ->paginate(10);

        $companies = User::query()
            ->where('type', UserType::COMPANY)
            ->where('active', true)
            ->get();

        $request->flash();
        return view('dashboard.pages.product.list', [
            'products' => $products,
            'companies' => $companies,
        ]);
    }

    public function show(Product $product)
    {
        return view('dashboard.pages.product.show', [
            'product' => $product,
        ]);
    }

    public function create()
    {
        $companies = User::query()
            ->where('type', UserType::COMPANY)
            ->where('active', true)
            ->get();
        $categories = Category::query()
            ->where('active', true)
            ->get();
        $weightTypes = [
            ['id' => WeightType::BY_GRAM, 'name' => __('messages.gram')],
            ['id' => WeightType::BY_KILOGRAM, 'name' => __('messages.kilogram')],
            ['id' => WeightType::BY_TON, 'name' => __('messages.ton')],
        ];
        return view('dashboard.pages.product.save', [
            'companies' => $companies,
            'categories' => $categories,
            'weightTypes' => $weightTypes,
            'product' => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required|image',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'companyId' => 'required|numeric',
            'categoryId' => 'required|numeric',
            'validity' => 'required|string',
            'productionDate' => 'required|date',
            'usage' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'weightType' => 'required|numeric',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->image = $request->file('photo');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->companyId = $request->input('companyId');
        $product->categoryId = $request->input('categoryId');
        $product->validity = $request->input('validity');
        $product->productionDate = $request->input('productionDate');
        $product->usage = $request->input('usage');
        $product->weight = $request->input('weight');
        $product->weightType = $request->input('weightType');
        $product->save();

        return redirect()->route('admin.product.index');
    }

    public function edit(Product $product)
    {
        $companies = User::query()
            ->where('type', UserType::COMPANY)
            ->where('active', true)
            ->get();
        $categories = Category::query()
            ->where('active', true)
            ->get();
        $weightTypes = [
            ['id' => WeightType::BY_GRAM, 'name' => __('messages.gram')],
            ['id' => WeightType::BY_KILOGRAM, 'name' => __('messages.kilogram')],
            ['id' => WeightType::BY_TON, 'name' => __('messages.ton')],
        ];
        return view('dashboard.pages.product.save', [
            'companies' => $companies,
            'categories' => $categories,
            'weightTypes' => $weightTypes,
            'product' => $product,
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'image',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'companyId' => 'required|numeric',
            'categoryId' => 'required|numeric',
            'validity' => 'required|string',
            'productionDate' => 'required|date',
            'usage' => 'required|string',
            'weightType' => 'required|numeric',
            'weight' => 'required|numeric|min:0',
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->companyId = $request->input('companyId');
        $product->categoryId = $request->input('categoryId');
        $product->validity = $request->input('validity');
        $product->productionDate = $request->input('productionDate');
        $product->usage = $request->input('usage');
        $product->weight = $request->input('weight');
        $product->weightType = $request->input('weightType');
        if ($request->hasFile('photo')) {
            $product->image = $request->file('photo');
        }
        $product->save();

        return redirect()->route('admin.product.show', $product->id);
    }

    public function activate(Product $product)
    {
        $product->active = !$product->active;
        $product->save();
        return redirect()->back();
    }
}
