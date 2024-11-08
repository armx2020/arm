<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use App\Services\EventService;

class EventController extends Controller
{
    public function __construct(private EventService $eventService)
    {
        $this->eventService = $eventService;
    }

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

    public function store(EventRequest $request)
    {
        $this->eventService->store($request);

        return redirect()->route('admin.event.index')->with('success', 'The event added');
    }

    public function show(string $id)
    {
        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'The event not found');
        }

        return view('admin.event.show', ['event' => $event]);
    }

    public function edit(string $id)
    {
        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'The event not found');
        }

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

    public function update(EventRequest $request, string $id)
    {
        $event = Event::find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'The event not found');
        }

        $event = $this->eventService->update($request, $event);

        return redirect()->route('admin.event.index')->with('success', 'The event updated');
    }

    public function destroy(string $id)
    {
        $event = Event::find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'The event not found');
        }

        $event->delete();

        return redirect()->route('admin.event.index')->with('succes', 'The event deleted');
    }
}
