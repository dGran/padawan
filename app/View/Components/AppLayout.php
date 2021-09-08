<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public $wfooter;
    public $breadcrumb;
    public $wloader;

    public function __construct($title = null, $wfooter = null, $breadcrumb = null, $wloader = null)
    {
        $this->title = $title;
        $this->wfooter = $wfooter;
        $this->breadcrumb = $breadcrumb;
        $this->wloader = $wloader;
    }

    public function render()
    {
        return view('layouts.app');
    }
}
