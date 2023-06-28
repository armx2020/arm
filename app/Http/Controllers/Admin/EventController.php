<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
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
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $event = new Event();

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->date_to_start = $request->date_to_start;
        $event->parent_type = 'App\Models\Admin';
        $event->parent_id = 1;

        if ($request->image) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('admin.event.index')->with('success', 'The event added');
    }

    public function show(string $id)
    {
        $event = Event::with('parent')->findOrFail($id);

        return view('admin.event.show', ['event' => $event]);
    }

    public function edit(string $id)
    {
        $event = Event::with('parent')->findOrFail($id);

        return view('admin.event.edit', ['event' => $event]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $event = Event::findOrFail($id);

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->date_to_start = $request->date_to_start;

        if ($request->image) {
            Storage::delete('public/'.$event->image);
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
