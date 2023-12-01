<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class user_product extends Model
{
    use HasFactory;

    protected $fillable = ['product_id' , 'user_id' , 'quantity'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'user_products' , 'product_id' , 'user_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(product::class , 'user_products' , 'user_id' , 'product_id')->withPivot('quantity');
    }
}
