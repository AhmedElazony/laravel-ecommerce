<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StoreFrontLayout extends Component
{
    public string $title;
    public string $heading;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $heading = null)
    {
        $this->title = $title ?? config('app.name');
        $this->heading = $heading ?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.store-front');
    }
}
