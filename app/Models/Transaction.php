<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeStatus($query, $status)
    {
        $query->when( $status ?? false, function ($query, $status){
            return $query->where('status', $status);
        });
    }
    public function scopeDate($query, $date)
    {
        $query->when( $date ?? false, function ($query, $date){
            if( $date =='hari ini' ) :
                return $query->whereDate('created_at', Carbon::today());
            elseif( $date =='minggu ini' ) :
                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            elseif( $date =='bulan ini' ) :
                return $query->whereMonth('created_at', Carbon::now()->month);
            elseif( $date =='tahun ini' ) :
                return $query->whereYear('created_at', Carbon::now()->year);
            endif;
        });
    }
    public function scopeBetweenTimeRange($query, $timeRange){
        return $query->when(isset($timeRange['start_time']) && isset($timeRange['end_time']), function ($query) use ($timeRange) {
            return $query->whereDate('created_at', ">=", $timeRange['start_time'])->whereDate('created_at', '<=', $timeRange['end_time']);
        });
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
