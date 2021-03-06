<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	protected $fillable = ['tournament_id', 'name', 'state', 'num_participants', 'inscription_price', 'free_inscription', 'players_databases_id', 'min_players', 'max_players', 'initial_budget', 'salary_cap', 'free_agents_default_salary', 'free_agents_default_price', 'free_agents_new_salary', 'free_agents_new_price', 'dismiss_remuneration', 'clauses_max_paid', 'clauses_max_received', 'clause_tax', 'period_salaries',
		'period_transfers', 'period_free_players', 'period_clauses', 'allow_cessions', 'slug'];

    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }

    public function reserves()
    {
        return $this->hasMany('App\Reserve');
    }

    public function seasons_posts()
    {
        return $this->hasMany('App\SeasonPost');
    }

    public function competitions() {
        return $this->hasMany('App\Competition');
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopeTournament($query, $tournament)
    {
        if ($tournament > 0) {
            $query->where("tournament_id", "=", $tournament);
        }
    }

    public function fullParticipants()
    {
        $max_registers = $this->num_participants;
        if ($max_registers > 0) {
            $current = $this->participants->count();
            if ($current >= $max_registers) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function hasCompetitionWithPhases()
    {
        foreach ($this->competitions as $competition) {
            if ($competition->phases->count() > 0) {
                return true;
            }
        }

        return false;
    }

    public function free_places()
    {
        $max_registers = $this->num_participants;
        if ($this->tournament->participant_type == 'individual') {
            $inscriptions = Participant::where('season_id', $this->id)->where('user_id', '>', 0)->count();
            $free_places = $max_registers - $inscriptions;
        } else {
            $inscriptions = Participant::where('season_id', $this->id)->where('eteam_id', '>', 0)->count();
            $free_places = $max_registers - $inscriptions;
        }

        return $free_places;
    }

    public function fill_places()
    {
        $max_registers = $this->num_participants;
        $free_places = $this->free_places();
        $fill_places = $max_registers - $free_places;

        return $fill_places;
    }

    public function fill_places_percent()
    {
        return intval(($this->fill_places() / $this->num_participants) * 100);
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
