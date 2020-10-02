<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
	protected $fillable = ['group_id', 'allow_draws', 'win_points', 'draw_points', 'lose_points', 'play_amount', 'win_amount', 'draw_amount', 'lose_amount'];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function days()
    {
        return $this->hasMany('App\LeagueDay', 'league_id');
    }

    public function tablezones()
    {
        return $this->hasMany('App\LeagueTablezone', 'league_id');
    }

    public function played_matches()
    {
        $played_matches = 0;
        if ($this->days->count() > 0) {
            foreach ($this->days as $day) {
                if ($day->matches->count() > 0) {
                    foreach ($day->matches as $match) {
                        if (!is_null($match->local_score) && !is_null($match->visitor_score)) {
                            $played_matches++;
                        }
                    }
                }
            }
        }
        return $played_matches;
    }

    public function generate_table()
    {
        $table_participants = collect();

        foreach ($this->group->participants as $key => $participant) {
            $data = $this->get_table_data_participant($participant->id);
            $table_participants->push([
                'participant' => $participant,
                'pj' => $data['pj'],
                'pg' => $data['pg'],
                'pe' => $data['pe'],
                'pp' => $data['pp'],
                'ps' => $data['ps'],
                'gf' => $data['gf'],
                'gc' => $data['gc'],
                'avg' => $data['avg'],
                'avg_p' => 0,
                'pts' => $data['pts'],
            ]);
        }
        $table_participants = $table_participants->sortByDesc('gf')->sortByDesc('avg')->sortByDesc('pts')->values();

        foreach ($table_participants as $key => $tp) {
            $filtered = $table_participants->filter(function ($value, $key) use ($tp) {
                if ($value['pts'] == $tp['pts']) {
                    return $value;
                }
            })->values();

            if (count($filtered) == 2) {
                if ($filtered[0]['participant'] == $tp['participant']) {
                    $p1 = $filtered[0]['participant'];
                    $p2 = $filtered[1]['participant'];
                } else {
                    $p1 = $filtered[1]['participant'];
                    $p2 = $filtered[0]['participant'];
                }
                $matches = \App\LeagueDay::select('leagues_days.*', 'matches.*')
                    ->join('matches', 'matches.day_id', '=', 'leagues_days.id')
                    ->where(function ($query) use ($p1, $p2) {
                        $query->where('matches.local_id', '=', $p1->id)
                              ->Where('matches.visitor_id', '=', $p2->id);
                    })
                    ->orWhere(function ($query) use ($p1, $p2) {
                        $query->where('matches.local_id', '=', $p2->id)
                              ->Where('matches.visitor_id', '=', $p1->id);
                    })
                    ->get();

                $p1_goals = 0;
                $p2_goals = 0;
                foreach ($matches as $match) {
                    if ($match->local_id == $p1->id) {
                        $p1_goals += $match->local_score;
                        $p2_goals += $match->visitor_score;
                    } else {
                        $p1_goals += $match->visitor_score;
                        $p2_goals += $match->local_score;
                    }
                }

                if ($p1_goals > $p2_goals) {
                    $tp_aux = $table_participants->toArray();
                    $tp_aux[$key]['avg_p'] = 1;
                    $table_participants = collect($tp_aux);
                }
            }
        }

        $table_participants = $table_participants->sortByDesc('gf')->sortByDesc('avg')->sortByDesc('avg_p')->sortByDesc('pts')->values();

        if ($this->has_tablezones()) {
            $table_participants2 = collect();
            $zones = [];
            foreach ($this->tablezones as $key => $tablezone) {
                $zones[$key] = \App\LeagueTablezone::where('league_id', '=', $this->id)->where('position', '=', $key+1)->first()->tablezone;
            }

            foreach ($table_participants as $key => $tp) {
                $table_participants2->push([
                    'participant' => $table_participants[$key]['participant'],
                    'pj' => $table_participants[$key]['pj'],
                    'pg' => $table_participants[$key]['pg'],
                    'pe' => $table_participants[$key]['pe'],
                    'pp' => $table_participants[$key]['pp'],
                    'ps' => $table_participants[$key]['ps'],
                    'gf' => $table_participants[$key]['gf'],
                    'gc' => $table_participants[$key]['gc'],
                    'avg' => $table_participants[$key]['avg'],
                    'pts' => $table_participants[$key]['pts'],
                    'table_zone' => $zones[$key],
                ]);
            }
            $table_participants = $table_participants2;
        }

        return $table_participants;
    }

    protected function get_table_data_participant($participant_id)
    {
        $matches = LeagueDay::select('leagues_days.*', 'matches.*')
            ->join('matches', 'matches.day_id', '=', 'leagues_days.id')
            ->where('matches.local_id', '=', $participant_id)
            ->orwhere('matches.visitor_id', '=', $participant_id)
            ->get();

        $data = [
            "pj" => 0,
            "pg" => 0,
            "pe" => 0,
            "pp" => 0,
            "ps" => 0,
            "gf" => 0,
            "gc" => 0,
            "avg" => 0,
            "pts" => 0
        ];

        foreach ($matches as $match) {
            if (!is_null($match->local_score) && !is_null($match->visitor_score))
            {
                $data['pj'] = $data['pj'] + 1;

                if ($participant_id == $match->local_id) { //local
                    if ($match->local_score > $match->visitor_score) {
                        $data['pg'] = $data['pg'] + 1;
                        $data['pts'] = $data['pts'] + intval($this->win_points);
                    } elseif ($match->local_score == $match->visitor_score) {
                        $data['pe'] = $data['pe'] + 1;
                        $data['pts'] = $data['pts'] + intval($this->draw_points);
                    } else {
                        $data['pp'] = $data['pp'] + 1;
                        $data['pts'] = $data['pts'] + intval($this->lose_points);
                    }
                    $data['gf'] = $data['gf'] + $match->local_score;
                    $data['gc'] = $data['gc'] + $match->visitor_score;

                } else { //visitor
                    if ($match->visitor_score > $match->local_score) {
                        $data['pg'] = $data['pg'] + 1;
                        $data['pts'] = $data['pts'] + intval($this->win_points);
                    } elseif ($match->local_score == $match->visitor_score) {
                        $data['pe'] = $data['pe'] + 1;
                        $data['pts'] = $data['pts'] + intval($this->draw_points);
                    } else {
                        $data['pp'] = $data['pp'] + 1;
                        $data['pts'] = $data['pts'] + intval($this->lose_points);
                    }
                    $data['gf'] = $data['gf'] + $match->visitor_score;
                    $data['gc'] = $data['gc'] + $match->local_score;
                }

                if ($match->sanctioned_id && ($participant_id == $match->sanctioned_id )) {
                    $data['ps'] = $data['ps'] + 1;
                }
            }
        }
        $data['avg'] = $data['gf'] - $data['gc'];
        return $data;
    }

    public function table_participant_position($position)
    {
        $pos = $position -1;
        $tp = $this->generate_table();
        return $tp[$pos]['participant'];
    }

    public function total_matches()
    {
        $counter = 0;
        foreach ($this->days as $day) {
            $counter += $day->matches->count();
        }
        return $counter;
    }

    public function pending_matches()
    {
        $counter = 0;
        foreach ($this->days as $day) {
            foreach ($day->matches as $match) {
                if (is_null($match->local_score) && is_null($match->visitor_score)) {
                    $counter++;
                }
            }
        }
        return $counter;
    }

    public function has_winner()
    {
        if ($this->pending_matches() == 0) {
            if ($this->group->phase->is_last()) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function has_tablezones()
    {
        if (LeagueTablezone::where('league_id', $this->id)->whereNotNull('tablezone_id')->count() > 0) {
            return true;
        }
        return false;
    }

}
