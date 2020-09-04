<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceResult extends Model
{
	protected $table = 'races_results';

	protected $fillable = ['race_id', 'group_participant_id', 'user_id', 'eteam_id', 'type', 'position', 'time', 'fastest_lap', 'sanction', 'state'];

    public function race()
    {
        return $this->belongsTo('App\Race');
    }

    public function group_participant()
    {
        return $this->belongsTo('App\GroupParticipant');
    }

    public function state()
    {
        switch ($this->state) {
            case 'not_shown':
                return 'No participa';
                break;
            case 'retired':
                return 'Retirado';
                break;
            case 'disqualified':
                return 'Descalificado';
                break;
            case 'finished':
                return 'Carrera finalizada';
                break;
        }
    }
}
