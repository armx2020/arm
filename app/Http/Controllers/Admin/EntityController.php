<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\Entity\StoreEntityRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\EntityType;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EntityController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $categorieForOffer = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();
        $categoriesForGroup = Category::query()->group()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();
        $typies = EntityType::all();
        $users = User::all();

        return view('admin.entity.create', [
            'users' => $users,
            'menu' => $this->menu,
            'categorieForOffer' => $categorieForOffer,
            'categoriesForGroup' => $categoriesForGroup,
            'typies' => $typies
        ]);
    }

    public function store(StoreEntityRequest $request)
    {
        $this->entityAction->store($request, $request->user ?: 1);

        return redirect()->route('admin.company.index')->with('success', 'Компания добавлена');
    }

    public function edit(Company $company)
    {
        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();
        $users = User::all();

        return view('admin.company.edit', ['company' => $company, 'users' => $users, 'menu' => $this->menu, 'categories' => $categories]);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company = $this->entityAction->update($request, $company, $request->user ?: 1);

        return redirect()->route('admin.company.edit', ['company' => $company->id])
            ->with('success', "Компания сохранена");
    }

    public function destroy(Company $company)
    {
        if (count($company->offers) > 0) {
            return redirect()->route('admin.company.index')->with('alert', 'У компании есть предложения, удалите сначала их');
        }

        foreach ($company->events as $event) {
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $event->delete();
        }

        foreach ($company->news as $news) {
            if ($news->image) {
                Storage::delete('public/' . $news->image);
            }
            $news->delete();
        }

        foreach ($company->projects as $project) {
            if ($project->image !== null) {
                Storage::delete('public/' . $project->image);
            }
            $project->delete();
        }

        foreach ($company->works as $work) {
            $work->delete();
        }

        if ($company->image !== null) {
            Storage::delete('public/' . $company->image);
        }

        $company->delete();

        return redirect()->route('admin.company.index')->with('success', 'Компания удалена');
    }
}
