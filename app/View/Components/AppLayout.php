<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public $wfooter;
    public $breadcrumb;

    public function __construct($title = null, $wfooter = null, $breadcrumb = null)
    {
        $this->title = $title;
        $this->wfooter = $wfooter;
        $this->breadcrumb = $breadcrumb;
    }

    public function render()
    {
        return view('layouts.app');
    }
}
