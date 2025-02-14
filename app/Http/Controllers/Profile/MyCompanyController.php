<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\CompanyAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCompanyController extends BaseController
{
    public function __construct(private CompanyAction $companyAction)
    {
        parent::__construct();
        $this->companyAction = $companyAction;
    }


    public function index(Request $request)
    {
        $entitiesName = 'mycompanies';
        $entityName = 'mycompany';

        $companies = Auth::user()->entities()->companies()->with('primaryImage')->orderByDesc('updated_at')->paginate(10);

        return view('profile.pages.company.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'entities' => $companies,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::query()->companies()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('profile.pages.company.create', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categories' => $categories,
            'regions' => $this->regions,
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyAction->store($request, Auth::user()->id);

        return redirect()->route('mycompanies.index')->with('success', 'Компания "' . $company->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $sum =  ($entity->address ? 10 : 0) +
            ($entity->description ? 10 : 0) +
            ($entity->image ? 10 : 0) +
            ($entity->phone ? 5 : 0) +
            ($entity->web ? 5 : 0) +
            ($entity->whatsapp ? 5 : 0) +
            ($entity->instagram ? 5 : 0) +
            ($entity->vkontakte ? 5 : 0) +
            ($entity->telegram ? 5 : 0) +
            ($entity->name ? 5 : 0);

        $fullness = (round(($sum / 70) * 100));

        return view('profile.pages.company.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'entity' => $entity,
            'fullness' => $fullness,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $categories = Category::query()->companies()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('profile.pages.company.edit', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categories' => $categories,
            'regions' => $this->regions,
            'entity' => $entity,
        ]);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $entity = $this->companyAction->update($request, $entity, Auth::user()->id);

        return redirect()->route('mycompanies.show', ['mycompany' => $entity->id])->with('success', 'Компания "' . $entity->name . '" обнавлена');
    }

    public function destroy($id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $this->companyAction->destroy($entity);

        return redirect()->route('mycompanies.index')->with('success', 'Компания удалена');
    }
}
