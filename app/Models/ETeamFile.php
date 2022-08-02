<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamFile extends Model
{
    use HasFactory;

    protected $table = 'eteams_files';

    protected $fillable = [
        'eteam_id', 'name', 'type', 'path'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function getCreatedAtDate()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("LL");
    }

    public function getCreatedAtTime()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("H[:]mm");
    }
}
