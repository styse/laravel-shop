<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate as FacadesGate;

class providersController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/providers",
     *      operationId="getProviders",
     *      tags={"Providers"},
     *      summary="Get list of providers",
     *      description="Returns list of providers",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Provider")
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
        abort_if(FacadesGate::denies('providers-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProviderResource(Provider::with([])->paginate());
    }

     /**
     * @OA\Post(
     *      path="/api/v1/providers",
     *      operationId="insertProvider",
     *      tags={"Providers"},
     *      summary="Stores a new provider",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Provider")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Provider")
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
    public function store(StoreProviderRequest $request)
    {
        abort_if(FacadesGate::denies('providers-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider = Provider::create($request->all());

        return (new ProviderResource($provider))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/providers/{id}",
     *      operationId="getProvider",
     *      tags={"Providers"},
     *      summary="Returns a single provider",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the provider which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Provider")
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
        // abort_if(FacadesGate::denies('providers-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider = Provider::findOrfail($id);

        return new ProviderResource($provider);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/providers/{id}",
     *      tags={"Providers"},
     *      summary="Updates a single provider",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="Provider's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Provider")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Provider")
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
    public function update(UpdateProviderRequest $request, int $id)
    {
        // abort_if(FacadesGate::denies('providers-put-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider = Provider::findOrFail($id);
        $provider->update($request->all());

        return (new ProviderResource($provider))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/providers/{id}",
     *      operationId="deleteProvider",
     *      tags={"Providers"},
     *      summary="Delete Existing Provider",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Provider's id",
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
    public function destroy(Provider $provider)
    {
        
        // abort_if(FacadesGate::denies('providers-put-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
