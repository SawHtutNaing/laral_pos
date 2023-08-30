<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouncher extends Model
{
    use HasFactory;
    // protected $fillable = ["customer", "vouncher_number", "tax", "net_total", "user_id", "total"];
    protected $guarded = [];

    public function children_vounchers()
    {
        return $this->hasMany(VouncherRecords::class);
    }
}
