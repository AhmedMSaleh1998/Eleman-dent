<?php


namespace App\Services;

use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use Illuminate\Http\Request;

class CertificateService extends BaseService
{

    public function __construct(CertificateRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $input = $request->validated();
        $input['image'] = uploadImage($input['image'], 'certificates');
        Certificate::create([
            'image' => $input['image'],

            'en' => [
                'alt' => $input['alt_en'],
            ],
            'ar' => [
                'alt' => $input['alt_ar'],
            ],
        ]);
    }

    public function update($request, $id)
    {
        $certificate = $this->show($id);

        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'certificates', 'certificates', $id);
        }
        $certificate->update([
            'image' => $image ?? $certificate->image,

            'en' => [
                'alt' => $request['alt_en'],
            ],
            'ar' => [
                'alt' => $request['alt_ar'],
            ],
        ]);
    }
}
