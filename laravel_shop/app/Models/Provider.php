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
    protected $fillable = ['id', 'email', 'nationalcode', 'nationalcode_verified' , 'fathername'];

    
    /** 
     * @OA\Property(
     *     title="E-Mail",
     *     description="E-Mail of the individual",
     *     format="string",
     *     example="smile@tyyi.net"
     * )
     *
     * @var string
     */
    private $email;

     /** 
     * @OA\Property(
     *     title="nationalcode",
     *     description="nationalcode",
     *     format="string",
     *     example="3860000000"
     * )
     *
     * @var string
     */
    private $nationalcode;

    /**
     * @OA\Property(
     *      title="Father's name",
     *      description="Firstname of the individual's parent",
     *      example="Mohammad"
     * )
     *
     * @var string
     */
    public $fathername;

    /**
     * @OA\Property(
     *      title="NationalCode Verified",
     *      description="Is ownership of national code verified",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $nationalcode_verified;

}

