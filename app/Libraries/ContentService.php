<?php

namespace App\Libraries;

use App\Enums\ContentKey;
use App\Models\Content;

class ContentService
{
    public function getAboutCompany()
    {
        return Content::query()->where('key', ContentKey::ABOUT_COMPANY)->firstOrFail()->value;
    }

    public function setAboutCompany($aboutCompany)
    {
        Content::query()->where('key', ContentKey::ABOUT_COMPANY)->update(['value' => $aboutCompany]);
    }

    public function getWhoWeAre()
    {
        return Content::query()->where('key', ContentKey::WHO_WE_ARE)->firstOrFail()->value;
    }

    public function setWhoWeAre($whoWeAre)
    {
        Content::query()->where('key', ContentKey::WHO_WE_ARE)->update(['value' => $whoWeAre]);
    }

    public function getCompanyAddress()
    {
        return Content::query()->where('key', ContentKey::ADDRESS)->firstOrFail()->value;
    }

    public function setCompanyAddress($address)
    {
        Content::query()->where('key', ContentKey::ADDRESS)->update(['value' => $address]);
    }

    public function getCompanyMobile()
    {
        return Content::query()->where('key', ContentKey::MOBILE)->firstOrFail()->value;
    }

    public function setCompanyMobile($mobile)
    {
        Content::query()->where('key', ContentKey::MOBILE)->update(['value' => $mobile]);
    }

    public function getCompanyEmail()
    {
        return Content::query()->where('key', ContentKey::EMAIL)->firstOrFail()->value;
    }

    public function setCompanyEmail($email)
    {
        Content::query()->where('key', ContentKey::EMAIL)->update(['value' => $email]);
    }

    public function getCompanyLocationLat()
    {
        return Content::query()->where('key', ContentKey::LOCATION_LAT)->firstOrFail()->value;
    }

    public function setCompanyLocationLat($latitude)
    {
        Content::query()->where('key', ContentKey::LOCATION_LAT)->update(['value' => $latitude]);
    }

    public function getCompanyLocationLng()
    {
        return Content::query()->where('key', ContentKey::LOCATION_LNG)->firstOrFail()->value;
    }

    public function setCompanyLocationLng($longitude)
    {
        Content::query()->where('key', ContentKey::LOCATION_LNG)->update(['value' => $longitude]);
    }

    public function getServices()
    {
        return json_decode(Content::query()->where('key', ContentKey::SERVICES)->firstOrFail()->value);
    }

    public function setServices($services)
    {
        if (!empty($services)) {
            $services = json_encode($services);
        }
        Content::query()->where('key', ContentKey::SERVICES)->update(['value' => $services]);
    }

    public function getCompanyServices()
    {
        return json_decode(Content::query()->where('key', ContentKey::COMPANY_SERVICES)->firstOrFail()->value);
    }

    public function setCompanyServices($companyServices)
    {
        if (!empty($companyServices)) {
            $companyServices = json_encode(array_filter($companyServices));
        }
        Content::query()->where('key', ContentKey::COMPANY_SERVICES)->update(['value' => $companyServices]);
    }

    public function getPoultryJamServices()
    {
        return json_decode(Content::query()->where('key', ContentKey::POULTRY_JAM_SERVICES)->firstOrFail()->value);
    }

    public function setPoultryJamServices($poultryJamServices)
    {
        if (!empty($poultryJamServices)) {
            $poultryJamServices = json_encode(array_filter($poultryJamServices));
        }
        Content::query()->where('key', ContentKey::POULTRY_JAM_SERVICES)->update(['value' => $poultryJamServices]);
    }

    public function getDealerServices()
    {
        return json_decode(Content::query()->where('key', ContentKey::DEALER_SERVICES)->firstOrFail()->value);
    }

    public function setDealerServices($dealerServices)
    {
        if (!empty($dealerServices)) {
            $dealerServices = json_encode(array_filter($dealerServices));
        }
        Content::query()->where('key', ContentKey::DEALER_SERVICES)->update(['value' => $dealerServices]);
    }

    public function getDistributorServices()
    {
        return json_decode(Content::query()->where('key', ContentKey::DISTRIBUTOR_SERVICES)->firstOrFail()->value);
    }

    public function setDistributorServices($distributorServices)
    {
        if (!empty($distributorServices)) {
            $distributorServices = json_encode(array_filter($distributorServices));
        }
        Content::query()->where('key', ContentKey::DISTRIBUTOR_SERVICES)->update(['value' => $distributorServices]);
    }

    public function getVetServices()
    {
        return json_decode(Content::query()->where('key', ContentKey::VET_SERVICES)->firstOrFail()->value);
    }

    public function setVetServices($vetServices)
    {
        if (!empty($vetServices)) {
            $vetServices = json_encode(array_filter($vetServices));
        }
        Content::query()->where('key', ContentKey::VET_SERVICES)->update(['value' => $vetServices]);
    }
}