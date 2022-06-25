<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamLog extends Model
{
    use HasFactory;

    protected $table = 'eteams_logs';

    protected $fillable = [
        'eteam_id', 'message'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function getCreatedAtDate()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("LL");
    }

    public function getCreatedAtTime()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("H[:]mm");
    }
}
