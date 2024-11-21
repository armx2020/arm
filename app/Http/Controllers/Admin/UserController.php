<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseAdminController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.user.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view('admin.user.create', ['menu' => $this->menu]);
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request);

        return redirect()->route('admin.user.index')->with('success', 'The user added');
    }

    public function show(string $id)
    {
        $user = User::with(
            'events',
            'groups',
            'companies',
            'works',
            'projects',
        )
            ->find($id);

        if (empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user not found');
        }

        return view('admin.user.edit', ['user' => $user, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user not found');
        }

        return view('admin.user.edit', ['user' => $user, 'menu' => $this->menu]);
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user not found');
        }

        $user = $this->userService->update($request, $user);

        return redirect()->route('admin.user.edit', ['user' => $user->id])
            ->with('success', "The user updated");
    }

    public function destroy(string $id)
    {
        $user = User::with(
            'inGroups',
            'events',
            'news',
            'groups',
            'companies',
            'works',
            'projects',
        )->find($id);

        if (empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user not found');
        }

        foreach ($user->inGroups as $group) {
            $user->inGroups()->detach($group->id);
        }

        foreach ($user->groups as $group) {
            if ($group->image) {
                Storage::delete('public/' . $group->image);
            }
            if ($group->image1) {
                Storage::delete('public/' . $group->image1);
            }
            if ($group->image2) {
                Storage::delete('public/' . $group->image2);
            }
            if ($group->image2) {
                Storage::delete('public/' . $group->image3);
            }
            if ($group->image4) {
                Storage::delete('public/' . $group->image4);
            }
            $group->delete();
        }

        foreach ($user->companies as $company) {
            if ($company->image) {
                Storage::delete('public/' . $company->image);
            }
            $group->delete();
        }

        foreach ($user->events as $event) {
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $event->delete();
        }

        foreach ($user->news as $news) {
            if ($news->image) {
                Storage::delete('public/' . $news->image);
            }
            if ($news->image1) {
                Storage::delete('public/' . $news->image1);
            }
            if ($news->image2) {
                Storage::delete('public/' . $news->image2);
            }
            if ($news->image3) {
                Storage::delete('public/' . $news->image3);
            }
            if ($news->image4) {
                Storage::delete('public/' . $news->image4);
            }
            $news->delete();
        }

        foreach ($user->projects as $project) {
            if ($project->image !== null) {
                Storage::delete('public/' . $project->image);
            }
            $project->delete();
        }

        foreach ($user->resumes as $resume) {
            if ($resume->image !== null) {
                Storage::delete('public/' . $resume->image);
            }
            $project->delete();
        }

        foreach ($user->vacancies as $vacancy) {
            $vacancy->delete();
        }

        if ($user->image !== null) {
            Storage::delete('public/' . $user->image);
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'The user deleted');
    }
}
