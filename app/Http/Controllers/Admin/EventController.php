<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('parent')->latest()->paginate(20);

        return view('admin.event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'description' => ['string'],
            'image' => ['image', 'max:2048'],
        ]);

        $event = new Event();

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->date_to_start = $request->date_to_start;
        $event->parent_type = 'App\Models\Admin';
        $event->parent_id = 1;

        if ($request->image) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('admin.event.index')->with('success', 'The event added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('parent')->findOrFail($id);

        return view('admin.event.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::with('parent')->findOrFail($id);

        return view('admin.event.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'description' => ['string'],
            'image' => ['image', 'max:2048'],
        ]);

        $event = Event::findOrFail($id);

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->date_to_start = $request->date_to_start;

        if ($request->image) {
            Storage::delete('public/'.$event->image);
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->update();

        return redirect()->route('admin.event.index')->with('success', 'The event added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.event.index')->with('succes', 'The event deleted');
    }
}
