<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cook extends Model
{
    use HasFactory;
    protected $primaryKey = 'cook_id';
    protected $fillable = [
        'cook_name',
        'price',
        'rating',
        'discount_price',
        'about_cook',
        'cook_image',
        'gallary_images',
        'status',
        'cook_parent_id'
    ];
}
