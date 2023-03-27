<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Comment",
 *     description="Comment Model",
 *     @OA\Xml(
 *         name="Comment"
 *     )
 * )
 */
class Comment extends Model
{
    use HasFactory;
        
    protected $fillable=['id', 'username', 'title', 'content'];
        
    /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID of the comment",
     *     format="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /** 
     * @OA\Property(
     *     title="Title",
     *     description="Title of the comment",
     *     format="string",
     *     example="Ziba bood"
     * )
     *
     * @var string
     */
    public $title;
    
    /**
     * @OA\Property(
     *      title="Content",
     *      description="content of the comment",
     *      example="Ipsum quis aute amet dolore laboris 
     *      Lorem nulla Lorem consequat labore aliqua 
     *      excepteur cupidatat."
     * )
     *
     * @var string
     */
    public $content;
     
}
