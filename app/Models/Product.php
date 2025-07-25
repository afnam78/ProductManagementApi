<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
