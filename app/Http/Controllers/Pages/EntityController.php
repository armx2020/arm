<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function companies(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';

        $type = 1;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'type' => $type,
        ]);
    }
    public function groups(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Группы';
        $entity = 'groups';

        $type = 2;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function places(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entity = 'places';

        $type = 3;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function communities(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entity = 'communities';

        $type = 4;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function show(Request $request, Entity $entity)
    {
        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'communities';

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function company(Request $request, Entity $entity)
    {
        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Бизнес - справочник';
        $entityName = 'companies';

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function group(Request $request, Entity $entity)
    {
        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'groups';

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function place(Request $request, Entity $entity)
    {
        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entityName = 'places';

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function community(Request $request, Entity $entity)
    {
        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'communities';

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }
}
