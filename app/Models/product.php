<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'image' ,'available', 'price' , 'description' , 'category_id'];


    public function category() : BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(review::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'user_products' , 'product_id' , 'user_id')->withPivot('quantity');
    }
    public function users2(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'user_prods' , 'product_id' , 'user_id')->withPivot('quantity');
    }
}
