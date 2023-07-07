<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Region;

class SelectEvents extends Component
{
    use WithPagination;

    public $region;

    public function mount(Request $request)
    {
        $reg = Region::where('InEnglish', '=', $request->session()->get('region'))->First();

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }
    }
    public function render()
    {
        if ($this->region == 1) {
            $events = Event::orderBy('date_to_start')->paginate(12);
        } else {
            $events = Event::with('region')
                ->where('region_id', '=', $this->region)
                ->orderBy('date_to_start')
                ->paginate(12);
        }

        $regions = Region::all();

        return view('livewire.select-events', [
            'events' => $events,
            'regions' => $regions,
            'region' => $this->region
        ]);
    }
}
