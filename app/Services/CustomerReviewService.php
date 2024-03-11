<?php


namespace App\Services;

use App\Models\CustomerReview;
use App\Repositories\CustomerReviewRepository;
use Illuminate\Http\Request;

class CustomerReviewService extends BaseService
{

    public function __construct(CustomerReviewRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $record = $request->validated();

        $record['image'] = uploadImage($record['image'], 'reviews');
        CustomerReview::create([
            'image' => $record['image'],
            'name'  => $record['name'],
            'review' => $record['review'],
        ]);
    }

    public function update($request, $id)
    {
        $review = $this->show($id);
        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'reviews', 'customer_reviews', $id);
        }
        $review->update([
            'value' => $request['value'],
            'image' => $image ?? $review->image,
            'name'  => $request['name']
        ]);
    }
}
