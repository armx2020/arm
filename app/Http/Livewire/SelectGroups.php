<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\GroupCategory;
use Livewire\Component;
use Livewire\WithPagination;

class SelectGroups extends Component
{
    use WithPagination;

    public $term = 0;

    public function render()
    {
        if ($this->term == 0) {
            $groups = Group::with('users')->paginate(12);
        } else {
            $groups = Group::with('users')->where('group_category_id', '=', $this->term)->paginate(12);
        }

        $categories = GroupCategory::orderBy('sort_id', 'asc')->get();

        return view('livewire.select-groups', ['groups' => $groups, 'categories' => $categories]);
    }
}
