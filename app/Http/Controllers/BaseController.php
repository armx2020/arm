<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Region;

abstract class BaseController extends Controller
{
    protected $regions = [];

    public function __construct()
    {
        $this->regions = Region::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });
    }
}
