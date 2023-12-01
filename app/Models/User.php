<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'fname',
        'lname',
        'username',
        'email',
        'password',
        'role'
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function reviews() : HasMany
    {
        return $this->hasMany(review::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(product::class , 'user_products' , 'user_id' , 'product_id')->withPivot('quantity');
    }
    public function products2(): BelongsToMany
    {
        return $this->belongsToMany(product::class , 'user_prods' , 'user_id' , 'product_id')->withPivot('quantity');
    }
    
    public function checkout() : HasMany
    {
        return $this->hasMany(checkout::class);
    }
}
