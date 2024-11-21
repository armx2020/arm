<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\EventRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use App\Services\EventService;

class EventController extends BaseAdminController
{
    public function __construct(private EventService $eventService)
    {
        parent::__construct();
        $this->eventService = $eventService;
    }

    public function index()
    {
        return view('admin.event.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.event.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function store(EventRequest $request)
    {
        $this->eventService->store($request);

        return redirect()->route('admin.event.index')->with('success', 'Событие добавлено');
    }

    public function show(string $id)
    {
        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'Событие не найдено');
        }

        return view('admin.event.edit', ['event' => $event, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'Событие не найдено');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.event.edit', [
            'event' => $event,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function update(EventRequest $request, string $id)
    {
        $event = Event::find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'Событие не найдено');
        }

        $event = $this->eventService->update($request, $event);

        return redirect()->route('admin.event.edit', ['event' => $event->id])->with('success', 'Событие сохранено');
    }

    public function destroy(string $id)
    {
        $event = Event::find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'Событие не найдено');
        }

        $event->delete();

        return redirect()->route('admin.event.index')->with('succes', 'Событие удалено');
    }
}
