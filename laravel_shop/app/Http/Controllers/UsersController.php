<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\LoginResult;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/login",
     *      operationId="Login",
     *      tags={"Users"},
     *      summary="Creates a new API key for the user",
     *      description="It will generate a new token for their login.",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Login")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResult")
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
    public function login(UserLoginRequest $request)
    {
        // Login
        $login = User::where('phone_number', $request->phone_number)->first();
        if (!$login)
            abort(403, 'Invalid login');
        $success = Hash::check($request->password, $login['password']);

        // Initiate result
        $loginResult = new LoginResult();
        $loginResult->username = $request->phone_number;
        $loginResult->success = $success;
        $loginResult->user_id = $login->id;
        
        // Generate token
        $token = $request->generate_new_api_token ? Str::random(32) : false;

        if ($success)
        {
            // Check token updated
            if ($token)
            {
                // Update Token in Database
                $login->update([
                    'api_token' => $token
                ]);

                // Set token in response
                $loginResult->api_key = $token;
            }
            
            // Set auth user
            Auth::setUser($login);
        }

        // Return response
        return $loginResult;
    }

     /**
     * @OA\Post(
     *      path="/api/v1/register",
     *      operationId="Register",
     *      tags={"Users"},
     *      summary="Stores a new user",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Register")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Register")
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
    public function store(UserRegisterRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


         /**
     * @OA\Post(
     *      path="/api/v1/changePassword",
     *      operationId="ChangePassword",
     *      tags={"Users"},
     *      summary="Change users password",
     *      description="Stores password in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ChangePassword")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ChangePassword")
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

    public function changePassword(UserChangePasswordRequest $request)
    {
        abort_if(FacadesGate::denies('changepassword-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userdata = User::where('phone', $request->phone)->first();

        $password = Hash::check($request->current_password , $userdata['password']);
        
        if($password){
            $newpass = Hash::make($request->new_password);
            $userdata->update(['password'=>$newpass]);

            return (new UserResource($userdata))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);        
        };
        abort(402, 'Incorrect password');        
    }

    /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="getUsers",
     *      tags={"Users"},
     *      summary="Get list of users",
     *      description="Returns list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
        // abort_if(FacadesGate::denies('users-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return new UserResource(User::with([])->paginate());
    }

    /**
     * @OA\Get(
     *      path="/api/v1/person/{id}",
     *      operationId="getPerson",
     *      tags={"Users"},
     *      summary="Returns a single User",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the user which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
        // abort_if(FacadesGate::denies('user-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::findOrfail($id);
        return new UserResource($user);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/person/{phone}",
     *      tags={"Users"},
     *      summary="Update user information",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="phone",
    *          description="User's phone",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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

    public function update(UpdateUserRequest $request,string $phone)
    {
        abort_if(FacadesGate::denies('person-put'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $user = User::where('phone', $phone)->first();
        $user->update($request->all());
        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

}

