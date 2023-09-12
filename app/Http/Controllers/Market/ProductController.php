<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductRequest;
use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Http\Resources\resource\ProductResource;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
use App\Repositories\MySQL\ProductRepository\InterfaceProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use function App\upload_asset_file;
/**
 * @group Product
 *
 *API endpoints for Product Services
 *
 *
 */
class ProductController extends Controller
{

    private InterfaceProductRepository $interfaceProductRepository;

    public function __construct(InterfaceProductRepository $interfaceProductRepository)
    {
        $this->interfaceProductRepository = $interfaceProductRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductRequest $request): AnonymousResourceCollection
    {
        $count = @$request->count ?? 10;
        $name = @$request->name;
        $status = @$request->status;

        $products = $this->interfaceProductRepository->query();

        if (@$name)
            $products = $products->whereName($name);
        if (@$status != null)
            $products = $products->whereStatus($status);

        return ProductResource::collection($products->paginate($count));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
          $data = $request->except(['_token']);

          $product = $this->interfaceProductRepository->insertData($data);
            foreach ($request->file('images') as $key => $image) {
                $url = upload_asset_file($image, "product-image");

                ProductImage::create([
                    'image' => $url,
                    'product_id' => $product->id
                ]);
            }
            return response()->json(['message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ProductResource
    {
        return ProductResource::make($this->interfaceProductRepository->findById($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {

        if ($request->file('images')) {
            $data = $request->except(['_token','images']);
            $productImages = ProductImage::where('product_id', '=', $id)->get();

            foreach ($productImages as $image) {
                \File::delete($image->image);
                $image->delete();
            }

            foreach ($request->file('images') as $image) {
                $url = upload_asset_file($image, "product-image");
                ProductImage::create([
                    'image' => $url,
                    'product_id' => $id
                ]);
            }

        } else {
            $data = $request->except(['_token', 'images']);
        }
        if ($this->interfaceProductRepository->updateItem($id, $data))
            return response()->json(['message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        if ($this->interfaceProductRepository->deleteData($id))
            return response()->json(['message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);

    }


    public function newest(){
        return ProductResource::collection($this->interfaceProductRepository->query()->orderBy('created_at','desc')->get());
    }


    


}
