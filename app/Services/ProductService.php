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
            $data = $this->repository->query()->active()->with(['brand', 'category', 'categories'])->orderBy('seq', 'asc')->get();
        } else {

            $input = $request->all();

            $data = $this->repository->query()->active()->with(['brand', 'category', 'categories']);
            
            if (isset($input['filter']['category_id'])) {
                $data = $data->where('category_id', $input['filter']['category_id']);
            }

            if (isset($input['filter']['brand_id'])) {
                $data = $data->where('brand_id', $input['filter']['brand_id']);
            }

            if (isset($input['filter']['min_price']) && isset($input['filter']['max_price'])) {

                $data = $data->whereBetween('price', array($input['filter']['min_price'], $input['filter']['max_price']));
            }
            $data = $data->orderBy('seq', 'asc')->paginate(12);
        }
        return ProductResource::collection($data)->response()->getData();
    }
    
    // قائمة المنتجات في لوحة التحكم مع فلترة اختيارية بالقسم/الماركة
    public function getAdminList($request)
    {
        $query = $this->repository->query()->with(['brand', 'category', 'categories', 'translations']);

        if ($request->filled('category_id')) {
            $categoryId = $request->input('category_id');
            // القسم ممكن يكون متسجل في عمود category_id أو في جدول الربط categories
            $query->where(function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId)
                    ->orWhereHas('categories', function ($q2) use ($categoryId) {
                        $q2->where('categories.id', $categoryId);
                    });
            });
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        return $query->orderBy('seq', 'asc')->get();
    }

    public function bulkMoveCategory($request)
    {
        $ids = array_filter(explode(',', (string) $request->input('product_ids')));
        $categoryId = $request->input('category_id');

        if (empty($ids) || empty($categoryId)) {
            return 0;
        }

        $products = Product::whereIn('id', $ids)->get();
        foreach ($products as $product) {
            $product->update(['category_id' => $categoryId]);
            $product->categories()->sync([$categoryId]);
        }

        return $products->count();
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
        $pdf = null ;
        $record['image'] = uploadImage($record['image'], 'products');
        if ($request->hasFile('pdf')) {
            $pdf = uploadImage($record['pdf'], 'product_pdfs');
        }

        $product = Product::create([
            'image' => $record['image'],
            'pdf' => $pdf,
            'price' => $record['price'],
            'discount_price' => $record['discount_price'],
            'quantity' => $record['quantity'],
            'is_top_product' => $request->boolean('is_top_product'),
            'brand_id' => $record['brand_id'] ?? null,
            'seq' => $record['seq'],
            'video_url' => $record['video_url'],
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
        $product->categories()->attach($record['category_id']);
        return $record;
    }

    public function update($request, $id)
    {
        $product = $this->show($id);

        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'products', 'products', $id);
        }
        
        if ($request->hasFile('pdf')) {
            $pdf = uploadImage($request['pdf'], 'product_pdfs' , 'products' , $id);
        }

        $product->update([
            'image' => $image ?? $product->image,
            'pdf' => $pdf ?? $product->pdf,
            'price' => $request['price'],
            'discount_price' => $request['discount_price'],
            'quantity' => $request['quantity'],
            'is_top_product' => $request->boolean('is_top_product'),
            'brand_id' => $request['brand_id'],
            'seq' => $request['seq'],
            'video_url' => $request['video_url'],
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
        $product->categories()->sync($request['category_id']);

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
        $products = Product::active()
            ->when($filter, function ($query) use ($filter) {
                return $query->where(function ($query) use ($filter) {
                    // Search in product translations
                    $query->whereHas('translations', function ($query) use ($filter) {
                        $query->where(function ($subQuery) use ($filter) {
                            $subQuery->where('name', 'like', '%' . $filter . '%')
                                ->orWhere('keywords', 'like', '%' . $filter . '%')
                                ->orWhere('description', 'like', '%' . $filter . '%')
                                ->orWhere('title', 'like', '%' . $filter . '%');
                        });
                    })
                    // Search in brand translations
                    ->orWhereHas('brand.translations', function ($query) use ($filter) {
                        $query->where(function ($subQuery) use ($filter) {
                            $subQuery->where('name', 'like', '%' . $filter . '%');
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
        $data['price']['min'] = Product::active()->min('discount_price');
        $data['price']['max'] = Product::active()->max('discount_price');

        return $data;
    }
    
    public function getAll()
    {
        return Product::orderBy('seq', 'ASC')->get();
    }
}
