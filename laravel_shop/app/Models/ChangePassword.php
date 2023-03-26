<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     title="Change Password",
 *     description="Change Password Model",
 *     @OA\Xml(
 *         name="ChangePassword"
 *     )
 * )
 */

 class ChangePassword extends Model
 {
     use HasFactory;
 
     protected $fillable=['phone', 'current_password', 'new_password'];
     
     /** 
      * @OA\Property(
      *     title="phone",
      *     description="Phone number of user",
      *     format="string",
      *     example="+989388063351"
      * )
      *
      * @var string
      */
     public $phone;
     
     /** 
      * @OA\Property(
      *     title="Current Password",
      *     description="Secret Passkey",
      *     format="string",
      *     example="3Xample123!@#"
      * )
      *
      * @var string
      */
     public $current_password;
     
     /** 
      * @OA\Property(
      *     title="New Password",
      *     description="Secret Passkey",
      *     format="string",
      *     example="eXamplel456"
      * )
      *
      * @var string
      */
     public $new_password;
     
 }
 