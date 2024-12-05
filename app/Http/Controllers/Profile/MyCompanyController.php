<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\CompanyAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Models\Category;
use App\Models\Company;
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
        $companies = Auth::user()->companies;

        return view('profile.pages.company.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'companies' => $companies,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('profile.pages.company.create', [
            'categories' => $categories,
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyAction->store($request, Auth::user()->id);

        return redirect()->route('mycompanies.index')->with('success', 'Компания "' . $company->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $company = Company::where('user_id', '=', Auth::user()->id)->with('categories')->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $sum =  ($company->address ? 10 : 0) +
            ($company->description ? 10 : 0) +
            ($company->image ? 10 : 0) +
            ($company->phone ? 5 : 0) +
            ($company->web ? 5 : 0) +
            ($company->viber ? 5 : 0) +
            ($company->whatsapp ? 5 : 0) +
            ($company->instagram ? 5 : 0) +
            ($company->vkontakte ? 5 : 0) +
            ($company->telegram ? 5 : 0) +
            ($company->name ? 5 : 0);

        $fullness = (round(($sum / 70) * 100));

        return view('profile.pages.company.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'company' => $company,
            'fullness' => $fullness,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function edit(Request $request, $id)
    {
        $company = Company::where('user_id', '=', Auth::user()->id)->with('categories')->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('profile.pages.company.edit', [
            'categories' => $categories,
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'company' => $company,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        $company = $this->companyAction->update($request, $company, Auth::user()->id);

        return redirect()->route('mycompanies.show', ['mycompany' => $company->id])->with('success', 'Компания "' . $company->name . '" обнавлена');
    }

    public function destroy($id)
    {
        $company = Company::with('events', 'projects', 'news', 'offers')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        if (count($company->offers) > 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У компании есть товары, необходимо удалить сначало их');
        }

        $this->companyAction->destroy($company);

        return redirect()->route('mycompanies.index')->with('success', 'Компания удалена');
    }
}
