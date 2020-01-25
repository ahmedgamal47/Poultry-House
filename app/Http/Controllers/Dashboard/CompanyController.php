<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UserType;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $categoryId = $request->input('categoryId');
        $activeStatus = $request->input('status');

        $companies = Company::query();
        if ($name != null) {
            $companies = $companies->whereHas('user', function (Builder $query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }
        if ($phone != null) {
            $companies = $companies->whereHas('user', function (Builder $query) use ($phone) {
                $query->where('phone', 'like', '%' . $phone . '%');
            });
        }
        if ($categoryId != null) {
            $companies = $companies->whereHas('user.categories', function ($query) use ($categoryId) {
                $query->where('category.id', $categoryId);
            });
        }
        if ($activeStatus != null) {
            $companies = $companies->whereHas('user', function (Builder $query) use ($activeStatus) {
                $query->where('active', $activeStatus);
            });
        }
        $companies = $companies->with(['user' => function ($query) {
            $query->orderBy('active', 'desc');
        }])
            ->orderBy('id', 'desc')
            ->paginate(10);

        $categories = Category::query()
            ->where('active', true)
            ->get();

        $request->flash();
        return view('dashboard.pages.company.list', [
            'companies' => $companies,
            'categories' => $categories,
        ]);
    }

    public function show(Company $company)
    {
        return view('dashboard.pages.company.show', [
            'company' => $company,
        ]);
    }

    public function create()
    {
        $categories = Category::query()
            ->where('active', true)
            ->get();
        return view('dashboard.pages.company.save', [
            'company' => null,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pass' => 'required|min:8',
            'logo' => 'required|image',
            'phone' => 'required|numeric|unique:users',
            'address' => 'required',
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

        DB::beginTransaction();
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('pass');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->bio = $request->input('bio');
        $user->image = $request->file('logo');
        $user->type = UserType::COMPANY;
        $user->active = true;
        $user->save();

        $company = new Company();
        $company->description = $request->input('description');
        $company->website = $request->input('website');
        $company->latitude = $request->input('latitude');
        $company->longitude = $request->input('longitude');
        $company->facebookLink = $request->input('facebookLink');
        $company->twitterLink = $request->input('twitterLink');
        $company->googlePlusLink = $request->input('googlePlusLink');
        $company->instagramLink = $request->input('instagramLink');
        $company->userId = $user->id;
        $company->save();

        $companyCategories = $request->input('categories');
        foreach ($companyCategories as $companyCategoryId) {
            $companyCategory = new CompanyCategory();
            $companyCategory->companyId = $user->id;
            $companyCategory->categoryId = $companyCategoryId;
            $companyCategory->save();
        }

        DB::commit();

        return redirect()->route('admin.company.index');
    }

    public function edit($id)
    {
        $company = Company::query()
            ->where('id', $id)
            ->with(['user.categories' => function ($query) {
                $query->select('category.id');
            }])
            ->firstOrFail();
        if (count($company->user->categories) > 0) {
            $company->user->categories = $company->user->categories->pluck('id')->toArray();
        }
        $categories = Category::query()
            ->where('active', true)
            ->get();
        return view('dashboard.pages.company.save', [
            'categories' => $categories,
            'company' => $company,
        ]);
    }

    public function update(Company $company, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $company->user->id,
            'logo' => 'image',
            'phone' => 'required|numeric|unique:users,phone,' . $company->user->id,
            'address' => 'required',
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

        DB::beginTransaction();
        $company->user->name = $request->input('name');
        $company->user->email = $request->input('email');
        $company->user->address = $request->input('address');
        $company->user->phone = $request->input('phone');
        $company->user->bio = $request->input('bio');

        if ($request->hasFile('logo')) {
            $company->user->image = $request->file('logo');
        }
        $company->user->save();

        $company->description = $request->input('description');
        $company->website = $request->input('website');
        $company->latitude = $request->input('latitude');
        $company->longitude = $request->input('longitude');
        $company->facebookLink = $request->input('facebookLink');
        $company->twitterLink = $request->input('twitterLink');
        $company->googlePlusLink = $request->input('googlePlusLink');
        $company->instagramLink = $request->input('instagramLink');
        $company->save();

        CompanyCategory::query()->where('companyId', $company->user->id)->delete();
        $companyCategories = $request->input('categories');
        foreach ($companyCategories as $companyCategoryId) {
            $companyCategory = new CompanyCategory();
            $companyCategory->companyId = $company->user->id;
            $companyCategory->categoryId = $companyCategoryId;
            $companyCategory->save();
        }

        DB::commit();

        return redirect()->route('admin.company.show', $company->id);
    }

    public function activate(Company $company)
    {
        $company->user->active = !$company->user->active;
        $company->user->save();
        return redirect()->back();
    }
}
