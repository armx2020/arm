<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Region;
use Illuminate\Contracts\Database\Query\Builder;
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

    public function mount(Request $request, $region = null, $type = 1)
    {
        if ($region) {
            $reg = Region::where('transcription', 'like', $region)->First();
        } else {
            $reg = Region::where('transcription', 'like', $request->session()->get('regionTranslit'))->First();
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
        $entities = Entity::query()->active()->with('fields', 'offers')->withCount('offers');

        if ($this->type) {
            $entities = $entities->where('entity_type_id', $this->type);
        }

        if ($this->region !== '1') {
            $entities = $entities->orderByRaw("FIELD(`region_id`, $this->region) DESC")->orderBy('offers_count', 'desc');
        }


        $entities = $entities->orderByDesc('sort_id');

        if ($this->category !== 'Все') {
            $entities = $entities
                ->where(function (Builder $query) {
                    $query
                        ->where('category_id', $this->category)
                        ->orWhereHas('fields', function ($que) {
                            $que->where('category_entity.main_category_id', '=', $this->category);
                        });
                });
        }

        $entities = $entities->paginate($this->quantityOfDisplayed);

        $regions = Region::all();
        $entityTypies = EntityType::active()->get();

        return view('livewire.base-page', [
            'entityShowRout' => $entityShowRout,
            'entities' => $entities,
            'regions' => $regions,
            'region' => $this->region,
            'categories' => $categories,
            'entityTypies' => $entityTypies
        ]);
    }

    public function resetCategory()
    {
        $this->category = 'Все';
    }
}
