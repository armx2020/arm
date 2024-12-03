<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EventAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;


class EventController extends BaseAdminController
{
    public function __construct(private EventAction $eventAction)
    {
        parent::__construct();
        $this->eventAction = $eventAction;
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
        $categories = Category::event()->get();

        return view('admin.event.create', [
            'categories' => $categories,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function store(EventRequest $request)
    {
        $this->eventAction->store($request);

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
        $event = Event::with(['parent', 'category'])->find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'Событие не найдено');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();
        $categories = Category::event()->whereNot('id', $event->category_id)->get();

        return view('admin.event.edit', [
            'event' => $event,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'categories' => $categories,
            'menu' => $this->menu
        ]);
    }

    public function update(EventRequest $request, string $id)
    {
        $event = Event::find($id);

        if (empty($event)) {
            return redirect()->route('admin.event.index')->with('alert', 'Событие не найдено');
        }

        $event = $this->eventAction->update($request, $event);

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
