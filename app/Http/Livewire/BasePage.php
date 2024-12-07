<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\Project;
use App\Models\Region;
use App\Models\Work;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class BasePage extends Component
{
    use WithPagination;

    public $region;
    public $position = 2;
    public $entity = 'companies';
    public $category = 'Все';

    protected $quantityOfDisplayed = 20; // Количество отоброжаемых сущностей

    public function mount(Request $request, $regionCode = null, $entity = 'companies')
    {
        if ($regionCode) {
            $reg = Region::where('code', '=', $regionCode)->First();
        } else {
            $reg = Region::where('name', '=', $request->session()->get('region'))->First();
        }

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }

        $this->entity = $entity;
    }

    public function render()
    {
        $categories = null;
        $activities = null;
        $typeWorks = null;

        switch ($this->entity) {
            case 'projects':
                $entityShowRout = 'projects.show';
                $entities = Project::query()->active();

                $activities = [
                    'Все' => 'Все',
                    'Открытые' => 1,
                    'Закрытые' => 0
                ];

                if ($this->category !== 'Все' && ($this->category == 0 || $this->category == 1)) {
                    $entities = $entities->where('activity', '=', $this->category);
                }

                break;
            case 'companies':
                $entityShowRout = 'companies.show';
                $entities = Company::query()->active()->with(['categories', 'region']);
                $categories = Category::offer()->active()->main()->get();

                if ($this->category !== 'Все') {
                    $entities = $entities->whereHas('categories', function ($query) {
                        $query->where('category_company.main_category_id', '=', $this->category);
                    });
                }

                break;
            case 'events':
                $entityShowRout = 'events.show';
                $entities = Event::query()->active()->with('city');
                $categories = Category::event()->active()->main()->get();

                if ($this->category !== 'Все') {
                    $entities = $entities->where('category_id', '=', $this->category);
                }
                break;
            case 'news':
                $entityShowRout = 'news.show';
                $entities = Project::query()->active();
                break;
            case 'groups':
                $entityShowRout = 'groups.show';
                $entities = Group::query()->active()->with('region');
                $categories = Category::group()->active()->main()->get();

                if ($this->category !== 'Все') {
                    $entities = $entities->where('category_id', '=', $this->category);
                }
                break;
            case 'works':
                $entityShowRout = 'works.show';
                $entities = Work::query()->active()->with('city');

                $typeWorks = [
                    'Все' => 'Все',
                    'Вакансии' => 'vacancy',
                    'Резюмэ' => 'resume'
                ];

                if ($this->category !== 'Все' && ($this->category == 'vacancy' || $this->category == 'resume')) {
                    $entities = $entities->where('type', '=', $this->category);
                }

                break;
            default:
                $entityShowRout = 'companies.show';
                $entities = Company::query()->active()->with(['categories', 'region']);
                $categories = Category::offer()->active()->main()->get();

                if ($this->category !== 'Все') {
                    $entities = $entities->whereHas('categories', function ($query) {
                        $query->where('category_company.main_category_id', '=', $this->category);
                    });
                }

                break;
        }

        $recommendations = [];

        if ($this->region !== 1) {
            $entities = $entities
                ->where('region_id', '=', $this->region);
        }

        $entities = $entities->paginate($this->quantityOfDisplayed);

        $regions = Region::all();

        return view('livewire.base-page', [
            'entityShowRout' => $entityShowRout,
            'entities' => $entities,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
            'categories' => $categories,
            'activities' => $activities,
            'typeWorks' => $typeWorks
        ]);
    }
}
