<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $regions = [];
    protected $selectRegion = null;

    public function __construct()
    {
        $this->regions = Region::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });
    }
}
