<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Group;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;

    public $term = 0;
    public $region = 1;
    public $search = '';
    public $sort = "updated_at|desc";


    public function render()
    {
        $exp = explode('|', $this->sort);

        if ($this->search == '') {
            sleep(1);
            if ($this->term == 0 && $this->region == 1) {
                $groups = Group::with('users', 'category')->where('activity', 1)->orderBy($exp[0], $exp[1])->paginate(4);
            } elseif ($this->term !== 0 && $this->region == 1) {
                $groups = Group::with('users', 'region', 'category')
                    ->where('activity', 1)
                    ->where('category_id', '=', $this->term)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(4);
            } elseif ($this->term == 0 && $this->region !== 1) {
                $groups = Group::with('users', 'region', 'category')
                    ->where('activity', 1)
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(4);
            } else {
                $groups = Group::with('users', 'region', 'category')
                    ->where('activity', 1)
                    ->where('category_id', '=', $this->term)
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(4);
            }
        } else {
            sleep(1);
            $groups = Group::search($this->search)->with('users', 'region', 'category')->where('activity', 1)->paginate(4);
        }

        $categories = Category::orderBy('sort_id', 'asc')->active()->group()->get();
        $regions = Region::all();

        return view('livewire.home-page', [
            'groups' => $groups,
            'regions' => $regions,
            'categories' => $categories
        ]);
    }
}
