<?php

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EntityChild extends Component
{
    public function __construct(public $entity)
    {
        //
    }
    
    public function render(): View|Closure|string
    {
        return view('components.pages.entity-child');
    }
}