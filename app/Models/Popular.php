<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popular extends Model
{
    use HasFactory;
    protected $primaryKey = 'popular_id';
    protected $fillable = ['popular_cook_ids'];
}
