<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function remove_img_from_storage($folder, $name)
    {
        \Storage::disk($folder)->delete($name . '.jpeg');
        \Storage::disk($folder)->delete($name . '.png');
        \Storage::disk($folder)->delete($name . '.jpg');
        \Storage::disk($folder)->delete($name . '.gif');
        \Storage::disk($folder)->delete($name . '.svg');
    }
}
