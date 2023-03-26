<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Provider",
 *     description="Provider Model",
 *     @OA\Xml(
 *         name="Provider"
 *     )
 * )
 */

class Provider extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'slug', 'address' , 'phone'];

    
    /** 
     * @OA\Property(
     *     title="Id",
     *     description="Id of the provider",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    private $id;

     /** 
     * @OA\Property(
     *     title="name",
     *     description="providers name",
     *     format="string",
     *     example="asus laptop"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *      title="Slug",
     *      description="slug of the provider",
     *      example="asuse-laptop-274h8fk"
     * )
     *
     * @var string
     */
    public $slug;

    /**
     * @OA\Property(
     *      title="address",
     *      description="providers address",
     *      example="Veniam excepteur ex excepteur aliquip aute sunt minim et."
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      title="NationalCode Verified",
     *      description="providers phone number",
     *      example="+9813468053"
     * )
     *
     * @var string
     */
    public $phone;
}
