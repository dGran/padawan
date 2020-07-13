<?php

namespace App\Exports;

use App\SeasonPost;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeasonsPostsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $seasons_posts;

    public function __construct($seasons_posts = null)
    {
        $this->seasons_posts = $seasons_posts;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->seasons_posts ?: SeasonPost::all();
    }

    public function headings(): array
    {
        return [
            'id', 'season_id', 'type', 'title', 'content', 'created_at', 'updated_at'
        ];
    }
}