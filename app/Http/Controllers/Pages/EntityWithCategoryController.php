<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use Illuminate\Http\Request;

class EntityWithCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function companies(Request $request, $category = null)
    {
        $region = $this->getRegion($request, null);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';

        $type = 1;

        if ($category) {
            $category = Category::active()->main()->companies()->select('id', 'transcription')->where('transcription', $category)->First();

            if ($category) {
                $categoryUri = $category->id;
            } else {
                return redirect()->route('companies.index');
            }
        }

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => $categoryUri,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'type' => $type,
        ]);
    }
    
    public function groups(Request $request, $category = null)
    {
        $region = $this->getRegion($request, null);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Группы';
        $entity = 'groups';

        $type = 2;

        if ($category) {
            $category = Category::active()->main()->groups()->select('id', 'transcription')->where('transcription', $category)->First();

            if ($category) {
                $categoryUri = $category->id;
            } else {
                return redirect()->route('groups.index');
            }
        }

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => $categoryUri,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function places(Request $request, $category = null)
    {
        $region = $this->getRegion($request, null);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entity = 'places';

        $type = 3;

        if ($category) {
            $category = Category::active()->main()->places()->select('id', 'transcription')->where('transcription', $category)->First();

            if ($category) {
                $categoryUri = $category->id;
            } else {
                return redirect()->route('places.index');
            }
        }

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => $categoryUri,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function communities(Request $request, $category = null)
    {
        $region = $this->getRegion($request, null);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entity = 'communities';

        $type = 4;

        if ($category) {
            $category = Category::active()->main()->communities()->select('id', 'transcription')->where('transcription', $category)->First();

            if ($category) {
                $categoryUri = $category->id;
            } else {
                return redirect()->route('communities.index');
            }
        }

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => $categoryUri,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }
}
