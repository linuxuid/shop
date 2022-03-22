<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Basket extends Model
{
    use HasFactory;

    protected $table = 'baskets';

    protected $primaryKey = 'id';

    public function products()
    {
        return $this->BelongsToMany(Product::class)->withPivot('quantity');
    }

    public function getAmount()
    {
        $amount = 0.0;
        foreach($this->products as $product){
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }
}
