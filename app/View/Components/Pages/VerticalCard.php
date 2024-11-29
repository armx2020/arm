<?php

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VerticalCard extends Component
{
    public function __construct(public $entity, public $entityShowRout)
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.pages.vertical-card');
    }
}