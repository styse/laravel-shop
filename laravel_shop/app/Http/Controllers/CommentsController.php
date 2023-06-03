<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentsController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/comments",
     *      operationId="getComments",
     *      tags={"Comments"},
     *      summary="Get list of comments",
     *      description="Returns list of comments",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
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
        // abort_if(FacadesGate::denies('comments-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommentResource(Comment::with([])->paginate());
    }


     /**
     * @OA\Post(
     *      path="/api/v1/comments",
     *      operationId="insertComment",
     *      tags={"Comments"},
     *      summary="Stores a new comment",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Comment")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
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
    public function store(StoreCommentRequest $request)
    {
        // abort_if(FacadesGate::denies('comments-post') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $Comment = Comment::create($request->all());

        return (new CommentResource($Comment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    
    /**
     * @OA\Get(
     *      path="/api/v1/comments/{id}",
     *      operationId="getComment",
     *      tags={"Comments"},
     *      summary="Returns a single comment",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the comment which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
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
        // abort_if(FacadesGate::denies('comments-get') , Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $comment = Comment::findOrFail($id);

        return new CommentResource($comment);
    }


    
    /**
     * @OA\Put(
     *      path="/api/v1/comments/{id}",
     *      tags={"Comments"},
     *      summary="Updates a single comment",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="Comment's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Comment")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
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
    public function update(UpdateCommentRequest $request, string $id)
    {
        // abort_if(FacadesGate::denies('comments-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    
    /**
     * @OA\Delete(
     *      path="/api/v1/comments/{id}",
     *      operationId="deleteComment",
     *      tags={"Comments"},
     *      summary="Delete Existing Comment",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment's id",
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
    public function destroy(Comment $comment)
    {
        // abort_if(FacadesGate::denies('comments-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $comment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
