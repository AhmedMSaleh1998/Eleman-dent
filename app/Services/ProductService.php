<?php


namespace App\Services;


use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductSizeRepository;
use App\Repositories\ColorRepository;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RelatedProductsResource;
use App\Models\Product;
use App\Repositories\BrandRepository;
use App\Repositories\FavouriteRepository;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class ProductService extends BaseService
{
    private $categoryRepository;
    private $brandRepository;

    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository, BrandRepository $brandRepository, Request $request)
    {
        parent::__construct($repository, $request);
        $this->categoryRepository       = $categoryRepository;
        $this->brandRepository    = $brandRepository;


        /* $this->with = [
            'productImages',
            'category',
            'sizes',
            'color'
        ]; */
    }

    public function getAllProducts($request)
    {
        if (empty($request)) {
            $data = $this->repository->where('status', '1');
        } else {

            $input = $request->all();

            $data = $this->repository->query();
            
            if (isset($input['filter']['category_id'])) {
                $data = $data->where('category_id', $input['filter']['category_id']);
            }

            if (isset($input['filter']['brand_id'])) {
                $data = $data->where('brand_id', $input['filter']['brand_id']);
            }

            if (isset($input['filter']['min_price']) && isset($input['filter']['max_price'])) {

                $data = $data->whereBetween('price', array($input['filter']['min_price'], $input['filter']['max_price']));
            }
            $data = $data->where('status', '1')->paginate(12);
        }
        return ProductResource::collection($data)->response()->getData();
    }
    
    public function getFormData()
    {
        return [
            'categories' => $this->categoryRepository->getActiveItems(),
            'brands'     => $this->brandRepository->getActiveItems(),
        ];
    }

    public function store($request)
    {
        $record = $request->all();

        $record['image'] = uploadImage($record['image'], 'products');

        $product = Product::create([
            'image' => $record['image'],
            'price' => $record['price'],
            'quantity' => $record['quantity'],
            'brand_id' => $record['brand_id'] ?? null,
            'category_id' => $record['category_id'],
            'en' => [
                'name' => $record['name_en'],
                'title' => $record['title_en'],
                'alt' => $record['alt_en'],
                'description' => $record['description_en'],
                'description_meta' => $record['description_meta_en'],
                'keywords_meta' => $record['keywords_meta_en'],
                'keywords' => $record['keywords_en'],

            ],
            'ar' => [
                'name' => $record['name_ar'],
                'title' => $record['title_ar'],
                'alt' => $record['alt_ar'],
                'description' => $record['description_ar'],
                'description_meta' => $record['description_meta_ar'],
                'keywords_meta' => $record['keywords_meta_ar'],
                'keywords' => $record['keywords_ar'],
            ],
        ]);

        return $record;
    }

    public function update($request, $id)
    {
        $product = $this->show($id);

        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'products', 'products', $id);
        }

        $product->update([
            'image' => $image ?? $product->image,
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'brand_id' => $request['brand_id'],
            'category_id' => $request['category_id'],
            'en' => [
                'name' => $request['name_en'],
                'title' => $request['title_en'],
                'alt' => $request['alt_en'],
                'description' => $request['description_en'],
                'description_meta' => $request['description_meta_en'],
                'keywords_meta' => $request['keywords_meta_en'],
                'keywords' => $request['keywords_en'],

            ],
            'ar' => [
                'name' => $request['name_ar'],
                'title' => $request['title_ar'],
                'alt' => $request['alt_ar'],
                'description' => $request['description_ar'],
                'description_meta' => $request['description_meta_ar'],
                'keywords_meta' => $request['keywords_meta_ar'],
                'keywords' => $request['keywords_ar'],
            ],
        ]);
        return $product;
    }

    public function show($id, $with = [])
    {
        return parent::show($id);
    }

    public function related($category_id)
    {
        $related = $this->repository->get()->where('category_id', $category_id);
    }

    // public function productRate($request)
    // {
    //     return $this->productRateRepository->create($request);
    // }

    public function relatedProducts($product_id)
    {

        $data = $this->repository->where('product_id', $product_id)->where('status', '1');
        return RelatedProductsResource::collection($data);
    }

    public function is_favourite($product_id)
    {

        $data =  DB::table('favourites')->where([
            ['product_id', '=', $product_id],
            ['user_id', '=', getCurrentUser()]
        ])->exists() ? 1 : 0;

        return $data;
    }

    public function search($filter)
    {
        $products = Product::where('status', 1)
            ->when($filter, function ($query) use ($filter) {
                return $query->where(function ($query) use ($filter) {
                    $query->whereHas('translations', function ($query) use ($filter) {
                        $query->where(function ($subQuery) use ($filter) {
                            $subQuery->where('name', 'like', '%' . $filter . '%')
                                ->orWhere('keywords', 'like', '%' . $filter . '%')
                                ->orWhere('description', 'like', '%' . $filter . '%')
                                ->orWhere('title', 'like', '%' . $filter . '%');
                        });
                    });
                });
            })
            ->get();
    
        return ProductResource::collection($products);
    }

    public function allLookups()
    {
        $data = [];

        // $data['color'] = $this->colorRepository->get();
        // $data['material'] = $this->MaterialRepository->get();
        // $data['model'] = $this->modelRepository->get();
        // $data['sole'] = $this->soleRepository->get();
        // $data['size'] = $this->sizeRepository->get();
        $data['price']['min'] = $this->repository->min('discount_price');
        $data['price']['max'] = $this->repository->max('discount_price');

        return $data;
    }
}
