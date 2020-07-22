<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Str;
use App\SeasonPost;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generate_season_post($season_id, $type, $img, $title, $content)
    {
    	SeasonPost::create([
    		'season_id'		=> $season_id,
    		'type'			=> $type,
    		'img'			=> $img,
    		'title'			=> $title,
    		'content'		=> $content,
    		'slug'			=> Str::slug($title, '-')
    	]);
    }

}
