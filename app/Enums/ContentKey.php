<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ContentKey extends Enum
{
    const ABOUT_COMPANY = 'about_company';
    const WHO_WE_ARE = 'who_we_are';
    const ADDRESS = 'address';
    const MOBILE = 'mobile';
    const EMAIL = 'email';
    const LOCATION_LAT = 'location_lat';
    const LOCATION_LNG = 'location_lng';
    const SERVICES = 'services';
    const COMPANY_SERVICES = 'company_services';
    const POULTRY_JAM_SERVICES = 'poultry_jam_services';
    const DEALER_SERVICES = 'dealer_services';
    const DISTRIBUTOR_SERVICES = 'distributor_services';
    const VET_SERVICES = 'vet_services';
}
