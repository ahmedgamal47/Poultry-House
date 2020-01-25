<?php

namespace App\Http\Controllers\Main;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\PoultryJam;
use App\Notifications\ContactNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PoultryJamController extends Controller
{
    public function getPoultryJams(Request $request)
    {
        $poultryJams = PoultryJam::query()
            ->with('user')
            ->paginate(10);
        return view('pages.poultryJam.list', [
            'poultryJams' => $poultryJams,
        ]);
    }

    public function getPoultryJam($id)
    {
        $poultryJam = User::query()
            ->with('poultryJam')
            ->findOrFail($id);
        return view('pages.poultryJam.single', [
            'poultryJam' => $poultryJam,
        ]);
    }

    public function sendInquiry(Request $request)
    {
        $request->validate([
            'receiverId' => 'required|numeric',
            'name' => 'required|string',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        $user = Auth::user();
        $receiver = User::query()->findOrFail($request->input('receiverId'));

        $inquiry = new Inquiry();
        $inquiry->senderId = $user->id;
        $inquiry->fromName = $request->input('name');
        $inquiry->fromEmail = $request->input('email');
        $inquiry->fromPhone = $request->input('mobile');
        $inquiry->message = $request->input('message');
        $inquiry->receiverId = $receiver->id;
        $inquiry->receiverName = $receiver->name;
        $inquiry->receiverEmail = $receiver->email;
        $inquiry->includeAdmin = false;
        $receiver->notify(new ContactNotification($inquiry));

        $admin = User::query()->where('type', UserType::ADMINISTRATOR)->firstOrFail();
        $inquiry->includeAdmin = true;
        $admin->notify(new ContactNotification($inquiry));

        return back()->with('success', __('messages.inquiry_sent'));
    }

    public function account(Request $request)
    {
        $tab = $request->input('tab', 'info');
        return view('pages.poultryJam.profile', [
            'poultryJam' => Auth::user(),
            'tab' => $tab,
        ]);
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'photo' => 'image',
            'phone' => 'required|numeric|unique:users,phone,' . $user->id,
            'description' => 'required|string|max:191',
            'field' => 'required|string',
            'code' => 'required|numeric'
        ]);

        $poultryJam = PoultryJam::query()->where('userId', $user->id)->firstOrFail();

        DB::beginTransaction();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->bio = $request->input('description');
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo');
        }
        $user->save();

        $poultryJam->field = $request->input('field');
        $poultryJam->code = $request->input('code');
        $poultryJam->save();
        DB::commit();

        return redirect()->route('poultry-jam.account', ['tab' => 'info'])
            ->with('success', __('messages.settings_updated'));
    }
}
