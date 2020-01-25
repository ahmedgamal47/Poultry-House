<?php

namespace App\Http\Controllers\Dashboard;

use App\Libraries\ContentService;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{

    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function getConfigurations()
    {
        $configurations = Content::all();
        $configurations = array_column($configurations->toArray(), 'value', 'key');
        return view('dashboard.pages.configuration.list', [
            'configurations' => $configurations,
        ]);
    }

    public function saveConfigurations(Request $request)
    {
        $request->validate([
            'about_company' => 'required',
            'who_we_are' => 'required',
            'address' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'services' => 'array',
            'services.*.name' => 'required|string',
            'services-photos.*' => 'required|image',
            'companyServices' => 'array',
            'poultryJamServices' => 'array',
            'dealerServices' => 'array',
            'distributorServices' => 'array',
            'vetServices' => 'array',
        ]);

        $services = $request->input('services');
        if ($request->hasFile('services-photos')) {
            foreach ($request->file('services-photos') as $i => $image) {
                $services[$i]['photo'] = url('storage/' . $image->store('services', 'public'));
            }
        }

        DB::beginTransaction();
        $this->contentService->setAboutCompany($request->input('about_company'));
        $this->contentService->setWhoWeAre($request->input('who_we_are'));
        $this->contentService->setCompanyAddress($request->input('address'));
        $this->contentService->setCompanyMobile($request->input('mobile'));
        $this->contentService->setCompanyEmail($request->input('email'));
        $this->contentService->setCompanyLocationLat($request->input('latitude'));
        $this->contentService->setCompanyLocationLng($request->input('longitude'));
        $this->contentService->setServices($services);
        $this->contentService->setCompanyServices($request->input('companyServices'));
        $this->contentService->setPoultryJamServices($request->input('poultryJamServices'));
        $this->contentService->setDealerServices($request->input('dealerServices'));
        $this->contentService->setDistributorServices($request->input('distributorServices'));
        $this->contentService->setVetServices($request->input('vetServices'));
        DB::commit();

        return redirect()->back()->with('success', __('messages.settings_updated'));
    }
}
