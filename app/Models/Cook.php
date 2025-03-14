<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cook extends Model
{
    use HasFactory; 
    protected $table = 'cooks';
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
        'cook_parent_id',
        'category_id',
        'cook_time', 
    ];
    public function childs(){
        return $this->hasMany(Cook::class, 'cook_parent_id','cook_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'cook_id');
    }
    public function category_name()
    {
        return $this->belongsTo(Category::class, 'category_id' );
    }
    public function variants(){
        return $this->hasMany(Variation::class, 'cook_id', 'cook_id');
    }
}
 