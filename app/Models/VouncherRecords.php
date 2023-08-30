<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VouncherRecords extends Model
{
    use HasFactory;
    // protected $fillable = ["vouncher_id", "product_id", "quantity", "cost"];
    protected $guarded = [];

    public function Vouncher()
    {
        return   $this->belongsTo(Vouncher::class);
    }
    public  function getTodaySell()
    {
        $today = Carbon::today();
        return $this->whereDate('created_at', $today)->sum('cost');
        // ->where('user_id', Auth::id())
    }
    public  function getTodayQuantity()
    {
        $today = Carbon::today();
        return $this->whereDate('created_at', $today)->sum('quantity');
        // ->where('user_id', Auth::id())
    }
}
