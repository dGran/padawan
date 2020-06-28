<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	protected $table = 'tournaments_seasons';
	protected $fillable = ['tournament_id', 'name', 'state', 'num_participants', 'inscription_price', 'free_inscription', 'players_databases_id', 'min_players', 'max_players', 'initial_budget', 'salary_cap', 'free_agents_salary', 'free_agents_new_salary', 'free_agents_new_cost', 'free_agents_new_remuneration', 'clauses_max_paid', 'clauses_max_received', 'clause_tax', 'period_salaries',
		'period_transfers', 'period_free_players', 'period_clauses', 'allow_cession', 'slug'];

    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
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

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
