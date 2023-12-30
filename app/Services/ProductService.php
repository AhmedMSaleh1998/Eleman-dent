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
use App\Repositories\FavouriteRepository;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class ProductService extends BaseService
{
    private $categoryRepository;
    private $ProductSizeRepository;
    private $colorRepository;
    private $typeRepository;
    private $sizeRepository;

    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository, ProductSizeRepository $ProductSizeRepository, ColorRepository $colorRepository, TypeRepository $typeRepository, Request $request)
    {
        parent::__construct($repository, $request);
        $this->categoryRepository       = $categoryRepository;
        $this->ProductSizeRepository    = $ProductSizeRepository;
        $this->colorRepository          = $colorRepository;
        $this->typeRepository          = $typeRepository;

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
            $data = $this->repository->where('status', '1')->paginate(8);
        } else {

            $input = $request->all();

            $data = $this->repository->query();

            if (isset($input['filter']['category_id'])) {
                $subCategories = $this->categoryRepository->where('parent_id', $input['filter']['category_id'])->pluck('id');
                $data = $data->whereIn('category_id', $subCategories);
            }

            if (isset($input['filter']['sub_category_id'])) {
                $data = $data->where('category_id', $input['filter']['sub_category_id']);
            }

            if (isset($input['filter']['color_id'])) {
                $data = $data->where('color_id', $input['filter']['color_id']);
            }

            if (isset($input['filter']['model_id'])) {
                $data = $data->where('model_id', $input['filter']['model_id']);
            }

            if (isset($input['filter']['size_id'])) {
                $products = $this->ProductSizeRepository->where('size_id', $input['filter']['size_id'])->pluck('product_id');
                $data = $data->whereIn('id', $products);
            }

            if (isset($input['filter']['min_price']) && isset($input['filter']['max_price'])) {

                $data = $data->whereBetween('discount_price', array($input['filter']['min_price'], $input['filter']['max_price']));
            }
            $data = $data->where('status', '1')->paginate(8);
        }
        return ProductResource::collection($data);
        //return $data;
    }
    public function getFormData()
    {
        return [
            'categories' => $this->categoryRepository->getActiveItems(),
            'colors'     => $this->colorRepository->getActiveItems(),
            'types'      => $this->typeRepository->getActiveItems(),
            'related'    => $this->repository->getActiveItems(),
        ];
    }

    public function store($request)
    {
        $record = $request->all();

        $record['image'] = uploadImage($record['image'], 'products');

        $product = $this->repository->create($record);
        if ($request->has('color_id')) {
            $product->colors()->attach($record['color_id']);
        }
        if ($request->has('type_id')) {
            $product->types()->attach($record['type_id']);
        }
        if ($request->has('related_id')) {
            $product->related()->attach($record['related_id']);
        }
        return $record;
    }

    public function update($request, $id)
    {
        $product = $this->show($id);

        $record = $request->validated();
        //dd($record);
        unset($record['color_id']);
        unset($record['type_id']);
        unset($record['related_id']);

        if ($request->hasFile('image')) {
            $record['image'] = uploadImage($request['image'], 'products', 'products', $id);
        }

        $product = parent::update($id, $record);

        $product->colors()->sync($request->color_id);
        $product->types()->sync($request->type_id);
        $product->related()->sync($request->related_id);
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

    public function productRate($request)
    {
        return $this->productRateRepository->create($request);
    }

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
        $record = $this->repository->where('name', 'like', '%' . $filter . '%')->orWhere('description', 'like', '%' . $filter . '%')->get();
        return ProductResource::collection($record);
    }

    public function allLookups()
    {
        $data = [];

        $data['color'] = $this->colorRepository->get();
        $data['material'] = $this->MaterialRepository->get();
        $data['model'] = $this->modelRepository->get();
        $data['sole'] = $this->soleRepository->get();
        $data['size'] = $this->sizeRepository->get();
        $data['price']['min'] = $this->repository->min('discount_price');
        $data['price']['max'] = $this->repository->max('discount_price');

        return $data;
    }
}
