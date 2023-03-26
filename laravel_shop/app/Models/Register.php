<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     title="Register",
 *     description="Register Model",
 *     @OA\Xml(
 *         name="Register"
 *     )
 * )
*/


class Register extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'phone';
    public $incrementing = false;
    public function getKeyName(){
        return 'phone';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = ['name', 'phone', 'password', 'remember_token', 'api_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = ['password', 'remember_token', 'api_token'];


    /** 
     * @OA\Property(
     *     title="Phone",
     *     description="Phone number of user",
     *     format="string",
     *     example="+9812345678"
     * )
     *
     * @var string
     */
    public $phone;

    /** 
     * @OA\Property(
     *     title="Name",
     *     description="Fullname of the user",
     *     format="string",
     *     example="John Doe"
     * )
     *
     * @var string
     */
    public $name;

    /** 
     * @OA\Property(
     *     title="Password",
     *     description="Secret Passkey",
     *     format="string",
     *     example="3Xample123!@#"
     * )
     *
     * @var string
     */
    public $password;

    /** 
     * @OA\Property(
     *     title="API Token",
     *     description="Secret random key",
     *     format="string",
     *     example="aabbcc112233"
     * )
     *
     * @var string
     */
    public $api_token;
}
