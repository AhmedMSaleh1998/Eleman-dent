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

    public function update($request, $id)
    {
        $course = $this->show($id);
        // dd($request);    
        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'courses', 'courses', $id);
        }

        $course->update([
            'image' => $image ?? $course->image,

            'en' => [
                'name' => $request['name_en'],
                'description' => $request['description_en'],
            ],
            'ar' => [
                'name' => $request['name_ar'],
                'description' => $request['description_ar'],
            ],
        ]);
    }
}
