<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeAvailable($query)
    {
        return $query->whereHas('product', function($q) {
            $q->where('stock', '>', 0);
        });
    }

    public function scopeUnavailable($query)
    {
        return $query->whereHas('product', function($q) {
            $q->where('stock', '<', 1);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
