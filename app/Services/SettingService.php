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
                'location_one' => $request['location_one'],
                'location_two' => $request['location_two'],
                'src_one' => $request['src_one'],
                'src_two' => $request['src_two'],
                'phone_one' => $request['phone_one'],
                'phone_two' => $request['phone_two'],
                'email' => $request['email'],
                'whatsapp' => $request['whatsapp'],
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'twitter' => $request['twitter'],
                'youtube' => $request['youtube'],

                'en' => [
                    'address_one' => $request['address_one_en'],
                    'address_two' => $request['address_two_en'],
                    'keywords' => $request['keywords_en'],
                    'privacy' => $request['privacy_en'],
                    'terms' => $request['terms_en'],
                    'about_us' => $request['about_us_en'],

                ],
                'ar' => [
                    'address_one' => $request['address_one_ar'],
                    'address_two' => $request['address_two_ar'],
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
                'location_one' => $request['location_one'],
                'location_two' => $request['location_two'],
                'src_one' => $request['src_one'],
                'src_two' => $request['src_two'],
                'phone_one' => $request['phone_one'],
                'phone_two' => $request['phone_two'],
                'email' => $request['email'],
                'whatsapp' => $request['whatsapp'],
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'twitter' => $request['twitter'],
                'youtube' => $request['youtube'],

                'en' => [
                    'address_one' => $request['address_one_en'],
                    'address_two' => $request['address_two_en'],
                    'keywords' => $request['keywords_en'],
                    'privacy' => $request['privacy_en'],
                    'terms' => $request['terms_en'],
                    'about_us' => $request['about_us_en'],

                ],
                'ar' => [
                    'address_one' => $request['address_one_ar'],
                    'address_two' => $request['address_two_ar'],
                    'keywords' => $request['keywords_ar'],
                    'privacy' => $request['privacy_ar'],
                    'terms' => $request['terms_ar'],
                    'about_us' => $request['about_us_ar'],

                ],
            ]
        );
    }
}
