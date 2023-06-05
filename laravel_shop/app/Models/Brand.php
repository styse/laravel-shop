<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @OA\Schema(
 *     title="Brand",
 *     description="Brand Model",
 *     @OA\Xml(
 *         name="Brand"
 *     )
 * )
 */
class Brand extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable=['id', 'name', 'slug'];
     
        
    /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID of the brand",
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
     *     description="Name of the brand",
     *     format="string",
     *     example="Asus"
     * )
     *
     * @var string
     */
    public $name;
    
    /**
     * @OA\Property(
     *      title="Slug",
     *      description="slug of the brand",
     *      example="asus-laptops-23t45tge5674ewedfk"
     * )
     *
     * @var string
     */
    public $slug;
}
