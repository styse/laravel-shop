<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="LoginResult",
 *     description="LoginResult Model",
 *     @OA\Xml(
 *         name="LoginResult"
 *     )
 * )
 */
class LoginResult extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'api_key', 'success', 'user_id'];


     /** 
     * @OA\Property(
     *     title="Username",
     *     description="Login of the user",
     *     format="string",
     *     example="guest"
     * )
     *
     * @var string
     */
    private $username;

    /** 
     * @OA\Property(
     *     title="API Key",
     *     description="Bearer Token Generated for Authorization",
     *     format="string",
     *     example="qwertyuioplkjhgfdsazxcvbnm123456"
     * )
     *
     * @var string
     */
    private $api_key;

    /** 
     * @OA\Property(
     *     title="Success",
     *     description="Was login successful",
     *     format="boolean",
     *     example=false
     * )
     *
     * @var boolean
     */
    private $success;

    /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID of the user",
     *     format="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    private $user_id;
}
