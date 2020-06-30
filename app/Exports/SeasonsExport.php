<?php

namespace App\Exports;

use App\Season;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeasonsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $seasons;

    public function __construct($seasons = null)
    {
        $this->seasons = $seasons;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->seasons ?: Season::all();
    }

    public function headings(): array
    {
        return [
            'id', 'tournament_id', 'name', 'state', 'num_participants', 'inscription_price', 'free_inscription', 'players_databases_id', 'min_players', 'max_players', 'initial_budget', 'salary_cap', 'free_agents_default_salary', 'free_agents_default_price', 'free_agents_new_salary', 'free_agents_new_price', 'dismiss_remuneration', 'clauses_max_paid', 'clauses_max_received', 'clause_tax', 'period_salaries', 'period_transfers', 'period_free_players', 'period_clauses', 'allow_cessions'
        ];
    }
}