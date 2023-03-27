<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/brands",
     *      operationId="getBrands",
     *      tags={"Brands"},
     *      summary="Get list of brands",
     *      description="Returns list of brands",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
        // abort_if(FacadesGate::denies('brands-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BrandResource(Brand::with([])->paginate());
    }


     /**
     * @OA\Post(
     *      path="/api/v1/brands",
     *      operationId="insertBrand",
     *      tags={"Brands"},
     *      summary="Stores a new brand",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Brand")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
    public function store(StoreBrandRequest $request)
    {
        // abort_if(FacadesGate::denies('brands-post') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $Brand = Brand::create($request->all());

        return (new BrandResource($Brand))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    
    /**
     * @OA\Get(
     *      path="/api/v1/brands/{id}",
     *      operationId="getBrand",
     *      tags={"Brands"},
     *      summary="Returns a single brand",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the brand which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
        // abort_if(FacadesGate::denies('brands-get') , Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $brand = Brand::findOrFail($id);

        return new BrandResource($brand);
    }


    
    /**
     * @OA\Put(
     *      path="/api/v1/brands/{id}",
     *      tags={"Brands"},
     *      summary="Updates a single brand",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="Brand's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Brand")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
    public function update(UpdateBrandRequest $request, string $id)
    {
        // abort_if(FacadesGate::denies('brand-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return (new BrandResource($brand))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    
    /**
     * @OA\Delete(
     *      path="/api/v1/brands/{id}",
     *      operationId="deleteBrand",
     *      tags={"Brands"},
     *      summary="Delete Existing Brand",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Brand's id",
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
    public function destroy(Brand $brand)
    {
        // abort_if(FacadesGate::denies('brands-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $brand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
