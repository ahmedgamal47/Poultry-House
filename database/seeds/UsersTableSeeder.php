<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Company;
use App\Models\PoultryJam;
use App\Enums\UserType;
use App\Models\CompanyField;
use App\Models\CompanyCategory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $user = new User();
        $user->name = 'admin';
        $user->email = 'abdelrahman10waheed@gmail.com';
        $user->password = '123456';
        $user->address = '16 Bierut St, Heliopolis, New Cairo';
        $user->phone = rand(100000000, 999999999);
        $user->bio = 'bio bio bio bio bio bio bio bio';
        $user->image = User::defaultAvatar();
        $user->type = UserType::ADMINISTRATOR;
        $user->email_verified_at = date('Y-m-d h:i:s');
        $user->save();

        // Companies
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->name = 'شركه امون فيت ' . $i;
            $user->email = 'company' . $i . '@companies.com';
            $user->password = '123456';
            $user->address = 'الدقهليه - ميت غمر - شارع الحريه - بجوار بنك مصر';
            $user->phone = rand(100000000, 999999999);
            $user->bio = 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات ';
            $user->image = User::defaultAvatar();
            $user->type = UserType::COMPANY;
            $user->email_verified_at = date('Y-m-d h:i:s');
            $user->save();

            $company = new Company();
            $company->description = 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق "ليتراسيت" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل "ألدوس بايج مايكر" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.';
            $company->website = 'https://google.com';
            $company->latitude = '30.223153165';
            $company->longitude = '31.0651313543';
            $company->facebookLink = 'https://facebook.com';
            $company->twitterLink = 'https://twitter.com';
            $company->googlePlusLink = 'https://googleplus.com';
            $company->instagramLink = 'https://instagram.com';
            $company->userId = $user->id;
            $company->save();

            // company categories
            $limit = rand(1, 3);
            for ($j = 1; $j <= $limit; $j++) {
                $companyCategory = new CompanyCategory();
                $companyCategory->companyId = $user->id;
                $companyCategory->categoryId = rand(1, 5);
                $companyCategory->save();
            }
        }

        // Poultry Jams
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->name = 'اسم المربي بالكامل ' . $i;
            $user->email = 'poultryjam' . $i . '@poultryjams.com';
            $user->password = '123456';
            $user->address = 'الدقهليه - ميت غمر - شارع الحريه - بجوار بنك مصر';
            $user->phone = rand(100000000, 999999999);
            $user->bio = 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات ';
            $user->image = User::defaultAvatar();
            $user->type = UserType::POULTRY_JAM;
            $user->email_verified_at = date('Y-m-d h:i:s');
            $user->save();

            $poultryJam = new PoultryJam();
            $poultryJam->field = 'نشاط المربى';
            $poultryJam->code = '15245';
            $poultryJam->userId = $user->id;
            $poultryJam->save();
        }
    }
}
