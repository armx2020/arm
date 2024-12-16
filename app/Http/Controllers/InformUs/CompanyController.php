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
        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-company', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
            'categories' => $categories,

        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyAction->store($request, null, false);

        return redirect()->route('inform-us.company')->with('success', 'Ваша заявка успешно принята');
    }
}
