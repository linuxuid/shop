<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $guarded = [];

    /*
     * Products belongs to categories
     */ 
     public function category()
        {
         return $this->belongsTo(Category::class);
        }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class)->withPivot('quantity');
    }
}
