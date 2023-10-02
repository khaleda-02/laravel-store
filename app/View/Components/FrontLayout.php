<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title;
    public function __construct($title = null)
    {
        $title = $title ?? config('app.name');
    }


    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
