<?php

namespace App\Imports;

use App\Tournament;
use App\Season;
use App\PlayerDatabase;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class SeasonsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $tournament = Tournament::find($row['tournament_id']);
        if ($row['players_databases_id'] > 0) {
        	$database = PlayerDatabase::find($row['players_databases_id']);
    	}
        if ($tournament) {
	        if ($row['players_databases_id'] > 0) {
        		if ($database) {
        			$season = $this->create($row);
        			return $season;
        		}
    		}
			$season = $this->create($row);
			return $season;
        }
    }

    public function create($row)
    {
        $season = Season::create([
           'tournament_id'          	=> $row['tournament_id'],
           'name'                   	=> $row['name'],
           'state'						=> $row['state'],
           'num_participants'			=> $row['num_participants'] == null ? 0 : $row['num_participants'],
           'inscription_price'			=> $row['inscription_price'],
           'free_inscription'			=> $row['free_inscription'] == null ? 0 : $row['free_inscription'],
           'players_databases_id'		=> $row['players_databases_id'],
           'min_players'				=> $row['min_players'],
           'max_players'				=> $row['max_players'],
           'initial_budget'				=> $row['initial_budget'],
           'salary_cap'					=> $row['salary_cap'],
           'free_agents_default_salary'	=> $row['free_agents_default_salary'],
           'free_agents_default_price'	=> $row['free_agents_default_price'],
           'free_agents_new_salary'		=> $row['free_agents_new_salary'],
           'free_agents_new_price'		=> $row['free_agents_new_price'],
           'dismiss_remuneration'		=> $row['dismiss_remuneration'],
           'clauses_max_paid'			=> $row['clauses_max_paid'],
           'clauses_max_received'		=> $row['clauses_max_received'],
           'clause_tax'					=> $row['clause_tax'],
           'period_salaries'			=> $row['period_salaries'] == null ? 0 : $row['period_salaries'],
           'period_transfers'			=> $row['period_transfers'] == null ? 0 : $row['period_transfers'],
           'period_free_players'		=> $row['period_free_players'] == null ? 0 : $row['period_free_players'],
           'period_clauses'				=> $row['period_clauses'] == null ? 0 : $row['period_clauses'],
           'allow_cessions'				=> $row['allow_cessions'] == null ? 0 : $row['allow_cessions'],
           'slug'             			=> Str::slug($row['name'], '-'),
        ]);
        return $season;
    }
}