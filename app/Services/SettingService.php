<?php


namespace App\Services;

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingService extends BaseService
{

    public function __construct(SettingRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        Setting::create(
            [
                'location' => $request['location'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'whatsapp' => $request['whatsapp'],
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'twitter' => $request['twitter'],
                'youtube' => $request['youtube'],

                'en' => [
                    'address' => $request['address_en'],
                    'keywords' => $request['keywords_en'],
                    'privacy' => $request['privacy_en'],
                    'terms' => $request['terms_en'],
                    'about_us' => $request['about_us_en'],

                ],
                'ar' => [
                    'address' => $request['address_ar'],
                    'keywords' => $request['keywords_ar'],
                    'privacy' => $request['privacy_ar'],
                    'terms' => $request['terms_ar'],
                    'about_us' => $request['about_us_ar'],

                ],
            ]
        );
    }

    public function updateSetting($request,$id)
    {
        $setting = $this->show($id);

        $setting ->update(
            [
                'location' => $request['location'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'whatsapp' => $request['whatsapp'],
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'twitter' => $request['twitter'],
                'youtube' => $request['youtube'],

                'en' => [
                    'address' => $request['address_en'],
                    'keywords' => $request['keywords_en'],
                    'privacy' => $request['privacy_en'],
                    'terms' => $request['terms_en'],
                    'about_us' => $request['about_us_en'],

                ],
                'ar' => [
                    'address' => $request['address_ar'],
                    'keywords' => $request['keywords_ar'],
                    'privacy' => $request['privacy_ar'],
                    'terms' => $request['terms_ar'],
                    'about_us' => $request['about_us_ar'],

                ],
            ]
        );
    }
}
