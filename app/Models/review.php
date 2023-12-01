<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class review extends Model
{
    use HasFactory;
    protected $fillable = ['comment'];

    public function products() : BelongsTo
    {
        return $this->belongsTo(product::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(user::class);
    }

}
