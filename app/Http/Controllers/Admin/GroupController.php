<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\User;
use App\Services\GroupService;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    public function __construct(private GroupService $groupService)
    {
        $this->groupService = $groupService;
    }


    public function index()
    {
        return view('admin.group.index');
    }

    public function create()
    {
        $categories = GroupCategory::all();
        $users = User::all();

        return view('admin.group.create', ['categories' => $categories, 'users' => $users]);
    }

    public function store(GroupRequest $request)
    {
        $this->groupService->store($request);

        return redirect()->route('admin.group.index')->with('success', 'The group added');
    }

    public function show(string $id)
    {
        $group = Group::with('user', 'category', 'users')->find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'The group not found');
        }

        return view('admin.group.show', ['group' => $group]);
    }

    public function edit(string $id)
    {
        $group = Group::with('user', 'category')->find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'The group not found');
        }

        $categories = GroupCategory::all();
        $users = User::all();
        $user = $group->user;
        $category = $group->category;

        return view('admin.group.edit', [
            'group' => $group,
            'user' => $user,
            'category' => $category,
            'categories' => $categories,
            'users' => $users
        ]);
    }

    public function update(GroupRequest $request, string $id)
    {
        $group = Group::find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'The group not found');
        }

        $group = $this->groupService->update($request, $group);

        return redirect()->route('admin.group.show', ['group' => $group->id])
            ->with('success', 'The group updated');
    }

    public function destroy(string $id)
    {
        $group = Group::with('users', 'events', 'projects', 'vacancies', 'news')->find($id);

        if (empty($group)) {
            return redirect()->route('admin.group.index')->with('alert', 'The group not found');
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

        foreach ($group->vacancies as $vacancy) {
            $vacancy->delete();
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

        return redirect()->route('admin.group.index')->with('success', 'The group deleted');
    }
}
