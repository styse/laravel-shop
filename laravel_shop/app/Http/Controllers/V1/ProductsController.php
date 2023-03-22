<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPostRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/products",
     *      operationId="getProducts",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *        response=422,
     *        description="Unprocessable Content",
     *      )
     *     )
     */
    public function index()
    {
        // abort_if(FacadesGate::denies('products-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource(Product::with([])->paginate());
    }


     /**
     * @OA\Post(
     *      path="/api/v1/products",
     *      operationId="insertProduct",
     *      tags={"Products"},
     *      summary="Stores a new Product",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function store(ProductPostRequest $request)
    {
        // abort_if(FacadesGate::denies('products-post') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $product = Product::create($request->all());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    
    /**
     * @OA\Get(
     *      path="/api/v1/products/{id}",
     *      operationId="getProduct",
     *      tags={"Products"},
     *      summary="Returns a single product",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the product which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function show(int $id)
    {
        abort_if(FacadesGate::denies('products-get') , Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }

    
    /**
     * @OA\Put(
     *      path="/api/v1/products/{id}",
     *      tags={"Products"},
     *      summary="Updates a single product",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="Product's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        abort_if(FacadesGate::denies('products-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


    
    /**
     * @OA\Delete(
     *      path="/api/v1/products/{id}",
     *      operationId="deleteCity",
     *      tags={"Products"},
     *      summary="Delete Existing Product",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Product $product)
    {
        abort_if(FacadesGate::denies('cities-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


}