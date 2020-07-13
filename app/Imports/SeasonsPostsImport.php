<?php

namespace App\Imports;

use App\SeasonPost;
use App\Season;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class SeasonsPostsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
		$season = Season::find($row['season_id']);
        if ($season) {
            $season_post = SeasonPost::create([
           		'season_id' => $row['season_id'],
           		'type'      => $row['type'],
           		'title'     => $row['title'],
           		'content'   => $row['content'],
           		'slug'		=> Str::slug($row['title'], '-'),
              'created_at' => $row['created_at'],
              'updated_at' => $row['updated_at'],
            ]);
            return $season_post;
        }
    }
}