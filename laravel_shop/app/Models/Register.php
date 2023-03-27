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

    protected $primaryKey = 'phone_number';
    public $incrementing = false;
    public function getKeyName(){
        return 'phone_number';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = ['name', 'email', 'password', 'phone_number', 'api_token', 'remember_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = ['password', 'remember_token', 'api_token'];

    /** 
     * @OA\Property(
     *     title="Email",
     *     description="Email of the user",
     *     format="string",
     *     example="styse011@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /** 
     * @OA\Property(
     *     title="Phone number",
     *     description="Phone number of the user",
     *     format="string",
     *     example="+9812345678"
     * )
     *
     * @var string
     */
    public $phone_number;

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
