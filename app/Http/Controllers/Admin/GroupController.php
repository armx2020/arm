<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\GroupRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\User;
use App\Services\GroupService;
use Illuminate\Support\Facades\Storage;

class GroupController extends BaseAdminController
{
    public function __construct(private GroupService $groupService)
    {
        parent::__construct();
        $this->groupService = $groupService;
    }


    public function index()
    {
        return view('admin.group.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $categories = Category::group()->active()->get();
        $users = User::all();

        return view('admin.group.create', ['categories' => $categories, 'users' => $users, 'menu' => $this->menu]);
    }

    public function store(GroupRequest $request)
    {
        $this->groupService->store($request);

        return redirect()->route('admin.group.index')->with('success', 'Группа добавлена');
    }

    public function show(string $id)
    {
        $group = Group::with('user', 'category', 'users')->find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'Группа не найдена');
        }

        return view('admin.group.edit', ['group' => $group, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $group = Group::with('user', 'category')->find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'Группа не найдена');
        }

        $categories = Category::group()->active()->get();
        $users = User::all();
        $user = $group->user;
        $category = $group->category;

        return view('admin.group.edit', [
            'group' => $group,
            'user' => $user,
            'category' => $category,
            'categories' => $categories,
            'users' => $users,
            'menu' => $this->menu
        ]);
    }

    public function update(GroupRequest $request, string $id)
    {
        $group = Group::find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'Группа не найдена');
        }

        $group = $this->groupService->update($request, $group);

        return redirect()->route('admin.group.edit', ['group' => $group->id])
            ->with('success', 'Группа сохранена');
    }

    public function destroy(string $id)
    {
        $group = Group::with('users', 'events', 'projects', 'works', 'news')->find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'Группа не найдена');
        }

        foreach ($group->events as $event) {
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $event->delete();
        }

        foreach ($group->news as $news) {
            if ($news->image) {
                Storage::delete('public/' . $news->image);
            }
            $news->delete();
        }

        foreach ($group->projects as $project) {
            if ($project->image !== null) {
                Storage::delete('public/' . $project->image);
            }
            $project->delete();
        }

        foreach ($group->works as $work) {
            $work->delete();
        }

        foreach ($group->users as $user) {
            $group->users()->detach($user->id);
        }

        if ($group->image !== null) {
            Storage::delete('public/' . $group->image);
        }
        if ($group->image1 !== null) {
            Storage::delete('public/' . $group->image1);
        }
        if ($group->image2 !== null) {
            Storage::delete('public/' . $group->image2);
        }
        if ($group->image3 !== null) {
            Storage::delete('public/' . $group->image3);
        }
        if ($group->image4 !== null) {
            Storage::delete('public/' . $group->image4);
        }

        $group->delete();

        return redirect()->route('admin.group.index')->with('success', 'Группа удалена');
    }
}
