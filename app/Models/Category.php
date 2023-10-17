<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products(): HasMany{
        return $this->hasMany(Product::class);
    }

    public function scopeType($query, $type)
    {
        $query->when( $type ?? false, function ($query, $type){
            return $query->where('gender', $type);
        });
    }
}



