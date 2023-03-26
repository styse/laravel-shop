<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category Model",
 *     @OA\Xml(
 *         name="Category"
 *     )
 * )
 */
class Category extends Model
{
    use HasFactory;
    
    protected $fillable=['id', 'name', 'slug'];
     
        
    /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID of the category",
     *     format="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /** 
     * @OA\Property(
     *     title="Name",
     *     description="Name of the category",
     *     format="string",
     *     example="Laptops"
     * )
     *
     * @var string
     */
    public $name;
    
    /**
     * @OA\Property(
     *      title="Slug",
     *      description="slug of the category",
     *      example="laptops-27ewfjkl4h8fk"
     * )
     *
     * @var string
     */
    public $slug;
}
