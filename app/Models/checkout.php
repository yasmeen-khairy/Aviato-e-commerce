<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class checkout extends Model
{
    use HasFactory;
    protected $fillable = ['fullname' , 'address' , 'city' , 'country' ,'phone_no' , 'total_price' , 'payment_method' , 'user_id'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(user::class);
    }
}
