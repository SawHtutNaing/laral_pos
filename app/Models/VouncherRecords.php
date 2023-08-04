<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VouncherRecords extends Model
{
    use HasFactory;
    public function Vouncher()
    {
        return   $this->belongsTo(Vouncher::class);
    }
}
