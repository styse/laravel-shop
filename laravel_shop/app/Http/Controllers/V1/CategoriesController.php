<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;


class CategoriesController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/categories",
     *      operationId="getCategories",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
        // abort_if(FacadesGate::denies('categories-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryResource(Category::with([])->paginate());
    }


     /**
     * @OA\Post(
     *      path="/api/v1/categories",
     *      operationId="insertCategory",
     *      tags={"Categories"},
     *      summary="Stores a new category",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Category")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function store(StoreCategoryRequest $request)
    {
        // abort_if(FacadesGate::denies('categories-post') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $Category = Category::create($request->all());

        return (new CategoryResource($Category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    
    /**
     * @OA\Get(
     *      path="/api/v1/categoris/{id}",
     *      operationId="getCategory",
     *      tags={"Category"},
     *      summary="Returns a single category",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the category which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
        // abort_if(FacadesGate::denies('categories-get') , Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }


    
    /**
     * @OA\Put(
     *      path="/api/v1/categories/{id}",
     *      tags={"Categories"},
     *      summary="Updates a single category",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="Category's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Category")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function update(UpdateCategoryRequest $request, string $id)
    {
        // abort_if(FacadesGate::denies('category-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    
    /**
     * @OA\Delete(
     *      path="/api/v1/categories/{id}",
     *      operationId="deleteCategory",
     *      tags={"Category"},
     *      summary="Delete Existing Category",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category's id",
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
    public function destroy(Category $category)
    {
        // abort_if(FacadesGate::denies('categories-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $category->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
