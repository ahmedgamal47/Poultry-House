<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UserType;
use App\Models\PoultryJam;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PoultryJamController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $code = $request->input('code');
        $activeStatus = $request->input('status');

        $poultryJams = PoultryJam::query();
        if ($name != null) {
            $poultryJams = $poultryJams->whereHas('user', function (Builder $query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }
        if ($phone != null) {
            $poultryJams = $poultryJams->whereHas('user', function (Builder $query) use ($phone) {
                $query->where('phone', 'like', '%' . $phone . '%');
            });
        }
        if ($phone != null) {
            $poultryJams = $poultryJams->whereHas('user', function (Builder $query) use ($email) {
                $query->where('email', 'like', '%' . $email . '%');
            });
        }
        if ($code != null) {
            $poultryJams = $poultryJams->where('code', $code);
        }
        if ($activeStatus != null) {
            $poultryJams = $poultryJams->whereHas('user', function (Builder $query) use ($activeStatus) {
                $query->where('active', $activeStatus);
            });
        }
        $poultryJams = $poultryJams->with([
            'user' => function ($query) {
                $query->orderBy('active', 'desc');
            }])
            ->orderBy('id', 'desc')
            ->paginate(10);

        $request->flash();
        return view('dashboard.pages.poultry-jam.list', [
            'poultryJams' => $poultryJams,
        ]);
    }

    public function show($id)
    {
        $poultryJam = PoultryJam::query()
            ->with('user')
            ->findOrFail($id);
        return view('dashboard.pages.poultry-jam.show', [
            'poultryJam' => $poultryJam,
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.poultry-jam.save', [
            'poultryJam' => null,
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
            'field' => 'required|string|max:191',
            'code' => 'required',
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
        $user->type = UserType::POULTRY_JAM;
        $user->active = true;
        $user->save();

        $poultryJam = new PoultryJam();
        $poultryJam->field = $request->input('field');
        $poultryJam->code = $request->input('code');
        $poultryJam->userId = $user->id;
        $poultryJam->save();
        DB::commit();

        return redirect()->route('admin.poultry-jam.index');
    }

    public function edit(PoultryJam $poultryJam)
    {
        return view('dashboard.pages.poultry-jam.save', [
            'poultryJam' => $poultryJam,
        ]);
    }

    public function update(PoultryJam $poultryJam, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $poultryJam->user->id,
            'logo' => 'image',
            'phone' => 'required|numeric|unique:users,phone,' . $poultryJam->user->id,
            'address' => 'required',
            'bio' => 'required|string|max:191',
            'field' => 'required|string|max:191',
            'code' => 'required',
        ]);

        DB::beginTransaction();
        $poultryJam->user->name = $request->input('name');
        $poultryJam->user->email = $request->input('email');
        $poultryJam->user->address = $request->input('address');
        $poultryJam->user->phone = $request->input('phone');
        $poultryJam->user->bio = $request->input('bio');
        if ($request->hasFile('logo')) {
            $poultryJam->user->image = $request->file('logo');
        }
        $poultryJam->user->save();

        $poultryJam->field = $request->input('field');
        $poultryJam->code = $request->input('code');
        $poultryJam->save();
        DB::commit();

        return redirect()->route('admin.poultry-jam.show', $poultryJam->id);
    }

    public function activate(PoultryJam $poultryJam)
    {
        $poultryJam->user->active = !$poultryJam->user->active;
        $poultryJam->user->save();
        return redirect()->back();
    }
}
