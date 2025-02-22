<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name',
        'category_image',
        'parent_id',
        'status',
    ];
    public function cooks(){
        return $this->hasMany(Cook::class, 'category_id');
    }
}
