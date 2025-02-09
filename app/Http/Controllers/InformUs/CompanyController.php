<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\CompanyAction;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CompanyController extends BaseInformUsController
{

    public function __construct(private CompanyAction $companyAction)
    {
        $this->companyAction = $companyAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $categories = Category::query()->companies()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-company', [
            'region'   => $request->session()->get('region'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'cities' => $this->cities,
            'secondPositionUrl' => 'inform-us.company',
            'secondPositionName' => $this->secondPositionName,
            'categories' => $categories,

        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $fields = $request->fields;
        $company = $this->companyAction->store($request, null, false);

        return redirect()->route('inform-us.company')->with('success', 'Ваша заявка успешно принята');
    }
}
