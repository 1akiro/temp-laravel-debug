<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TourCard extends Component
{

    public $tour;
    /**
     * Create a new component instance.
     */
    public function __construct($tour)
    {
        $this->tour = $tour;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tour-card');
    }
}
