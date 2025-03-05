<?php

namespace App\Http\Controllers\InformUs;

use App\Http\Controllers\BaseController;
use App\Models\City;


abstract class BaseInformUsController extends BaseController
{
    public $cities;

    public function __construct()
    {
        $this->cities = City::all();
        parent::__construct();
    }
}
