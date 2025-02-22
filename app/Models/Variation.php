<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $primaryKey = 'variant_id';
    protected $fillable = [
        'cook_id',
        'variant_price',
        'variant_name'
    ];
}
