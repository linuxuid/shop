<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $guarded = [];

    /*
     * hasMany realationship with product table
     */ 
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
