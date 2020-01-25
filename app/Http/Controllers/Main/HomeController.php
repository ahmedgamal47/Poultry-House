<?php

namespace App\Http\Controllers\Main;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Libraries\ContentService;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Post;
use App\Notifications\ContactNotification;
use App\User;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function home()
    {
        $categories = Category::query()->where('active', true)
            ->whereHas('fewCompanies')
            ->limit(5)
            ->get()
            ->each(function ($feed) {
                $feed->load('fewCompanies');
            });

        $aboutCompany = $this->contentService->getAboutCompany();
        $companyServices = $this->contentService->getCompanyServices();
        $poultryJamServices = $this->contentService->getPoultryJamServices();
        $dealerServices = $this->contentService->getDealerServices();
        $distributorServices = $this->contentService->getDistributorServices();
        $vetServices = $this->contentService->getVetServices();

        return view('pages.main.home.home', [
            'categories' => $categories,
            'aboutCompany' => $aboutCompany,
            'companyServices' => $companyServices,
            'poultryJamServices' => $poultryJamServices,
            'dealerServices' => $dealerServices,
            'distributorServices' => $distributorServices,
            'vetServices' => $vetServices,
        ]);
    }

    public function whoWeAre()
    {
        $whoWeAre = $this->contentService->getWhoWeAre();
        $services = $this->contentService->getServices();
        return view('pages.main.who-we-are', [
            'whoWeAre' => $whoWeAre,
            'services' => $services,
        ]);
    }

    public function contactUs()
    {
        $address = $this->contentService->getCompanyAddress();
        $mobile = $this->contentService->getCompanyMobile();
        $email = $this->contentService->getCompanyEmail();
        $locationLat = $this->contentService->getCompanyLocationLat();
        $locationLng = $this->contentService->getCompanyLocationLng();

        return view('pages.main.contact-us', [
            'address' => $address,
            'mobile' => $mobile,
            'email' => $email,
            'latitude' => $locationLat,
            'longitude' => $locationLng,
        ]);
    }

    public function sendInquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $admin = User::query()->where('type', UserType::ADMINISTRATOR)->firstOrFail();

        $inquiry = new Inquiry();
        $inquiry->senderId = Auth::user() ? Auth::user()->id : null;
        $inquiry->fromName = $request->input('name');
        $inquiry->fromEmail = $request->input('email');
        $inquiry->fromPhone = $request->input('mobile');
        $inquiry->message = $request->input('message');
        $inquiry->receiverId = $admin->id;
        $inquiry->receiverName = $admin->name;
        $inquiry->receiverEmail = $admin->email;

        $admin->notify(new ContactNotification($inquiry));

        return back()->with('success', __('messages.inquiry_sent'));
    }

    public function experts(Request $request)
    {
        $keyword = $request->input('keyword');

        $posts = Post::query()->where('active', true);
        if ($keyword != null) {
            $posts = $posts->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        }
        $posts = $posts->orderBy('id', 'desc')
            ->paginate(12);

        session()->flashInput($request->input());
        return view('pages.blog.list', [
            'posts' => $posts,
        ]);
    }

    public function article($slug)
    {
        $post = Post::query()->where('slug', $slug)->firstOrFail();
        return view('pages.blog.single', [
            'post' => $post,
        ]);
    }
}
