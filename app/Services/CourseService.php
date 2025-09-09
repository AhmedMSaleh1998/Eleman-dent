<?php


namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseService extends BaseService
{

    public function __construct(CourseRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $input = $request->validated();
        $input['image'] = uploadImage($input['image'], 'courses');
        Course::create([
            'image' => $input['image'],

            'en' => [
                'name' => $input['name_en'],
                'description' => $input['description_en'],
            ],
            'ar' => [
                'name' => $input['name_ar'],
                'description' => $input['description_ar'],
            ],
        ]);

    }

}
