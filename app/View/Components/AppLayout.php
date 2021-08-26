<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public $wfooter;

    public function __construct($title = null, $wfooter = null)
    {
        $this->title = $title;
        $this->wfooter = $wfooter;
    }

    public function render()
    {
        return view('layouts.app');
    }
}
