<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event.index');
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.event.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->findOrFail($request->city);

        $event = new Event();

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->region_id = $city->region->id; // add to region key
        $event->date_to_start = $request->date_to_start;

        if ($request->parent == 'User') {
            $event->parent_type = 'App\Models\User';
            $event->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $event->parent_type = 'App\Models\Company';
            $event->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $event->parent_type = 'App\Models\Group';
            $event->parent_id = $request->group;
        } else {
            $event->parent_type = 'App\Models\Admin';
            $event->parent_id = 1;
        }

        if ($request->image) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('admin.event.index')->with('success', 'The event added');
    }

    public function show(string $id)
    {
        $event = Event::with('parent')->findOrFail($id);

        return view('admin.event.show', [ 'event' => $event ]);
    }

    public function edit(string $id)
    {
        $event = Event::with('parent')->findOrFail($id);
        
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.event.edit', [
            'event' => $event,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $event = Event::findOrFail($id);
        
        $city = City::with('region')->findOrFail($request->city);

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->region_id = $city->region->id; // add to region key
        $event->date_to_start = $request->date_to_start;

        if ($request->parent == 'User') {
            $event->parent_type = 'App\Models\User';
            $event->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $event->parent_type = 'App\Models\Company';
            $event->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $event->parent_type = 'App\Models\Group';
            $event->parent_id = $request->group;
        } else {
            $event->parent_type = 'App\Models\Admin';
            $event->parent_id = 1;
        }

        if ($request->image) {
            Storage::delete('public/' . $event->image);
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->update();

        return redirect()->route('admin.event.index')->with('success', 'The event added');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.event.index')->with('succes', 'The event deleted');
    }
}
