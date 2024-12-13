<?php

namespace App\Http\Controllers;

use App\Entity\Actions\CompanyAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class InformUsController extends BaseController
{
    public $secondPositionUrl = 'inform-us';
    public $secondPositionName = 'Сообщите нам';
    public $cities;

    public function __construct(private CompanyAction $companyAction)
    {
        $this->cities = City::all();
        $this->companyAction = $companyAction;

        parent::__construct();
    }

    public function index(Request $request, $entity)
    {
        switch ($entity) {
            case "company":
                return $this->createCompanyForm($request);
                break;
            default:
                return redirect()->route('home');
        }
    }

    private function createCompanyForm($request)
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

    public function storeCompany(StoreCompanyRequest $request)
    {
        $company = $this->companyAction->store($request, null, false);

        return redirect()->route('inform-us', ['entity' => 'company'])->with('success', 'Ваша заявка успешно принята');
    }
}
