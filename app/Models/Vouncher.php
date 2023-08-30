<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vouncher extends Model
{
    use HasFactory;
    // protected $fillable = ["customer", "vouncher_number", "tax", "net_total", "user_id", "total"];
    protected $guarded = [];

    public function children_vounchers()
    {
        return $this->hasMany(VouncherRecords::class);
    }

    public  function getSellByDate($thatDay)
    {

        return $this->where('user_id', Auth::id())->whereDate('created_at', $thatDay)->sum('net_total');
    }

    public  function getQuantityByDate($thatDay)
    {

        return $this->where('user_id', Auth::id())->whereDate('created_at', $thatDay)->sum('quantity');
    }
}
