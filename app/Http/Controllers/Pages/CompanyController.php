<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $category = null, $subCategory = null)
    {
        $region = $this->getRegion($request, null);

        $entities = Entity::query()->active()->companies()->with('fields', 'offers')->withCount('offers');
        $categories = Category::query()->main()->active()->companies()->get();
        $subCategories = null;

        if ($category) {
            $category = Category::active()->main()->companies()->select('id', 'transcription')->where('transcription', $category)->First();

            if ($category) {
                $category_id = $category->id;
                $subCategories = Category::where('category_id', $category_id)->get();
            } else {
                return redirect()->route('region.companies', ['regionTranslit' => $region->transcription]);
            }

            if ($subCategory) {
                $subCategory = Category::active()->companies()->select('id', 'transcription')->where('transcription', $subCategory)->First();

                if ($subCategory) {
                    $subCategory_id = $subCategory->id;
                } else {
                    return redirect()->route('region.companies', ['regionTranslit' => $region->transcription]);
                }

                $entities = $entities
                    ->where(function (Builder $query) use ($category_id, $subCategory_id) {
                        $query
                            ->where('category_id', $category_id) // ID категории
                            ->whereHas('fields', function ($que) use ($subCategory_id) {
                                $que->where('category_entity.category_id', '=', $subCategory_id); // ID подкатегории
                            });
                    });
            } else {
                $entities = $entities
                    ->where(function (Builder $query) use ($category_id) {
                        $query
                            ->where('category_id', $category_id) // ID категории
                            ->orWhereHas('fields', function ($que) use ($category_id) {
                                $que->where('category_entity.main_category_id', '=', $category_id); // ID категории
                            });
                    });
            }
        }

        $entities = $entities->orderByDesc('sort_id')->paginate($this->quantityOfDisplayed);

        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';
        $entityName = 'companies';
        $entityShowRout = 'company.show';

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entityShowRout' => $entityShowRout,
            'entities' => $entities,
            'selectedCategory' => $category,
            'categories' => $categories,
            'selectedSubCategory' => $subCategory,
            'subCategories' => $subCategories
        ]);
    }

    public function region(Request $request, $regionTranslit = null, $category = null, $subCategory = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $entities = Entity::query()->active()->companies()->with('fields', 'offers')->withCount('offers');
        $categories = Category::query()->main()->active()->companies()->get();
        $subCategories = null;

        if ($regionTranslit) {
            $entities = $entities->orderByRaw("FIELD(`region_id`, $region->id) DESC")->orderBy('offers_count', 'desc');
        }

        if ($category) {
            $category = Category::active()->main()->companies()->select('id', 'transcription')->where('transcription', $category)->First();

            if ($category) {
                $category_id = $category->id;
                $subCategories = Category::where('category_id', $category_id)->get();
            } else {
                return redirect()->route('region.companies', ['regionTranslit' => $region->transcription]);
            }

            if ($subCategory) {
                $subCategory = Category::active()->companies()->select('id', 'transcription')->where('transcription', $subCategory)->First();

                if ($subCategory) {
                    $subCategory_id = $subCategory->id;
                } else {
                    return redirect()->route('region.companies', ['regionTranslit' => $region->transcription]);
                }

                $entities = $entities
                    ->where(function (Builder $query) use ($category_id, $subCategory_id) {
                        $query
                            ->where('category_id', $category_id) // ID категории
                            ->whereHas('fields', function ($que) use ($subCategory_id) {
                                $que->where('category_entity.category_id', '=', $subCategory_id); // ID подкатегории
                            });
                    });
            } else {
                $entities = $entities
                    ->where(function (Builder $query) use ($category_id) {
                        $query
                            ->where('category_id', $category_id) // ID категории
                            ->orWhereHas('fields', function ($que) use ($category_id) {
                                $que->where('category_entity.main_category_id', '=', $category_id); // ID категории
                            });
                    });
            }
        }

        $entities = $entities->orderByDesc('sort_id')->paginate($this->quantityOfDisplayed);

        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';
        $entityName = 'companies';
        $entityShowRout = 'company.show';

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entityShowRout' => $entityShowRout,
            'entities' => $entities,
            'selectedCategory' => $category,
            'categories' => $categories,
            'selectedSubCategory' => $subCategory,
            'subCategories' => $subCategories
        ]);
    }
}
