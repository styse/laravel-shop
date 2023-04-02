<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product Model",
 *     @OA\Xml(
 *         name="Product"
 *     )
 * )
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'price', 'brand_id', 'description', 'slug' , 'stock'];

    
    /** 
     * @OA\Property(
     *     title="Id",
     *     description="Id of the product",
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
     *     description="products name",
     *     format="string",
     *     example="asus laptop"
     * )
     *
     * @var string
     */
    private $name;

            
    /** 
     * @OA\Property(
     *     title="Brand_id",
     *     description="ID of the brand",
     *     format="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    private $brand_id;

        
    /** 
     * @OA\Property(
     *     title="Price",
     *     description="Price of the product",
     *     format="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    private $price;


    /**
     * @OA\Property(
     *      title="description",
     *      description="products description",
     *      example="Veniam excepteur ex excepteur aliquip aute sunt minim et."
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Slug",
     *      description="slug of the product",
     *      example="asuse-laptop-274h8fk"
     * )
     *
     * @var string
     */
    public $slug;

    /**
     * @OA\Property(
     *      title="NationalCode Verified",
     *      description="Is this product stocked?",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $stock;
}
