<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InformUsController extends BaseController
{
    public $secondPositionUrl = 'inform-us';
    public $secondPositionName = 'Сообщите нам';
    public $cities;

    public function __construct()
    {
        $this->cities = City::all();

        parent::__construct();
    }

    public function index(Request $request, $entity)
    {
        switch ($entity) {
            case "company":
                return $this->createCompaniesForm($request);
                break;
            default:
                return redirect()->route('home');
        }
    }

    private function createCompaniesForm($request)
    {
        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-company', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
            'categories' => $categories

        ]);
    }

    public function store(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            $user - new User();
            $user->firstname = $request->firstname;
            $user->phone = $request->phone;
            $user->password = Hash::make('0000'); // 0000
            $user->save();
        }

        switch ($request->category) {
            case 'companies':
                $entity = new Company();
                break;
            case 'places':
                $entity = new Group();
                break;
            case 'groups':
                $entity = new Group();
                break;
            case 'projects':
                $entity = new Group();
                break;
            default:
                $entity = new Group();
                break;
        }

        $entity->activity = false;
        $entity->name = $request->name;
        $entity->description = $request->description;
        $entity->user_id = $user->id;
        $entity->phone = $user->phone;
        $entity->save();



        return redirect()->route('inform-us')->with('success', 'Ваша заявка успешно принята');
    }
}
