<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    function rel_to_product(){
        return $this->BelongsTo(Product::class, 'product_id');
    }
}
