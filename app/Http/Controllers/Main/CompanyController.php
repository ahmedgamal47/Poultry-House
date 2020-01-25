<?php

namespace App\Http\Controllers\Main;

use App\Enums\WeightType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Product;
use App\Models\Video;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function getCompanies(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $productId = $request->input('productId');
        $companies = Company::query()
            ->with('user.categories')
            ->whereHas('user', function (Builder $query) {
                $query->where('active', true);
            });
        if ($categoryId != null) {
            $companies = $companies->whereHas('user.categories', function (Builder $query) use ($categoryId) {
                $query->where('category.id', $categoryId);
            });
        }
        if ($productId != null) {
            $companies = $companies->whereHas('user.products', function (Builder $query) use ($productId) {
                $query->where('id', $productId);
            });
        }
        $companies = $companies->paginate(12);
        $categories = Category::query()->where('active', true)->get();
        $products = Product::query()->where('active', true)->get();

        session()->flashInput($request->input());
        return view('pages.company.list', [
            'companies' => $companies,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function getCompany($id)
    {
        $company = User::query()
            ->with('company')
            ->findOrFail($id);
        $products = Product::query()
            ->where('companyId', $company->id)
            ->paginate(4);
        $videos = Video::query()->where('companyId', $company->id)
            ->get();
        return view('pages.company.single', [
            'company' => $company,
            'products' => $products,
            'videos' => $videos,
        ]);
    }

    public function account(Request $request)
    {
        $tab = $request->input('tab', 'info');
        $userId = Auth::user()->id;
        $company = User::query()
            ->with('company')
            ->findOrFail($userId);
        $categories = Category::query()
            ->where('active', true)
            ->get();
        $products = Product::query()
            ->where('companyId', $userId)
            ->paginate(10, ['*'], 'prodPage');
        $videos = Video::query()
            ->where('companyId', $userId)
            ->paginate(10, ['*'], 'videoPage');
        $productId = $request->input('productId');
        $product = null;
        if ($productId != null) {
            $product = Product::query()
                ->where('id', $productId)
                ->where('companyId', $userId)
                ->firstOrFail();
        }
        $weightTypes = [
            ['id' => WeightType::BY_GRAM, 'name' => __('messages.gram')],
            ['id' => WeightType::BY_KILOGRAM, 'name' => __('messages.kilogram')],
            ['id' => WeightType::BY_TON, 'name' => __('messages.ton')],
        ];

        $companyId = $company->id;
        $companyCategories = Category::query()
            ->where('active', true)
            ->whereHas('companies', function (Builder $query) use ($companyId) {
                $query->where('users.id', $companyId);
            })
            ->get();

        return view('pages.company.profile', [
            'tab' => $tab,
            'company' => $company,
            'categories' => $categories,
            'products' => $products,
            'videos' => $videos,
            'companyCategories' => $companyCategories,
            'product' => $product,
            'weightTypes' => $weightTypes,
        ]);
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'logo' => 'image',
            'phone' => 'required|numeric|unique:users,phone,' . $user->id,
            'bio' => 'required|string|max:191',
            'description' => 'required',
            'website' => 'url',
            'categories' => 'required|array|min:1',
            'latitude' => 'numeric|nullable',
            'longitude' => 'numeric|nullable',
            'facebookLink' => 'url|nullable',
            'twitterLink' => 'url|nullable',
            'googlePlusLink' => 'url|nullable',
            'instagramLink' => 'url|nullable',
        ]);

        $company = Company::query()->where('userId', $user->id)->firstOrFail();

        DB::beginTransaction();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->bio = $request->input('bio');
        if ($request->hasFile('logo')) {
            $user->image = $request->file('logo');
        }
        $user->save();

        $company->description = $request->input('description');
        $company->website = $request->input('website');
        $company->latitude = $request->input('latitude');
        $company->longitude = $request->input('longitude');
        $company->facebookLink = $request->input('facebookLink');
        $company->twitterLink = $request->input('twitterLink');
        $company->googlePlusLink = $request->input('googlePlusLink');
        $company->instagramLink = $request->input('instagramLink');
        $company->save();

        CompanyCategory::query()->where('companyId', $user->id)->delete();
        $companyCategories = $request->input('categories');
        foreach ($companyCategories as $companyCategoryId) {
            $companyCategory = new CompanyCategory();
            $companyCategory->companyId = $user->id;
            $companyCategory->categoryId = $companyCategoryId;
            $companyCategory->save();
        }

        DB::commit();

        return redirect()->route('company.account', ['tab' => 'info'])
            ->with('success', __('messages.settings_updated'));
    }

    public function createVideo(Request $request)
    {
        $request->validate([
            'videoName' => 'required|string|max:191',
            'videoUrl' => 'required|url|max:191',
        ]);
        $name = $request->input('videoName');
        $url = $request->input('videoUrl');

        $video = new Video();
        $video->name = $name;
        $video->url = $url;
        $video->companyId = Auth::user()->id;
        $video->save();

        return redirect()->route('company.account', ['tab' => 'videos'])
            ->with('success', __('messages.video_created'));
    }

    public function deleteVideo($id)
    {
        Video::query()->where('id', $id)->delete();
        return redirect()->route('company.account', ['tab' => 'videos'])
            ->with('success', __('messages.video_deleted'));
    }
}
