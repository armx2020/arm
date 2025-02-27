<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\UserAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseAdminController
{
    public function __construct(private UserAction $userAction)
    {
        parent::__construct();
        $this->userAction = $userAction;
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
        $this->userAction->store($request);

        return redirect()->route('admin.user.index')->with('success', 'Пользователь добавлен');
    }

    public function edit(User $user)
    {
        $entities = $user->entities()->with('primaryImage', 'city', 'region', 'category', 'type')->paginate(20);
        $entityName  = 'entity';
        $emptyEntity = 'сущностей нет';
        $selectedColumns = [
            'id',
            'img',
            'name',
            'type',
            'category_id',
            'city_id',
            'sort_id',
            'region_id',
            'address',
            'phone'
        ];
        return view('admin.user.edit', [
            'user' => $user,
            'menu' => $this->menu,
            'entities' => $entities,
            'selectedColumns' => $selectedColumns,
            'entityName' => $entityName,
            'emptyEntity' => $emptyEntity
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userAction->update($request, $user);

        return redirect()->route('admin.user.edit', ['user' => $user->id])
            ->with('success', "Пользователь обнавлён");
    }

    public function destroy(string $id)
    {
        $user = User::with(
            'entities',
        )->find($id);

        if (empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'Пользователь не найден');
        }

        foreach ($user->entities as $entity) {
            if ($entity->image) {
                Storage::delete('public/' . $entity->image);
            }
            $entity->delete();
        }

        if ($user->image !== null) {
            Storage::delete('public/' . $user->image);
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Пользователь удалён');
    }
}
