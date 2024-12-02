<?php

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public function __construct(
        public $firstPositionUrl = '/',
        public $firstPositionName = 'Главная',
        public $secondPositionUrl = null,
        public $secondPositionName = null,
        public $thirdPositionUrl = null,
        public $thirdPositionName = null,
        public $fourthPositionUrl = null,
        public $fourthPositionName = null,
    ) {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.pages.breadcrumbs');
    }
}
