<?php

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HorizontalCard extends Component
{
    public function __construct(public $entity)
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.pages.horizontal-card');
    }
}
