<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class user_prod extends Model
{
    use HasFactory;

    protected $fillable = ['product_id' , 'user_id' , 'quantity'];

    public function users2(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'user_prods' , 'product_id' , 'user_id');
    }

    public function products2(): BelongsToMany
    {
        return $this->belongsToMany(product::class , 'user_prods' , 'user_id' , 'product_id')->withPivot('quantity');
    }
}
