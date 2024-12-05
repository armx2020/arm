<?php

namespace App\Http\Livewire;

use App\Models\Region;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseSelect extends Component
{
    use WithPagination;

    public $region;
    public $sort;
    public $position;

    protected $quantityOfDisplayed = 20; // Количество отоброжаемых сущностей

    public function __construct(string $sort = "updated_at|desc", int $position = 2)
    {
        $this->sort = $sort;
        $this->position = $position;
    }

    public function mount(Request $request, $regionCode = null)
    {
        if($regionCode) {
            $reg = Region::where('code', '=', $regionCode)->First();
        } else {
            $reg = Region::where('name', '=', $request->session()->get('region'))->First();
        }

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }
    }
}
