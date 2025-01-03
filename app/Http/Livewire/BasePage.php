<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Region;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;


class BasePage extends Component
{
    use WithPagination;

    public $region = '1';
    public $type = '';
    public $category = 'Все';

    protected $quantityOfDisplayed = 20; // Количество отоброжаемых сущностей

    public function mount(Request $request, $regionCode = null, $type = 1)
    {
        if ($regionCode) {
            $reg = Region::where('code', '=', $regionCode)->First();
        } else {
            $reg = Region::where('name', '=', $request->session()->get('region'))->First();
        }

        if (empty($reg)) {
            $this->region = '1';
        } else {
            $this->region = (string) $reg->id;
        }

        $this->type = $type;
    }

    public function render()
    {
        $categories = null;

        $entityShowRout = '';
        $categories = Category::active()->main()->where('entity_type_id', $this->type)->get();
        $entities = Entity::query()->active()->with('fields')->where('entity_type_id', $this->type);

        if ($this->region !== '1') {
            $entities = $entities
                ->where('region_id', '=', $this->region);
        }

        if ($this->category !== 'Все') {
            $entities = $entities->whereHas('fields', function ($query) {
                $query->where('category_entity.main_category_id', '=', $this->category);
            });
        }

        $recommendations = [];

        $entities = $entities->paginate($this->quantityOfDisplayed);

        $regions = Region::all();
        $entityTypies = EntityType::all();

        return view('livewire.base-page', [
            'entityShowRout' => $entityShowRout,
            'entities' => $entities,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'categories' => $categories,
            'entityTypies' => $entityTypies
        ]);
    }

    public function resetCategory()
    {
        $this->category = 'Все';
    }
}
